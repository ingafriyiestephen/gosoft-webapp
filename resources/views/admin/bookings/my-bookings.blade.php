<x-app-layout>
  @include('layouts.home-head')
  <style> 
    table {
      display: block;
      overflow-x: auto;
      white-space: nowrap;
    }
  
    table tbody {
      display: table;
      width: 100%;
    }
   </style>
     <!-- body -->
     <body class="main-layout text-bg-light p-3">
      {{-- <div  class="pageLoader" id="pageLoader"></div> --}}
        <section >
           <!--main content-->
              <div class="row justify-content-center">
                      <div class="card p-3 text-bg-light">
                          <div class="row justify-content-center">
                              <div class="col-12">
                                  <h2 class="heading text-center">My Bookings</h2>
                                    @if (session('message'))
                                    <div class="alert alert-success w-1/2 max-w-full px-12">
                                            {{ session('message') }}
                                        </div>
                                    @endif
                              </div>
                          </div>
   
                          <div class="row justify-content-center mr-3">
                            <table  class="table" class="table_wrapper">
                              <tbody id="trip_table" name="trip_table">
                                 @forelse ($bookings as $booking)
                                <tr>
                                  <td>
                                    <div class="flex px-2 py-1">
                                      <div>
                                        <img src="/assets/img/red-bus.png" style="height: 80px; margin-left: 0;"/>
                                        <span>
                                          <h4>{{$booking->booking_code}}</h4>
                                          {{$booking->departure}} - {{$booking->destination}}<br/>                               <?php
                                          $trip_duration = (strtotime($booking->end_time) - strtotime($booking->start_time)) / 3600;
                                          echo round(ceil($trip_duration*100)/100, 5). ' Hours';
                                        ?>
                                        </span>
                                      </div>
                                    </div>
                                 </td>
                                 <td>
                                    <div>
                                      <img src="/assets/img/logos/icons8-report-time-96.png" style="width: 50px;"/>
                                    </div>
                                    <div>
                                        <b>Report Time</b> 
                                        <?php 
                                        $start_time = $booking->start_time;
                                        $report_time = date('H:i:s', strtotime($start_time. ' -40 minutes'));
                                        echo $report_time;
                                        ?>
                                    </div>
                                    <br>
                                    <div>
                                      <img src="/assets/img/logos/icons8-time-96.png" style="width: 50px;"/>
                                    </div>
                                    <div>
                                        <b>Departure Time</b> {{$booking->start_time}}
                                    </div>
                                 </td>
                                  <td >
                                    <div>
                                      <img src="/assets/img/logos/icons8-money-96.png" style="width: 50px;"/>
                                      <br>
                                      <span>
                                        <b>Travel Fare</b>
                                        <h3>  GH₵ {{$booking->fare}}</h3>
                                      </span>
                                    </div>
                                  </td>
                                  <td>
                                    <div>
                                      <img src="/assets/img/logos/icons8-numbers-input-form-100.png" style="width: 50px;"/>
                                      <br>
                                      <span>
                                        <b>Bus Number</b>
                                        <h3> {{$booking->bus_number}}</h3>
                                      </span>
                                    </div>
                                  </td>
                                  <td>
                                    <div>
                                      <br>
                                      <span>
                                        <b>Staff</b>
                                        <h3> {{$booking->pay_ref}}</h3>
                                      </span>
                                    </div>
                                  </td>
                                  <!--<td>-->
                                  <!--  <div style="height: 50px;"></div>-->
                                  <!--  @if ($booking->status == 'Pending')-->
                                  <!--  <form id="paymentForm" role="form" onsubmit="" action="{{ url("/pay_booking") }}" method="POST">-->
                                  <!--    @csrf-->
                                  <!--    <input type="text" id="booking_code" name="booking_code" value="{{$booking->booking_code}}"-->
                                  <!--    hidden />-->
                                  <!--    <input type="text" id="pay_ref" name="pay_ref" value=""-->
                                  <!--    hidden />-->
                                  <!--    <input type="text" id="amount" name="amount" value="{{$booking->booking_amount}}"-->
                                  <!--    hidden />-->
                  
                                  <!--    <button id="pay-stack" type="button" class="btn btn-success d-block btn-block mb-3">-->
                                  <!--        PAY GHS {{$booking->booking_amount}} <span class="ms-3 fas fa-arrow-right"></span>-->
                                  <!--        </button><br/>            -->
                                  <!--  </form>-->
                                  <!--  @endif-->
                                  <!--</td>-->
                                </tr>
                                @empty
                                <p style="margin-left: 1320px;">You have no bookings!</p>
                                @endforelse

                              </tbody>
                            </table>
                          </div>
                      </div>                             
              </div>
          <!--/end main content-->
        </section>
        <script src="https://js.paystack.co/v1/inline.js"></script> 
        <script>                               
              const paymentForm = document.getElementById('paymentForm');
              const paymentOnline = document.getElementById('pay-stack');

              paymentOnline.addEventListener("click", payWithPaystack, false);
              function payWithPaystack(e) {
              e.preventDefault(); 
              let handler = PaystackPop.setup({
              key: 'pk_test_20ef68f4f6fcfd612472d79d36d2c4f461a30b4c', // Replace with your public key
              email: 'booking@sofrimpongtransport.com',
              amount: document.getElementById("amount").value * 100,
              currency: "GHS",
              ref: ''+Math.floor((Math.random() * 1000000000) + 1), // generates a pseudo-unique reference. Please replace with a reference you generated. Or remove the line entirely so our API will generate one for you
              // label: "Optional string that replaces customer email"
              onClose: function(){
                 console.log('payment cancelled')
              },
              callback: function(response){
                    $("#pay_ref").val(response.reference);
                    document.getElementById('paymentForm').submit();

              }
              });
              handler.openIframe();
           

              }
              function payWithAgent(e) {
              e.preventDefault(); 
              document.getElementById('paymentForm').submit();
              }
              
        </script>
        <script>
          window.onload = function() {
            $('#pageLoader').hide();
          };
        </script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    @include('layouts.home-footer')
  </html>
  </x-app-layout>
  
  