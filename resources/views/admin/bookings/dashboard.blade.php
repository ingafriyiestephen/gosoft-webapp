  @include('layouts.head')
      <!-- partial -->
      @include('layouts.sidenav')
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title">
                <span class="page-title-icon bg-gradient-danger text-white me-2">
                  <i class="mdi mdi-home"></i>
                </span> Dashboard
              </h3>
              <nav aria-label="breadcrumb">
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
                                <button class="btn btn-danger" type="submit">GET</button>
                              </div>
                        </form>
                        <form action="{{ url("/booking_dashboard") }}" method="GET">
                          @csrf
                              <div class="col-lg-4 col-md-6 col-sm-12">
                                <input type="hidden" class="form-control" name="all_data" value="All data" />
                                <button class="btn btn-danger" type="submit">All</button>
                              </div>
                            </div>
                        </form>
    
                </div>   
              </nav>
            </div>
            <div class="row">
              <div class="col-md-3 stretch-card grid-margin">
                <div class="card bg-gradient-danger card-img-holder text-white">
                  <div class="card-body">
                    <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">Revenue<i class="mdi mdi-chart-line mdi-24px float-end"></i>
                    </h4>
                    <h2 class="mb-5">₵<?php echo(number_format($total_confirmed, 2, '.', ',')); ?></h2>
                    {{-- <h6 class="card-text">Increased by 60%</h6> --}}
                  </div>
                </div>
              </div>
              <div class="col-md-3 stretch-card grid-margin">
                <div class="card bg-gradient-info card-img-holder text-white">
                  <div class="card-body">
                    <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">Bookings<i class="mdi mdi-bookmark-outline mdi-24px float-end"></i>
                    </h4>
                    <h2 class="mb-5">{{$bookings}}</h2>
                  </div>
                </div>
              </div>
              <div class="col-md-3 stretch-card grid-margin">
                <div class="card bg-gradient-danger card-img-holder text-white">
                  <div class="card-body">
                    <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">Pending Bookings<i class="fa fa-clock-o mdi-24px float-end"></i>
                    </h4>
                    <h2 class="mb-5">{{$count_pending}}</h2>
                    {{-- <h6 class="card-text">Decreased by 10%</h6> --}}
                  </div>
                </div>
              </div>
              <div class="col-md-3 stretch-card grid-margin">
                <div class="card bg-gradient-success card-img-holder text-white">
                  <div class="card-body">
                    <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">Confirmed Bookings<i class="mdi mdi-bookmark-outline mdi-24px float-end"></i>
                    </h4>
                    <h2 class="mb-5">{{$count_confirmed}}</h2>
                    {{-- <h6 class="card-text">Decreased by 10%</h6> --}}
                  </div>
                </div>
              </div>
           
            </div>
            <div class="row">



            </div>
            <div class="row">
              <div class="col-md-3 stretch-card grid-margin">
                <div class="card bg-gradient-success card-img-holder text-white">
                  <div class="card-body">
                    <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">Trips <i class="fa fa-road mdi-24px float-end"></i>
                    </h4>
                    <h2 class="mb-5">{{$trips}}</h2>
                    {{-- <h6 class="card-text">Increased by 5%</h6> --}}
                  </div>
                </div>
              </div>
              <div class="col-md-3 stretch-card grid-margin">
                <div class="card bg-gradient-dark card-img-holder text-white">
                  <div class="card-body">
                    <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">Parcels <i class="fa fa-gift mdi-24px float-end"></i>
                    </h4>
                    <h2 class="mb-5">{{$parcels}}</h2>
                    {{-- <h6 class="card-text">Increased by 5%</h6> --}}
                  </div>
                </div>
              </div>
              <div class="col-md-3 stretch-card grid-margin">
                <div class="card bg-gradient-warning card-img-holder text-white">
                  <div class="card-body">
                    <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">Hirings<i class="mdi mdi-bookmark-outline mdi-24px float-end"></i>
                    </h4>
                    <h2 class="mb-5">{{$hirings}}</h2>
                    {{-- <h6 class="card-text">Decreased by 10%</h6> --}}
                  </div>
                </div>
              </div>
              <div class="col-md-3 stretch-card grid-margin">
                <div class="card bg-gradient-secondary card-img-holder text-white">
                  <div class="card-body">
                    <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">New Users<i class="mdi mdi-bookmark-outline mdi-24px float-end"></i>
                    </h4>
                    <h2 class="mb-5">{{$count_customers}}</h2>
                    {{-- <h6 class="card-text">Decreased by 10%</h6> --}}
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-3 grid-margin">
                <div class="card card-img-holder text-black">
                  <div class="card-body">
                    <h4 class="font-weight-normal mb-3">Staff<i class="fa fa-users mdi-24px float-end"></i>
                    </h4>
                    <h2>{{$team}}</h2>
                  </div>
                </div>
              </div>
              <div class="col-md-3 grid-margin">
                <div class="card card-img-holder text-black">
                  <div class="card-body">
                    <h4 class="font-weight-normal mb-3">Drivers<i class="fa fa-users mdi-24px float-end"></i>
                    </h4>
                    <h2>{{$drivers}}</h2>
                  </div>
                </div>
              </div>
              <div class="col-md-3 grid-margin">
                <div class="card card-img-holder text-black">
                  <div class="card-body">
                    <h4 class="font-weight-normal mb-3">Buses<i class="fa fa-car mdi-24px float-end"></i>
                    </h4>
                    <h2>{{$buses}}</h2>
                  </div>
                </div>
              </div>
              <div class="col-md-3 grid-margin">
                <div class="card card-img-holder text-black">
                  <div class="card-body">
                    <h4 class="font-weight-normal mb-3">Locations<i class="fa fa-map-marker mdi-24px float-end"></i>
                    </h4>
                    <h2>{{$locations}}</h2>
                  </div>
                </div>
              </div>
            </div>

          </div>
          <!-- content-wrapper ends -->

        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    @include('layouts.script')