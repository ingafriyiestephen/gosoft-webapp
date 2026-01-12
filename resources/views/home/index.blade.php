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
            <div class="row justify-content-center">
                    <div class="card p-3 text-bg-light">
                        <div class="row justify-content-center">
                            <div class="col-12">
                                <h2 class="heading text-center">Where would you like to go?</h2>
                                  @if (session('message'))
                                  <div class="alert alert-success w-1/2 max-w-full px-12">
                                          {{ session('message') }}
                                      </div>
                                  @endif
                            </div>
                        </div>
                        <!--<form role="form" action="{{ url("/search_trip") }}" class="form-card" method="POST">-->
                        <!--  @csrf-->
                        <!--    <div class="container">-->
                        <!--            <div class="row">-->
                        <!--                <div class="col-lg-3 col-sm-12">-->
                        <!--                     <select id="departure" name="departure"  class="form-control" onchange="getSelectValue(this.value);">-->
                        <!--                        <option value="location_from" disabled selected>Travelling From</option>-->
                        <!--                        @foreach ($locations as $location)-->
                        <!--                        <option value="{{$location->location_name}}">{{$location->location_name}}</option>-->
                        <!--                        @endforeach-->
                        <!--                     </select>-->
                        <!--                </div>-->
                        <!--                <div class="col-lg-3 col-sm-12">-->
                        <!--                     <select id="destination" name="destination" class="form-control">-->
                        <!--                        <option value="location_to" disabled selected>Travelling To</option>-->
                        <!--                        @foreach ($locations as $location)-->
                        <!--                        <option value="{{$location->location_name}}">{{$location->location_name}}</option>-->
                        <!--                        @endforeach-->
                        <!--                     </select>-->
                        <!--                </div>-->
                        <!--                <div class="col-lg-3 col-sm-12">-->
                        <!--                  <input type="date" name="trip_date" id="trip_date" max="2023-02-31" class="form-control txtDate" style="height: 34px;" placeholder="Choose Date" type="date">-->
                        <!--             </div>-->
                        <!--               <div class="col-lg-3 col-sm-12">                                   -->
                        <!--                  <button type="submit" class="btn btn-primary" onclick="selectLocation();" style="background-color:blue; width: 200px; background-image: linear-gradient(to right, rgba(255,0,0,0), rgba(255,0,0,1));"">Search</button>-->
                        <!--               </div>-->
                        <!--            </div>-->
                        <!--    </div>-->
                        <!--</form>-->
                        <div class="row justify-content-center mr-3">
                          <table  class="table" class="table_wrapper">
                            <tbody id="trip_table" name="trip_table">
                               @foreach ($trips as $trip)
                              <tr>
                                <td>
                                  <div class="flex px-2 py-1">
                                    <div>
                                      <!--<img src="/assets/img/red-bus.png" style="height: 80px; margin-left: 0;"/>-->
                                      <span>
                                        <h4>{{$trip->trip_name}}</h4>
                                        <?php
                                             $date_time = $trip->trip_date;
                                             $new_date = date("d-m-Y",strtotime($date_time));
                                             echo $new_date;
                                             
                                        //   $trip_duration = (strtotime($trip->end_time) - strtotime($trip->start_time)) / 3600;
                                        //   echo round(ceil($trip_duration*100)/100, 5). ' Hours';
                                        ?>
                                      </span>
                                    </div>
                                  </div>
                               </td>
                               <td>
                                  <div>
                                      {{$trip->departure}} 
                                    <?php 
                                    //   $start_time = $trip->start_time;
                                    //   $report_time = date('H:i:s', strtotime($start_time. ' -40 minutes'));
                                    //   echo $report_time;
                                    ?>
                                    <b>{{$trip->start_time}}</b>
                                  </div>
                                  <div>
                                    <img src="/assets/img/logos/icons8-arrow-down-100.png" style="width: 50px;"/>
                                  </div>
                                  <div>
                                      {{$trip->destination}} <b>{{$trip->end_time}}</b>
                                  </div>
                               </td>
                                <td >
                                  <div>
                                    <!--<img src="/assets/img/logos/icons8-money-96.png" style="width: 50px;"/>-->
                                    <!--<br>-->
                                    <span>
                                      <b>Travel Fare</b> 
                                      <h3>  GHS {{$trip->fare}}</h3>
                                    </span>
                                  </div>
                                </td>
                                <td>
                                  <div>
                                    <!--<img src="/assets/img/logos/icons8-numbers-input-form-100.png" style="width: 50px;"/>-->
                                    <!--<br>-->
                                    <span>
                                      <b>Bus Number</b>
                                      <h3> {{$trip->bus_number}}</h3>
                                    </span>
                                  </div>
                                </td>
                                <!--<td>-->
                                <!--  <div>-->
                                <!--    <img src="/assets/img/logos/icons8-seat-64.png" style="width: 50px;"/>-->
                                <!--  </div>-->
                                <!--  <div>-->
                                <!--    <span>-->
                                <!--      <h3>{{$trip->seat_number}} Seats</h3>-->
                                <!--      <h5>-->
                                <!--      </h5>-->
                                <!--    </span>-->
                                <!--  </div>-->
                                <!-- </td>-->
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
                        </div>
                        <div class="row justify-content-center" style="margin-top: 20px;">
                          <div class="header-row" id="header-row" style="padding: 0px;">
                            <div class="container-fluid" style="padding: 0px;">
                                <div class="row"> 
                                  <div class="col-xs-12"> 
                                  <!-- place your image here -->
                                        <img src="/assets/img/passengers_onbus.jpg" style="width: 100%;">
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
        var today = new Date().toISOString().split('T')[0];
        document.getElementsByName("trip_date")[0].setAttribute('min', today);
        //Ensure that From and To are selected
        function selectLocation() {
              var dept = document.getElementById("departure").value;
              var dest = document.getElementById("destination").value;
              var trip_date = document.getElementById("trip_date").value;
              if (dept==="location_from"){
                  swal({
                      dept: "Please select a departure point",
                      icon: "warning",
                      button: "Ok",
                  })
              }else if (dest==="location_to"){
                swal({
                      title: "Please select a destination point",
                      icon: "warning",
                      button: "Ok",
                  })
              }else if (trip_date===""){
                swal({
                      title: "Please select a trip date",
                      icon: "warning",
                      button: "Ok",
                  })
              }
            }

            function getSelectValue(departure) {
              if(departure != ' '){
                  $("#destination option[value='"+departure+"']").hide();
                  $("#destination option[value!='"+departure+"']").show();

              }
            };
      </script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
  @include('layouts.home-footer')
</html>
</x-app-layout>

