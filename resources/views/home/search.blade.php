<x-app-layout>
<?php
$cnt_bkns = count($trips) + 1;
$avail_seats = count($trips);
?>
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
    <div  class="pageLoader" id="pageLoader"></div>
      <section >
         <!--main content-->
         <div class="container-fluid text-bg-light" style="background: -webkit-linear-gradient(left, #F02800, #FF5757">
            <div class="row justify-content-center">
                <div class="col-12 col-md-12" style="background: -webkit-linear-gradient(left, #F02800, #FF5757">
                    <div class="card p-3 text-bg-light">
                        <div class="row justify-content-center">
                            <div class="col-12">
                                <h4 class="text-center mt-2 mb-4">Where would you like to go?</h4>
                            </div>
                        </div>
                        {{-- <h4 class="text-center">Where would you like to go?</h4> --}}
                        <form role="form" name="search_trip" id="search_trip" action="{{ url("/search_trip") }}" class="form-card" method="POST">
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
                                          <input type="date" name="trip_date" id="trip_date" max="2023-02-31" class="form-control txtDate" style="height: 34px;" placeholder="Choose Date"  type="date" required>
                                     </div>
                                       <div class="col-lg-3 col-sm-12">                                   
                                          <button type="submit" class="btn btn-primary" onclick="selectLocation();" style="background-color:blue; width: 200px; background-image: linear-gradient(to right, rgba(255,0,0,0), rgba(255,0,0,1));"">Search</button>
                                       </div>
                                    </div>
                            </div>
                          </form>
                            <table  class="table" class="table_wrapper">
                              <tbody id="trip_table" name="trip_table">
                                 @foreach ($trips as $trip)
                                <tr>
                                  <td>
                                    <div class="flex px-2 py-1">
                                      <div>
                                        <img src="https://cms.eichertrucksandbuses.com/uploads/truck/sub-category/a933e5958e4a354cfb8d22665bd244fd.png" style="width: 80px;"/>
                                        <span>
                                          <h4>{{$trip->trip_name}}</h4>
                                          {{$trip->departure}} - {{$trip->destination}}
                                        </span>
                                      </div>
                                      <div>
                                        {{$trip->start_time}} - {{$trip->end_time}}
                                      </div>
                                      <div>
                                        <img src="/assets/img/logos/icons8-duration-64.png" style="width: 20px;"/>
                                        <?php
                                          $trip_duration = (strtotime($trip->end_time) - strtotime($trip->start_time)) / 3600;
                                          echo round(ceil($trip_duration*100)/100, 5). ' Hours';
                                        ?>
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
                                        $start_time = $trip->start_time;
                                        $report_time = date('H:i:s', strtotime($start_time. ' -40 minutes'));
                                        echo $report_time;
                                        ?>
                                    </div>
                                    <br>
                                    <div>
                                      <img src="/assets/img/logos/icons8-time-96.png" style="width: 50px;"/>
                                    </div>
                                    <div>
                                        <b>Departure Time</b> {{$trip->start_time}}
                                    </div>
                                 </td>
                                  <td >
                                    <div>
                                      <img src="/assets/img/logos/icons8-money-96.png" style="width: 50px;"/>
                                      <br>
                                      <span>
                                        <b>Travel Fare</b>
                                        <h3>  GH₵ {{$trip->fare}}</h3>
                                      </span>
                                    </div>
                                  </td>
                                  <td>
                                    <div>
                                      <img src="/assets/img/logos/icons8-numbers-input-form-100.png" style="width: 50px;"/>
                                      <br>
                                      <span>
                                        <b>Bus Number</b>
                                        <h3> {{$trip->bus_number}}</h3>
                                      </span>
                                    </div>
                                  </td>
                                  <td>
                                    <div>
                                      <img src="/assets/img/logos/icons8-seat-64.png" style="width: 50px;"/>
                                    </div>
                                    <div>
                                      <span>
                                        <h3>{{$trip->seat_number}} Seats</h3>
                                        <h5>
                                        <?php
                                        foreach ($book_seats as $key => $value){
                                          if ($key == $trip->trip_id){
                                            $d = $trip->seat_number - (int)$value;
                                            echo $d. ' Available';                                  
                                          }
                                        }
                                        ?>
                                        </h5>
                                      </span>
                                    </div>
                                   </td>
                                  <td>
                                    <div style="height: 50px;"></div>
                                    <a href="{{ url("/view_trip/{$trip->trip_id}") }}"> 
                                      <button type="submit" class="btn" style="background-color:#008000; color:#fff; marigin-top: 20px;">VIEW SEATS</button>
                                    </a>
                                  </td>
                                </tr>
                                @endforeach
                              </tbody>
                            </table>

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
                                            <img src="/assets/img/passengers_onbus.jpg" style="width: 100%;">
                                          </a> 
                                      </div>     
                                    </div>
                                </div>
                              </div>
                            </div>
                    </div>                  
                </div>              
            </div>
        </div>
        <!--/end main content-->
      </section>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
      <script>
        window.onload = function() {
          $('#pageLoader').hide();
        };
        //Block earlier and some later dates
        if (document.getElementById('trip_table').rows.length == 0) {
          //...do something here
          swal({
              title: "Oops! We Found No Trip.",
              text: "No avalable trips for the above selection. Please try with other location or date.",
              icon: "warning",
              button: "Ok",
          })
        }
        var today = new Date().toISOString().split('T')[0];
        document.getElementsByName("trip_date")[0].setAttribute('min', today);
        //Ensure that From and To are selected
        function selectLocation() {
              var x = document.getElementById("departure").value;
              var y = document.getElementById("destination").value;
              if (x==="location_from"){
                  swal({
                      title: "Please select a departure point",
                      icon: "warning",
                      button: "Ok",
                  })
              }else if (y==="location_to"){
                swal({
                      title: "Please select a destination point",
                      icon: "warning",
                      button: "Ok",
                  })
              }
            }

            let form = document.querySelector('#search_trip');

            form.addEventListener('submit', function (event) {
              event.preventDefault();
              $('#pageLoader').hide();
            });
      </script>
</html>
</x-app-layout>
