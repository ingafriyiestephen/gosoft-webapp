@include('layouts.head')
<!-- partial -->
@include('layouts.sidenav')
  <!-- partial -->
  <div class="main-panel">
    <div class="content-wrapper">
      <div class="page-header">
        <h3 class="page-title">
          <span class="page-title-icon bg-gradient-danger text-white me-2">
            <i class="fa fa-drivers-license-o"></i>
          </span> Edit Driver
        </h3>
      </div>
 

      <div class="flex flex-wrap -mx-3">
        <div class="flex-none w-full max-w-full px-3">
          <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
            <!--Add Bus form-->
            <div class="flex-auto p-6">
              <!--Back button-->
              <div class="relative w-full mb-3">
                <a href="{{ url("/drivers") }}"> 
                  <button class="btn btn-secondary back-button"><i class="fas fa-arrow-left"></i> Back</button>
                </a>
              </div>
              <div class="relative w-full mb-3">
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
              </div>
            <form role="form" action="{{ url("/update_driver/{$driver->driver_id}") }}" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="container">
              <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-12 mt-3">            
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 mt-3">     
                  <img class="shadow-4-strong rounded-circle" style="width: 250px;" alt="avatar2" src="/driver/{{$driver->driver_image}}" />       
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 mt-3">            
                </div>
              </div>
              <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-12 mt-3">            
                      <label class="form-label" for="image">CHANGE DRIVER'S PICTURE</label>
                      <input class="block w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 cursor-pointer dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="driver_image" name="driver_image" value="{{$driver->driver_image}}" type="file">
                      <div class="mt-1 text-sm text-gray-500 dark:text-gray-300" >Maximum size should not exceed 800kb</div>
              </div>
              <div class="col-lg-4 col-md-6 col-sm-12 mt-3"> 
                    <label class="form-label" htmlfor="grid-password">
                      Driver Name
                    </label>
                    <input type="text" name="driver_name" id="driver_name" class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow" value="{{$driver->driver_name}}" />
              </div>
              <div class="col-lg-4 col-md-6 col-sm-12 mt-3"> 
                  <label class="form-label" htmlfor="grid-password">
                    Driver Phone
                  </label>
                  <input type="text" name="phone" id="phone" class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow" value="{{$driver->phone}}" />
              </div>
              </div>
              <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12 mt-3"> 
                    <label class="form-label" htmlfor="grid-location">
                      Driver Location
                    </label>
                    <select id="location" name="location" class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow">
                      <option value="{{$driver->location}}">{{$driver->location}}</option>
                      @foreach ($locations as $location)
                      <option value="{{$location->location_name}}">{{$location->location_name}}</option>
                      @endforeach
                    </select>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 mt-3"> 
                  <label class="form-label" htmlfor="grid-license">
                    License Number
                  </label>
                  <input type="text" name="license_number" id="license_number" class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow" value="{{$driver->license_number}}" required/>
                </div>
              </div>
              <div class="row">
              <div class="col-lg-6 col-md-6 col-sm-12 mt-3"> 
                    <label class="form-label" htmlfor="grid-license">
                      Ghana Card Number
                    </label>
                    <input type="text" name="ghana_card_number" id="ghana_card_number" class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow" value="{{$driver->ghana_card_number}}" required/>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-12 mt-3"> 
                    <label class="form-label" htmlfor="grid-password">
                      Status
                    </label>
                    <select id="condition" name="condition" class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow">
                      <option selected value="{{$driver->condition}}">{{$driver->condition}}</option>
                      <option value="Available">Available</option>
                      <option value="Un-available">Un-available</option>
                      <option value="On-leave">On-leave</option>
                    </select> 
                </div>
              </div>
              <div class="modal-footer">
                <button type="submit" class="btn btn-success save-button">Save Changes</button>
              </div>
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

