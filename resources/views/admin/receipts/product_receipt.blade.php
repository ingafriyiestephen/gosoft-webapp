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
      <title>Rejuvenate Gaia Global Ltd - Reciept</title>
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
                    <img src="/assets/img/rejuvenate_logo.png" style="text-align: center; height: 100px;"/>
                    <h2 class="text-success" style="text-align: center;">Rejuvenate Gaia Global Ltd.</h2>
                    <br>
                    <br>
                    <div class="row">
                        <div class="col-md-6"> 
                            <div class="billed"><span class="font-weight-bold text-uppercase">Sender/Billed - </span><span class="ml-1">{{$farmer->farmer_name}}</span></div>
                            <div class="billed"><span class="font-weight-bold text-uppercase">Conatct</span><span class="ml-1">{{$farmer->phone}}</span></div>
                            <br>
                            <div class="billed"><span class="font-weight-bold text-uppercase">District - </span><span class="ml-1">{{$farmer->district}}</span></div>
                            <div class="billed"><span class="font-weight-bold text-uppercase">Date - </span><span class="ml-1">{{$farmer->created_at}}</span></div>
                        </div>
                        <div class="col-md-6 text-right mt-3">
                            <div>
                                <div class="billed"><span class="font-weight-bold text-uppercase">Order ID - </span><span class="ml-1">#{{$farmer->tracking_code}}</span></div>
                                <div class="billed"><span class="font-weight-bold text-uppercase">Agent - </span><span class="ml-1">{{$farmer->agent}}</span></div>
                                <br>
                                <div class="billed"><span class="font-weight-bold text-uppercase">Number/Quantity - </span><span class="ml-1">{{$farmer->quantity}}</span></div>
                                <div class="billed"><span class="font-weight-bold text-uppercase">Price - </span><span class="ml-1">{{$farmer->price}}</span></div>
                            </div>
                        </div>

                        </div>
                    <div class="mt-3">
                        <div class="table-responsive">
                            <table id="table" class="table">
                                <thead>
                                    <tr>
                                        <th>Item</th>
                                        <th>Unit Cost</th>
                                        <th>Quantity</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>25kg Fertilizer</td>
                                        <td>-</td>
                                        <td>{{$farmer->quantity}}</td>
                                        <td id="parcel_fee">{{$farmer->price}}</td>
                                    </tr>
                                    <tr>
                                        <td>Discount</td>
                                        <td>-</td>
                                        <td>-</td>
                                        <td id="discount">{{$farmer->discount}}</td>
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
                            <p>Issued By: {{$farmer->agent}}</p>
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
                                  {!! QrCode::size(100)->generate(url("/farmer_receipt/{$farmer->farmer_id}")); !!}
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
      var total_fee = parseFloat({{$farmer->price}}).toFixed(2);
      td.innerHTML = "GHS " + "" + total_fee;
   </script>
</html>

