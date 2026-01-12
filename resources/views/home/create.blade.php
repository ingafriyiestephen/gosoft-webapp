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
                @if (session('message'))
                <div class="alert alert-success w-1/2 max-w-full px-12">
                        {{ session('message') }}
                    </div>
                @endif
                 @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fa fa-exclamation-circle me-2"></i>{{ session('error') }}!
                </div>
                @endif
                <div id="grad2">
                  <span>
                    <a href="{{url('/')}}">
                     <h2> {{$trip->departure}} <img src="/assets/img/logos/icons8-forward-arrow-96.png" style="width: 30px;"/> {{$trip->destination}}, <img src="/assets/img/logos/icons8-calendar-96.png" style="width: 20px;"/>{{$trip->trip_date}}, <img src="/assets/img/logos/icons8-time-96.png" style="width: 20px;"/>{{$trip->start_time}} - {{$trip->end_time}}</h2> 
                    </a>
                  </span>
                  
                </div>
              </div>
              <div class="row">
                <div class="col-md-12 mx-0">
                  <form id="paymentForm" role="form" onsubmit="" action="{{ url("/store_booking") }}" method="POST">
                    @csrf
                    <input type="text" id="trip_id" name="trip_id" value="{{$trip->trip_id}}"
                    hidden/>
                    <input type="text" id="trip_name" name="trip_name" value="{{$trip->trip_name}}"
                    hidden/>
                    <input type="text" id="bus_id" name="bus_id" value="{{$trip->bus_id}}"
                    hidden/>
                    <input type="text" id="booking_code" name="booking_code" value="{{$trip->trip_name}}-{{$trip->trip_id}}-{{$cnt_bkns}}"
                    hidden/>
                    <input type="text" id="booking_fare" name="booking_fare" value="{{$trip->fare}}"
                    hidden/>
                    <input type="text" id="bus_number" name="bus_number" value="{{$trip->bus_number}}"
                    hidden/>
                    


                    <!-- fieldsets -->
                    <fieldset>   
                      <input id="seat_next_pay" type="button" name="next" class="next action-button" value="Next"/>                   
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
                              <p><img src="/assets/img/seats/icons8-selected-seats.JPG" style="width: 25px;"/> Selected</p>
                            </div>
                          </div>
                          <div class="row mb-3">
                            <div class="col-2">
                                <img src="/assets/img/seats/driver-seat.png" style="width: 50px;"  class="input-passenger-seat driver-seat" data-myseat="0"/>
                            </div>
                            <div class="col-2"></div>
                            <div class="col-3"></div>
                            <div class="col-2"></div>
                            <div class="col-2"></div>
                          </div>
                          <!--Seat Row 2-->
                          <div class="row mb-3 seats-1-4">
                            <div class="col-2">
                              <img src="/assets/img/seats/icons8-car-seat-1.png" style="width: 50px;"  class="input-passenger-seat" data-myseat="1"/>
                            </div>
                            <div class="col-2">
                              <img src="/assets/img/seats/icons8-car-seat-2.png" style="width: 50px;"  class="input-passenger-seat" data-myseat="2"/>
                            </div>
                            <div class="col-3"></div>
                            <div class="col-2">
                              <img src="/assets/img/seats/icons8-car-seat-3.png" style="width: 50px;"  class="input-passenger-seat" data-myseat="3"/>
                            </div>
                            <div class="col-2">
                              <img src="/assets/img/seats/icons8-car-seat-4.png" style="width: 50px;"  class="input-passenger-seat" data-myseat="4"/>
                            </div>


                          </div>
                          <!--Seat Row 2-->
                          <!--Seat Row 3-->
                          <div class="row mb-3 seats-5-8">
                            <div class="col-2">
                              <img src="/assets/img/seats/icons8-car-seat-5.png" style="width: 50px;"  class="input-passenger-seat" data-myseat="5"/>
                            </div>
                            <div class="col-2">
                              <img src="/assets/img/seats/icons8-car-seat-6.png" style="width: 50px;"  class="input-passenger-seat" data-myseat="6"/>
                            </div>
                            <div class="col-3"></div>
                            <div class="col-2">
                              <img src="/assets/img/seats/icons8-car-seat-7.png" style="width: 50px;"  class="input-passenger-seat" data-myseat="7"/>
                            </div>
                            <div class="col-2">
                              <img src="/assets/img/seats/icons8-car-seat-8.png" style="width: 50px;"  class="input-passenger-seat" data-myseat="8"/>
                            </div>
                          </div>
                          <!--Seat Row 3-->
                          <!--Seat Row 4-->
                          <div class="row mb-3 seats-9-12">
                            <div class="col-2">
                              <img src="/assets/img/seats/icons8-car-seat-9.png" style="width: 50px;"  class="input-passenger-seat" data-myseat="9"/>
                            </div>
                            <div class="col-2">
                              <img src="/assets/img/seats/icons8-car-seat-10.png" style="width: 50px;"  class="input-passenger-seat" data-myseat="10"/>
                            </div>
                            <div class="col-3"></div>
                            <div class="col-2">
                              <img src="/assets/img/seats/icons8-car-seat-11.png" style="width: 50px;"  class="input-passenger-seat" data-myseat="11"/>
                            </div>
                            <div class="col-2">
                              <img src="/assets/img/seats/icons8-car-seat-12.png" style="width: 50px;"  class="input-passenger-seat" data-myseat="12"/>
                            </div>
                          </div>
                          <!--Seat Row 4-->
                          <!--Seat Row 5-->
                          <div class="row mb-3 seats-13-16">
                            <div class="col-2">
                              <img src="/assets/img/seats/icons8-car-seat-13.png" style="width: 50px;"  class="input-passenger-seat" data-myseat="13"/>
                            </div>
                            <div class="col-2">
                              <img src="/assets/img/seats/icons8-car-seat-14.png" style="width: 50px;"  class="input-passenger-seat" data-myseat="14"/>
                            </div>
                            <div class="col-3"></div>
                            <div class="col-2">
                              <img src="/assets/img/seats/icons8-car-seat-15.png" style="width: 50px;"  class="input-passenger-seat" data-myseat="15"/>
                            </div>
                            <div class="col-2">
                              <img src="/assets/img/seats/icons8-car-seat-16.png" style="width: 50px;"  class="input-passenger-seat" data-myseat="16"/>
                            </div>
                          </div>
                          <!--Seat Row 5-->
                          <!--Seat Row 6-->
                          <div class="row mb-3 seats-17-20">
                            <div class="col-2">
                              <img src="/assets/img/seats/icons8-car-seat-17.png" style="width: 50px;"  class="input-passenger-seat" data-myseat="17"/>
                            </div>
                            <div class="col-2">
                              <img src="/assets/img/seats/icons8-car-seat-18.png" style="width: 50px;"  class="input-passenger-seat" data-myseat="18"/>
                            </div>
                            <div class="col-3"></div>
                            <div class="col-2">
                              <img src="/assets/img/seats/icons8-car-seat-19.png" style="width: 50px;"  class="input-passenger-seat" data-myseat="19"/>
                            </div>
                            <div class="col-2">
                              <img src="/assets/img/seats/icons8-car-seat-20.png" style="width: 50px;"  class="input-passenger-seat" data-myseat="20"/>
                            </div>
                          </div>
                          <!--Seat Row 6-->
                          <!--Seat Row 7-->
                          <div class="row mb-3 seats-21-24">
                            <div class="col-2">
                              <img src="/assets/img/seats/icons8-car-seat-21.png" style="width: 50px;"  class="input-passenger-seat" data-myseat="21"/>
                            </div>
                            <div class="col-2">
                              <img src="/assets/img/seats/icons8-car-seat-22.png" style="width: 50px;"  class="input-passenger-seat" data-myseat="22"/>
                            </div>
                            <div class="col-3"></div>
                            <div class="col-2">
                              <img src="/assets/img/seats/icons8-car-seat-23.png" style="width: 50px;"  class="input-passenger-seat" data-myseat="23"/>
                            </div>
                            <div class="col-2">
                              <img src="/assets/img/seats/icons8-car-seat-24.png" style="width: 50px;"  class="input-passenger-seat" data-myseat="24"/>
                            </div>
                          </div>
                          <!--Seat Row 7-->
                          <!--Seat Row 8-->
                          <div class="row mb-3 seats-25-28">
                            <div class="col-2">
                              <img src="/assets/img/seats/icons8-car-seat-25.png" style="width: 50px;"  class="input-passenger-seat" data-myseat="25"/>
                            </div>
                            <div class="col-2">
                              <img src="/assets/img/seats/icons8-car-seat-26.png" style="width: 50px;"  class="input-passenger-seat" data-myseat="26"/>
                            </div>
                            <div class="col-3"></div>
                            <div class="col-2">
                              <img src="/assets/img/seats/icons8-car-seat-27.png" style="width: 50px;"  class="input-passenger-seat" data-myseat="27"/>
                            </div>
                            <div class="col-2">
                              <img src="/assets/img/seats/icons8-car-seat-28.png" style="width: 50px;"  class="input-passenger-seat" data-myseat="28"/>
                            </div>
                          </div>
                          <!--Seat Row 8-->
                          <!--Seat Row 9-->
                          <div class="row mb-3 seats-29-32">
                            <div class="col-2">
                              <img src="/assets/img/seats/icons8-car-seat-29.png" style="width: 50px;"  class="input-passenger-seat" data-myseat="29"/>
                            </div>
                            <div class="col-2">
                              <img src="/assets/img/seats/icons8-car-seat-30.png" style="width: 50px;"  class="input-passenger-seat" data-myseat="30"/>
                            </div>
                            <div class="col-3"></div>
                            <div class="col-2">
                              <img src="/assets/img/seats/icons8-car-seat-31.png" style="width: 50px;"  class="input-passenger-seat" data-myseat="31"/>
                            </div>
                            <div class="col-2">
                              <img src="/assets/img/seats/icons8-car-seat-32.png" style="width: 50px;"  class="input-passenger-seat" data-myseat="32"/>
                            </div>
                          </div>
                          <!--Seat Row 9-->
                          <!--Seat Row 10-->
                          <div class="row mb-3 seats-33-36">
                            <div class="col-2">
                              <img src="/assets/img/seats/icons8-car-seat-33.png" style="width: 50px;"  class="input-passenger-seat" data-myseat="33"/>
                            </div>
                            <div class="col-2">
                              <img src="/assets/img/seats/icons8-car-seat-34.png" style="width: 50px;"  class="input-passenger-seat" data-myseat="34"/>
                            </div>
                            <div class="col-3"></div>
                            <div class="col-2">
                              <img src="/assets/img/seats/icons8-car-seat-35.png" style="width: 50px;"  class="input-passenger-seat" data-myseat="35"/>
                            </div>
                            <div class="col-2">
                              <img src="/assets/img/seats/icons8-car-seat-36.png" style="width: 50px;"  class="input-passenger-seat" data-myseat="36"/>
                            </div>
                          </div>
                          <!--Seat Row 10-->
                          <!--Seat Row 11-->
                          <div class="row mb-3 seats-37-40">
                            <div class="col-2">
                              <img src="/assets/img/seats/icons8-car-seat-37.png" style="width: 50px;"  class="input-passenger-seat" data-myseat="37"/>
                            </div>
                            <div class="col-2">
                              <img src="/assets/img/seats/icons8-car-seat-38.png" style="width: 50px;"  class="input-passenger-seat" data-myseat="38"/>
                            </div>
                            <div class="col-3"></div>
                            <div class="col-2">
                              <img src="/assets/img/seats/icons8-car-seat-39.png" style="width: 50px;"  class="input-passenger-seat" data-myseat="39"/>
                            </div>
                            <div class="col-2">
                              <img src="/assets/img/seats/icons8-car-seat-40.png" style="width: 50px;"  class="input-passenger-seat" data-myseat="40"/>
                            </div>
                          </div>
                          <!--Seat Row 11-->
                          <!--Seat Row 12-->
                          <div class="row mb-3 seats-41-44">
                            <div class="col-2">
                              <img src="/assets/img/seats/icons8-car-seat-41.png" style="width: 50px;"  class="input-passenger-seat" data-myseat="41"/>
                            </div>
                            <div class="col-2">
                              <img src="/assets/img/seats/icons8-car-seat-42.png" style="width: 50px;"  class="input-passenger-seat" data-myseat="42"/>
                            </div>
                            <div class="col-3"></div>
                            <div class="col-2">
                              <img src="/assets/img/seats/icons8-car-seat-43.png" style="width: 50px;"  class="input-passenger-seat" data-myseat="43"/>
                            </div>
                            <div class="col-2">
                              <img src="/assets/img/seats/icons8-car-seat-44.png" style="width: 50px;"  class="input-passenger-seat" data-myseat="44"/>
                            </div>
                          </div>
                          <!--Seat Row 12-->
                          <!--Seat Row 13-->
                          <div class="row mb-3  bus-50-backseat seats-45-49">
                            <div class="col-2">
                              <img src="/assets/img/seats/icons8-car-seat-45.png" style="width: 50px;"  class="input-passenger-seat" data-myseat="45"/>
                            </div>
                            <div class="col-2">
                              <img src="/assets/img/seats/icons8-car-seat-46.png" style="width: 50px;"  class="input-passenger-seat" data-myseat="46"/>
                            </div>
                            <div class="col-3">
                              <img src="/assets/img/seats/icons8-car-seat-47.png" style="width: 50px;"  class="input-passenger-seat" data-myseat="47"/>
                            </div>
                            <div class="col-2">
                              <img src="/assets/img/seats/icons8-car-seat-48.png" style="width: 50px;"  class="input-passenger-seat" data-myseat="48"/>
                            </div>
                            <div class="col-2">
                              <img src="/assets/img/seats/icons8-car-seat-49.png" style="width: 50px;"  class="input-passenger-seat" data-myseat="49"/>
                            </div>
                          </div>
                          <div class="row mb-3 seats-45-48">
                            <div class="col-2">
                              <img src="/assets/img/seats/icons8-car-seat-45.png" style="width: 50px;"  class="input-passenger-seat" data-myseat="45"/>
                            </div>
                            <div class="col-2">
                              <img src="/assets/img/seats/icons8-car-seat-46.png" style="width: 50px;"  class="input-passenger-seat" data-myseat="46"/>
                            </div>
                            <div class="col-3"></div>
                            <div class="col-2">
                              <img src="/assets/img/seats/icons8-car-seat-47.png" style="width: 50px;"  class="input-passenger-seat" data-myseat="47"/>
                            </div>
                            <div class="col-2">
                              <img src="/assets/img/seats/icons8-car-seat-48.png" style="width: 50px;"  class="input-passenger-seat" data-myseat="48"/>
                            </div>
                          </div>
                          <div class="row mb-3 seats-49-52">
                            <div class="col-2">
                              <img src="/assets/img/seats/icons8-car-seat-49.png" style="width: 50px;"  class="input-passenger-seat" data-myseat="49"/>
                            </div>
                            <div class="col-2">
                              <img src="/assets/img/seats/icons8-car-seat-50.png" style="width: 50px;"  class="input-passenger-seat" data-myseat="50"/>
                            </div>
                            <div class="col-3"></div>
                            <div class="col-2">
                              <img src="/assets/img/seats/icons8-car-seat-51.png" style="width: 50px;"  class="input-passenger-seat" data-myseat="51"/>
                            </div>
                            <div class="col-2">
                              <img src="/assets/img/seats/icons8-car-seat-52.png" style="width: 50px;"  class="input-passenger-seat" data-myseat="52"/>
                            </div>
                          </div>
                          <div class="row mb-3  seats-53-56">
                            <div class="col-2">
                              <img src="/assets/img/seats/icons8-car-seat-53.png" style="width: 50px;"  class="input-passenger-seat" data-myseat="53"/>
                            </div>
                            <div class="col-2">
                              <img src="/assets/img/seats/icons8-car-seat-54.png" style="width: 50px;"  class="input-passenger-seat" data-myseat="54"/>
                            </div>
                            <div class="col-3"></div>
                            <div class="col-2">
                              <img src="/assets/img/seats/icons8-car-seat-55.png" style="width: 50px;"  class="input-passenger-seat" data-myseat="55"/>
                            </div>
                            <div class="col-2">
                              <img src="/assets/img/seats/icons8-car-seat-56.png" style="width: 50px;"  class="input-passenger-seat" data-myseat="56"/>
                            </div>
                          </div>
            
                          <div class="row mb-3 bus-60-backseat seats-57-61" >
                            <div class="col-2">
                              <img src="/assets/img/seats/icons8-car-seat-57.png" style="width: 50px;"  class="input-passenger-seat" data-myseat="57"/>
                            </div>
                            <div class="col-2">
                              <img src="/assets/img/seats/icons8-car-seat-58.png" style="width: 50px;"  class="input-passenger-seat" data-myseat="58"/>
                            </div>
                            <div class="col-3">
                              <img src="/assets/img/seats/icons8-car-seat-59.png" style="width: 50px;"  class="input-passenger-seat" data-myseat="59"/>
                            </div>
                            <div class="col-2">
                              <img src="/assets/img/seats/icons8-car-seat-60.png" style="width: 50px;"  class="input-passenger-seat" data-myseat="60"/>
                            </div>
                            <div class="col-2">
                              <img src="/assets/img/seats/icons8-car-seat-61.png" style="width: 50px;"  class="input-passenger-seat" data-myseat="61"/>
                            </div>
                          </div>

                      </div>
                      <div class="col-lg-6 col-sm-12 col-md-12 mt-3">
                        <div class="px-4 py-5">
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
                              <input type="text" id="customer_phone" name="customer_phone" required/>
                            </div>
                            <div class='col-lg-4 col-md-4 col-sm-6'>
                                <label>
                                  Next of Kin Name*
                                </label>
                                <input type="text" name="kin_name" id="kin_name" required/>
                            </div>
                            <div class='col-lg-4 col-md-4 col-sm-6'>
                            <label>
                              Next of Kin Phone*
                            </label>
                            <input type="tel" name="kin_contact" id="kin_contact" required
                            />
                            </div>
                          </div>
                          <h2 class="fs-title theme-color">
                            Traveler(s) Details
                          </h2>
                          <div class="row traveler-details">
                        
                          </div>
                          <input id="passenger_summary" name="passenger_summary" value="" class="form-control block" type="text"/>
                            <div class="row">
                              <div class="col">
                                <label>
                                  No. of Children below 4yrs
                                </label>
                                <select id="number_children" name="number_children" class="form-control">
                                  <option value="0" selected>
                                    0
                                  </option>
                                  <option value="1">
                                    1
                                  </option>
                                </select>
                              </div>
                            </div>
                            <br>
                            <div class="row">
                              <div class="col">
                                <label>
                                  No. of Luggage (*Total number of luggage you want to put in the booth)
                                </label>
                                <input type="tel" name="luggage_count" id="luggage_count" maxlength="10" value="0" required/>
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
                            <div class="form-card mb-5 rounded shadow-lg">

                              <!--Card Body-->
                              <div class="card-body card-body-cascade">
                      
                                <!--Card Description-->
                                <div class="card2decs">
                      
                                  <div class="p-0 mx-auto px-2">
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
                                    <div class="form">
                                        <div class="row">
                                            <div class="col-12">
                                              <input type="text" name="booking_seat" id="booking_seat" value="" hidden>
                                              <input id="trip_fare" name="trip_fare" class="form-control ps-5" type="text" placeholder="Payment Amount" value="{{$trip_amount->fare}}" hidden>
                                              <input id="booking_amount" name="booking_amount" class="form-control ps-5" type="text" placeholder="Payment Amount" value="" hidden>
                                              <input type="text" name="number_passengers" id="number_passengers" hidden>
                                              <input type="text" name="seat_count" id="seat_count" hidden>
                                              <input type="hidden" name="pay_ref" id="pay_ref" value="{{$user_name}}">
                                            </div>

                                            {{-- <div class="form-group">
                                              <div>
                                                I have read and accepted SOFT terms & conditions.
                                              </div>
                                              <label>
                                                  <input type="checkbox"  /> 
                                              </label>
                                          </div> --}}

                                        </div>
                                        


                                        {{-- <button id="pay-stack" type="button" class="btn btn-primary d-block btn-block mb-3">
                                          PAY GHS 0.00 <span class="ms-3 fas fa-arrow-right"></span>
                                        </button>
                                        <p style="margin-left: 43%;" class="mb-2">--OR--</p> --}}
                                        <button id="book-now" type="button" class="btn btn-success d-block btn-block mb-3">
                                          BOOK NOW GHS0.00 <span class="ms-3 fas fa-arrow-right"></span>
                                        </button>
                                        {{-- <p class="theme-color fs-title">Please Note:</p>
                                        <ul>
                                          <li>Kindly read and accept terms & conditions page.</li>
                                          <li>SOFT will not guarantee tickets confirmation unless payment process is completed.</li>
                                        </ul> --}}
                                    </div>
                                </div>
      
                                </div>
                      
                              </div>
                              <script>                               
                                  const paymentForm = document.getElementById('paymentForm');
                                  const paymentOnline = document.getElementById('pay-stack');
                                  const bookNow = document.getElementById('book-now');

                                  bookNow.addEventListener("click", payBooking, false);
                                  function payBooking(e) {
                                  e.preventDefault(); 


                                  var seats_add_pass = [];

                           
                                  var passengers = document.querySelectorAll(".passenger-add");
                                  passengers.forEach(function(passenger) {
                                    var attribute = passenger.value;
                                    seats_add_pass.push(attribute);
                                  });

                                  //Output the passenger details onto the page
                                  var seat_arr_text = seats_add_pass.toString().replace(/,/g, ' ');
                                  $('#passenger_summary').val(seat_arr_text);

                                  //alert(seat_arr_text);

                                  document.getElementById('paymentForm').submit();
                                  }
                                  
                              </script>
                          </div>
                        </div>
                      </div>


                      <input type="button" name="previous" class="previous action-button-previous"
                      value="Previous" />
                      {{-- <input type="button" name="next" class="next action-button choose-seat-button"
                      value="Next Step" /> --}}
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


      const raw_seat = <?php echo json_encode($seat_number); ?>;
      console.log(raw_seat);

      if(raw_seat == 50){
      $('.seats-45-48').hide();
      $('.seats-49-52').hide();
      $('.seats-53-56').hide();
      $('.bus-60-backseat').hide();
    }else if(raw_seat == 60){
      $('.bus-50-backseat').hide();
    }
      
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
        $('#booking_amount').val(fare_text);
        //$('#pay-stack').html(`PAY GHS `+fare_text+`<span class="ms-3 fas fa-arrow-right"></span>`);
        $('#book-now').html(`BOOK NOW `+fare_text+`<span class="ms-3 fas fa-arrow-right"></span>`);

      });
      })


      const bookings_array = <?php echo json_encode($bookings); ?>;
      // Select the textbox element by its ID
      const kin_name_textbox = document.getElementById('kin_name');
      const customer_phone_textbox = document.getElementById('customer_phone');
      document.addEventListener('DOMContentLoaded', (event) => {
            customer_phone_textbox.addEventListener('input', () => {
              $('#kin_name').val('');
              $('#kin_contact').val('');
              const bookingArray = bookings_array.filter(entry => entry.customer_phone == customer_phone_textbox.value);
              $('#kin_name').val(bookingArray[bookingArray.length - 1].kin_name);
              $('#kin_contact').val(bookingArray[bookingArray.length - 1].kin_contact);

            });
        });


      $(document).ready(function() {

        var current_fs, next_fs, previous_fs; //fieldsets
        var opacity;

        $(".next").click(function() {

          $('.traveler-details').html(``);

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
                Gender
              </label>
              <select id="pass_gender" name="pass_gender" class="form-control passenger-add">
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

        // var seats_add_pass = [];

        // $('#book-now').click(function() {
        //   var passengers = document.querySelectorAll(".passenger-add");
        //   passengers.forEach(function(passenger) {
        //     var attribute = passenger.value;
        //     seats_add_pass.push(attribute);
        //   });

        // // //Output the passenger details onto the page
        // var seat_arr_text = seats_add_pass.toString().replace(/,/g, ' ');
        // $('#passenger_summary').val(seat_arr_text);
        // });

        // $('#book-now').click(function() {
        //   var passengers = document.querySelectorAll(".passenger-add");
        //   passengers.forEach(function(passenger) {
        //     var attribute = passenger.value;
        //     seats_add_pass.push(attribute);
        //   });

        // //Output the passenger details onto the page
        // var seat_arr_text = seats_add_pass.toString().replace(/,/g, ' ');
        // $('#passenger_summary').val(seat_arr_text);

        // });




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
