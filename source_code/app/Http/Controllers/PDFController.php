<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bill;
use App\Models\ChiTietBill;
use PDF;
class PDFController extends Controller
{
   public function In_PDF(string $ID){

    $bill=Bill::where('id',$ID)->first();
    $ctbill=ChiTietBill::where('id_user',$bill->id_user)->where('id_dh',$ID)->get();

    $donhang= [
        'ID' => $bill ,
        'CTB'=> $ctbill
    ];
    $pdf = PDF::loadView('View_PDF',$donhang);
    return $pdf->stream();
    }
}