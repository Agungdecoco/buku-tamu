<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;

class PdfExportController extends Controller
{
    public function exportToPdf()
    {
        // Get the HTML content of your dashboard view
        $html = view('admin.home')->render();

        // Generate the PDF using dompdf
        $pdf = PDF::loadHtml($html);

        // Download the PDF
        return $pdf->download('dashboard.pdf');
    }
}
