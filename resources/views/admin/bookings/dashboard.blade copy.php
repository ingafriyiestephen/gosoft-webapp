
   <x-app-layout>
    @include('layouts.head')
     <body class="m-0 font-sans antialiased font-normal text-base leading-default bg-gray-50 text-slate-500">
     @include('layouts.sidenav')
     @include('layouts.mobile-nav')
   
     <div class="container-fluid">

            <div class="container">
              <div class="row">
                <h5 class="text-center my-3">Filter Data between Dates</h5>
                    <h6>{{$filter_result}}</h6>
                    <form action="{{ url("/booking_dashboard") }}" method="GET">
                    @csrf
                        <div class="input-group mb-3">
                          <div class="col-lg-3 col-md-6 col-sm-12">
                            <input type="date" class="form-control" name="start_date">
                          </div>
                          <div class="col-lg-3 col-md-6 col-sm-12">
                            <input type="date" class="form-control" name="end_date">
                          </div>
                          <div class="col-lg-2 col-md-6 col-sm-12">
                            <button class="btn btn-primary" style="height: 38px;" type="submit">GET</button>
                          </div>
                    </form>
                    <form action="{{ url("/booking_dashboard") }}" method="GET">
                      @csrf
                          <div class="col-lg-4 col-md-6 col-sm-12">
                            <input type="hidden" class="form-control" name="all_data" value="All data" />
                            <button class="btn btn-primary" style="height: 38px;" type="submit">All</button>
                          </div>
                        </div>
                    </form>

            </div>              
             <!--Start Row-->
              <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-12">
                  <a href="#" style="text-decoration: none; color: inherit;">
                    <div class="wrimagecard wrimagecard-topimage">
                        <div class="wrimagecard-topimage_header" style="background-color:rgba(187, 120, 36, 0.1)">
                           <center><img src="/assets/img/logos/icons8-route-96.png" style="width: 60px;"/></center>
                        </div>
                        <div class="wrimagecard-topimage_title">
                          <h5>Trips: &nbsp;&nbsp; {{$trips}}</h5>
                        </div>
                    </div>
                  </a>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12">
                  <form action="{{ url("/filter_sales") }}" method="GET">
                    @csrf
                    <input type="text" class="form-control" name="start_date_sales" value="{{$start_date}}" hidden>
                    <input type="text" class="form-control" name="end_date_sales" value="{{$end_date}}" hidden>
                    <div class="wrimagecard wrimagecard-topimage">
                      <div class="wrimagecard-topimage_header" style="background-color:rgba(162, 36, 187, 0.1) ">
                        <center><img src="/assets/img/logos/icons8-report-time-96.png" style="width: 60px;"/></center>
                          </div>
                          <div class="wrimagecard-topimage_title">
                            <button class="btn" type="submit"><h5>Bookings:&nbsp; {{$bookings}}</h5></button>
                          </div>
                          
                      </div>  
                    </form>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12">
                  <form action="{{ url('/pending') }}" method="GET">
                    @csrf
                    <input type="text" class="form-control" name="start_date_pending" value="{{$start_date}}" hidden>
                    <input type="text" class="form-control" name="end_date_pending" value="{{$end_date}}" hidden>
                    <div class="wrimagecard wrimagecard-topimage">
                      <div class="wrimagecard-topimage_header" style="background-color:  rgba(89, 193, 207, 0.1)">
                          <center><img src="/assets/img/logos/icons8-pending-96.png" style="width: 60px;"/></center>
                          </div>
                          <div class="wrimagecard-topimage_title">
                            <button class="btn" type="submit"><h5>Pending:&nbsp; {{$count_pending}}</h5></button>
                          </div>
                          
                      </div>  
                    </form>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12">
                  <form action="{{ url("/confirmed") }}" method="GET">
                    @csrf
                    <input type="text" class="form-control" name="start_date_confirm" value="{{$start_date}}" hidden>
                    <input type="text" class="form-control" name="end_date_confirm" value="{{$end_date}}" hidden>
                    <div class="wrimagecard wrimagecard-topimage">
                        <div class="wrimagecard-topimage_header" style="background-color:  rgba(250, 188, 9, 0.1)">
                            <center><img src="/assets/img/logos/icons8-mobile-id-verification-96.png" style="width: 60px;"/></center>
                          </div>
                          <div class="wrimagecard-topimage_title">
                            <button class="btn" type="submit"><h5>Confirmed:&nbsp; {{$count_confirmed}}</h5></button>
                          </div>
                          
                      </div>  
                    </form>
                </div>
              </div>

              <!--Start Row-->
              <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-12">
                  <a href="#" style="text-decoration: none; color: inherit;">
                    <div class="wrimagecard wrimagecard-topimage">
                        <div class="wrimagecard-topimage_header" style="background-color:rgba(187, 120, 36, 0.1)">
                            <center><img src="/assets/img/logos/icons8-money-96.png" style="width: 60px;"/></center>
                        </div>
                        <div class="wrimagecard-topimage_title">
                          <h6>Amount Confirmed:</h6> <h5>₵<?php echo(number_format($total_confirmed, 2, '.', ',')); ?></h5>
                        </div>
                    </div>
                  </a>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12">
                <a href="#" style="text-decoration: none; color: inherit;">
                  <div class="wrimagecard wrimagecard-topimage">
                      <div class="wrimagecard-topimage_header" style="background-color:rgba(187, 120, 36, 0.1)">
                          <center><img src="/assets/img/logos/icons8-payment-history-96.png" style="width: 60px;"/></center>
                      </div>
                      <div class="wrimagecard-topimage_title">
                        <h6>Amount Pending:</h6> <h5>₵<?php echo(number_format($total_pending, 2, '.', ',')); ?></h5>
                      </div>
                  </div>
                </a>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12">
                  <a href="#" style="text-decoration: none; color: inherit;">
                    <div class="wrimagecard wrimagecard-topimage">
                        <div class="wrimagecard-topimage_header" style="background-color:rgba(187, 120, 36, 0.1)">
                            <center><img src="/assets/img/logos/icons8-banknotes-96.png" style="width: 60px;"/></center>
                        </div>
                        <div class="wrimagecard-topimage_title">
                          <h6>Total Amount:</h6> <h5> ₵<?php echo(number_format($total_confirmed + $total_pending , 2, '.', ',')); ?></h5>
                        </div>
                    </div>
                  </a>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12">
                  <a href="{{url('/hirings')}}" style="text-decoration: none; color: inherit;">
                    <div class="wrimagecard wrimagecard-topimage">
                        <div class="wrimagecard-topimage_header" style="background-color:rgba(187, 120, 36, 0.1)">
                            <center><img src="/assets/img/logos/icons8-trip-96.png " style="width: 60px;"/></center>
                        </div>
                        <div class="wrimagecard-topimage_title">
                          <h5>Hirings: &nbsp;&nbsp; {{$hirings}}</h5>
                        </div>
                    </div>
                  </a>
                </div>
              </div>
              <!--/End Row-->
    
            <!--Start Row-->
            <div class="row">
              <div class="col-lg-3 col-md-6 col-sm-12">
                <a href="{{url('/customers')}}" style="text-decoration: none; color: inherit;">
                <div class="wrimagecard wrimagecard-topimage">
                        <div class="wrimagecard-topimage_header" style="background-color:rgba(162, 36, 187, 0.1) ">
                          <center><img src="/assets/img/logos/icons8-name-96.png" style="width: 60px;"/></center>
                        </div>
                        <div class="wrimagecard-topimage_title" style="text-decoration: none;">
                          <h5>Customers: &nbsp; {{$count_customers}}</h5>
                        </div>
                  </div>
                </a>
              </div>
              <div class="col-lg-3 col-md-6 col-sm-12">
                <a href="{{url('/customers')}}" style="text-decoration: none; color: inherit;">
                <div class="wrimagecard wrimagecard-topimage">
                        <div class="wrimagecard-topimage_header" style="background-color:rgba(162, 36, 187, 0.1) ">
                          <center><img src="/assets/img/logos/icons8-bus-96.png" style="width: 60px;"/></center>
                        </div>
                        <div class="wrimagecard-topimage_title">
                          <h5>Buses: &nbsp;&nbsp; {{$buses}}</h5>
                        </div>
                  </div>
                </a>
              </div>
              <div class="col-lg-3 col-md-6 col-sm-12">
                <a href="{{url('/drivers')}}" style="text-decoration: none; color: inherit;">
                  <div class="wrimagecard wrimagecard-topimage">
                      <div class="wrimagecard-topimage_header" style="background-color:rgba(187, 120, 36, 0.1)">
                          <center><img src="/assets/img/logos/icons8-driver-96.png" style="width: 60px;"/></center>
                      </div>
                      <div class="wrimagecard-topimage_title">
                        <h5>Drivers: &nbsp;&nbsp; {{$drivers}}</h5>
                      </div>
                  </div>
                </a>
              </div>
             <div class="col-lg-3 col-md-6 col-sm-12">
                <a href="{{url('/stores')}}" style="text-decoration: none; color: inherit;">
                  <div class="wrimagecard wrimagecard-topimage">
                      <div class="wrimagecard-topimage_header" style="background-color: rgba(250, 188, 9, 0.1)">
                          <center><img src="/assets/img/logos/icons8-users-96.png" style="width: 60px;"/></center>
                      </div>
                      <div class="wrimagecard-topimage_title">
                        <h5>Team: &nbsp;&nbsp; {{$team}}</h5>
                      </div>
                  </div>
                </a>
              </div>    
            </div>
            <!--/End Row-->

    

    
    

    
        </div>
    
    </div>
  @include('layouts.script')
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  </body>
  </html>
  </x-app-layout>
