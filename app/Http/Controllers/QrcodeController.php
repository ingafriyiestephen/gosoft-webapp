<?php

namespace App\Http\Controllers;

use App\Models\Parcel;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QrcodeController extends Controller
{
    //
    public function parcel_qrcode($id){
        $parcel = Parcel::findOrFail($id);
        return view('admin.view_qrcode', compact('parcel'));
    }
}
