<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function register()
    {
        return view('sign-up');
    }

    public function akun(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'alamat' => 'required|string|max:255',
            'telepon' => 'required|string|max:20',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Simpan data ke database
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Encrypt password
            'alamat' => $request->alamat,
            'telepon' => $request->telepon,
            'kota' => null,
        ]);

        $tahapan = [

            [
                'tahap' => 1,
                'nama_tahap' => 'Penyemaian',
                'deskripsi' => 'Pada tahap penyemaian, benih tembakau disebar di sekitar tanah dan menunggu waktu satu bulan.',
                'mulai' => 1,
                'selesai' => 30
            ],
            [
                'tahap' => 2,
                'nama_tahap' => 'Pemindahan dan Penumbuhan Tray',
                'deskripsi' => 'Pemindahan tembakau dari ladang ke Tray. Tahap ini berlangsung selama 15 hari sampai bibit mencapai tinggi sekitar 15 cm, siap untuk dipindahkan ke ladang.',
                'mulai' => 31,
                'selesai' => 45
            ],
            [
                'tahap' => 3,
                'nama_tahap' => 'Pemindahan Bibit ke Ladang',
                'deskripsi' => 'Bibit yang sudah berumur 45 hari dipindahkan ke lahan pertanian. Sebelum pemindahan, lahan harus sudah dipersiapkan dengan lubang tanam (bisa menggunakan tanah kompos) dengan dalam lubang 15 cm dan diberikan pupuk organik. Pemindahan dilakukan dengan hati-hati agar tanaman dapat tumbuh dengan baik di lahan.',
                'mulai' => 46,
                'selesai' => 46
            ],
            [
                'tahap' => 4,
                'nama_tahap' => 'Tahap Pertumbuhan Awal',
                'deskripsi' => 'Pada minggu pertama setelah penanaman, tanaman dibiarkan selama seminggu untuk beradaptasi dengan lingkungan baru di ladang.',
                'mulai' => 47,
                'selesai' => 53
            ],
            [
                'tahap' => 5,
                'nama_tahap' => 'Pemupukan Pertama',
                'deskripsi' => 'Pada minggu pertama setelah adaptasi pertumbuhan awal, tanaman mulai beradaptasi dengan lingkungan baru di ladang. Pada periode ini, dilakukan pemupukan pertama menggunakan pupuk kimia (dapat berupa pupuk NPK) dengan cara disiram menggunakan cairan air yang sudah dicampur pupuk kimia dengan dosis 2 cangkir per 25 liter air. Pemupukan pertama bertujuan untuk mempercepat adaptasi dan pertumbuhan akar tanaman.',
                'mulai' => 54,
                'selesai' => 54
            ],
            [
                'tahap' => 6,
                'nama_tahap' => 'Tahap Pertumbuhan Dua',
                'deskripsi' => 'Pada minggu pertama setelah penanaman, tanaman dibiarkan selama dua minggu di ladang.',
                'mulai' => 55,
                'selesai' => 68
            ],
            [
                'tahap' => 7,
                'nama_tahap' => 'Pemupukan Kedua',
                'deskripsi' => 'Pemupukan kedua dilakukan pada minggu ke 2 setelah pemupukan pertama. Dosis pupuk yang digunakan bertambah menjadi 4 cangkir NPK per 25 liter air. Pemupukan ini untuk mendukung perkembangan daun yang lebih kuat dan lebih banyak.',
                'mulai' => 69,
                'selesai' => 69
            ],
            [
                'tahap' => 8,
                'nama_tahap' => 'Tahap Pertumbuhan Tiga',
                'deskripsi' => 'Pada minggu pertumbuhan ketiga, tanaman dibiarkan hingga mencapai umur 1 bulan sejak pemindahaan ke ladang.',
                'mulai' => 70,
                'selesai' => 75
            ],
            [
                'tahap' => 9,
                'nama_tahap' => 'Penimbunan dan Pemupukan Ketiga',
                'deskripsi' => 'Pada minggu tahap ini, selain pemupukan ketiga, dilakukan penimbunan tanah di sekitar batang tanaman. Ini dilakukan untuk memperkuat akar tanaman agar tidak mudah tumbang dan memperkuat tanaman dalam menghadapi cuaca. Pemupukan ketiga juga dilakukan dengan pupuk ZA/NPK sesuai dosis yang disesuaikan.',
                'mulai' => 76,
                'selesai' => 76
            ],
            [
                'tahap' => 10,
                'nama_tahap' => 'Pemotongan Cabang Samping',
                'deskripsi' => 'Pada tahap ini, cabang samping yang tumbuh di tanaman dipotong untuk mencegah kompetisi nutrisi antara daun utama dan cabang samping. Pemotongan ini dilakukan rutin sekali pada setiap minggu selama durasi tiga minggu, masa pertumbuhan ini berguna untuk memastikan daun utama mendapatkan nutrisi yang cukup hingga siap dipanen.',
                'mulai' => 76,
                'selesai' => 97
            ],
            [
                'tahap' => 11,
                'nama_tahap' => 'Panen Akhir',
                'deskripsi' => 'Panen 3,5 bulan hanya berlaku pada jenis tembakau Receh dan Temangi. Jenis tembakau yang lain akan melakukan panen pada umur 4 bulan. Jika tembakau berada di daerah dingin, akan melakukan panen pada umur 6 bulan. Pada tahap ini, daun tembakau yang sudah matang dipanen secara bertahap. Panen pertama biasanya dimulai dari daun bagian bawah tanaman, yang sudah siap untuk dipetik. Panen dapat dilakukan beberapa kali hingga semua daun di bagian atas sudah siap. Tanaman pada tahap ini sudah tidak membutuhkan pemupukan lagi, dan hanya tinggal menunggu daun yang tersisa matang untuk dipanen.',
                'mulai' => 105, // Bulan ke-3,5 (105 hari)
                'selesai' => 135 // Selesai (setelah 4 bulan)
            ],
        ];


        foreach ($tahapan as $data) {
            DB::table('tahapan')->insert([
                'tahap' => $data['tahap'],
                'nama_tahap' => $data['nama_tahap'],
                'deskripsi' => $data['deskripsi'],
                'mulai' => $data['mulai'],
                'selesai' => $data['selesai'],
                'id_user' => $user->id,
            ]);
        }


        // Redirect ke halaman lain setelah berhasil
        return redirect('/login')->with('success', 'Registration successful.');
    }
}