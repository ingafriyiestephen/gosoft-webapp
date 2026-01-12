{{--Remove the unwanted characters in the parcel type--}}
<?php 
$str_parcel_type= str_replace('[',"",$parcel->parcel_type);
$str_parcel_type= str_replace(']',"",$str_parcel_type);
$str_parcel_type= str_replace('"'," ",$str_parcel_type);
?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
      <title>CalDriva - Reciept</title>
      <style>
        body {
        background: #eee;
        }
      </style>
   <body>
    <div class="container mt-5">
        <div class="d-flex justify-content-center row">
            <div class="col-md-12">
                <div class="p-3 bg-white rounded">
                    <img src="/assets/img/logo.png" style="text-align: center; height: 100px;"/>
                    <h2 class="text-danger" style="text-align: center;">CalDriva Delivery Services</h2>
                    <br>
                    <br>
                    <div class="row">
                        <div class="col-md-6"> 
                            <div class="billed"><span class="font-weight-bold text-uppercase">Sender/Billed - </span><span class="ml-1">{{$parcel->sender_name}}</span></div>
                            <div class="billed"><span class="font-weight-bold text-uppercase">Conatct</span><span class="ml-1">{{$parcel->sender_phone}}</span></div>
                            <br>
                            <div class="billed"><span class="font-weight-bold text-uppercase">Recipient - </span><span class="ml-1">{{$parcel->receiver_name}}</span></div>
                            <div class="billed"><span class="font-weight-bold text-uppercase">Contact - </span><span class="ml-1">{{$parcel->receiver_phone}}</span></div>
                            <br>
                            <div class="billed"><span class="font-weight-bold text-uppercase">From : To - </span><span class="ml-1">{{$parcel->from_location}} - {{$parcel->to_location}}</span></div>
                            <div class="billed"><span class="font-weight-bold text-uppercase">Date - </span><span class="ml-1">{{$parcel->created_at}}</span></div>
                            <br>
                            <div class="billed"><span class="font-weight-bold text-uppercase">Vehicle No. - </span><span class="ml-1">{{$parcel->bus_number}}</span></div>
                        </div>
                        <div class="col-md-6 text-right mt-3">
                            <div>
                                <div class="billed"><span class="font-weight-bold text-uppercase">Order ID - </span><span class="ml-1">#{{$parcel->tracking_code}}</span></div>
                                <br>
                                <div class="billed"><span class="font-weight-bold text-uppercase">Number/Quantity - </span><span class="ml-1">{{$parcel->number_parcels}}</span></div>
                                <div class="billed"><span class="font-weight-bold text-uppercase">Parcel Weight - </span><span class="ml-1">{{$parcel->parcel_weight}}kg</span></div>
                                <br>
                                <div class="billed"><span class="font-weight-bold text-uppercase">Collection Type - </span><span class="ml-1">{{$parcel->collection_type}}</span></div>
                                <br>
                                <div class="billed"><span class="font-weight-bold text-uppercase">Pick-up Location - </span><span class="ml-1">{{$parcel->pickup_location}}</span></div>
                                <div class="billed"><span class="font-weight-bold text-uppercase">Pick-up Landmark - </span><span class="ml-1">{{$parcel->landmark}}</span></div>
                            </div>
                        </div>

                        </div>
                    <div class="mt-3">
                        <div class="table-responsive">
                            <table id="table" class="table">
                                <thead>
                                    <tr>
                                        <th>Item(s)</th>
                                        <th>Unit Cost</th>
                                        <th>Quantity</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{$str_parcel_type}}</td>
                                        <td>-</td>
                                        <td>{{$parcel->number_parcels}}</td>
                                        <td id="parcel_fee">{{$parcel->parcel_fee}}</td>
                                    </tr>
                                    <tr>
                                        <td>Company Delivery Fee</td>
                                        <td>-</td>
                                        <td>-</td>
                                        <td id="delivery_fee">{{$parcel->delivery_fee}}</td>
                                    </tr>
                                    {{-- <tr>
                                        <td>TAX</td>
                                        <td>-</td>
                                        <td>-</td>
                                        <td id="tax_fee">0.00</td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td>Nhil @ 2.5%</td>
                                        <td id="tax_fee">0.00</td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td>GetF @ 2.5%</td>
                                        <td>0.00</td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td>CovidL @ 1%</td>
                                        <td>0.00</td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td>Vat @ 12.5%</td>
                                        <td id="tax_fee">0.00</td>
                                    </tr> --}}
                                    <tr>
                                        <td>-</td>
                                        <td>-</td>
                                        <td>Total</td>
                                        <td id="total_fee"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row" style="text-align: center">
                        <div class="col">
                            <p>Issued By: {{$parcel->staff_name}}</p>
                        </div>
                        {{-- <div class="col">
                                <button type="button" class="btn btn-labeled btn-warning" onclick="window.print();"><span class="btn-label"><i class="fa fa-print"></i></span> Print</button>
                        </div> --}}

                    </div>

                    <div class="row" style="text-align: center">
                        <div class="col">
                        For Enquries and Complains, Please contact us on: <br> Phone/Whatsapp on: 0240062822 / 0208009774
                        </div>
                    </div>

                    <div class="row" style="text-align: center; margin-top: 50px;">
                            <div class='col' style="display: block; margin-left: auto; margin-right: auto; width: 40%;">
                                <div class="visible-print text-center">
                                  {!! QrCode::size(100)->generate(url("/parcel_receipt/{$parcel->parcel_id}")); !!}
                                  <br>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

   </body>
   <script>
      var table = document.getElementById("table");
      var row = table.getElementsByTagName("tr")[3];
      var td = row.getElementsByTagName("td")[3];
      var total_fee = parseFloat({{$parcel->parcel_fee}} + {{$parcel->delivery_fee}}).toFixed(2);
      td.innerHTML = "GHS " + "" + total_fee;
   </script>
</html>

