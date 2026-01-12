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
          </span> Edit Bus
        </h3>
      </div>
 

        <div class="flex flex-wrap -mx-3">
          <div class="flex-none w-full max-w-full px-3">
            <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
              <!--Add Location form-->
              <div class="flex-auto p-6">
              <!--Back button-->
              <div class="relative w-full mb-3">
                <a href="{{ url("/locations") }}"> 
                  <button class="btn btn-secondary back-button"><i class="fas fa-arrow-left"></i> Back</button>
                </a>
              </div>
                <div class="relative w-full mb-3">
                  @if (session('message'))
                  <div class="alert alert-success w-1/2 max-w-full px-12">
                          {{ session('message') }}
                      </div>
                  @endif
                </div>
              <form role="form" action="{{ url("/update_location/{$location->location_id}") }}" method="POST">
                @csrf
                <div class="container">
                <div class='row' style="margin-bottom: 20px;">
                    <div class="col">
                      <label class="form-label" htmlfor="grid-password">
                        Location Name
                      </label>
                      <input type="text" name="location_name" id="location_name" class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow" value="{{$location->location_name}}" />
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
