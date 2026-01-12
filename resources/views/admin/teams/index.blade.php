@include('layouts.head')
<!-- partial -->
@include('layouts.sidenav')
  <!-- partial -->
  <div class="main-panel">
    <div class="content-wrapper">
      <div class="page-header d-flex justify-content-between align-items-center mb-4">
          <h3 class="page-title mb-0">
              <span class="page-title-icon bg-gradient-danger text-white me-2">
                  <i class="fa fa-users"></i>
              </span>
              Team Members
          </h3>

          <button
              type="button"
              class="btn btn-danger btn-sm px-4"
              data-toggle="modal"
              data-target="#modalUser"
          >
              <i class="fa fa-user-plus me-1"></i> New Member
          </button>
      </div>

 

      <div class="container-fluid">
        <!-- Modal -->
        <div class="modal fade" id="modalUser" tabindex="-1">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content border-0 shadow-lg">
                    <div class="modal-header bg-dark text-white">
                        <h5 class="modal-title">
                            <i class="fa fa-user-plus me-2"></i> Add New Team Member
                        </h5>
                        <button type="button" class="close text-white" data-dismiss="modal">
                            <span>&times;</span>
                        </button>
                    </div>

                    <form action="{{ url('/store_member') }}" method="POST">
                        @csrf
                        <div class="modal-body px-4">
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <label class="fw-bold">Name</label>
                                    <input type="text" name="name" class="form-control" required>
                                </div>

                                <div class="col-md-4">
                                    <label class="fw-bold">Email</label>
                                    <input type="email" name="email" class="form-control" required>
                                </div>

                                <div class="col-md-4">
                                    <label class="fw-bold">Password</label>
                                    <input type="password" name="password" value="defpass_2024$" class="form-control" required>
                                </div>

                                <div class="col-md-6">
                                    <label class="fw-bold">Phone</label>
                                    <input type="tel" name="phone" class="form-control" required>
                                </div>

                                <div class="col-md-6">
                                    <label class="fw-bold">Role</label>
                                    <select name="role_id" class="form-select" required>
                                        <option value="">Select role</option>
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->role_id }}">{{ $role->role_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer px-4">
                            <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-danger">Save Member</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        </div>
    

    <div class="flex flex-wrap -mx-3">
      <div class="flex-none w-full max-w-full px-3">
        <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
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
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0 fw-bold">All Team Members</h5>
    </div>

    <div class="card-body">
        <table id="dataTable" class="table table-hover align-middle w-100">
            <thead class="table-light">
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Role</th>
                    <th>Created</th>
                    <th>Updated</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($users as $user)
                <tr>
                    <td class="fw-semibold">{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->phone }}</td>
                    <td>
                        <span class="badge bg-dark">{{ $user->role_name }}</span>
                    </td>
                    <td>{{ $user->created_at }}</td>
                    <td>{{ $user->updated_at }}</td>
                    <td class="text-center">
                        <a href="{{ url("/edit_member/{$user->id}") }}" class="btn btn-sm btn-warning me-1">
                            <i class="bi bi-pencil-square"></i>
                        </a>

                        <form method="POST" action="{{ url("/delete_member/{$user->id}") }}" class="d-inline">
                            @csrf
                            <input type="hidden" name="_method" value="DELETE">
                            <button type="submit" class="btn btn-sm btn-danger show_confirm">
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
      </div>


    </div>
    <!-- content-wrapper ends -->

  </div>
  <!-- main-panel ends -->
</div>
<!-- page-body-wrapper ends -->
</div>
@include('layouts.script')
