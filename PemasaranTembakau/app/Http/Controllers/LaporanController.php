<?php

namespace App\Http\Controllers;

use App\Models\BarangPanen;
use App\Models\ItemPemesanan;
use App\Models\Pemesanan;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;

class LaporanController extends Controller
{

    public function index(Request $request)
    {
        $user = Auth::id(); // Ambil ID pengguna yang sedang login
        // Filter untuk grafik laporan
        $filter = $request->get('filter', 'day');

        switch ($filter) {
            case 'month':
                $reports = Pemesanan::select(DB::raw('MIN(DATE_FORMAT(created_at, "%M")) as period'), DB::raw('SUM(total_harga) as total_harga'))
                    ->groupBy(DB::raw('MONTH(created_at)'))
                    ->where('status', 'Sudah')
                    ->get()
                    ->map(function ($item) {
                        $item->period = $this->getIndonesianMonth($item->period);
                        return $item;
                    });
                break;

            case 'year':
                $reports = Pemesanan::select(DB::raw('YEAR(created_at) as period'), DB::raw('SUM(total_harga) as total_harga'))
                    ->groupBy(DB::raw('YEAR(created_at)'))
                    ->where('status', 'Sudah')
                    ->get();
                break;

            default: // day
                $reports = Pemesanan::select(DB::raw('MIN(DATE_FORMAT(created_at, "%d %M %Y")) as period'), DB::raw('SUM(total_harga) as total_harga'))
                    ->groupBy(DB::raw('DATE(created_at)'))
                    ->where('status', 'Sudah')
                    ->get()
                    ->map(function ($item) {
                        $item->period = $this->convertToIndonesianDate($item->period);
                        return $item;
                    });
                break;
        }

        // Ambil filter dari request untuk penjualan
        $salesFilter = $request->input('sales_filter', 'today');

        // Inisialisasi rentang tanggal untuk total penjualan
        $startDate = Carbon::today();
        $endDate = Carbon::today();

        // Tentukan rentang tanggal berdasarkan filter untuk penjualan
        if ($salesFilter === 'month') {
            $startDate = Carbon::now()->startOfMonth();
            $endDate = Carbon::now()->endOfMonth();
        } elseif ($salesFilter === 'year') {
            $startDate = Carbon::now()->startOfYear();
            $endDate = Carbon::now()->endOfYear();
        } elseif ($salesFilter === 'custom') {
            $startDate = Carbon::parse($request->input('start_date'));
            $endDate = Carbon::parse($request->input('end_date'));
        }

        // Menghitung jumlah barang terjual berdasarkan rentang tanggal
        $totalSales = ItemPemesanan::whereBetween('created_at', [$startDate, $endDate])
            ->get()
            ->sum(function ($item) {
                // Decode JSON 'keranjang' jika itu adalah string JSON
                $keranjang = json_decode($item->keranjang, true);

                // Pastikan 'jumlah' ada sebelum mengembalikannya
                return $keranjang['jumlah'] ?? 0; // Jika tidak ada, kembalikan 0
            });





        // Mengambil data untuk tabel berdasarkan tanggal pemesanan
        $pemesanan = $this->filterDataByDate($request)->paginate(5);

        // Mengambil pemesanan terbaru dengan status
        $recentSales = Pemesanan::where('status', 'Sudah')->latest()->take(5)->get();

        // Mengambil item terlaris berdasarkan jumlah penjualan
        $topSellingDetails = $this->getTopSellingDetails();
        $salesPeriod = ($salesFilter === 'custom') ? "{$startDate->format('Y-m-d')} to {$endDate->format('Y-m-d')}" : ucfirst($filter);

        return view('BackEnd.laporan', compact('reports', 'recentSales','user', 'topSellingDetails', 'salesPeriod', 'filter', 'pemesanan', 'totalSales', 'salesFilter', 'startDate', 'endDate'));
    }

