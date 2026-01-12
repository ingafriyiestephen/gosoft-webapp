@include('layouts.head')
<!-- partial -->
@include('layouts.sidenav')
  <!-- partial -->
  <div class="main-panel">
    <div class="content-wrapper">
      <div class="page-header">
        <h3 class="page-title">
          <span class="page-title-icon bg-gradient-primary text-white me-2">
            <i class="fa fa-drivers-license-o"></i>
          </span> Edit Member
        </h3>
      </div>
 

      <div class="flex flex-wrap -mx-3">
        <div class="flex-none w-full max-w-full px-3">
          <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
            <!--Add Bus form-->
            <div class="flex-auto p-6">
              <!--Back button-->
              <div class="relative w-full mb-3">
                <a href="{{ url("/team_members") }}"> 
                  <button class="btn btn-secondary back-button"><i class="fas fa-arrow-left"></i> Back</button>
                </a>
              </div>
              @if (session('message'))
              <div class="alert alert-success w-1/2 max-w-full px-12">
                      {{ session('message') }}
                  </div>
              @endif
              <!--Display All Error Messages -->
              @if ($errors->any())
              <div class="alert alert-danger">
                  <strong>Whoops!</strong> There were some problems with your input.<br><br>
                  <ul>
                      @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                      @endforeach
                  </ul>
              </div>
              @endif
              <form role="form" action="{{ url("/update_member/{$user->id}") }}" method="POST">
                @csrf
                <div class="container">
                  <div class='row' style="margin-bottom: 20px;">
                    <div class="col-lg-6 col-md-6 col-sm-12 mt-3">
                      <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2" htmlfor="grid-password">
                        Name
                      </label>
                      <input type="text" name="name" id="name" class="form-control text-gray-700" value="{{$user->name}}" required/>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 mt-3">
                      <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2" htmlfor="grid-password">
                        Email
                      </label>
                      <input type="email" name="email" id="email" class="form-control text-gray-700" value="{{$user->email}}" required/>
                    </div>
                  </div>
                  <div class='row' style="margin-bottom: 20px;">
                    <div class="col-lg-6 col-md-6 col-sm-12 mt-3">
                      <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2" htmlfor="grid-password">
                        Phone
                      </label>
                      <input type="tel" name="phone" id="phone" class="form-control text-gray-700" value="{{$user->phone}}" required/>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 mt-3">
                      <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2" htmlfor="grid-password">
                        Role
                      </label>
                      <select id="role_id" name="role_id" class="form-select text-gray-700">
                        <option selected value="{{$user->role_id}}">{{$user->role_name}}</option>
                        @foreach ($roles as $role)
                          <option value="{{$role->role_id}}">{{$role->role_name}}</option>
                        @endforeach
                      </select> 
                    </div>
                  </div>
                  {{-- <div class='row' style="margin-bottom: 20px;">
                    <div class="col-lg-6 col-md-4 col-sm-12 mt-3">
                      <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2" htmlfor="grid-password">
                        Password
                      </label>
                      <input type="password" name="password" id="password" class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow" placeholder="Enter Password"/>
                    </div>
                    <div class="col-lg-6 col-md-4 col-sm-12 mt-3">
                      <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2" htmlfor="grid-password">
                       Confirm Password
                      </label>
                      <input type="confirm_password" name="confirm_password" id="password" class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow" placeholder="Confirm Password"/>
                    </div>
                  </div> --}}
                  {{-- <div class='row' style="margin-bottom: 20px;">
                    <div class="col-lg-6 col-md-6 col-sm-12 mt-3">
                      <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2" htmlfor="grid-password">
                        ID Type (Optional)
                      </label>
                      <select id="id_type" name="id_type" class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow">
                        <option selected>{{$user->id_type}}</option>
                        <option value="Ghana Card">Ghana Card</option>
                        <option value="Passport">Passport</option>
                      </select> 
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 mt-3">
                      <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2" htmlfor="grid-password">
                        ID Number (Optional)
                      </label>
                      <input type="tel" name="id_number" id="id_number" class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow" value="{{$user->id_number}}"/>
                    </div>
                </div> --}}
                </div>
                <div class="modal-footer">
                  <button type="submit" class="btn btn-success save-button" style="margin-right: 10px;">Save Changes</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    

    </div>
    <!-- content-wrapper ends -->
  </div>
  <!-- main-panel ends -->

@include('layouts.script')
