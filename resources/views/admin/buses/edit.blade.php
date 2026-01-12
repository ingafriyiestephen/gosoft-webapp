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
            <!--Add Bus form-->
            <div class="flex-auto p-6">
            <!--Back button-->
            <div class="relative w-full mb-3">
              <a href="{{ url("/buses") }}"> 
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
            <form role="form" action="{{ url("/update_bus/{$bus->bus_id}") }}" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="container">
              <div class='row' style="margin-bottom: 20px;">
                <div class="col-12 mt-3">
                    <label class="form-label" htmlfor="grid-password">
                      Bus Number
                    </label>
                    <input type="text" name="bus_number" id="bus_number" class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow" value="{{$bus->bus_number}}" />
                </div>
                <div class="col-12 mt-3">
                    <label class="form-label" htmlfor="grid-password">
                      Seat Number
                    </label>
                    <select id="seat_number" name="seat_number" class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow">
                      <option value="{{$bus->seat_number}}">{{$bus->seat_number}}</option>
                      <option value="50">50</option>
                      <option value="60">60</option>
                    </select> 
                </div>
                <div class="col-12 mt-3">
                    <label class="form-label" htmlfor="grid-password">
                      Status
                    </label>
                    <select id="condition" name="condition" class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow">
                      <option value="{{$bus->condition}}">{{$bus->condition}}</option>
                      @foreach ($conditions as $condition)
                        <option value="{{$condition->condition}}">{{$condition->condition}}</option>
                      @endforeach
                    </select> 
                </div>
                <div class="col-12 mt-3">        
                  <img class="shadow-4-strong rounded-circle" alt="avatar2" src="/bus/{{$bus->bus_image}}" />       
                </div>
                <div class="col-12 mt-3">            
                  <label class="form-label" for="image">Change Bus Picture</label>
                  <input class="block w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 cursor-pointer dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="bus_image" name="bus_image" type="file" accept="image/png, image/jpeg"/>
                  <div class="mt-1 text-sm text-gray-500 dark:text-gray-300" >Maximum size should not exceed 800kb</div>
                </div>
                <div class="modal-footer">
                  <button type="submit" class="btn btn-success" style="margin-bottom: 10px; margin-right: 20px;">Save Changes</button>
                </div>
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


 
 