    public function admin(Request $request)
    {
        $user = Auth::id(); // Ambil ID pengguna yang sedang login
        
        // Filter untuk grafik laporan
        $filter = $request->get('filter', 'day');

        switch ($filter) {
            case 'month':
                $reports = Pemesanan::select(DB::raw('MIN(DATE_FORMAT(created_at, "%M")) as period'), DB::raw('SUM(total_harga) as total_harga'))
                    ->groupBy(DB::raw('MONTH(created_at)'))
                    ->where('status', 'Sudah')
                    ->get()
                    ->map(function ($item) {
                        $item->period = $this->getIndonesianMonth($item->period);
                        return $item;
                    });
                break;

            case 'year':
                $reports = Pemesanan::select(DB::raw('YEAR(created_at) as period'), DB::raw('SUM(total_harga) as total_harga'))
                    ->groupBy(DB::raw('YEAR(created_at)'))
                    ->where('status', 'Sudah')
                    ->get();
                break;

            default: // day
                $reports = Pemesanan::select(DB::raw('MIN(DATE_FORMAT(created_at, "%d %M %Y")) as period'), DB::raw('SUM(total_harga) as total_harga'))
                    ->groupBy(DB::raw('DATE(created_at)'))
                    ->where('status', 'Sudah')
                    ->get()
                    ->map(function ($item) {
                        $item->period = $this->convertToIndonesianDate($item->period);
                        return $item;
                    });
                break;
        }

         //Revenue
         $filterRevenue = $request->get('filterRevenue', 'day');

         // Inisialisasi rentang tanggal untuk total harga
         $startDate = Carbon::today();
         $endDate = Carbon::today();
 
         // Tentukan rentang tanggal berdasarkan filter untuk laporan
         if ($filterRevenue === 'month') {
             $startDate = Carbon::now()->startOfMonth();
             $endDate = Carbon::now()->endOfMonth();
         } elseif ($filterRevenue === 'year') {
             $startDate = Carbon::now()->startOfYear();
             $endDate = Carbon::now()->endOfYear();
         } else {
             // Default ke hari ini
             $startDate = Carbon::today();
             $endDate = Carbon::today();
         }
 
         // Mengambil laporan berdasarkan rentang tanggal
         $hasil = Pemesanan::select(DB::raw('SUM(total_harga) as total_harga'))
             ->where('status', 'Sudah')
             ->whereBetween('tgl_pmsan', [$startDate, $endDate]) // Filter berdasarkan rentang tanggal
             ->groupBy(DB::raw('DATE(tgl_pmsan)')) // Mengelompokkan berdasarkan tanggal
             ->get();
 
         // Ambil total_harga berdasarkan rentang tanggal
         $totalHarga = $hasil->sum('total_harga');
 
 
        // Ambil filter dari request untuk penjualan
        $salesFilter = $request->input('sales_filter', 'today');

        // Inisialisasi rentang tanggal untuk total penjualan
        $startDate = Carbon::today();
        $endDate = Carbon::today();

        // Tentukan rentang tanggal berdasarkan filter untuk penjualan
        if ($salesFilter === 'month') {
            $startDate = Carbon::now()->startOfMonth();
            $endDate = Carbon::now()->endOfMonth();
        } elseif ($salesFilter === 'year') {
            $startDate = Carbon::now()->startOfYear();
            $endDate = Carbon::now()->endOfYear();
        } else
        {
            $startDate = Carbon::today();
            $endDate =Carbon::today();
        }

        // Menghitung jumlah barang terjual berdasarkan rentang tanggal
        $totalSales = ItemPemesanan::join('keranjangs', 'item_pmsan.keranjang_id', '=', 'keranjangs.id')
            ->join('pemesanan', 'item_pmsan.pemesanan_id', '=', 'pemesanan.id_pmsan')
            ->whereBetween('pemesanan.tgl_pmsan', [$startDate, $endDate]) // Filter berdasarkan rentang tanggal
            ->select(DB::raw('SUM(keranjangs.jumlah) as total_sold'))
            ->where('keranjangs.pembayaran', '=', 'iya') // Hanya data dengan pembayaran sukses
            ->where('pemesanan.status', '=', 'Sudah') // Pastikan status pemesanan "Sudah"
            ->groupBy('keranjangs.barang_id')
            ->orderBy('total_sold', 'desc')
            ->get();


        // Mengambil data untuk tabel berdasarkan tanggal pemesanan
        $pemesanan = $this->filterDataByDate($request)->paginate(5);

        // Mengambil pemesanan terbaru dengan status 'iya'
        $recentSales = Pemesanan::with('user') // Pastikan 'user' adalah relasi yang tepat
        ->where('status', 'Sudah')
        ->latest()
        ->take(5)
        ->get();


        // Mengambil item terlaris berdasarkan jumlah penjualan
        $topSellingDetails = $this->getTopSellingDetails();
        $salesPeriod = ($salesFilter === 'custom') ? "{$startDate->format('Y-m-d')} to {$endDate->format('Y-m-d')}" : ucfirst($filter);

        return view('BackEnd.home', compact('reports', 'recentSales','user', 'topSellingDetails', 'salesPeriod', 'filter', 'pemesanan', 'totalSales', 'salesFilter', 'filterRevenue','totalHarga', 'startDate', 'endDate'));

    }
    // Helper function untuk item terlaris
    
