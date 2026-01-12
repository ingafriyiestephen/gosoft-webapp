@include('layouts.head')
@include('layouts.sidenav')

<div class="main-panel">
  <div class="content-wrapper">

    <!-- PAGE HEADER -->
    <div class="page-header">
      <h3 class="page-title">
        <span class="page-title-icon bg-gradient-danger text-white me-2">
          <i class="fa fa-drivers-license-o"></i>
        </span>
        Drivers
      </h3>
    </div>

    <div class="container-fluid">

      <!-- ADD DRIVER MODAL -->
      <div class="modal fade" id="modalDriver" tabindex="-1">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">

            <div class="modal-header">
              <h5 class="modal-title">Add New Driver</h5>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <form action="{{ url('/store_driver') }}" method="POST" enctype="multipart/form-data">
              @csrf

              <div class="modal-body">
                <div class="row g-3">

                  <div class="col-md-4">
                    <label class="form-label">Driver Photo</label>
                    <input type="file" name="driver_image" class="form-control" required>
                    <small class="text-muted">Max size: 800kb</small>
                  </div>

                  <div class="col-md-4">
                    <label class="form-label">Driver Name</label>
                    <input type="text" name="driver_name" class="form-control" required>
                  </div>

                  <div class="col-md-4">
                    <label class="form-label">Phone</label>
                    <input type="text" name="phone" class="form-control" required>
                  </div>

                  <div class="col-md-6">
                    <label class="form-label">Location</label>
                    <input class="form-control" list="locations" name="location">
                    <datalist id="locations">
                      @foreach ($locations as $location)
                        <option value="{{ $location->location_name }}">
                      @endforeach
                    </datalist>
                  </div>

                  <div class="col-md-6">
                    <label class="form-label">License Number</label>
                    <input type="text" name="license_number" class="form-control" required>
                  </div>

                  <div class="col-md-6">
                    <label class="form-label">Ghana Card Number</label>
                    <input type="text" name="ghana_card_number" class="form-control" required>
                  </div>

                  <div class="col-md-6">
                    <label class="form-label">Status</label>
                    <select name="condition" class="form-select" required>
                      <option value="">Select</option>
                      <option value="Available">Available</option>
                      <option value="Un-available">Unavailable</option>
                      <option value="On-leave">On Leave</option>
                    </select>
                  </div>

                </div>
              </div>

              <div class="modal-footer">
                <button class="btn btn-danger" data-dismiss="modal">Cancel</button>
                <button class="btn btn-success">Save Driver</button>
              </div>

            </form>
          </div>
        </div>
      </div>

      <!-- ALERTS -->
      @if (session('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
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

      <!-- DRIVERS TABLE -->
      <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center">
          <h5 class="mb-0">Drivers List</h5>
          <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#modalDriver">
            <i class="fa fa-plus"></i> New Driver
          </button>
        </div>

        <div class="card-body">
          <div class="table-responsive">
            <table id="dataTable" class="table table-striped table-hover w-100">
              <thead class="thead-light">
                <tr>
                  <th>ID</th>
                  <th>Photo</th>
                  <th>Name</th>
                  <th>Contact</th>
                  <th>License</th>
                  <th>Ghana Card</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>

              <tbody>
                @foreach ($drivers as $driver)
                <tr>
                  <td>{{ $driver->driver_id }}</td>

                  <td class="text-center">
                    <img src="/driver/{{ $driver->driver_image }}"
                         class="img-thumbnail"
                         style="width:70px;height:70px;object-fit:cover;">
                  </td>

                  <td>{{ $driver->driver_name }}</td>

                  <td>
                    {{ $driver->phone }} <br>
                    <small class="text-muted">{{ $driver->location }}</small>
                  </td>

                  <td>{{ $driver->license_number }}</td>
                  <td>{{ $driver->ghana_card_number }}</td>

                  <td>
                    <span class="badge 
                      {{ $driver->condition === 'Available' ? 'badge-success' : 'badge-warning' }}">
                      {{ $driver->condition }}
                    </span>
                  </td>

                  <td>
                    <a href="{{ url("/edit_driver/{$driver->driver_id}") }}"
                       class="btn btn-sm btn-warning">
                      <i class="bi bi-pencil-square"></i>
                    </a>

                    <form action="{{ url("/delete_driver/{$driver->driver_id}") }}"
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
