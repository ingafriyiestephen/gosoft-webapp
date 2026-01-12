@include('layouts.head')
<!-- partial -->
@include('layouts.sidenav')
  <!-- partial -->
  <div class="main-panel">
    <div class="content-wrapper">
      <div class="page-header">
        <h3 class="page-title">
          <span class="page-title-icon bg-gradient-primary text-white me-2">
            <i class="fa fa-drivers-license-o"></i>
          </span> Edit Trip
        </h3>
      </div>
 

      <div class="flex flex-wrap -mx-3">
        <div class="flex-none w-full max-w-full px-3">
          <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
            <!--Add Bus form-->
            <div class="flex-auto p-6">
              <!--Back button-->
              <div class="relative w-full mb-3">
                <a href="{{ url("/trips") }}"> 
                  <button class="btn btn-secondary back-button"><i class="fas fa-arrow-left"></i> Back</button>
                </a>
              </div>
              <div class="relative w-full mb-3">
                @if (session('message'))
                <div class="alert alert-success w-1/2 max-w-full px-12">
                        {{ session('message') }}
                    </div>
                @endif
                <!--Display All Error Messages -->
                @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
              </div>
            <form role="form" action="{{ url("/update_trip/{$trip->trip_id}") }}" style="margin-left: 20px;" method="POST">
              @csrf
              <h6 class="text-blueGray-400 text-sm mt-3 mb-6 font-bold uppercase">
                Edit Trip
              </h6>
              <div class="row">
              <div class="row" style="margin-bottom: 20px;">
                  <div class="col-lg-3 col-sm-12">
                        <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2" htmlfor="grid-password">
                          Trip Name
                        </label>
                        <input type="text" name="trip_name" id="trip_name" class="form-control" value="{{$trip->trip_name}}" />
                  </div>
                  <div class="col-lg-3 col-sm-12">
                    <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2" htmlfor="grid-departure">
                      Departure
                    </label>
                    <select id="departure" name="departure" class="form-select">
                      <option value="{{$trip->departure}}">{{$trip->departure}}</option>
                      @foreach ($locations as $location)
                        <option value="{{$location->location_name}}">{{$location->location_name}}</option>
                      @endforeach
                    </select> 
                </div>
                <div class="col-lg-3 col-sm-12">
                    <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2" htmlfor="grid-destination">
                      Destination
                    </label>
                    <select id="destination" name="destination" class="form-select">
                      <option value="{{$trip->destination}}">{{$trip->destination}}</option>
                      @foreach ($locations as $location)
                        <option value="{{$location->location_name}}">{{$location->location_name}}</option>
                      @endforeach
                    </select> 
                </div>
                <div class="col-lg-3 col-sm-12">
                  <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2" htmlfor="grid-destination">
                    Status
                  </label>
                  <select id="trip_status" name="trip_status" class="form-select">
                    <option value="{{$trip->trip_status}}">{{$trip->trip_status}}</option>
                    <option value="Pending" >Trip pending</option>
                    <option value="Booking">Trip booking</option>
                    <option value="Cancelled">Trip cancelled</option>
                    <option value="Set-off">Bus has set-off</option>
                    <option value="Temporarily-Stopped">Bus has temporarily stopped</option>
                    <option value="Arrived">Bus has arrived</option>
                    <option value="Closed">Trip closed</option>
                  </select> 
                </div>
              </div>
              <div class="row" style="margin-bottom: 20px;">
                <div class="col-lg-3 col-sm-12">
                    <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2" htmlfor="grid-password">
                      Trip Start Date
                    </label>
                    <input type="date" name="trip_date" id="trip_date" class="form-control text-gray-700" value="{{$first}}" />
                </div>
                <div class="col-lg-3 col-sm-12">
                    <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2" htmlfor="grid-password">
                      Start Time
                    </label>
                    <input type="time" name="start_time" id="start_time" class="form-control text-gray-700" value="{{$trip->start_time}}" />
                </div>
                <div class="col-lg-3 col-sm-12">
                    <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2" htmlfor="grid-password">
                      Trip End Date
                    </label>
                    <input type="date" name="trip_end_date" id="trip_end_date" class="form-control text-gray-700" value="{{$last}}" />
                </div>
                <div class="col-lg-3 col-sm-12">
                    <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2" htmlfor="grid-password">
                      End Time
                    </label>
                    <input type="time" name="end_time" id="end_time" class="form-control text-gray-700" value="{{$trip->end_time}}" />
                </div>
              </div>
              <div class="row" style="margin-bottom: 20px;">
                <div class="col-lg-3 col-sm-12">
                    <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2" htmlfor="grid-password">
                      Fare
                    </label>
                    <input type="text" name="fare" id="fare" class="form-control" value="{{$trip->fare}}" />
                </div>
                <div class="col-lg-3 col-sm-12">
                    <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2" htmlfor="grid-bus_id">
                      Bus
                    </label>
                    <select id="bus_id" name="bus_id" class="form-select">
                      <option value="{{$trip->bus_id}}">{{$trip->bus_number}}</option>
                      @foreach ($buses as $bus)
                        <option value="{{$bus->bus_id}}">{{$bus->bus_number}}</option>
                      @endforeach
                    </select> 
                </div>
                <div class="col-lg-3 col-sm-12">
                    <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2" htmlfor="grid-driver_id">
                      Driver
                    </label>
                    <select id="driver_id" name="driver_id" class="form-select">
                      <option value="{{$trip->driver_id}}">{{$trip->driver_name}}</option>
                      @foreach ($drivers as $driver)
                        <option value="{{$driver->driver_id}}">{{$driver->driver_name}}</option>
                      @endforeach
                    </select> 
                </div>
                  <div class="col-lg-3 col-sm-12">
                      <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2" htmlfor="grid-driver_id">
                        Availability
                      </label>
                      <select id="trip_available" name="trip_available" class="form-select">
                        <option value="{{$trip->trip_available}}">{{$trip->trip_available}}</option>
                          <option value="Yes">Yes</option>
                          <option value="No">No</option>
                      </select> 
                  </div>
              </div>
              </div>
              </div>
              <div class="modal-footer">
                <button type="submit" class="btn btn-success" style="margin-bottom: 10px; margin-right: 20px;">Save Changes</button>
              </div>
            </form>
            </div>
          </div>
        </div>


    </div>
    <!-- content-wrapper ends -->
  </div>
  <!-- main-panel ends -->

@include('layouts.script')