    public function sale(Request $request)
    {
        $user = Auth::id(); // Ambil ID pengguna yang sedang login
        
        // Filter untuk grafik laporan
        $filter = $request->get('filter', 'day');

        switch ($filter) {
            case 'month':
                $reports = Pemesanan::select(DB::raw('MIN(DATE_FORMAT(created_at, "%M")) as period'), DB::raw('SUM(total_harga) as total_harga'))
                    ->groupBy(DB::raw('MONTH(created_at)'))
                    ->where('status', 'Sudah')
                    ->get()
                    ->map(function ($item) {
                        $item->period = $this->getIndonesianMonth($item->period);
                        return $item;
                    });
                break;

            case 'year':
                $reports = Pemesanan::select(DB::raw('YEAR(created_at) as period'), DB::raw('SUM(total_harga) as total_harga'))
                    ->groupBy(DB::raw('YEAR(created_at)'))
                    ->where('status', 'Sudah')
                    ->get();
                break;

            default: // day
                $reports = Pemesanan::select(DB::raw('MIN(DATE_FORMAT(created_at, "%d %M %Y")) as period'), DB::raw('SUM(total_harga) as total_harga'))
                    ->groupBy(DB::raw('DATE(created_at)'))
                    ->where('status', 'Sudah')
                    ->get()
                    ->map(function ($item) {
                        $item->period = $this->convertToIndonesianDate($item->period);
                        return $item;
                    });
                break;
        }

         //Revenue
         $filterRevenue = $request->get('filterRevenue', 'day');

         // Inisialisasi rentang tanggal untuk total harga
         $startDate = Carbon::today();
         $endDate = Carbon::today();
 
         // Tentukan rentang tanggal berdasarkan filter untuk laporan
         if ($filterRevenue === 'month') {
             $startDate = Carbon::now()->startOfMonth();
             $endDate = Carbon::now()->endOfMonth();
         } elseif ($filterRevenue === 'year') {
             $startDate = Carbon::now()->startOfYear();
             $endDate = Carbon::now()->endOfYear();
         } else {
             // Default ke hari ini
             $startDate = Carbon::today();
             $endDate = Carbon::today();
         }
 
         // Mengambil laporan berdasarkan rentang tanggal
         $hasil = Pemesanan::select(DB::raw('SUM(total_harga) as total_harga'))
             ->where('status', 'Sudah')
             ->whereBetween('tgl_pmsan', [$startDate, $endDate]) // Filter berdasarkan rentang tanggal
             ->groupBy(DB::raw('DATE(tgl_pmsan)')) // Mengelompokkan berdasarkan tanggal
             ->get();
 
         // Ambil total_harga berdasarkan rentang tanggal
         $totalHarga = $hasil->sum('total_harga');
 
 
        // Ambil filter dari request untuk penjualan
        $salesFilter = $request->input('sales_filter', 'today');

        // Inisialisasi rentang tanggal untuk total penjualan
        $startDate = Carbon::today();
        $endDate = Carbon::today(); // atau bisa Anda set ke tanggal lain jika perlu
        

        // Tentukan rentang tanggal berdasarkan filter untuk penjualan
        if ($salesFilter === 'month') {
            $startDate = Carbon::now()->startOfMonth();
            $endDate = Carbon::now()->endOfMonth();
        } elseif ($salesFilter === 'year') {
            $startDate = Carbon::now()->startOfYear();
            $endDate = Carbon::now()->endOfYear();
        } elseif ($salesFilter === 'today') {
            // Tidak perlu mengubah startDate dan endDate karena sudah diinisialisasi untuk hari ini
            // Jika ingin lebih eksplisit, bisa diatur lagi
            $startDate = Carbon::today();
            $endDate = Carbon::today();
        } else {
            // Jika filter tidak dikenali, default ke hari ini
            $startDate = Carbon::today();
            $endDate = Carbon::today();
        }

        // Selanjutnya, Anda dapat menggunakan $startDate dan $endDate untuk query penjualan


        // Menghitung jumlah barang terjual berdasarkan rentang tanggal
        $totalSales = ItemPemesanan::join('keranjangs', 'item_pmsan.keranjang_id', '=', 'keranjangs.id')
            ->join('pemesanan', 'item_pmsan.pemesanan_id', '=', 'pemesanan.id_pmsan')
            ->whereBetween('pemesanan.tgl_pmsan', [$startDate, $endDate]) // Filter berdasarkan rentang tanggal
            ->select(DB::raw('SUM(keranjangs.jumlah) as total_sold'))
            ->where('keranjangs.pembayaran', '=', 'iya') // Hanya data dengan pembayaran sukses
            ->where('pemesanan.status', '=', 'Sudah') // Pastikan status pemesanan "Sudah"
            ->groupBy('keranjangs.barang_id')
            ->orderBy('total_sold', 'desc')
            ->get();


        // Mengambil data untuk tabel berdasarkan tanggal pemesanan
        $pemesanan = $this->filterDataByDate($request)->paginate(5);

        // Mengambil pemesanan terbaru dengan status 'iya'
        $recentSales = Pemesanan::where('status', 'Sudah')->latest()->take(5)->get();

        // Mengambil item terlaris berdasarkan jumlah penjualan
        $topSellingDetails = $this->getTopSellingDetails();
        $salesPeriod = ($salesFilter === 'custom') ? "{$startDate->format('Y-m-d')} to {$endDate->format('Y-m-d')}" : ucfirst($filter);

        return view('BackEnd.home', compact('reports', 'recentSales','user', 'topSellingDetails', 'salesPeriod', 'filter', 'pemesanan', 'totalSales', 'salesFilter', 'filterRevenue','totalHarga', 'startDate', 'endDate'));

    }


