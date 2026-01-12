@include('layouts.home-head')
   <!-- body -->
   <x-app-layout>
   <body class="main-layout text-bg-light p-3">
      <section >
         <!--main content-->
         <div class="container-fluid text-bg-light" style="background: -webkit-linear-gradient(left, #F02800, #FF5757">
            <div class="row justify-content-center">
                <div class="col-12 col-md-12" style="background: -webkit-linear-gradient(left, #F02800, #FF5757">
                    <div class="card p-3 text-bg-light">
                        <div class="row justify-content-center">
                            <div class="col-12">
                                <h2 class="heading text-center">Where would you like to go?</h2>
                            </div>
                        </div>
                        <form role="form" action="{{ url("/search_trip") }}" class="form-card" method="POST">
                          @csrf
                            <div class="container">
                                    <div class="row">
                                        <div class="col-lg-3 col-sm-12">
                                             <select id="departure" name="departure"  class="form-control">
                                                <option value="location_from" disabled selected>Travelling From</option>
                                                @foreach ($locations as $location)
                                                <option value="{{$location->location_name}}">{{$location->location_name}}</option>
                                                @endforeach
                                             </select>
                                        </div>
                                        <div class="col-lg-3 col-sm-12">
                                             <select id="destination" name="destination" class="form-control">
                                                <option value="location_to" disabled selected>Travelling To</option>
                                                @foreach ($locations as $location)
                                                <option value="{{$location->location_name}}">{{$location->location_name}}</option>
                                                @endforeach
                                             </select>
                                        </div>
                                        <div class="col-lg-3 col-sm-12">
                                          <input type="date" name="trip_date" id="trip_date" max="2023-01-31" class="form-control txtDate" style="height: 34px;" placeholder="Choose Date" type="date">
                                     </div>
                                       <div class="col-lg-3 col-sm-12">                                   
                                          <button type="submit" class="btn btn-primary" onclick="selectLocation();" style="background-color:blue;">Search</button>
                                       </div>
                                    </div>
                            </div>
                            <div class="row justify-content-center" style="margin-top: 20px;">
                              <div class="header-row" id="header-row" style="padding: 0px;">
                                <!-- container-fluid is the same as container but spans a wider viewport, 
                                  it still has padding though so you need to remove this either by adding 
                                  another class with no padding or inline as I did below -->
                                <div class="container-fluid" style="padding: 0px;">
                                    <div class="row"> 
                                      <!-- You originally has it set up for two columns, remove the second 
                                  column as it is unneeded and set the first to always span all 12 columns 
                                  even when at its smallest (xs). Set the overflow to hidden so no matter 
                                  the height of your image it will never show outside this div-->
                                      <div class="col-xs-12"> 
                                          <a class="navbar-brand logo" href="index.html">
                                      <!-- place your image here -->
                                            <img src="/assets/img/banner.jpg" alt="company logo" style="width: 100%;">
                                          </a> 
                                      </div>     
                                    </div>
                                </div>
                              </div>
                            </div>
                        </form>

                        <table  class="table">
                           <thead>
                             <tr>
                               <th scope="col">Trip #</th>
                               <th scope="col">Route</th>
                               <th scope="col">Date/Time</th>
                               <th scope="col">Fare</th>
                               <th scope="col">Bus</th>
                               <th scope="col"></th>
                             </tr>
                           </thead>
                           <tbody id="trip_table" name="trip_table">
                              @foreach ($trips as $trip)
                             <tr>
                               <th scope="row">
                                 {{$trip->trip_name}}
                              </th>
                              <td>
                                 {{$trip->departure}} - {{$trip->destination}}
                              </td>
                              <td>
                                 {{$trip->trip_date}} - {{$trip->start_time}}
                              </td>
                               <td >
                                 {{$trip->fare}}
                               </td>
                               <td>
                                 {{$trip->bus_number}}
                               </td>
                               <td>
                              <a href="{{ url("/view_trip/{$trip->trip_id}") }}"> 
                                <button type="submit" class="btn" style="background-color:#008000; color:#fff">BOOK!</button>
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
        <!--/end main content-->
      </section>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
      <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <script>
      if (document.getElementById('trip_table').rows.length == 0) {
          //...do something here
          swal({
              title: "Oops! We Found No Trip.",
              text: "No avalable trips for the above selection. Please try with other location or date.",
              icon: "warning",
              button: "Ok",
          })
      }

      var elem = document.getElementsByClassName('selected_seat');
      for(var i=0; i<elem.length; i++)
      {
        elem[i].addEventListener('click', function(){
          document.getElementById('seat_number').innerHTML = this.id;
          document.getElementById('booking_seat').value = document.getElementById('trip_id').value + "-" + this.id;
        })
      } 
      var today = new Date().toISOString().split('T')[0];
      document.getElementsByName("trip_date")[0].setAttribute('min', today);
    </script>
</x-app-layout>
</html>

