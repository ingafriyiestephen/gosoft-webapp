<x-app-layout>
<?php
$cnt_bkns = count($trips) + 1;
$avail_seats = count($trips);
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.0.1/mdb.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
<link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.21.2/dist/bootstrap-table.min.css">
<style>
  *, *:before, *:after {
box-sizing: border-box;
}

html {
font-size: 16px;
}

.plane {
margin: 20px auto;
max-width: 300px;
}

.exit {
position: relative;
height: 50px;
}
.exit:before, .exit:after {
content: "EXIT";
font-size: 14px;
line-height: 18px;
padding: 0px 2px;
font-family: "Arial Narrow", Arial, sans-serif;
display: block;
position: absolute;
background: green;
color: white;
top: 50%;
transform: translate(0, -50%);
}
.exit:before {
left: 0;
}
.exit:after {
right: 0;
}

.fuselage {
border-right: 5px solid #d8d8d8;
border-left: 5px solid #d8d8d8;
}

ol {
list-style: none;
padding: 0;
margin: 0;
}

.seats {
display: flex;
flex-direction: row;
flex-wrap: nowrap;
justify-content: flex-start;
}

.seat {
display: flex;
flex: 0 0 14.28571428571429%;
padding: 5px;
position: relative;
}
.seat:nth-child(3) {
margin-right: 14.28571428571429%;
}
.seat input[type=checkbox] {
position: absolute;
opacity: 0;
}
.seat input[type=checkbox]:checked + label {
background: #bada55;
-webkit-animation-name: rubberBand;
animation-name: rubberBand;
animation-duration: 300ms;
animation-fill-mode: both;
}
.seat input[type=checkbox]:disabled + label {
background: #dddddd;
text-indent: -9999px;
overflow: hidden;
}
.seat input[type=checkbox]:disabled + label:after {
content: "X";
text-indent: 0;
position: absolute;
top: 4px;
left: 50%;
transform: translate(-50%, 0%);
}
.seat input[type=checkbox]:disabled + label:hover {
box-shadow: none;
cursor: not-allowed;
}
.seat label {
display: block;
position: relative;
width: 100%;
text-align: center;
font-size: 14px;
font-weight: bold;
line-height: 1.5rem;
padding: 4px 0;
background: #F42536;
border-radius: 5px;
animation-duration: 300ms;
animation-fill-mode: both;
}

.fa-stack{
  color: #C0C0C0;
}

.seat label:before {
content: "";
position: absolute;
width: 75%;
height: 75%;
top: 1px;
left: 50%;
transform: translate(-50%, 0%);
background: rgba(255, 255, 255, 0.4);
border-radius: 3px;
}
.seat label:hover {
cursor: pointer;
box-shadow: 0 0 0px 2px #5C6AFF;
}

@-webkit-keyframes rubberBand {
0% {
  -webkit-transform: scale3d(1, 1, 1);
  transform: scale3d(1, 1, 1);
}
30% {
  -webkit-transform: scale3d(1.25, 0.75, 1);
  transform: scale3d(1.25, 0.75, 1);
}
40% {
  -webkit-transform: scale3d(0.75, 1.25, 1);
  transform: scale3d(0.75, 1.25, 1);
}
50% {
  -webkit-transform: scale3d(1.15, 0.85, 1);
  transform: scale3d(1.15, 0.85, 1);
}
65% {
  -webkit-transform: scale3d(0.95, 1.05, 1);
  transform: scale3d(0.95, 1.05, 1);
}
75% {
  -webkit-transform: scale3d(1.05, 0.95, 1);
  transform: scale3d(1.05, 0.95, 1);
}
100% {
  -webkit-transform: scale3d(1, 1, 1);
  transform: scale3d(1, 1, 1);
}
}
@keyframes rubberBand {
0% {
  -webkit-transform: scale3d(1, 1, 1);
  transform: scale3d(1, 1, 1);
}
30% {
  -webkit-transform: scale3d(1.25, 0.75, 1);
  transform: scale3d(1.25, 0.75, 1);
}
40% {
  -webkit-transform: scale3d(0.75, 1.25, 1);
  transform: scale3d(0.75, 1.25, 1);
}
50% {
  -webkit-transform: scale3d(1.15, 0.85, 1);
  transform: scale3d(1.15, 0.85, 1);
}
65% {
  -webkit-transform: scale3d(0.95, 1.05, 1);
  transform: scale3d(0.95, 1.05, 1);
}
75% {
  -webkit-transform: scale3d(1.05, 0.95, 1);
  transform: scale3d(1.05, 0.95, 1);
}
100% {
  -webkit-transform: scale3d(1, 1, 1);
  transform: scale3d(1, 1, 1);
}
}
.rubberBand {
-webkit-animation-name: rubberBand;
animation-name: rubberBand;
}