    public function revenue(Request $request)
    {
        $user = Auth::id(); // Ambil ID pengguna yang sedang login
        
        // Filter untuk grafik laporan
        $filter = $request->get('filter', 'day');

        switch ($filter) {
            case 'month':
                $reports = Pemesanan::select(DB::raw('MIN(DATE_FORMAT(created_at, "%M")) as period'), DB::raw('SUM(total_harga) as total_harga'))
                    ->groupBy(DB::raw('MONTH(created_at)'))
                    ->where('status', 'Sudah')
                    ->get()
                    ->map(function ($item) {
                        $item->period = $this->getIndonesianMonth($item->period);
                        return $item;
                    });
                break;

            case 'year':
                $reports = Pemesanan::select(DB::raw('YEAR(created_at) as period'), DB::raw('SUM(total_harga) as total_harga'))
                    ->groupBy(DB::raw('YEAR(created_at)'))
                    ->where('status', 'Sudah')
                    ->get();
                break;

            default: // day
                $reports = Pemesanan::select(DB::raw('MIN(DATE_FORMAT(created_at, "%d %M %Y")) as period'), DB::raw('SUM(total_harga) as total_harga'))
                    ->groupBy(DB::raw('DATE(created_at)'))
                    ->where('status', 'Sudah')
                    ->get()
                    ->map(function ($item) {
                        $item->period = $this->convertToIndonesianDate($item->period);
                        return $item;
                    });
                break;
        }
        
        //Revenue
        $filterRevenue = $request->get('filterRevenue', 'day');

        // Inisialisasi rentang tanggal untuk total harga
        $startDate = Carbon::today();
        $endDate = Carbon::today();

        // Tentukan rentang tanggal berdasarkan filter untuk laporan
        if ($filterRevenue === 'month') {
            $startDate = Carbon::now()->startOfMonth();
            $endDate = Carbon::now()->endOfMonth();
        } elseif ($filterRevenue === 'year') {
            $startDate = Carbon::now()->startOfYear();
            $endDate = Carbon::now()->endOfYear();
        } else {
            // Default ke hari ini
            $startDate = Carbon::today();
            $endDate = Carbon::today();
        }

        // Mengambil laporan berdasarkan rentang tanggal
        $hasil = Pemesanan::select(DB::raw('SUM(total_harga) as total_harga'))
            ->where('status', 'Sudah')
            ->whereBetween('tgl_pmsan', [$startDate, $endDate]) // Filter berdasarkan rentang tanggal
            ->groupBy(DB::raw('DATE(tgl_pmsan)')) // Mengelompokkan berdasarkan tanggal
            ->get();

        // Ambil total_harga berdasarkan rentang tanggal
        $totalHarga = $hasil->sum('total_harga');


        //penjualaan
        // Ambil filter dari request untuk penjualan
        $salesFilter = $request->input('sales_filter', 'today');

        // Inisialisasi rentang tanggal untuk total penjualan
        $startDate = Carbon::today();
        $endDate = Carbon::today();

        // Tentukan rentang tanggal berdasarkan filter untuk penjualan
        if ($salesFilter === 'month') {
            $startDate = Carbon::now()->startOfMonth();
            $endDate = Carbon::now()->endOfMonth();
        } elseif ($salesFilter === 'year') {
            $startDate = Carbon::now()->startOfYear();
            $endDate = Carbon::now()->endOfYear();
        } else
        {
            $startDate = Carbon::today();
            $endDate =Carbon::today();
        }

        // Menghitung jumlah barang terjual berdasarkan rentang tanggal
        $totalSales = ItemPemesanan::join('keranjangs', 'item_pmsan.keranjang_id', '=', 'keranjangs.id')
            ->join('pemesanan', 'item_pmsan.pemesanan_id', '=', 'pemesanan.id_pmsan')
            ->whereBetween('pemesanan.tgl_pmsan', [$startDate, $endDate]) // Filter berdasarkan rentang tanggal
            ->select(DB::raw('SUM(keranjangs.jumlah) as total_sold'))
            ->where('keranjangs.pembayaran', '=', 'iya') // Hanya data dengan pembayaran sukses
            ->where('pemesanan.status', '=', 'Sudah') // Pastikan status pemesanan "Sudah"
            ->groupBy('keranjangs.barang_id')
            ->orderBy('total_sold', 'desc')
            ->get();


        // Mengambil data untuk tabel berdasarkan tanggal pemesanan
        $pemesanan = $this->filterDataByDate($request)->paginate(5);

        // Mengambil pemesanan terbaru dengan status 'iya'
        $recentSales = Pemesanan::where('status', 'Sudah')->latest()->take(5)->get();

        // Mengambil item terlaris berdasarkan jumlah penjualan
        $topSellingDetails = $this->getTopSellingDetails();
        $salesPeriod = ($salesFilter === 'custom') ? "{$startDate->format('Y-m-d')} to {$endDate->format('Y-m-d')}" : ucfirst($filter);

        return view('BackEnd.home', compact('reports', 'recentSales','user', 'topSellingDetails', 'salesPeriod', 'filter', 'pemesanan', 'totalSales', 'salesFilter', 'filterRevenue','totalHarga', 'startDate', 'endDate'));
    }


