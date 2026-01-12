<x-app-layout>
  @include('layouts.head')
   <body class="m-0 font-sans antialiased font-normal text-base leading-default bg-gray-50 text-slate-500">
   @include('layouts.sidenav')
   
   <main class="ease-soft-in-out xl:ml-68.5 relative h-full max-h-screen rounded-xl transition-all duration-200">

  <div class="w-full px-6 py-6 mx-auto">
    <!-- table 1 -->

    <div class="flex flex-wrap -mx-3">
      <div class="flex-none w-full max-w-full px-3">
        <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
          <!--Add Bus form-->
          <div class="flex-auto p-6">
          <!--Back button-->
          <div class="relative w-full mb-3">
            <a href="{{ url("/parcels") }}">
              <button class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Back</button>
            </a>
          </div>
            @if (session('message'))
            <div class="alert alert-success w-1/2 max-w-full px-12">
                    {{ session('message') }}
                </div>
            @endif
            {{-- Search the details of a user for booking --}}
            {{-- <form role="form" action="{{ url("/parcel_user_search") }}" method="POST" enctype="multipart/form-data">
              @csrf
            <div class='row' style="margin-bottom: 20px;">
              <div class="col">
                  <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2" htmlfor="grid-departure">
                    Search User By Phone
                  </label>
                  <select id="phone" name="phone" class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow">
                    <option>Select Phone</option>
                    @foreach ($users as $user)
                      <option value="{{$user->phone}}">{{$user->phone}}</option>
                    @endforeach
                  </select> 
                </div>
                <div class="col">
                  <button type="submit" class="btn btn-success" style="margin-top: 20px;">Find User</button>
                </div>
            </div>
            </form> --}}
            <form role="form" action="{{ url("/store_parcel") }}" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="row">
                <div class='row' style="margin-bottom: 20px;">
                  <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2" htmlfor="grid-departure">
                    <b>User Information</b>
                  </label>
                  <input type="text" name="user_id" id="user_id" class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow" value="{{$data->id}}" hidden required/>
                  <div class="col">
                    <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2" htmlfor="grid-password">
                      Name
                    </label>
                    <input type="text" name="name" id="name" class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow" value="{{$data->name}}" required/>
                  </div>
                  <div class="col">
                    <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2" htmlfor="grid-password">
                      Phone
                    </label>
                    <input type="text" name="phone" id="phone" class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow" value="{{$data->phone}}" required/>
                  </div>
                  <div class="col">
                    <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2" htmlfor="grid-password">
                      Email
                    </label>
                    <input type="email" name="email" id="email" class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow" value="{{$data->email}}" required/>
                  </div>
                  <div class="col">
                    <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2" htmlfor="grid-password">
                      City/Town
                    </label>
                    <select id="location" name="location" class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow">
                      <option value="{{$user->location}}" selected>{{$user->location}}</option>
                      @foreach ($locations as $location)
                        <option value="{{$location->location_name}}">{{$location->location_name}}</option>
                      @endforeach
                    </select> 
                  </div>
                </div>
                <div class='row' style="margin-bottom: 20px;">
                  <div class="col">
                    <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2" htmlfor="grid-password">
                      Address
                    </label>
                    <input type="address" name="email" id="address" class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow" value="{{$data->address}}" required/>
                  </div>
                  <div class="col">
                    <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2" htmlfor="grid-password">
                      ID Type
                    </label>
                    <select id="id_type" name="id_type" class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow" required>
                      <option value="{{$data->id_type}}" selected>{{$data->id_type}}</option>
                      <option value="Ghana Card">Ghana Card</option>
                      <option value="Passport">Passport</option>
                    </select> 
                  </div>
                  <div class="col">
                    <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2" htmlfor="grid-password">
                      ID Number
                    </label>
                    <input type="tel" name="id_number" id="id_number" class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow" value="{{$data->id_number}}"/>
                  </div>
              </div>
              <hr><br>
              <div class='row' style="margin-bottom: 20px;">
                <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2" htmlfor="grid-departure">
                  <b>Parcel Information</b>
                </label>
                <div class="col">
                  <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2" htmlfor="grid-password">
                    Receiver Name
                  </label>
                  <input type="text" name="receiver_name" id="receiver_name" class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow" required/>
                </div>
                <div class="col">
                  <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2" htmlfor="grid-password">
                    Receiver Phone
                  </label>
                  <input type="tel" name="receiver_phone" id="receiver_phone" class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow" required/>
                </div>
                <div class="col">
                  <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2" htmlfor="grid-password">
                    Sending From
                  </label>
                  <select id="from_location" name="from_location" class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow" required>
                    <option value="" selected disabled>Select Location</option>
                    @foreach ($locations as $location)
                      <option value="{{$location->location_name}}">{{$location->location_name}}</option>
                    @endforeach
                  </select> 
                </div>
                <div class="col">
                  <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2" htmlfor="grid-password">
                    Sending To
                  </label>
                  <select id="to_location" name="to_location" class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow" required>
                    <option value="" selected disabled>Select Location</option>
                    @foreach ($locations as $location)
                      <option value="{{$location->location_name}}">{{$location->location_name}}</option>
                    @endforeach
                  </select> 
                </div>
              </div>
              <div class='row' style="margin-bottom: 20px;">
                <div class="col">
                    <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2" htmlfor="parcel_image">
                      Parcel Image
                    </label>
                      <input id="parcel_image" type="file" class="form-control" name="parcel_image">
                </div>
                <div class="col">
                    <img src="/assets/img/icons8-image-96.png" id="parcel-img-tag" width="200px" />   <!--for preview purpose -->
                </div>
              </div>
              <div class='row' style="margin-bottom: 20px;">
                <div class="col">
                  <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2" htmlfor="grid-password">
                    Parcel Type
                  </label>
                  <select id="parcel_type" name="parcel_type" class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow" required>
                    <option value="" selected disabled>Select Parcel Type</option>
                    @foreach ($parcel_types as $type)
                      <option value="{{$type->parcel_type}}">{{$type->parcel_type}}</option>
                    @endforeach
                  </select> 
                </div>
                <div class="col">
                  <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2">
                    Number of Parcels
                  </label>
                  <input type="tel" name="number_parcels" id="number_parcels" class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow" required/>
                </div>
                <div class="col">
                  <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2" htmlfor="grid-password">
                    Collection Type
                  </label>
                  <select id="collection_type" name="collection_type" class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow" required>
                    <option value="" selected disabled>Select Collection Type</option>
                    <option value="Station Pick-up">Station Pick-up</option>
                    <option value="Company Delivery">Company Delivery</option>
                  </select> 
                </div>
              </div>
              <div class='row' style="margin-bottom: 20px;">
                <div class="col col-pickup">
                  <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2" htmlfor="grid-password">
                    Pickup Location
                  </label>
                  <select id="pickup_location" name="pickup_location" class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow">
                    <option value="" selected disabled>Select Location</option>
                    @foreach ($locations as $location)
                      <option value="{{$location->location_name}}">{{$location->location_name}}</option>
                    @endforeach
                  </select> 
                </div>
                <div class="col col-landmark">
                  <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2" htmlfor="grid-password">
                    Landmark
                  </label>
                  <input type="text" name="landmark" id="landmark" class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow"/>
                </div>
              </div>
              <div class='row' style="margin-bottom: 20px;">
                <div class="col">
                  <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2">
                    Delivery Fee
                  </label>
                  <input type="tel" name="delivery_fee" id="delivery_fee" class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow" required/>
                </div>
                <div class="col">
                  <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2" htmlfor="grid-password">
                    Payment Status
                  </label>
                  <select id="payment_status" name="payment_status" class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow" required>
                    <option value="" selected disabled>Select Payment Status</option>
                    <option value="Paid">Paid</option>
                    <option value="Not-Paid">Not-Paid</option>
                  </select> 
                </div>
                <div class="col">
                  <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2" htmlfor="grid-password">
                    Delivery Status
                  </label>
                  <select id="delivery_status" name="delivery_status" class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow" required>
                    <option selected value="Received by Company">Received by Company</option>
                    <option value="Parcel Vehicle has set off">Parcel Vehicle has set off</option>
                    <option value="Parcel has arrived">Parcel has arrived</option>
                    <option value="Parcel in transit to Receiver"> Parcel in transit to Receiver</option>
                    <option value="Delivered to Receiver">Delivered to Receiver </option>

                  </select> 
                </div>
              </div>
              </div>
              <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Save Changes</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- card 2 -->

  </main>

