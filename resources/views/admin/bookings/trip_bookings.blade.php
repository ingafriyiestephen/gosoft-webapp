<x-app-layout>
  @include('layouts.head')
   <body class="m-0 font-sans antialiased font-normal text-base leading-default bg-gray-50 text-slate-500">
   @include('layouts.sidenav')
   @include('layouts.mobile-nav')
   <div class="container-fluid">
        <!-- Modal -->
        <div class="modal fade bd-example-modal-xl" id="modalBooking" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
          <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="modalBookingTitle">Add New Booking</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                  <!--Add Bus form-->
                  <form role="form" action="{{ url("/store_trip_booking/{$trip->trip_id}") }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="">
                      <div class="row" style="margin-bottom: 20px;">
                        <div class="col">
                          <div class="">
                            <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2" htmlfor="grid-departure">
                              Search User Phone
                            </label>
                            <select id="phone" name="phone" class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow">
                              <option>Select Phone</option>
                              @foreach ($users as $user)
                                <option value="{{$user->phone}}">{{$user->phone}}</option>
                              @endforeach
                            </select> 
                          </div>
                        </div>
                      <div class="col">
                        <div class="">
                          <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2" htmlfor="grid-password">
                            Passenger Name
                          </label>
                          <input type="text" name="user" id="user" class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow" placeholder="Enter User Name" />
                        </div>
                      </div>
                      <div class="col">
                        <div class="">
                          <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2" htmlfor="grid-password">
                            Email
                          </label>
                          <input type="text" name="email" id="email" class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow" placeholder="Enter User Email" />
                        </div>
                      </div>
                      <div class="col">
                        <div class="">
                          <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2" htmlfor="grid-departure">
                            Departure
                          </label>
                          <select id="departure" name="departure" class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow">
                            <option>Select</option>
                            {{-- @foreach ($locations as $location)
                              <option value="{{$location->location_name}}">{{$location->location_name}}</option>
                            @endforeach --}}
                          </select> 
                        </div>
                      </div>
                      <div class="col">
                        <div class="">
                          <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2" htmlfor="grid-destination">
                            Destination
                          </label>
                          <select id="destination" name="destination" class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow">
                            <option>Select</option>
                            {{-- @foreach ($locations as $location)
                              <option value="{{$location->location_name}}">{{$location->location_name}}</option>
                            @endforeach --}}
                          </select> 
                        </div>
                      </div>
                      </div>
                      <div class="row" style="margin-bottom: 20px;"><!--Start Row-->
                        <div class="col">
                            <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2" htmlfor="grid-password">
                              Trip Date
                            </label>
                            <input type="date" name="trip_date" id="trip_date" class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow" placeholder="Enter Trip Date" />
                        </div>
                      <div class="col">
                        <div class="">
                          <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2" htmlfor="grid-password">
                            Start Time
                          </label>
                          <input type="time" name="start_time" id="start_time" class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow" placeholder="Enter Start Time" />
                        </div>
                      </div>
                      <div class="col">
                        <div class="">
                          <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2" htmlfor="grid-password">
                            End Time
                          </label>
                          <input type="time" name="end_time" id="end_time" class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow" placeholder="Enter End Time" />
                        </div>
                      </div>
                      </div><!--End Row-->
                      <div class="row" style="margin-bottom: 20px;"><!--Start Row-->
                      <div class="col">
                          <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2" htmlfor="grid-password">
                            Fare
                          </label>
                          <input type="text" name="fare" id="fare" class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow" placeholder="Enter Trip" />
                      </div>
                      <div class="col">
                          <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2" htmlfor="grid-bus_id">
                            Bus
                          </label>
                          <select id="bus_id" name="bus_id" class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow">
                            <option>Select</option>
                            {{-- @foreach ($buses as $bus)
                              <option value="{{$bus->bus_id}}">{{$bus->bus_number}}</option>
                            @endforeach --}}
                          </select> 
                      </div>
                      <div class="col">
                        <div class="">
                          <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2" htmlfor="grid-driver_id">
                            Driver
                          </label>
                          <select id="driver_id" name="driver_id" class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow">
                            <option>Select</option>
                            {{-- @foreach ($drivers as $driver)
                              <option value="{{$driver->driver_id}}">{{$driver->driver_name}}</option>
                            @endforeach --}}
                          </select> 
                        </div>
                      </div>
                      <div class="col">
                        <div class="">
                          <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2" htmlfor="grid-password">
                            Status
                          </label>
                          <select id="condition" name="condition" class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow">
                            <option>Select</option>
                              <option value="Avialable">Avialable</option>
                              <option value="Un-avialable">Un-available</option>
                          </select> 
                        </div>
                      </div>
                    </div><!--End Row-->
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                  </form>
              <!--/Add Bus Form-->
    
            </div>
          </div>
        </div>
        </div>

      <div class="flex-none w-full max-w-full px-3" style="margin-top: 20PX;">
        <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">


          <div class="card mb-4">
            <div class="card-header">
                <i class="fa leading-none fa-book me-1"></i>
                Bookings for Trip {{$trip->trip_name}}
                <a href="{{ url("/create_trip_booking/{$trip->trip_id}") }}"> 
                  <button type="button" class="btn btn-primary btn-sm" style="width: 200px; margin-left: 17px;">New Booking</button>
                </a>
  
            </div>
            <div class="card-body">
              <table id="dataTable" class="display no-wrap" style="width: 100%;">
                    <thead>
                        <tr>
                          {{-- <th>Trip Name</th> --}}
                          <th>Booking Code</th>
                          <th>Passenger</th>
                          <th>Count</th>
                          <th>Luggage (Above 10kg)</th>
                          <th>Contact Person</th>
                          <th>Time</th>
                          <th></th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                          {{-- <th>Trip Name</th> --}}
                          <th>Booking Code</th>
                          <th>Passenger</th>
                          <th>Count</th>
                          <th>Luggage (Above 10kg)</th>
                          <th>Contact Person</th>
                          <th>Time</th>
                          <th></th>
                      </tr>
                    </tfoot>
                    <tbody>
                      @foreach ($bookings as $booking)
                      <tr>
                        {{-- <td>
                          <div class="flex px-2 py-1">
                            <div class="flex flex-col justify-center">
                              <p class="mb-0 leading-tight text-xs text-slate-400">{{$trip->trip_name}}</p>
                            </div>
                          </div>
                        </td> --}}
                        <td>
                          <div class="flex px-2 py-1">
                            <div class="flex flex-col justify-center">
                              <p class="mb-0 leading-tight text-xs text-slate-400">{{$booking->booking_code}}</p>
                            </div>
                          </div>
                        </td>
                        <td>
                          <p class="mb-0 font-semibold leading-tight text-xs">{{$booking->customer_name}}</p>
                          <p class="mb-0 font-semibold leading-tight text-xs">{{$booking->customer_phone}}</p>
                          <p class="mb-0 leading-tight text-xs text-slate-400">{{$booking->customer_email}}</p>
                        </td>
                        <td>
                          <p class="mb-0 leading-tight text-xs text-slate-400">Adult: {{$booking->number_passengers}}</p>
                          <p class="mb-0 leading-tight text-xs text-slate-400">Children: {{$booking->number_children}}</p>
                        </td>
                        <td class="p-2 leading-normal text-center align-middle bg-transparent border-b text-sm whitespace-nowrap shadow-transparent">
                          <span class="font-semibold leading-tight text-xs text-slate-400">{{$booking->luggage_over}}</span>
                        </td>
                        <td class="p-2 leading-normal text-center align-middle bg-transparent border-b text-sm whitespace-nowrap shadow-transparent">
                          <span class="font-semibold leading-tight text-xs text-slate-400">{{$booking->contact_person}}</span>
                        </td>
                        <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                          <span class="font-semibold leading-tight text-xs text-slate-400">{{$booking->created_at}}</span>
                        </td>
                        <td>
                          <a href="{{ url("/edit_admin_booking/{$booking->booking_id}") }}" class="btn btn-sm btn-warning"> 
                            <i class="bi bi-pencil-square"></i>
                          </a>
                        </td>
                      </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
      </div>
    </div>
    <!-- card 2 -->
  </main>
</body>
@include('layouts.script')
</html>
</x-app-layout>
