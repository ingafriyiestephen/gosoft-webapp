@include('layouts.head')
<!-- partial -->
@include('layouts.sidenav')
  <!-- partial -->
  <div class="main-panel">
    <div class="content-wrapper">
    <div class="page-header d-flex justify-content-between align-items-center mb-4">
        <h3 class="page-title mb-0">
            <span class="page-title-icon bg-gradient-danger text-white me-2">
                <i class="fa fa-bus"></i>
            </span>
            Buses
        </h3>

        <button
            type="button"
            class="btn btn-danger btn-sm px-4"
            data-toggle="modal"
            data-target="#modalBus"
        >
            <i class="fa fa-plus me-1"></i> New Bus
        </button>
    </div>

 

      <div class="container-fluid">
        <!-- Modal -->
        <div class="modal fade" id="modalBus" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0 shadow-lg">
                    <div class="modal-header bg-dark text-white">
                        <h5 class="modal-title">
                            <i class="fa fa-bus me-2"></i> Add New Bus
                        </h5>
                        <button type="button" class="close text-white" data-dismiss="modal">
                            <span>&times;</span>
                        </button>
                    </div>

                    <form action="{{ url('/store_bus') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body px-4">
                            <div class="row g-3">
                                <div class="col-12">
                                    <label class="fw-bold">Bus Number</label>
                                    <input type="text" name="bus_number" class="form-control" required>
                                </div>

                                <div class="col-12">
                                    <label class="fw-bold">Seat Number</label>
                                    <select name="seat_number" class="form-select" required>
                                        <option value="">Select</option>
                                        <option value="50">50</option>
                                        <option value="60">60</option>
                                    </select>
                                </div>

                                <div class="col-12">
                                    <label class="fw-bold">Status</label>
                                    <select name="condition" class="form-select" required>
                                        <option value="">Select</option>
                                        @foreach ($conditions as $condition)
                                            <option value="{{ $condition->condition }}">{{ $condition->condition }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-12">
                                    <label class="fw-bold">Bus Image</label>
                                    <input type="file" name="bus_image" class="form-control" accept="image/png, image/jpeg" required>
                                    <small class="text-muted">Max size: 800kb</small>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer px-4">
                            <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">
                                Cancel
                            </button>
                            <button type="submit" class="btn btn-danger">
                                Save Bus
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        </div>
    
  
            @if (session('message'))
                <div class="alert alert-success col-md-6 mx-auto">
                    {{ session('message') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger col-md-6 mx-auto">
                    <strong>Whoops!</strong>
                    <ul class="mb-0 mt-2">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="card shadow-sm border-0">
                <div class="card-header bg-white">
                    <h5 class="mb-0 fw-bold">All Buses</h5>
                </div>

                <div class="card-body">
                    <table id="dataTable" class="table table-hover align-middle w-100">
                        <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>Picture</th>
                                <th>Bus Number</th>
                                <th>Seats</th>
                                <th>Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($buses as $bus)
                            <tr>
                                <td>{{ $bus->bus_id }}</td>

                                <td>
                                    <a href="{{ url("/bus/{$bus->bus_image}") }}" target="_blank">
                                        <img
                                            src="/bus/{{ $bus->bus_image }}"
                                            alt="Bus image"
                                            class="img-thumbnail"
                                            style="width: 120px; height: auto;"
                                        >
                                    </a>
                                </td>

                                <td class="fw-semibold">{{ $bus->bus_number }}</td>
                                <td>{{ $bus->seat_number }}</td>

                                <td>
                                    <span class="badge bg-dark">{{ $bus->condition }}</span>
                                </td>

                                <td class="text-center">
                                    <a href="{{ url("/edit_bus/{$bus->bus_id}") }}"
                                      class="btn btn-sm btn-warning me-1">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>

                                    <form method="POST"
                                          action="{{ url("/delete_bus/{$bus->bus_id}") }}"
                                          class="d-inline">
                                        @csrf
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit"
                                                class="btn btn-sm btn-danger show_confirm">
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

  
    
        <!-- card 2 -->
      </div>
 


    </div>
    <!-- content-wrapper ends -->

  </div>
  <!-- main-panel ends -->
<!-- page-body-wrapper ends -->
</div>
@include('layouts.script')





