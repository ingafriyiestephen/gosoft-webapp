@include('layouts.head')
@include('layouts.sidenav')

<div class="main-panel">
  <div class="content-wrapper">

    <!-- PAGE HEADER -->
    <div class="page-header">
      <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white me-2">
          <i class="fa fa-user"></i>
        </span>
        Trips
      </h3>
    </div>

    <div class="container-fluid">

      <!-- ADD TRIP MODAL -->
      <div class="modal fade" id="modalTrip" tabindex="-1">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">

            <div class="modal-header">
              <h5 class="modal-title">Add New Trip</h5>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <form action="{{ url('/store_trip') }}" method="POST">
              @csrf

              <div class="modal-body">
                <div class="row g-3">

                  <div class="col-md-4">
                    <label class="form-label">Departure</label>
                    <select name="departure" class="form-select" required>
                      <option value="">Select</option>
                      @foreach ($locations as $location)
                        <option value="{{ $location->location_name }}">
                          {{ $location->location_name }}
                        </option>
                      @endforeach
                    </select>
                  </div>

                  <div class="col-md-4">
                    <label class="form-label">Destination</label>
                    <select name="destination" class="form-select" required>
                      <option value="">Select</option>
                      @foreach ($locations as $location)
                        <option value="{{ $location->location_name }}">
                          {{ $location->location_name }}
                        </option>
                      @endforeach
                    </select>
                  </div>

                  <div class="col-md-4">
                    <label class="form-label">Trip Status</label>
                    <select name="trip_status" class="form-select">
                      <option value="Pending">Pending</option>
                      <option value="Booking">Booking</option>
                      <option value="Cancelled">Cancelled</option>
                      <option value="Set-off">Set-off</option>
                      <option value="Temporarily-Stopped">Temporarily Stopped</option>
                      <option value="Arrived">Arrived</option>
                      <option value="Closed">Closed</option>
                    </select>
                  </div>

                  <div class="col-md-3">
                    <label class="form-label">Start Date</label>
                    <input type="date" name="trip_date" class="form-control current-date">
                  </div>

                  <div class="col-md-3">
                    <label class="form-label">Start Time</label>
                    <input type="time" name="start_time" class="form-control">
                  </div>

                  <div class="col-md-3">
                    <label class="form-label">End Date</label>
                    <input type="date" name="trip_end_date" class="form-control current-date">
                  </div>

                  <div class="col-md-3">
                    <label class="form-label">End Time</label>
                    <input type="time" name="end_time" class="form-control">
                  </div>

                  <div class="col-md-3">
                    <label class="form-label">Fare</label>
                    <input type="text" name="fare" class="form-control">
                  </div>

                  <div class="col-md-3">
                    <label class="form-label">Bus</label>
                    <select name="bus_id" class="form-select" required>
                      <option value="">Select</option>
                      @foreach ($buses as $bus)
                        <option value="{{ $bus->bus_id }}">
                          {{ $bus->bus_number }}
                        </option>
                      @endforeach
                    </select>
                  </div>

                  <div class="col-md-3">
                    <label class="form-label">Driver</label>
                    <select name="driver_id" class="form-select" required>
                      <option value="">Select</option>
                      @foreach ($drivers as $driver)
                        <option value="{{ $driver->driver_id }}">
                          {{ $driver->driver_name }}
                        </option>
                      @endforeach
                    </select>
                  </div>

                  <div class="col-md-3">
                    <label class="form-label">Availability</label>
                    <select name="trip_available" class="form-select">
                      <option value="Yes" selected>Yes</option>
                      <option value="No">No</option>
                    </select>
                  </div>

                </div>
              </div>

              <div class="modal-footer">
                <button class="btn btn-danger" data-dismiss="modal">Cancel</button>
                <button class="btn btn-success">Save Trip</button>
              </div>

            </form>
          </div>
        </div>
      </div>

      <!-- ALERTS -->
      @if (session('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
      @endif

      @if (session('failure'))
        <div class="alert alert-danger">{{ session('failure') }}</div>
      @endif

      @if ($errors->any())
        <div class="alert alert-danger">
          <ul class="mb-0">
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <!-- TRIPS TABLE -->
      <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center">
          <h5 class="mb-0">Trips List</h5>
          <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#modalTrip">
            <i class="fa fa-plus"></i> New Trip
          </button>
        </div>

        <div class="card-body">
          <div class="table-responsive">
            <table id="dataTable" class="table table-hover table-striped w-100">

              <thead class="thead-light">
                <tr>
                  <th>Route</th>
                  <th>Date / Time</th>
                  <th>Seats</th>
                  <th>Fare</th>
                  <th>Bus</th>
                  <th>Driver</th>
                  <th>Created By</th>
                  <th>Status</th>
                  <th>Bookings</th>
                  <th>Action</th>
                </tr>
              </thead>

              <tbody>
                @foreach ($trips as $trip)
                <tr>
                  <td>
                    <strong>{{ $trip->departure }} → {{ $trip->destination }}</strong><br>
                    <small class="text-muted">{{ $trip->trip_name }}</small>
                  </td>

                  <td>
                    {{ $trip->trip_date }}<br>
                    <small class="text-muted">{{ $trip->start_time }} - {{ $trip->end_time }}</small>
                  </td>

                  <td>{{ $trip->seat_number }}</td>
                  <td>{{ $trip->fare }}</td>
                  <td>{{ $trip->bus_number }}</td>
                  <td>{{ $trip->driver_name }}</td>

                  <td>
                    {{ $trip->created_by }}<br>
                    <small class="text-muted">{{ $trip->created_at }}</small>
                  </td>

                  <td>
                    <span class="badge badge-info">{{ $trip->trip_status }}</span><br>
                    <small class="text-muted">{{ $trip->trip_available }}</small>
                  </td>

                  <td>
                    <a href="{{ url("/show_trip_bookings/{$trip->trip_id}") }}"
                       class="btn btn-dark btn-sm">
                      Bookings
                    </a>
                  </td>

                  <td>
                    <a href="{{ url("/edit_trip/{$trip->trip_id}") }}"
                       class="btn btn-sm btn-warning">
                      <i class="bi bi-pencil-square"></i>
                    </a>

                    <form action="{{ url("/delete_trip/{$trip->trip_id}") }}"
                          method="POST" class="d-inline">
                      @csrf
                      @method('DELETE')
                      <button class="btn btn-sm btn-danger show_confirm">
                        <i class="bi bi-trash-fill"></i>
                      </button>
                    </form>
                  </td>
                </tr>
                @endforeach
              </tbody>

            </table>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>

@include('layouts.script')

<script>
  $(function () {
    let today = new Date().toISOString().split('T')[0];
    $('.current-date').attr('min', today);
  });
</script>
