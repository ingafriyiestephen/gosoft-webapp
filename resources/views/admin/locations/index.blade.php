@include('layouts.head')

<!-- partial -->
@include('layouts.sidenav')
  <!-- partial -->
  <div class="main-panel">
    <div class="content-wrapper">
      <div class="page-header d-flex justify-content-between align-items-center mb-4">
          <h3 class="page-title mb-0">
              <span class="page-title-icon bg-gradient-danger text-white me-2">
                  <i class="fa fa-globe"></i>
              </span>
              Locations
          </h3>

          <button 
              type="button" 
              class="btn btn-danger btn-sm px-4"
              data-toggle="modal" 
              data-target="#modalLocation"
          >
              <i class="fa fa-plus me-1"></i> New Location
          </button>
      </div>

 

      <div class="container-fluid">

        <div class="modal fade" id="modalLocation" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content shadow-lg border-0">
                    <div class="modal-header bg-dark text-white">
                        <h5 class="modal-title" id="modalLocationTitle">
                            <i class="fa fa-map-marker me-2"></i> Add New Location
                        </h5>
                        <button type="button" class="close text-white" data-dismiss="modal">
                            <span>&times;</span>
                        </button>
                    </div>

                    <form action="{{ url('/store_location') }}" method="POST">
                        @csrf
                        <div class="modal-body px-4">
                            <div class="form-group">
                                <label class="fw-bold">Location Name</label>
                                <input
                                    type="text"
                                    name="location_name"
                                    class="form-control"
                                    placeholder="Enter location name"
                                    required
                                >
                            </div>
                        </div>

                        <div class="modal-footer px-4">
                            <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">
                                Cancel
                            </button>
                            <button type="submit" class="btn btn-danger">
                                Save Location
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    
       <div class="w-full px-6 py-6 mx-auto">
        <!-- table 1 -->
    
        @if (session('message'))
            <div class="alert alert-success alert-dismissible fade show col-md-6 mx-auto">
                {{ session('message') }}
                <button type="button" class="close" data-dismiss="alert">&times;</button>
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

<div class="card shadow-sm border-0 mb-4">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0 fw-bold">All Locations</h5>
    </div>

    <div class="card-body">
        <table id="dataTable" class="table table-hover align-middle w-100">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Location Name</th>
                    <th>Created</th>
                    <th>Updated</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($locations as $location)
                <tr>
                    <td>{{ $location->location_id }}</td>
                    <td class="fw-semibold">{{ $location->location_name }}</td>
                    <td>{{ $location->created_at }}</td>
                    <td>{{ $location->updated_at }}</td>
                    <td class="text-center">
                        <a href="{{ url("/edit_location/{$location->location_id}") }}"
                           class="btn btn-sm btn-warning me-1">
                            <i class="bi bi-pencil-square"></i>
                        </a>

                        <form method="POST"
                              action="{{ url("/delete_location/{$location->location_id}") }}"
                              class="d-inline">
                            @csrf
                            <input type="hidden" name="_method" value="DELETE">
                            <button
                                type="submit"
                                class="btn btn-sm btn-danger show_confirm"
                            >
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



