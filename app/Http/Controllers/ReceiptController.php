<?php

namespace App\Http\Controllers;

use App\Models\Farmer;
use App\Models\Parcel;
use Illuminate\Http\Request;

class ReceiptController extends Controller
{
    //
    function parcel_receipt($id)
    {
    $parcel = Parcel::findOrFail($id);
        
    // $parcel = Parcel::join('buses', 'buses.bus_id', '=', 'parcels.bus_id')
    // ->select('parcels.*', 'buses.*')
    // ->findOrFail($id)
    // ->get();


        return view('admin.receipts.parcel_receipt', compact('parcel'));
    }

    //
    function product_receipt($id)
    {
        $farmer = Farmer::findOrFail($id);

        return view('admin.receipts.product_receipt', compact('farmer'));
    }
}