</body>
<!-- plugin for charts  -->
<script src="http://127.0.0.1:8000/assets/js/plugins/chartjs.min.js" async></script>
<!-- plugin for scrollbar  -->
<script src="http://127.0.0.1:8000/assets/js/plugins/perfect-scrollbar.min.js" async></script>
<!-- github button -->
<script async defer src="https://buttons.github.io/buttons.js"></script>
<!-- main script file  -->
<script src="http://127.0.0.1:8000/assets/js/soft-ui-dashboard-tailwind.js?v=1.0.4" async></script>
<script>
  function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#parcel-img-tag').attr('src', e.target.result);
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }
    
    $("#parcel_image").change(function(){
        readURL(this);
    });

    $(document).ready(function() {
        $('.col-pickup').hide();
        $('.col-landmark').hide();
    } );

    //Toggle show or hide Pickup Location or Landmark
    var collection_type_drop = $('#collection_type');
    var select = this.value;
    collection_type_drop.change(function () {
        if ($(this).val() == 'Company Delivery') {
            $('.col-pickup').show();
            $('.col-landmark').show();
        }
        else if ($(this).val() == 'Station Pick-up' || $(this).val() == '') {
            $('.col-pickup').hide();
            $('.col-landmark').hide();
        }
    });
</script>
</html>
</x-app-layout>