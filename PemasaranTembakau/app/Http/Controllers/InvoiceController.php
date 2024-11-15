<?php

namespace App\Http\Controllers;

use App\Models\Pemesanan;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Barryvdh\DomPDF\PDF as DomPDFPDF;
use Illuminate\Http\Request;
use PDF; // Import the PDF facade

class InvoiceController extends Controller
{
    public function generateInvoice($id)
    {
        // Fetch the pemesanan data by ID
        $pemesanan = Pemesanan::with('items', 'user')->findOrFail($id);

        // Generate PDF using the view and pass the pemesanan data
        $pdf = FacadePdf::loadView('FrontEnd.invoice', compact('pemesanan'));

        // Download the PDF
        return $pdf->download('invoice_' . $pemesanan->id_pmsan . '.pdf');
    }
}