<?php $cnt_bkns=count($trips) + 1; $avail_seats=count($trips); ?>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
  rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
  crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.css">
  @include('layouts.home-pay-head')
  <!-- body -->
  
  <body class="main-layout text-bg-light">
    <div  class="pageLoader" id="pageLoader"></div>
    <section>
      <!-- MultiStep Form -->
      <div class="container-fluid p-3">
        <div class="row justify-content-center mt-0">
          <div class="col-11 col-sm-11 col-md-11 col-lg-11 text-center p-0 mt-3 mb-2">
            <div class="card px-0 pt-4 pb-0 mt-3 mb-3">
              <div class="flex px-2 py-1">
                <div id="grad2">
                  <span>
                    <a href="{{url('/')}}">
                     <h2><img src="/assets/img/logos/icons8-previous-96.png" class="grad2-label"/> {{$trip->departure}} <img src="/assets/img/logos/icons8-forward-arrow-96.png" style="width: 30px;"/> {{$trip->destination}}, <img src="/assets/img/logos/icons8-calendar-96.png" style="width: 20px;"/>{{$trip->trip_date}}, <img src="/assets/img/logos/icons8-time-96.png" style="width: 20px;"/>{{$trip->start_time}} - {{$trip->end_time}}</h2> 
                    </a>
                  </span>
                  
                  {{-- <a href="{{url('/')}}">
                    <input type="button" class="previous action-button-previous"
                    value="Previous" /> --}}
                </div>
              </div>
              <div class="row">
                <div class="col-md-12 mx-0">
                  <form id="paymentForm" role="form" onsubmit="" action="{{ url("/store_booking") }}" method="POST">
                    @csrf
                    <input type="text" id="trip_id" name="trip_id" value="{{$trip->trip_id}}"
                    hidden/>
                    <input type="text" id="booking_code" name="booking_code" value="{{$trip->trip_name}}-{{$trip->trip_id}}-{{$cnt_bkns}}"
                    hidden/>
                    <input type="text" id="booking_fare" name="booking_fare" value="{{$trip->fare}}"
                    hidden/>
                    <input type="text" id="bus_number" name="bus_number" value="{{$trip->bus_number}}"
                    hidden/>


                    <!-- fieldsets -->
                    <fieldset>   
                      <input type="button" name="next" class="next action-button" value="Next"/>                   
                      <div class="row">
                        <div class="bus seat-arr border-0 p-0 col-lg-5 col-sm-12 col-md-12">
                          <div class="row g-0">
                            <div class="col-lg-4 col-sm-4 col-md-12 mb-4">
                              <p><img src="/assets/img/seats/icons8-car-available.png" style="width: 25px;"/> Available</p>
                            </div>
                            <div class="col-lg-4 col-sm-4 col-md-12 mb-4">
                              <p><img src="/assets/img/seats/icons8-car-seat-0.png" style="width: 25px;"/> Booked</p>
                            </div>
                            <div class="col-lg-4 col-sm-4 col-md-12 mb-4">
                              <p><img src="/assets/img/seats/icons8-selected-seats.jpg" style="width: 25px;"/> Selected</p>
                            </div>
                          </div>
                          <div class="row mb-3">
                            <div class="col-2">
                                <img src="/assets/img/seats/icons8-driver-58.png" style="width: 50px;"  class="input-passenger-seat driver-seat" data-myseat="1"/>
                            </div>
                            <div class="col-2"></div>
                            <div class="col-3"></div>
                            <div class="col-2"></div>
                            <div class="col-2">
                              <img src="/assets/img/seats/icons8-car-seat-2.png" style="width: 50px;"  class="input-passenger-seat" data-myseat="2"/>
                            </div>
                          </div>
                          <!--Seat Row 2-->
                          <div class="row mb-3">
                            <div class="col-2">
                                <img src="/assets/img/seats/icons8-car-seat-3.png" style="width: 50px;"  class="input-passenger-seat" data-myseat="3"/>
                            </div>
                            <div class="col-2">
                              <img src="/assets/img/seats/icons8-car-seat-4.png" style="width: 50px;"  class="input-passenger-seat" data-myseat="4"/>
                            </div>
                            <div class="col-3">
                            </div>
                            <div class="col-2">
                              <img src="/assets/img/seats/icons8-car-seat-5.png" style="width: 50px;"  class="input-passenger-seat" data-myseat="5"/>
                            </div>
                            <div class="col-2">
                              <img src="/assets/img/seats/icons8-car-seat-6.png" style="width: 50px;"  class="input-passenger-seat" data-myseat="6"/>
                            </div>
                          </div>
                          <!--Seat Row 2-->
                          <!--Seat Row 3-->
                          <div class="row mb-3">
                            <div class="col-2">
                                <img src="/assets/img/seats/icons8-car-seat-7.png" style="width: 50px;"  class="input-passenger-seat" data-myseat="7"/>
                            </div>
                            <div class="col-2">
                              <img src="/assets/img/seats/icons8-car-seat-8.png" style="width: 50px;"  class="input-passenger-seat" data-myseat="8"/>
                            </div>
                            <div class="col-3">
                            </div>
                            <div class="col-2">
                              <img src="/assets/img/seats/icons8-car-seat-9.png" style="width: 50px;"  class="input-passenger-seat" data-myseat="9"/>
                            </div>
                            <div class="col-2">
                              <img src="/assets/img/seats/icons8-car-seat-10.png" style="width: 50px;"  class="input-passenger-seat" data-myseat="10"/>
                            </div>
                          </div>
                          <!--Seat Row 3-->
                          <!--Seat Row 4-->
                          <div class="row mb-3">
                            <div class="col-2">
                                <img src="/assets/img/seats/icons8-car-seat-11.png" style="width: 50px;"  class="input-passenger-seat" data-myseat="11"/>
                            </div>
                            <div class="col-2">
                              <img src="/assets/img/seats/icons8-car-seat-12.png" style="width: 50px;"  class="input-passenger-seat" data-myseat="12"/>
                            </div>
                            <div class="col-3">
                            </div>
                            <div class="col-2">
                              <img src="/assets/img/seats/icons8-car-seat-13.png" style="width: 50px;"  class="input-passenger-seat" data-myseat="13"/>
                            </div>
                            <div class="col-2">
                              <img src="/assets/img/seats/icons8-car-seat-14.png" style="width: 50px;"  class="input-passenger-seat" data-myseat="14"/>
                            </div>
                          </div>
                          <!--Seat Row 4-->
                          <!--Seat Row 5-->
                          <div class="row mb-3">
                            <div class="col-2">
                                <img src="/assets/img/seats/icons8-car-seat-15.png" style="width: 50px;"  class="input-passenger-seat" data-myseat="15"/>
                            </div>
                            <div class="col-2">
                              <img src="/assets/img/seats/icons8-car-seat-16.png" style="width: 50px;"  class="input-passenger-seat" data-myseat="16"/>
                            </div>
                            <div class="col-3">
                            </div>
                            <div class="col-2">
                              <img src="/assets/img/seats/icons8-car-seat-17.png" style="width: 50px;"  class="input-passenger-seat" data-myseat="17"/>
                            </div>
                            <div class="col-2">
                              <img src="/assets/img/seats/icons8-car-seat-18.png" style="width: 50px;"  class="input-passenger-seat" data-myseat="18"/>
                            </div>
                          </div>
                          <!--Seat Row 5-->
                          <!--Seat Row 6-->
                          <div class="row mb-3">
                            <div class="col-2">
                                <img src="/assets/img/seats/icons8-car-seat-19.png" style="width: 50px;"  class="input-passenger-seat" data-myseat="19"/>
                            </div>
                            <div class="col-2">
                              <img src="/assets/img/seats/icons8-car-seat-20.png" style="width: 50px;"  class="input-passenger-seat" data-myseat="20"/>
                            </div>
                            <div class="col-3">
                            </div>
                            <div class="col-2">
                              <img src="/assets/img/seats/icons8-car-seat-21.png" style="width: 50px;"  class="input-passenger-seat" data-myseat="21"/>
                            </div>
                            <div class="col-2">
                              <img src="/assets/img/seats/icons8-car-seat-22.png" style="width: 50px;"  class="input-passenger-seat" data-myseat="22"/>
                            </div>
                          </div>
                          <!--Seat Row 6-->
                          <!--Seat Row 7-->
                          <div class="row mb-3">
                            <div class="col-2">
                                <img src="/assets/img/seats/icons8-car-seat-23.png" style="width: 50px;"  class="input-passenger-seat" data-myseat="23"/>
                            </div>
                            <div class="col-2">
                              <img src="/assets/img/seats/icons8-car-seat-24.png" style="width: 50px;"  class="input-passenger-seat" data-myseat="24"/>
                            </div>
                            <div class="col-3">
                            </div>
                            <div class="col-2">
                              <img src="/assets/img/seats/icons8-car-seat-25.png" style="width: 50px;"  class="input-passenger-seat" data-myseat="25"/>
                            </div>
                            <div class="col-2">
                              <img src="/assets/img/seats/icons8-car-seat-26.png" style="width: 50px;"  class="input-passenger-seat" data-myseat="26"/>
                            </div>
                          </div>
                          <!--Seat Row 7-->
                          <!--Seat Row 8-->
                          <div class="row mb-3">
                            <div class="col-2">
                                <img src="/assets/img/seats/icons8-car-seat-27.png" style="width: 50px;"  class="input-passenger-seat" data-myseat="27"/>
                            </div>
                            <div class="col-2">
                              <img src="/assets/img/seats/icons8-car-seat-28.png" style="width: 50px;"  class="input-passenger-seat" data-myseat="28"/>
                            </div>
                            <div class="col-3">
                            </div>
                            <div class="col-2">
                              <img src="/assets/img/seats/icons8-car-seat-29.png" style="width: 50px;"  class="input-passenger-seat" data-myseat="29"/>
                            </div>
                            <div class="col-2">
                              <img src="/assets/img/seats/icons8-car-seat-30.png" style="width: 50px;"  class="input-passenger-seat" data-myseat="30"/>
                            </div>
                          </div>
                          <!--Seat Row 8-->
                          <!--Seat Row 9-->
                          <div class="row mb-3">
                            <div class="col-2">
                                <img src="/assets/img/seats/icons8-car-seat-31.png" style="width: 50px;"  class="input-passenger-seat" data-myseat="31"/>
                            </div>
                            <div class="col-2">
                              <img src="/assets/img/seats/icons8-car-seat-32.png" style="width: 50px;"  class="input-passenger-seat" data-myseat="32"/>
                            </div>
                            <div class="col-3">
                            </div>
                            <div class="col-2">
                              <img src="/assets/img/seats/icons8-car-seat-33.png" style="width: 50px;"  class="input-passenger-seat" data-myseat="33"/>
                            </div>
                            <div class="col-2">
                              <img src="/assets/img/seats/icons8-car-seat-34.png" style="width: 50px;"  class="input-passenger-seat" data-myseat="34"/>
                            </div>
                          </div>
                          <!--Seat Row 9-->
                          <!--Seat Row 10-->
                          <div class="row mb-3">
                            <div class="col-2">
                                <img src="/assets/img/seats/icons8-car-seat-35.png" style="width: 50px;"  class="input-passenger-seat" data-myseat="35"/>
                            </div>
                            <div class="col-2">
                              <img src="/assets/img/seats/icons8-car-seat-36.png" style="width: 50px;"  class="input-passenger-seat" data-myseat="36"/>
                            </div>
                            <div class="col-3">
                            </div>
                            <div class="col-2">
                              <img src="/assets/img/seats/icons8-car-seat-37.png" style="width: 50px;"  class="input-passenger-seat" data-myseat="37"/>
                            </div>
                            <div class="col-2">
                              <img src="/assets/img/seats/icons8-car-seat-38.png" style="width: 50px;"  class="input-passenger-seat" data-myseat="38"/>
                            </div>
                          </div>
                          <!--Seat Row 10-->
                          <!--Seat Row 11-->
                          <div class="row mb-3">
                            <div class="col-2">
                                <img src="/assets/img/seats/icons8-car-seat-39.png" style="width: 50px;"  class="input-passenger-seat" data-myseat="39"/>
                            </div>
                            <div class="col-2">
                              <img src="/assets/img/seats/icons8-car-seat-40.png" style="width: 50px;"  class="input-passenger-seat" data-myseat="40"/>
                            </div>
                            <div class="col-3">
                            </div>
                            <div class="col-2">
                              <img src="/assets/img/seats/icons8-car-seat-41.png" style="width: 50px;"  class="input-passenger-seat" data-myseat="41"/>
                            </div>
                            <div class="col-2">
                              <img src="/assets/img/seats/icons8-car-seat-42.png" style="width: 50px;"  class="input-passenger-seat" data-myseat="42"/>
                            </div>
                          </div>
                          <!--Seat Row 11-->
                          <!--Seat Row 12-->
                          <div class="row mb-3">
                            <div class="col-2">
                                <img src="/assets/img/seats/icons8-car-seat-43.png" style="width: 50px;"  class="input-passenger-seat" data-myseat="43"/>
                            </div>
                            <div class="col-2">
                              <img src="/assets/img/seats/icons8-car-seat-44.png" style="width: 50px;"  class="input-passenger-seat" data-myseat="44"/>
                            </div>
                            <div class="col-3">
                            </div>
                            <div class="col-2">
                              <img src="/assets/img/seats/icons8-car-seat-45.png" style="width: 50px;"  class="input-passenger-seat" data-myseat="45"/>
                            </div>
                            <div class="col-2">
                              <img src="/assets/img/seats/icons8-car-seat-46.png" style="width: 50px;"  class="input-passenger-seat" data-myseat="46"/>
                            </div>
                          </div>
                          <!--Seat Row 12-->
                          <!--Seat Row 13-->
                          <div class="row mb-3">
                            <div class="col-2">
                                <img src="/assets/img/seats/icons8-car-seat-47.png" style="width: 50px;"  class="input-passenger-seat" data-myseat="47"/>
                            </div>
                            <div class="col-2">
                              <img src="/assets/img/seats/icons8-car-seat-48.png" style="width: 50px;"  class="input-passenger-seat" data-myseat="48"/>
                            </div>
                            <div class="col-3">
                            </div>
                            <div class="col-2">
                              <img src="/assets/img/seats/icons8-car-seat-49.png" style="width: 50px;"  class="input-passenger-seat" data-myseat="49"/>
                            </div>
                            <div class="col-2">
                              <img src="/assets/img/seats/icons8-car-seat-50.png" style="width: 50px;"  class="input-passenger-seat" data-myseat="50"/>
                            </div>
                          </div>
                          <!--Seat Row 13--> 
                          {{-- <img src="https://portmoni.com/wp-content/uploads/2018/02/payment-methods-mtn-airtel-tigo-visa-mastercard.png"
                          />     --}}
                      </div>
                      <div class="col-lg-6 col-sm-12 col-md-12 mt-3">
                        <div class="px-4 py-5">
{{-- 
                      <span class="theme-color">Payment Summary</span> --}}
                      <h3 class="text-uppercase fs-title seat_title theme-color"></h3>
                      <div class="mb-3">
                          <hr class="new1">
                      </div>
      
                      <div class="d-flex justify-content-between">
                          <h4>Seat Count</h4>
                          <h4 class="passengers-span">0</h4>
                      </div>
      
      
                      <div class="d-flex justify-content-between">
                          <h4>Cost Per Seat</h4>
                          <h4>GHS {{$trip_amount->fare}}</h4>
                      </div>
                      
                      <div class="d-flex justify-content-between mt-3">
                          <h1>Total</h1>
                          <h1 class="theme-color total-fare-span">GHS 0.00</h1>
                      </div>  
                      </div>       
                      </div>     
                      </div>

                    </fieldset>
                    <fieldset>
                      <div class="row">
                        <div class="border-0 p-0 col-lg-8 col-md-8 col-sm-6">
                          <div class="contact-card">
                          <div class="row">
                            <h2 class="fs-title theme-color">
                              Contact Details
                            </h2>
                            <div class='col-lg-4 col-md-4 col-sm-6'>
                              <label>
                                Contact Phone*
                              </label>
                              <input type="tel" id="customer_phone" name="customer_phone" maxlength="10" required
                              value="{{$user_phone}}" />
                            </div>
                            <div class='col-lg-4 col-md-4 col-sm-6'>
                                <label>
                                  Next of Kin Name*
                                </label>
                                <input type="text" name="contact_person" id="contact_person" required/>
                            </div>
                            <div class='col-lg-4 col-md-4 col-sm-6'>
                            <label>
                              Next of Kin Phone*
                            </label>
                            <input type="tel" name="contact_person" id="contact_person" maxlength="10" required
                            />
                            </div>
                          </div>
                          <h2 class="fs-title theme-color">
                            Traveler(s) Details
                          </h2>
                          <div class="row traveler-details">
                        
                          </div>
                          <input id="passenger_summary" name="passenger_summary" value="" class="form-control block" hidden/>
                            <div class="row">
                              <div class="col">
                                <label>
                                  No. of Children (0-5yrs)
                                </label>
                                <select id="number_children" name="number_children" class="form-control">
                                  <option value="0" selected>
                                    0
                                  </option>
                                  <option value="1">
                                    1
                                  </option>
                                  <option value="2">
                                    2
                                  </option>
                                  <option value="3">
                                    3
                                  </option>
                                </select>
                              </div>
                            </div>
                            <br>
                            <div class="row">
                              <div class="col">
                                <label>
                                  Luggage (over 10kg)
                                </label>
                                <select id="luggage_over" name="luggage_over" class="form-control">
                                  <option value="Yes">
                                    Yes
                                  </option>
                                  <option value="No" selected>
                                    No
                                  </option>
                                </select>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-6">
                            <!-- place your image here -->
                            {{-- <img src="/assets/img/save_life.jpg" style="width: 350px;"> --}}
                            <div class="form-card mb-5 rounded shadow-lg">

                              <!--Card Body-->
                              <div class="card-body card-body-cascade">
                      
                                <!--Card Description-->
                                <div class="card2decs">
                      
                                  <div class="p-0 mx-auto px-2">
                                  {{-- <h4 class="theme-color"><strong>PAYMENT DETAILS</strong></h4> --}}
                                  <h5 class="fs-title theme-color">Payment Details</h5>
                                  <hr class="theme-color" style="height: 2px;">
                                  <p class="trip_item"><b>Trip Date</b><span class="text1">{{$trip->trip_date}}</span></p>
                                  <p class="trip_item"><b>Report Time</b><span class="text1">{{$trip->start_time}}</span></p>
                                  <p class="trip_item"><b>Departure Time</b><span class=" text1">
                                    <?php 
                                    $start_time = $trip->start_time;
                                    $report_time = date('H:i:s', strtotime($start_time. ' -40 minutes'));
                                    echo $report_time;
                                    ?>
                                  </span></p>
                                  <p class="trip_item"><b>Departure</b><span class=" text1">{{$trip->departure}}</span></p>
                                  <p class="trip_item"><b>Destination</b><span class=" text1">{{$trip->destination}}</span></p>
                                  <p class="trip_item"><b>Seat(s)</b><span class=" text1 seat_count"></span></p>
                                  <p class="trip_item" hidden>Full Name <span class=" text1 name-span"></span></p>
                                  <p class="trip_item" hidden>Phone Number<span class=" text1 phone-span"></span></p>
                                  <p class="trip_itim" hidden>Contact Person<span class=" text1 contact-person-span"></span></p>
                                  {{-- <p class="trip_item">Ticket Booking from<br> 
                                  {{$trip->departure}} To {{$trip->destination}}<br>
                                  Seats #<span class="seat_count"></span><br>
                                  <span class="passengers-span"></span> * {{$trip->booking_fare}}
                                    <span class="text1">{{$trip->trip_date}}</span></p> --}}
                                    <table class="table">
                                      <thead>
                                        <tr>
                                          <th scope="col">Details</th>
                                          <th scope="col">Amount GH¢</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                        <tr>
                                          <td>
                                            Ticket Booking from {{$trip->departure}} To {{$trip->destination}}<br>
                                            Seats #<span class="seat_count"></span><br>
                                            <span class="passengers-span"></span> * {{$trip->fare}}
                                          </td>
                                          <td class="total-fare-span"></td>
                                        </tr>
                                        <tr>
                                          <td>
                                            Online Charges
                                          </td>
                                          <td>0.00</td>
                                        </tr>
                                      </tbody>
                                      <tfoot>
                                        <tr>
                                          <th scope="col">Total Amount</th>
                                          <th scope="col" class="total-fare-span"></th>
                                        </tr>
                                      </tfoot>
                                    </table>
                                  {{-- <p class="h7 fw-bold mb-1">Pay this Invoice</p>
                                    <p class="textmuted h8">Make payment for this invoice by filling in the details</p> --}}
                                    <div class="form">
                                        <div class="row">
                                            {{-- <div class="col-12">
                                                <div class="card border-0"> <input id="momo_number" name="momo_number" class="form-control ps-5" type="text" placeholder="Mobile Money Number">
                                                    <span class="fas fa-mobile-alt"></span> </div>
                                            </div>
                                            <div class="col-12">
                                              <div class="card border-0"> <input id="payer_name" name="payer_name" class="form-control ps-5" type="text" placeholder="Account Name" hidden>
                                                  <span class="far fa-user"></span> </div>
                                            </div> --}}
                                            <div class="col-12">
                                              <input type="text" name="booking_seat" id="booking_seat" value="" hidden>
                                              <input id="trip_fare" name="trip_fare" class="form-control ps-5" type="text" placeholder="Payment Amount" value="{{$trip_amount->fare}}" hidden>
                                              <input id="amount" name="amount" class="form-control ps-5" type="text" placeholder="Payment Amount" value="" hidden>
                                              <input type="text" name="number_passengers" id="number_passengers" hidden>
                                              <input type="text" name="seat_count" id="seat_count" hidden>
                                              <input type="text" name="pay_ref" id="pay_ref" value="123" hidden>
                                            </div>

                                            <div class="form-group">
                                              <div>
                                                I have read and accepted SOFT terms & conditions.
                                              </div>
                                              <label>
                                                  <input type="checkbox"  /> 
                                              </label>
                                          </div>

                                        </div>
                                        


                                        <button id="pay-stack" type="button" class="btn btn-primary d-block btn-block mb-3">
                                          PAY GHS 0.00 <span class="ms-3 fas fa-arrow-right"></span>
                                        </button>
                                        <p style="margin-left: 43%;" class="mb-2">--OR--</p>
                                        <button id="pay-agent" type="button" class="btn btn-success d-block btn-block mb-3">
                                          PAY GHS 0.00 AS AGENT <span class="ms-3 fas fa-arrow-right"></span>
                                        </button>
                                        <p class="theme-color fs-title">Please Note:</p>
                                        <ul>
                                          <li>Kindly read and accept terms & conditions page.</li>
                                          <li>SOFT will not guarantee tickets confirmation unless payment process is completed.</li>
                                        </ul>
                                    </div>
                                </div>
      
                                </div>
                      
                              </div>
                              <script src="https://js.paystack.co/v1/inline.js"></script> 
                              <script>                               
                                  const paymentForm = document.getElementById('paymentForm');
                                  const paymentOnline = document.getElementById('payment-stack');
                                  const paymentOffline = document.getElementById('paymentagent');

                                  paymentForm.addEventListener("submit", payWithPaystack, false);
                                  function payWithPaystack(e) {
                                  e.preventDefault(); 
                                  // if (document.getElementById('customer_phone').value == "") {
                                  //       swal({
                                  //           title: "Phone number cannot be empty.",
                                  //           text: "Please provide a phone number.",
                                  //           icon: "warning",
                                  //           button: "Ok",
                                  //       })
                                  //   }else if(document.getElementById('contact_person').value == ""){
                                  //     swal({
                                  //       title: "Next of Kin/Contact Person number cannot be empty.",
                                  //           text: "Please provide a valid number.",
                                  //           icon: "warning",
                                  //           button: "Ok",
                                  //       })
                                  //   }else if(document.getElementById('momo_number').value == ""){
                                  //     swal({
                                  //       title: "Mobile Money number cannot be empty.",
                                  //           text: "Please provide a valid mobile money number.",
                                  //           icon: "warning",
                                  //           button: "Ok",
                                  //       })
                                  //   }else if(document.getElementById('payer_name').value == ""){
                                  //     swal({
                                  //       title: "Account name cannot be empty.",
                                  //           text: "Please provide a valid account name.",
                                  //           icon: "warning",
                                  //           button: "Ok",
                                  //       })

                                    let handler = PaystackPop.setup({
                                    key: 'pk_test_20ef68f4f6fcfd612472d79d36d2c4f461a30b4c', // Replace with your public key
                                    // email: document.getElementById("customer_email").value,
                                    email: 'afriyiestephen225@gmail.com',
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
                                  
                              </script>
                          </div>
                        </div>
                      </div>


                      <input type="button" name="previous" class="previous action-button-previous"
                      value="Previous" />
                      <input type="button" name="next" class="next action-button choose-seat-button"
                      value="Next Step" />
                    </fieldset>
                    <fieldset>
                      <div class="form-card">
                        <div class="row">
                    
                    <div class="col-6">
                    
                    </div>

                    <div class="col-6">


                      </div>
                      <input type="button" name="previous" class="previous action-button-previous" value="Previous"/>
                    </fieldset>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- end our blog -->
    </section>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js">
    </script>
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU="
    crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js">
    </script>
    <script>
      window.onload = function() {
        $('#pageLoader').hide();
      };

      
      //Array object to store user seats when booking
      const seat_arr = [];

      var passengerSeats = document.querySelectorAll(".input-passenger-seat");

      passengerSeats.forEach(function(passengerSeat) {
        var attribute = passengerSeat.getAttribute("data-myseat");
        const raw_this_array = <?php echo json_encode($newArray); ?>;
        const this_array = raw_this_array.flat(1);


        console.log(this_array);

        //Block all unavailable seats
        if (this_array.includes(attribute)){
          console.log(attribute);
          passengerSeat.classList.add('de-selected');
          passengerSeat.click(false);
          passengerSeat.src = '/assets/img/seats/icons8-car-seat-0.png';
        }
       

        //Enable customer to select available seats only
        passengerSeat.addEventListener('click', function() {
        // passengerSeat.src = '/assets/img/seats/icons8-car-seat-green.png';
        for (i = 0; i < this_array.length; i++) {
          if (this_array[i] == Number(attribute)) {
            $('.seat_title').text('Selected Seat(s): ' + 'None');
            // $('#booking_seat').val('');
            swal({
              title: "Oops! Seat is unavailable.",
              text: "Please choose a different seat.",
              icon: "warning",
              button: "Ok",
          })
          }

        }
 


        //Check if a seat is selected and highlight it in colour or deselected and remove the colour highlight
        if(passengerSeat.classList.contains('selected')){
          $(this).parent().find('.input-passenger-seat').removeClass('selected');
          const index = seat_arr.indexOf(attribute);
          if (index > -1) { // only splice array when item is found
            seat_arr.splice(index, 1); // 2nd parameter means remove one item only
          }
        }else{
          $(this).addClass('selected');
          seat_arr.push(attribute);
        }
        $('.seat_title').text('Selected Seat(s): ' + seat_arr);
        $('#booking_seat').val(seat_arr);
        $('.passengers-span').html(seat_arr.length);
        $('#number_passengers').val(seat_arr.length);
        $('#seat_count').val(seat_arr.length);
        $('.seat_count').text(seat_arr);

        var fare_text = parseFloat(seat_arr.length * $('#trip_fare').val()).toFixed(2);

        $('.total-fare-span').html(`GHS` + fare_text);
        $('#amount').val(fare_text);
        $('#pay-stack').html(`PAY GHS `+fare_text+`<span class="ms-3 fas fa-arrow-right"></span>`);
        $('#pay-agent').html(`AGENT PAY `+fare_text+`<span class="ms-3 fas fa-arrow-right"></span>`);

      });
      })




      $(document).ready(function() {

        var current_fs, next_fs, previous_fs; //fieldsets
        var opacity;

        $(".next").click(function() {

          current_fs = $(this).parent();
          next_fs = $(this).parent().next();

          //Add Class Active
          $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

          //show the next fieldset
          next_fs.show();
          //hide the current fieldset with style
          current_fs.animate({
            opacity: 0
          },
          {
            step: function(now) {
              // for making fielset appear animation
              opacity = 1 - now;

              current_fs.css({
                'display': 'none',
                'position': 'relative'
              });
              next_fs.css({
                'opacity': opacity
              });
            },
            duration: 600
          });

          $('.my_luggage').html(`
          <span class="fa-stack fa-sm">
                                  <img src="/assets/img/logos/icons8-luggage-trolley-96.png" style="width: 30px;"/>
                                </span>
                                &nbsp;
                                <b>Luggage</b> {{$trip->start_time}}-{{$trip->end_time}}
          `)


        
          var prnt_name = $('#customer_name').val();
          var prnt_phone = $('#customer_phone').val();      
          var prnt_nextkin = $('#contact_person').val();           
          var prnt_children = $('#number_children').val();      
          var prnt_luggage = $('#luggage_over').val();        
          $('.name-span').html(prnt_name);
          $('.phone-span').html(prnt_phone);
          $('.contact-person-span').html(prnt_nextkin);
          $('.children-span').html(prnt_children);
          $('.luggage-span').html(prnt_luggage);


          seat_arr.forEach(seats => {
            
            $('.traveler-details').append(`
          <div class='col-lg-2'>
            <b>Seat <br>` + seats + `</b>
              </div>
              <input value="  #" class="form-control passenger-add" hidden/>
              <div class='col-lg-4 col-md-4 col-sm-6'>
                <label>
                  Name*
                </label>
                <input type="text" id="pass_name" name="pass_name" class="form-control passenger-add"
                value="" required/>
              </div>
              <div class='col-lg-3 col-md-3 col-sm-6'>
                <label>
                  Age
                </label>
                <input type="tel" name="pass_age" id="pass_age" maxlength="3" class="form-control passenger-add"
                required/>
              </div>
              <div class='col-lg-3 col-md-3 col-sm-6'>
              <label>
                Gender*
              </label>
              <select id="pass_gender" name="pass_gender" class="form-control passenger-add" required>
                <option value="" selected>
                  Select
                </option>
                <option value="Male">
                  Male
                </option>
                <option value="Female">
                  Female
                </option>
            </select>

          </div>       
          `);


          });



        });

        var seats_add_pass = [];
        $('#pay-stack').click(function() {
          var passengers = document.querySelectorAll(".passenger-add");
          passengers.forEach(function(passenger) {
            var attribute = passenger.value;
            seats_add_pass.push(attribute);
          });


        //Output the passenger details onto the page
        var seat_arr_text = seats_add_pass.toString().replace(/,/g, ' ');
        // str = seat_arr_text.slice(0, -1); 
        // $('#seat_pass_sum').html('Passenger Seats:</br> ' + seat_arr_text);
        $('#passenger_summary').val(seat_arr_text);
          // ages.forEach(function(age) {
          //   var attribute = age.getAttribute("value");
          //   alert(age.value);
          // });
          // genders.forEach(function(gender) {
          //   var attribute = gender.getAttribute("value");
          //   alert(gender.value);
          // });
        });

        $(".previous").click(function() {

          current_fs = $(this).parent();
          previous_fs = $(this).parent().prev();

          //Remove class active
          $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");

          //show the previous fieldset
          previous_fs.show();

          //hide the current fieldset with style
          current_fs.animate({
            opacity: 0
          },
          {
            step: function(now) {
              // for making fielset appear animation
              opacity = 1 - now;

              current_fs.css({
                'display': 'none',
                'position': 'relative'
              });
              previous_fs.css({
                'opacity': opacity
              });
            },
            duration: 600
          });
        });

        $(".submit").click(function() {
          return false;
        })

      });
    </script>
    </html>