    private function getTopSellingDetails()
    {
        $topSelling = ItemPemesanan::join('keranjangs', 'item_pmsan.keranjang_id', '=', 'keranjangs.id')
        ->join('pemesanan', 'item_pmsan.pemesanan_id', '=', 'pemesanan.id_pmsan')
        ->select('keranjangs.barang_id', DB::raw('SUM(keranjangs.jumlah) as total_sold'))
        ->where('keranjangs.pembayaran', '=', 'iya') // Pastikan status berasal dari tabel keranjangs
        ->where('pemesanan.status', '=', 'Sudah')
        ->groupBy('keranjangs.barang_id')
        ->orderBy('total_sold', 'desc')
        ->take(5)
        ->get();
    

        $topSellingDetails = [];
        foreach ($topSelling as $item) {
            $barang = BarangPanen::find($item->barang_id);
            if ($barang) {
                $topSellingDetails[] = [
                    'barang' => $barang,
                    'total_sold' => $item->total_sold,
                ];
            }
        }

        return $topSellingDetails;
    }


    public function up()
    {
        Schema::table('item_pmsan', function (Blueprint $table) {
            $table->unsignedBigInteger('barang_id')->after('some_column'); // Specify the right position
        });
    }

    public function down()
    {
        Schema::table('item_pmsan', function (Blueprint $table) {
            $table->dropColumn('barang_id');
        });
    }

