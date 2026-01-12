@include('layouts.head')
<!-- partial -->
@include('layouts.sidenav')
  <!-- partial -->
  <div class="main-panel">
    <div class="content-wrapper">
      <div class="page-header">
        <h3 class="page-title">
          <span class="page-title-icon bg-gradient-primary text-white me-2">
            <i class="fa fa-book"></i>
          </span> Edit Booking
        </h3>
      </div>
 

      <div class="flex-none w-full max-w-full px-3" style="margin-top: 20PX;">
        <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
          <!--Back button-->
          <div class="relative w-full mb-3">
            <a href="{{ url("/admin_bookings") }}"> 
              <button class="btn btn-secondary back-button"><i class="fas fa-arrow-left"></i> Back</button>
            </a>
          </div>
          @if (session('message'))
          <div class="alert alert-success w-1/2 max-w-full px-12">
                  {{ session('message') }}
              </div>
          @endif
          <!--Add Bus form-->
              <form role="form" action="{{ url("/update_admin_booking/{$booking->booking_id}") }}" method="POST" style="margin-block: 20px; margin-left: 20px;">
                @csrf
                <input type="text" id="trip_id" name="trip_id" value="{{$booking->trip_id}}" hidden/>
                <input type="text" id="booking_code" name="booking_code" value="{{$booking->booking_code}}" hidden/>
                <input type="text" id="booking_seat" name="booking_seat" value="{{$booking->booking_seat}}" hidden/>
                <input type="text" id="bus_number" name="bus_number" value="{{$booking->bus_number}}" hidden/>
                <div class="row">
                <div class="col">
                  <span class="fa-stack fa-sm">
                    <i class="fa fa-circle fa-stack-2x" style="color: orange"></i>
                    <i class="fa fa-barcode fa-stack-1x fa-inverse"></i>
                  </span>
                  Booking Code - {{$booking->booking_code}}
                </div>
                </div>
                <br>
                <div class="row">
                  <div class="col">
                    <span class="fa-stack fa-sm">
                      <i class="fa fa-circle fa-stack-2x" style="color: #008000"></i>
                      <i class="fa fa-level-up fa-stack-1x fa-inverse"></i>
                    </span>
                    Departure - {{$booking->departure}}
                  </div>
                  <div class="col">
                    <span class="fa-stack fa-sm">
                      <i class="fa fa-circle fa-stack-2x" style="color: #FF0000"></i>
                      <i class="fa fa-level-down fa-stack-1x fa-inverse"></i>
                    </span>
                    Arrival - {{$booking->destination}}
                  </div>
                </div> 
                <br>
                <div class="row">
                  <div class="col">
                    <span class="fa-stack fa-sm">
                      <i class="fa fa-circle fa-stack-2x" style="color: #000000"></i>
                      <i class="fa fa-calendar-check-o fa-stack-1x fa-inverse"></i>
                    </span>
                    Date - {{$booking->trip_date}}
                  </div>
                </div>
                <br>
                <div class="row">
                  <div class="col">
                    <span class="fa-stack fa-sm">
                      <i class="fa fa-circle fa-stack-2x" style="color: #000000"></i>
                      <i class="fa fa-clock-o fa-stack-1x fa-inverse"></i>
                    </span>
                    Time - {{$booking->start_time}} - {{$booking->end_time}}
                  </div>
                  @php
                      $dur = (strtotime($booking->end_time) - strtotime($booking->start_time))/3600;
                  @endphp
                  <div class="col">
                    <span class="fa-stack fa-sm">
                      <i class="fa fa-circle fa-stack-2x" style="color: #000000"></i>
                      <i class="fa fa-hourglass-2 fa-stack-1x fa-inverse"></i>
                    </span>
                    Duration(hrs) - {{$dur}}
                  </div>
                </div>
                <br>
                <div class="row">
                  <div class="col">
                    <span class="fa-stack fa-sm">
                      <i class="fa fa-circle fa-stack-2x" style="color: #000000"></i>
                      <i class="fa fa-money fa-stack-1x fa-inverse"></i>
                    </span>
                    Fare - {{$booking->fare}}
                  </div>
                  <div class="col">
                    <span class="fa-stack fa-sm">
                      <i class="fa fa-circle fa-stack-2x" style="color: #000000"></i>
                      <i class="fa fa-bus fa-stack-1x fa-inverse"></i>
                    </span>
                    Bus - {{$booking->bus_number}}
                  </div>
                </div>
                <br>
                <div class="row">
                  <div class="col">
                    <span class="fa-stack fa-sm">
                      <i class="fa fa-circle fa-stack-2x" style="color: #000000"></i>
                      <i class="fa fa-bus fa-stack-1x fa-inverse"></i>
                    </span>No. of Passengers
                  </div>
                  <div class="col">
                      <div class="mb-3 pt-0">
                        <select id="number_passengers" name="number_passengers">
                          <option value="{{$booking->number_passengers}}" selected>{{$booking->number_passengers}}</option>
                          <option value="1" >1</option>
                          <option value="2">2</option>
                          <option value="3">3</option>
                          <option value="4">4</option>
                        </select><!-- /.select-->
                      </div>
                  </div>
                </div>
                <br>
                <div class="row">
                  <div class="col">
                    <span class="fa-stack fa-sm">
                      <i class="fa fa-circle fa-stack-2x" style="color: #000000"></i>
                      <i class="fa fa-bus fa-stack-1x fa-inverse"></i>
                    </span>No. of Children(0-4yrs)
                  </div>
                  <div class="col">
                      <div class="mb-3 pt-0">
                        <select id="number_children" name="number_children">
                          <option value="{{$booking->number_children}}" selected>{{$booking->number_children}}</option>
                          <option value="0">0</option>
                          <option value="1">1</option>
                        </select><!-- /.select-->
                      </div>
                  </div>
                </div>
                <br>
                <div class="row">
                  <div class="col">
                    <span class="fa-stack fa-sm">
                      <i class="fa fa-circle fa-stack-2x" style="color: #000000"></i>
                      <i class="fa fa-phone fa-stack-1x fa-inverse"></i>
                    </span>Contact Person
                  </div>
                  <div class="col">
                        <input type="text" id="contact_person" name="contact_person" value="{{$booking->contact_person}}" required/>
                  </div>
                </div>
                <br>
                <div class="row">
                  <div class="col">
                    <span class="fa-stack fa-sm">
                      <i class="fa fa-circle fa-stack-2x" style="color: #000000"></i>
                      <i class="fa fa-suitcase fa-stack-1x fa-inverse"></i>
                    </span>Luggage (over 10kg)
                  </div>
                  <div class="col">
                      <div class="mb-3 pt-0">
                        <select id="luggage_over" name="luggage_over">
                          <option value="{{$booking->luggage_over}}" selected>{{$booking->luggage_over}}</option>
                          <option value="Yes">Yes</option>
                          <option value="No" >No</option>
                      </select><!-- /.select-->
                      </div>
                  </div>
                </div>
                <div class="relative flex justify-between px-4 py-2 pl-0 mb-2 border-0 border-t-0 text-inherit rounded-xl">
                    <button type="submit" class="btn btn-primary" style="background-color:blue;">Update</button>
                  </div>
            </form>
        </div>

    <!-- card 2 -->

  </div>
    

    </div>
    <!-- content-wrapper ends -->
  </div>
  <!-- main-panel ends -->

@include('layouts.script')