</style>
@include('layouts.home-pay-head')
   <!-- body -->
   <x-app-layout>
   <body class="main-layout text-bg-light p-3">
      <section >
        <!-- our blog -->
      <div id="blog" class="blog text-bg-lght p-3">
        <div class="container text-bg-light p-3">
           <div class="row">
              <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                  <!--Start seating-->
                  <div class="plane">
                    <div class="p-6 px-4 pb-0 mb-0 text-bg-light p-3border-b-0 rounded-t-2xl">
                      <h1>Remaining Seats</h1>
                    </div>
                    <div class="max-w-full px-3 mb-6 md:mb-0 md:w-1/2 md:flex-none text-bg-light p-3">
                      <div class="relative flex flex-row items-center flex-auto min-w-0 p-6 break-words bg-transparent border border-solid shadow-none rounded-xl border-slate-100 bg-clip-border">
                        <img class="mb-0 mr-4 w-1/10" src="../assets/img/logos/icons8-seat-64.png" alt="logo" />
                        <h6 class="mb-0">{{$avail_seats}} / {{$trip->seat_number}}</h6>
                      </div>
                    </div>
                    <h1>Selected Seat: <span id="seat_number">None</span></h1>
                  <div class="fuselage">
                    
                  </div>
                  <ol class="cabin fuselage">
                    <li class="row row--1">
                      <ol class="seats" type="A">
                        <li class="seat">
                          <input type="checkbox" class="selected_seat" id="seat_0"  value="{{$trip->seat_0}}" onclick='handleClick(this);' />
                          <label for="seat_0">0</label>
                        </li>
                        <li class="seat">
                          <input type="checkbox" class="selected_seat" id="seat_1" value="{{$trip->seat_1}}" onclick='handleClick(this);' />
                          <label for="seat_1">1</label>
                        </li>
                        <li class="seat"> 
                          <input type="checkbox" class="selected_seat" id="seat_2" value="{{$trip->seat_2}}" onclick='handleClick(this);'/>
                          <label for="seat_2">2</label>
                        </li>
                        <li class="seat">
                          <input type="checkbox" class="selected_seat" id="seat_3" value="{{$trip->seat_3}}" onclick='handleClick(this);'/>
                          <label for="seat_3">3</label>
                        </li>
                        <li class="seat">
                          <input type="checkbox" class="selected_seat" id="seat_4" value="{{$trip->seat_4}}" onclick='handleClick(this);'/>
                          <label for="seat_4">4</label>
                        </li>
                        <li class="seat">
                          <input type="checkbox" class="selected_seat" id="seat_5" value="{{$trip->seat_5}}" onclick='handleClick(this);'/>
                          <label for="seat_5">5</label>
                        </li>
                      </ol>
                    </li>
                    <li class="row row--2">
                      <ol class="seats" type="A">
                        <li class="seat">
                          <input type="checkbox" class="selected_seat" id="seat_6" value="{{$trip->seat_6}}" onclick='handleClick(this);'/>
                          <label for="seat_6">6</label>
                        </li>
                        <li class="seat">
                          <input type="checkbox" class="selected_seat" id="seat_7" value="{{$trip->seat_7}}" onclick='handleClick(this);'/>
                          <label for="seat_7">7</label>
                        </li>
                        <li class="seat">
                          <input type="checkbox" class="selected_seat" id="seat_8" value="{{$trip->seat_8}}" onclick='handleClick(this);'/>
                          <label for="seat_8">8</label>
                        </li>
                        <li class="seat">
                          <input type="checkbox" class="selected_seat" id="seat_9" value="{{$trip->seat_9}}" onclick='handleClick(this);'/>
                          <label for="seat_9">9</label>
                        </li>
                        <li class="seat">
                          <input type="checkbox" class="selected_seat" id="seat_10" value="{{$trip->seat_10}}" onclick='handleClick(this);'/>
                          <label for="seat_10">10</label>
                        </li>
                        <li class="seat">
                          <input type="checkbox" class="selected_seat" id="2F" />
                          <label for="2F">2F</label>
                        </li>
                      </ol>
                    </li>
                    <li class="row row--3">
                      <ol class="seats" type="A">
                        <li class="seat">
                          <input type="checkbox" class="selected_seat" id="3A" />
                          <label for="3A">3A</label>
                        </li>
                        <li class="seat">
                          <input type="checkbox" class="selected_seat" id="3B" />
                          <label for="3B">3B</label>
                        </li>
                        <li class="seat">
                          <input type="checkbox" class="selected_seat" id="3C" />
                          <label for="3C">3C</label>
                        </li>
                        <li class="seat">
                          <input type="checkbox" class="selected_seat" id="3D" />
                          <label for="3D">3D</label>
                        </li>
                        <li class="seat">
                          <input type="checkbox" class="selected_seat" id="3E" />
                          <label for="3E">3E</label>
                        </li>
                        <li class="seat">
                          <input type="checkbox" class="selected_seat" id="3F" />
                          <label for="3F">3F</label>
                        </li>
                      </ol>
                    </li>
                    <li class="row row--4">
                      <ol class="seats" type="A">
                        <li class="seat">
                          <input type="checkbox" class="selected_seat" id="4A" />
                          <label for="4A">4A</label>
                        </li>
                        <li class="seat">
                          <input type="checkbox" class="selected_seat" id="4B" />
                          <label for="4B">4B</label>
                        </li>
                        <li class="seat">
                          <input type="checkbox" class="selected_seat" id="4C" />
                          <label for="4C">4C</label>
                        </li>
                        <li class="seat">
                          <input type="checkbox" class="selected_seat" id="4D" />
                          <label for="4D">4D</label>
                        </li>
                        <li class="seat">
                          <input type="checkbox" class="selected_seat" id="4E" />
                          <label for="4E">4E</label>
                        </li>
                        <li class="seat">
                          <input type="checkbox" class="selected_seat" id="4F" />
                          <label for="4F">4F</label>
                        </li>
                      </ol>
                    </li>
                    <li class="row row--5">
                      <ol class="seats" type="A">
                        <li class="seat">
                          <input type="checkbox" class="selected_seat" id="5A" />
                          <label for="5A">5A</label>
                        </li>
                        <li class="seat">
                          <input type="checkbox" class="selected_seat" id="5B" />
                          <label for="5B">5B</label>
                        </li>
                        <li class="seat">
                          <input type="checkbox" class="selected_seat" id="5C" />
                          <label for="5C">5C</label>
                        </li>
                        <li class="seat">
                          <input type="checkbox" class="selected_seat" id="5D" />
                          <label for="5D">5D</label>
                        </li>
                        <li class="seat">
                          <input type="checkbox" class="selected_seat" id="5E" />
                          <label for="5E">5E</label>
                        </li>
                        <li class="seat">
                          <input type="checkbox" class="selected_seat" id="5F" />
                          <label for="5F">5F</label>
                        </li>
                      </ol>
                    </li>
                    <li class="row row--6">
                      <ol class="seats" type="A">
                        <li class="seat">
                          <input type="checkbox" class="selected_seat" id="6A" />
                          <label for="6A">6A</label>
                        </li>
                        <li class="seat">
                          <input type="checkbox" class="selected_seat" id="6B" />
                          <label for="6B">6B</label>
                        </li>
                        <li class="seat">
                          <input type="checkbox" class="selected_seat" id="6C" />
                          <label for="6C">6C</label>
                        </li>
                        <li class="seat">
                          <input type="checkbox" class="selected_seat" id="6D" />
                          <label for="6D">6D</label>
                        </li>
                        <li class="seat">
                          <input type="checkbox" class="selected_seat" id="6E" />
                          <label for="6E">6E</label>
                        </li>
                        <li class="seat">
                          <input type="checkbox" class="selected_seat" id="6F" />
                          <label for="6F">6F</label>
                        </li>
                      </ol>
                    </li>
                    <li class="row row--7">
                      <ol class="seats" type="A">
                        <li class="seat">
                          <input type="checkbox" class="selected_seat" id="7A" />
                          <label for="7A">7A</label>
                        </li>
                        <li class="seat">
                          <input type="checkbox" class="selected_seat" id="7B" />
                          <label for="7B">7B</label>
                        </li>
                        <li class="seat">
                          <input type="checkbox" class="selected_seat" id="7C" />
                          <label for="7C">7C</label>
                        </li>
                        <li class="seat">
                          <input type="checkbox" class="selected_seat" id="7D" />
                          <label for="7D">7D</label>
                        </li>
                        <li class="seat">
                          <input type="checkbox" class="selected_seat" id="7E" />
                          <label for="7E">7E</label>
                        </li>
                        <li class="seat">
                          <input type="checkbox" class="selected_seat" id="7F" />
                          <label for="7F">7F</label>
                        </li>
                      </ol>
                    </li>
                    <li class="row row--8">
                      <ol class="seats" type="A">
                        <li class="seat">
                          <input type="checkbox" class="selected_seat" id="8A" />
                          <label for="8A">8A</label>
                        </li>
                        <li class="seat">
                          <input type="checkbox" class="selected_seat" id="8B" />
                          <label for="8B">8B</label>
                        </li>
                        <li class="seat">
                          <input type="checkbox" class="selected_seat" id="8C" />
                          <label for="8C">8C</label>
                        </li>
                        <li class="seat">
                          <input type="checkbox" class="selected_seat" id="8D" />
                          <label for="8D">8D</label>
                        </li>
                        <li class="seat">
                          <input type="checkbox" class="selected_seat" id="8E" />
                          <label for="8E">8E</label>
                        </li>
                        <li class="seat">
                          <input type="checkbox" class="selected_seat" id="8F" />
                          <label for="8F">8F</label>
                        </li>
                      </ol>
                    </li>
                    <li class="row row--9">
                      <ol class="seats" type="A">
                        <li class="seat">
                          <input type="checkbox" class="selected_seat" id="9A" />
                          <label for="9A">9A</label>
                        </li>
                        <li class="seat">
                          <input type="checkbox" class="selected_seat" id="9B" />
                          <label for="9B">9B</label>
                        </li>
                        <li class="seat">
                          <input type="checkbox" class="selected_seat" id="9C" />
                          <label for="9C">9C</label>
                        </li>
                        <li class="seat">
                          <input type="checkbox" class="selected_seat" id="9D" />
                          <label for="9D">9D</label>
                        </li>
                        <li class="seat">
                          <input type="checkbox" class="selected_seat" id="9E" />
                          <label for="9E">9E</label>
                        </li>
                        <li class="seat">
                          <input type="checkbox" class="selected_seat" id="9F" />
                          <label for="9F">9F</label>
                        </li>
                      </ol>
                    </li>
                    <li class="row row--10">
                      <ol class="seats" type="A">
                        <li class="seat">
                          <input type="checkbox" class="selected_seat" id="10A" />
                          <label for="10A">10A</label>
                        </li>
                        <li class="seat">
                          <input type="checkbox" class="selected_seat" id="10B" />
                          <label for="10B">10B</label>
                        </li>
                        <li class="seat">
                          <input type="checkbox" class="selected_seat" id="10C" />
                          <label for="10C">10C</label>
                        </li>
                        <li class="seat">
                          <input type="checkbox" class="selected_seat" id="10D" />
                          <label for="10D">10D</label>
                        </li>
                        <li class="seat">
                          <input type="checkbox" class="selected_seat" id="10E" />
                          <label for="10E">10E</label>
                        </li>
                        <li class="seat">
                          <input type="checkbox" class="selected_seat" id="10F" />
                          <label for="10F">10F</label>
                        </li>
                      </ol>
                    </li>
                  </ol>
                  <div class="fuselage"> 
                  </div>
                </div>
                  <!--/End seating-->
              </div>
              <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">

                <div class="w-full max-w-full px-3 mt-6 md:w-5/12 md:flex-none">
                  <div class="relative flex flex-col h-full min-w-0 mb-6 break-words bg-white border-0 shadow-soft-xl rounded-2xl bg-clip-border">
                    <div class="p-6 px-4 pb-0 mb-0 bg-white border-b-0 rounded-t-2xl">
                      <div class="flex flex-wrap -mx-3">
                        <div class="max-w-full px-3 md:w-1/2 md:flex-none">
                          <h1>Your Trip Suumary</h1>
                        </div>
                      </div>
                    </div>
                    <div class="flex-auto p-4 pt-6">
                      <form role="form" action="{{ url("/store_booking") }}" method="POST">
                        @csrf
                        <input type="text" id="trip_id" name="trip_id" value="{{$trip->trip_id}}"  hidden/>
                        <input type="text" id="booking_code" name="booking_code" value="{{$trip->trip_name}}-{{$trip->trip_id}}-{{$cnt_bkns}}" hidden/>
                        <input type="text" id="booking_seat" name="booking_seat" value="" hidden/>
                        <input type="text" id="booking_fare" name="booking_fare" value="{{$trip->fare}}" hidden/>
                        <input type="text" id="bus_number" name="bus_number" value="{{$trip->bus_number}}" hidden/>
                      <ul class="flex flex-col pl-0 mb-0 rounded-lg">
                        <li class="relative flex justify-between px-4 py-2 pl-0 mb-2 bg-white border-0 rounded-t-inherit text-inherit rounded-xl">
                        <div class="flex items-center">
                          <span class="fa-stack fa-sm">
                            <i class="fa fa-circle fa-stack-2x" style="color: orange"></i>
                            <i class="fa fa-barcode fa-stack-1x fa-inverse"></i>
                          </span>
                          Booking Code - {{$trip->trip_name}}-{{$trip->trip_id}}-{{$cnt_bkns}}
                        </div>
                        </li>
                        <li class="relative flex justify-between px-4 py-2 pl-0 mb-2 bg-white border-0 rounded-t-inherit text-inherit rounded-xl">
                          <div class="flex items-center">
                            <span class="fa-stack fa-sm">
                              <i class="fa fa-circle fa-stack-2x" style="color: #008000"></i>
                              <i class="fa fa-level-up fa-stack-1x fa-inverse"></i>
                            </span>
                            Departure - {{$trip->departure}}
                          </div>
                          <div class="flex items-center">
                            <span class="fa-stack fa-sm">
                              <i class="fa fa-circle fa-stack-2x" style="color: #FF0000"></i>
                              <i class="fa fa-level-down fa-stack-1x fa-inverse"></i>
                            </span>
                            Arrival - {{$trip->destination}}
                          </div>
                        </li> 
                        <li class="relative flex justify-between px-4 py-2 pl-0 mb-2 bg-white border-0 border-t-0 rounded-b-inherit text-inherit rounded-xl">
                          <div class="flex items-center">
                            <span class="fa-stack fa-sm">
                              <i class="fa fa-circle fa-stack-2x" style="color: #000000"></i>
                              <i class="fa fa-calendar-check-o fa-stack-1x fa-inverse"></i>
                            </span>
                            Date - {{$trip->trip_date}}
                          </div>
                        </li>
                        <li class="relative flex justify-between px-4 py-2 pl-0 mb-2 bg-white border-0 border-t-0 rounded-b-inherit text-inherit rounded-xl">
                          <div class="flex items-center">
                            <span class="fa-stack fa-sm">
                              <i class="fa fa-circle fa-stack-2x" style="color: #000000"></i>
                              <i class="fa fa-clock-o fa-stack-1x fa-inverse"></i>
                            </span>
                            Time - {{$trip->start_time}} - {{$trip->end_time}}
                          </div>
                          @php
                              $dur = (strtotime($trip->end_time) - strtotime($trip->start_time))/3600;
                          @endphp
                          <div class="flex items-center">
                            <span class="fa-stack fa-sm">
                              <i class="fa fa-circle fa-stack-2x" style="color: #000000"></i>
                              <i class="fa fa-hourglass-2 fa-stack-1x fa-inverse"></i>
                            </span>
                            Duration(hrs) - {{$dur}}
                          </div>
                        </li>
                        <li class="relative flex justify-between px-4 py-2 pl-0 mb-2 bg-white border-0 border-t-0 rounded-b-inherit text-inherit rounded-xl">
                          <div class="flex items-center">
                            <span class="fa-stack fa-sm">
                              <i class="fa fa-circle fa-stack-2x" style="color: #000000"></i>
                              <i class="fa fa-money fa-stack-1x fa-inverse"></i>
                            </span>
                            Fare - {{$trip->fare}}
                          </div>
                          <div class="flex items-center">
                            <span class="fa-stack fa-sm">
                              <i class="fa fa-circle fa-stack-2x" style="color: #000000"></i>
                              <i class="fa fa-bus fa-stack-1x fa-inverse"></i>
                            </span>
                            Bus - {{$trip->bus_number}}
                          </div>
                        </li>
                        <li class="relative flex justify-between px-4 py-2 pl-0 mb-2 bg-white border-0 border-t-0 text-inherit rounded-xl">
                          <div class="flex items-center">
                            <span class="fa-stack fa-sm">
                              <i class="fa fa-circle fa-stack-2x" style="color: #000000"></i>
                              <i class="fa fa-bus fa-stack-1x fa-inverse"></i>
                            </span>No. of Passengers
                          </div>
                          <div class="flex items-center">
                              <div class="mb-3 pt-0">
                                <select id="number_passengers" name="number_passengers">
                                  <option value="1" selected>1</option>
                                  <option value="2">2</option>
                                  <option value="3">3</option>
                                  <option value="4">4</option>
                                </select><!-- /.select-->
                              </div>
                          </div>
                        </li>
                        <li class="relative flex justify-between px-4 py-2 pl-0 mb-2 bg-white border-0 border-t-0 text-inherit rounded-xl">
                          <div class="flex items-center">
                            <span class="fa-stack fa-sm">
                              <i class="fa fa-circle fa-stack-2x" style="color: #000000"></i>
                              <i class="fa fa-bus fa-stack-1x fa-inverse"></i>
                            </span>No. of Children(0-5yrs)
                          </div>
                          <div class="flex items-center">
                              <div class="mb-3 pt-0">
                                <select id="number_children" name="number_children">
                                  <option value="0" selected>0</option>
                                  <option value="1">1</option>
                                  <option value="2">2</option>
                                  <option value="3">3</option>
                                </select><!-- /.select-->
                              </div>
                          </div>
                        </li>
                        <li class="relative flex justify-between px-4 py-2 pl-0 mb-2 bg-white border-0 border-t-0 text-inherit rounded-xl">
                          <div class="flex items-center">
                            <span class="fa-stack fa-sm">
                              <i class="fa fa-circle fa-stack-2x" style="color: #000000"></i>
                              <i class="fa fa-phone fa-stack-1x fa-inverse"></i>
                            </span>Contact Person
                          </div>
                          <div class="flex items-center">
                              <div class="mb-3 pt-0">
                                <input type="text" id="contact_person" name="contact_person" placeholder="02XXXXXXXX" class="px-2 py-1 placeholder-slate-300 text-slate-600 relative bg-white bg-white rounded text-sm rounded-lg border border-solid border-gray-300 outline-none focus:outline-none focus:ring w-full" required/>
                              </div>
                          </div>
                        </li>
                        <li class="relative flex justify-between px-4 py-2 pl-0 mb-2 bg-white border-0 border-t-0 text-inherit rounded-xl">
                          <div class="flex items-center">
                            <span class="fa-stack fa-sm">
                              <i class="fa fa-circle fa-stack-2x" style="color: #000000"></i>
                              <i class="fa fa-suitcase fa-stack-1x fa-inverse"></i>
                            </span>Luggage (over 10kg)
                          </div>
                          <div class="flex items-center">
                              <div class="mb-3 pt-0">
                                <select id="luggage_over" name="luggage_over">
                                  <option value="default">Select</option>
                                  <option value="yes">Yes</option>
                                  <option value="no" selected>No</option>
                              </select><!-- /.select-->
                              </div>
                          </div>
                        </li>
                        <li class="relative flex justify-between px-4 py-2 pl-0 mb-2 border-0 border-t-0 text-inherit rounded-xl">
                            <button type="submit" class="btn btn-primary" style="background-color:blue;">Submit</button>
                          </li>
                      </ul>
                    </form>
                    </div>
                  </div>
                </div>

              </div>
           </div>
        </div>
     </div>
     <!-- end our blog -->
      </section>
    <script>
        if(document.getElementById('seat_0').value == "true"){
          document.getElementById('seat_0').disabled = true;
        }
        if(document.getElementById('seat_1').value == "true"){
          document.getElementById('seat_1').disabled = true;
        }
        if(document.getElementById('seat_2').value == "true"){
          document.getElementById('seat_2').disabled = true;
        }
        if(document.getElementById('seat_3').value == "true"){
          document.getElementById('seat_3').disabled = true;
        }
        if(document.getElementById('seat_4').value == "true"){
          document.getElementById('seat_4').disabled = true;
        }
        if(document.getElementById('seat_5').value == "true"){
          document.getElementById('seat_5').disabled = true;
        }
        if(document.getElementById('seat_6').value == "true"){
          document.getElementById('seat_6').disabled = true;
        }
        if(document.getElementById('seat_7').value == "true"){
          document.getElementById('seat_7').disabled = true;
        }
        if(document.getElementById('seat_8').value == "true"){
          document.getElementById('seat_8').disabled = true;
        }
        if(document.getElementById('seat_9').value == "true"){
          document.getElementById('seat_9').disabled = true;
        }
        if(document.getElementById('seat_10').value == "true"){
          document.getElementById('seat_10').disabled = true;
        }
        
        

      var elem = document.getElementsByClassName('selected_seat');
      for(var i=0; i<elem.length; i++)
      {
        elem[i].addEventListener('click', function(){
          document.getElementById('seat_number').innerHTML = this.value;
          document.getElementById('booking_seat').value = document.getElementById('trip_id').value + "-" + this.value;
        })
      } 

      function handleClick(cb) {
        // display(cb.checked);
        document.getElementById('seat_number').innerHTML = cb.checked;
      }       
    </script>
</html>
</x-app-layout>
