@include('layouts.head')
<!-- partial -->
@include('layouts.sidenav')
  <!-- partial -->
  <div class="main-panel">
    <div class="content-wrapper">
      <div class="page-header">
        <h3 class="page-title">
          <span class="page-title-icon bg-gradient-danger text-white me-2">
            <i class="fa fa-book"></i>
          </span> Bookings
        </h3>
      </div>
 

      <div class="container-fluid">
        <!-- table 1 -->
    
    
    
              <div class="card mb-4">
                <div class="card-body">
                  @if (session('message'))
                        <div class="alert alert-success w-1/2 max-w-full px-12">
                          {{ session('message') }}
                      </div>
                  @endif
                  <table id="dataTable" class="display">
                        <thead>
                            <tr>
                              <th>Booking Code/Status</th>
                              <th>Customer</th>
                              <th>Passenger(s)</th>
                              <th>Children/Adults</th>
                              <th>Luggage (Above 10kg)</th>
                              <th>Contact Person</th>
                              <th>Booking Date</th>
                              <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                              <th>Booking Code/Status</th>
                              <th>Customer</th>
                              <th>Passenger(s)</th>
                              <th>Children/Adults</th>
                              <th>Luggage (Above 10kg)</th>
                              <th>Contact Person</th>
                              <th>Booking Date</th>
                              <th>Action</th>
                          </tr>
                        </tfoot>
                        <tbody>
                          @foreach ($bookings as $booking)
                          <tr>
                            <td>
                              <div class="flex px-2 py-1">
                                <div class="flex flex-col justify-center">
                                  <p class="mb-0 leading-tight text-xs text-slate-400">{{$booking->booking_code}}</p>
                                  <p class="mb-0 leading-tight text-xs text-slate-400">{{$booking->status}}</p>
                                </div>
                              </div>
                            </td>
                            <td>
                              <p class="mb-0 font-semibold leading-tight text-xs">{{$booking->customer_name}}</p>
                              <p class="mb-0 leading-tight text-xs text-slate-400">{{$booking->customer_phone}}</p>
                              <p class="mb-0 leading-tight text-xs text-slate-400">{{$booking->customer_email}}</p>
                            </td>
                            <td>
                              <p class="mb-0 leading-tight text-xs text-slate-400">Seats: {{$booking->booking_seat}}</p>
                              <p class="mb-0 leading-tight text-xs text-slate-400">Passengers: {{$booking->passenger_summary}}</p>
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
                              <span class="font-semibold leading-tight text-xs text-slate-400">{{$booking->booking_date}}</span>
                            </td>
                            <td>
                              <a href="{{ url("/edit_admin_booking/{$booking->booking_id}") }}" class="btn btn-sm btn-warning"> 
                                <i class="bi bi-pencil-square"></i>
                              </a>
                              @if ($booking->status == 'Pending')
                              <button type="button" id="confirmButton" data-id="{{$booking->booking_id}}" data-name="{{$booking->customer_name}}" data-phone="{{$booking->customer_phone}}" 
                                data-code="{{$booking->booking_code}}" data-seat="{{$booking->booking_seat}}" data-bus="{{$booking->bus_number}}" data-date="{{$booking->booking_date}}" style="color: #ffffff" class="btn bg-success btn-sm confirm_booking" data-toggle="modal" data-target="#confirmModal">
                                <i class="bi bi-check-circle-fill"></i>
                                </button>
                              @endif
                            </td>
                          </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        <!-- card 2 -->
    
    
        <!--confirm booking modal-->
        <div class="modal fade" id="confirmModal"  tabindex="-1" role="dialog" aria-labelledby="confirmModalLabel" aria-hidden="true">
          <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                      <h1 style="font-size: 30px;" class="modal-title">Confirm Booking</h1>
                  </div>
                  <div class="modal-body">
                  <form role="form" id="confirmForm" name="confirmForm" action="" method="POST"  style="margin-block: 20px; margin-left: 20px;">
                      @csrf
                      <div class="container">
                      <div class="row">
                      <div class="col-12">
                      </div>
                      <div class="col-12">
                          <label id="lbl_customer_name" class="form-label form-label-style" >
                          </label>
                      </div>
                      <div class="col-12">
                          <label id="lbl_customer_phone" class="form-label form-label-style" >
                          </label>
                      </div>
                      <div class="col-12">
                          <label id="lbl_booking_code" class="form-label form-label-style" >
                          </label>
                      </div>
                      <div class="col-12">
                        <label id="lbl_booking_date" class="form-label form-label-style" >
                        </label>
                      </div>
                      <div class="col-12">
                          <label id="lbl_seat_number" class="form-label form-label-style" >
                          </label>
                      </div>
                      <div class="col-12">
                        <label id="lbl_bus_number" class="form-label form-label-style" >
                        </label>
                    </div>
                      </div>
    
                      <div class="modal-footer">
                      <span class="icon">
                          <button type="submit" id="confirm_sale_btn" style="color: #ffffff" class="btn bg-success btn-lg">
                          <i class="bi bi-check-circle-fill"></i> Confirm
                          </button>
                      </span>
                      </div>
                      </div>
    
                  </form>
                  </div>
              </div>
          </div>
          </div>
          <!--/confirm booking modal-->
      </div>


    </div>
    <!-- content-wrapper ends -->

  </div>
  <!-- main-panel ends -->
</div>
<!-- page-body-wrapper ends -->
</div>
@include('layouts.script')
<script>
  $(document).ready(function() {
  var bookings = document.querySelectorAll(".confirm_booking");
  bookings.forEach(function(booking) {
      var attr_id = booking.getAttribute("data-id");
      var attr_name = booking.getAttribute("data-name");
      var attr_phone = booking.getAttribute("data-phone");
      var attr_code = booking.getAttribute("data-code");
      var attr_seat = booking.getAttribute("data-seat");
      var attr_date = booking.getAttribute("data-date");
      var attr_bus = booking.getAttribute("data-bus");

    booking.addEventListener("click", function(event){
      $('#lbl_customer_name').html(`<i class="bi bi-person-fill"></i>` + ' '  + attr_name)
      $('#lbl_customer_phone').html(`<i class="bi bi-phone-fill"></i>` + ' '  + attr_phone)
      $('#lbl_booking_code').html(`<i class="bi bi-upc"></i>` + ' '  + attr_code)
      $('#lbl_booking_date').html(`<i class="bi bi-calendar-check-fill"></i>` + ' '  + attr_date)
      $('#lbl_seat_number').html(`<i class="bi bi-123"></i>` + ' '  + attr_seat)
      $('#lbl_bus_number').html(`<i class="bi bi-bus-front-fill"></i>` + ' '  + attr_bus)
      $('#confirmForm').attr("action", `{{ url("/confirm_booking/` + attr_id + `") }}`);
    });
  })

} );
</script>
