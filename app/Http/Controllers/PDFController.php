<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;
use App\Models\User;
use PDF;

use Illuminate\Support\Facades\App;

class PDFController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
    */
    public function generatePDF($id)
{
    // $users = User::get();
    // $invoices = Invoice::get()->toArray(); // Convert the collection to an array

    // $pdf = PDF::loadView('backend.invoices.index', ['invoices' => $invoices]);

    // return $pdf->download('laraveltuts.pdf');

    // $pdf = App::make('dompdf.wrapper');
    // $pdf->loadHTML('<h1>hello</h1>');
    // $invoices = Invoice::get();
    // $pdf = Pdf:: loadView('backend.invoices.pdd', compact('invoices'));
    // return $pdf->download();
    $invoices = Invoice::with(['product'])->where('id', $id)->first();
    $IdInvoices = Invoice::where('id', $id)->first();
    $pdf = PDF::loadView('backend.invoices.pdd', compact('invoices','IdInvoices'));
    $doc = 'document';
    return $pdf->stream($doc . '.pdf');
}
}