    // Helper function to convert English month names to Indonesian
    private function getIndonesianMonth($month)
    {
        $englishMonths = [
            'January',
            'February',
            'March',
            'April',
            'May',
            'June',
            'July',
            'August',
            'September',
            'October',
            'November',
            'December'
        ];

        $indonesianMonths = [
            'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        ];

        return str_replace($englishMonths, $indonesianMonths, $month);
    }

    // Helper function to convert a full date string into Indonesian
    private function convertToIndonesianDate($date)
    {
        return str_replace(
            ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
            ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
            $date
        );
    }



    // Jangan tambahkan get() di sini, biarkan query builder yang diteruskan ke paginate()
    private function filterDataByDate(Request $request)
    {
        $query = Pemesanan::query();

        // Filter berdasarkan tanggal jika ada
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('tgl_pmsan', [$request->start_date, $request->end_date]);
        }

        // Tambahkan filter untuk hanya menampilkan pemesanan dengan status 'Sudah'
        $query->where('status', 'Sudah');

        // Kembalikan query tanpa get(), cukup dengan paginate di view yang memanggilnya
        return $query;
    }

    private function filterDataByDatePDF(Request $request)
    {
        $query = Pemesanan::query();

        // Filter berdasarkan tanggal jika ada
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('tgl_pmsan', [$request->start_date, $request->end_date]);
        }
        // Tambahkan filter untuk hanya menampilkan pemesanan dengan status 'Sudah'
        $query->where('status', 'Sudah');
        // Kembalikan query tanpa get(), cukup dengan paginate di view yang memanggilnya
        return $query->get();
    }

    public function filter_table(Request $request)
    {
        // Memanggil filterDataByDate() dan menerapkan paginate(5)
        $pemesanan = $this->filterDataByDate($request)->paginate(5);

        // Kembalikan view dengan data yang sudah dipaginate
        return view('BackEnd.laporan', compact('pemesanan'));
    }

    public function exportPdf(Request $request)
    {
        // Filter data untuk tabel laporan berdasarkan tanggal
        $pemesanan = $this->filterDataByDatePDF($request);

        // Tangkap rentang tanggal dari request
        $startDate = $request->start_date;
        $endDate = $request->end_date;

        // Buat PDF menggunakan DomPDF dengan view 'BackEnd.laporan_pdf'
        $pdf = Pdf::loadView('BackEnd.laporan_pdf', compact('pemesanan', 'startDate', 'endDate'));

        // Download file PDF dengan nama yang sesuai
        return $pdf->download('laporan_pemesanan.pdf');
    }
    public function getSalesData(Request $request)
    {
        // Ambil filter dari request
        $filter = $request->input('filter', 'today');

        // Inisialisasi rentang tanggal
        $startDate = Carbon::today();
        $endDate = Carbon::today();

        // Tentukan rentang tanggal berdasarkan filter
        if ($filter === 'month') {
            $startDate = Carbon::now()->startOfMonth();
            $endDate = Carbon::now()->endOfMonth();
        } elseif ($filter === 'year') {
            $startDate = Carbon::now()->startOfYear();
            $endDate = Carbon::now()->endOfYear();
        } elseif ($filter === 'custom') {
            $startDate = Carbon::parse($request->input('start_date'));
            $endDate = Carbon::parse($request->input('end_date'));
        }

        // Menghitung jumlah barang terjual berdasarkan rentang tanggal
        //error
        $totalSales = ItemPemesanan::whereBetween('created_at', [$startDate, $endDate])
            ->sum('keranjang->jumlah');

        return view('admin.laporan.index', [
            'totalSales' => $totalSales,
            'salesPeriod' => ($filter === 'custom') ? "{$startDate->format('Y-m-d')} to {$endDate->format('Y-m-d')}" : ucfirst($filter),
            'filter' => $filter,
            'startDate' => $startDate->format('Y-m-d'),
            'endDate' => $endDate->format('Y-m-d'),
        ]);
    }



    // Helper function to filter pemesanan data by date
}