<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf; 

class PDFController extends Controller
{
    //
    public function viewPDF()
    {
        $data = ['title' => 'My First PDF'];
        $pdf = Pdf::loadView('pdf_view', $data);

        return $pdf->stream('sample.pdf');
    }
}
