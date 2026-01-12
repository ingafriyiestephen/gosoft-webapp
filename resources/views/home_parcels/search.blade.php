<x-app-layout>
  @include('layouts.head')
   <body class="m-0 font-sans antialiased font-normal text-base leading-default bg-gray-50 text-slate-500">
   @include('layouts.sidenav')
  <div class="container-fluid">

  <div class="w-full px-6 py-6 mx-auto">
    <!-- table 1 -->

    <div class="flex flex-wrap -mx-3">
      <div class="flex-none w-full max-w-full px-3">
        <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
          <!--Add Parcel form-->
          <div class="flex-auto p-6">
          <!--Back button-->
          <div class="row">
            <div class="col-lg-3 col-md-12 col-sm-12">
            <a href="{{ url("/parcels") }}"> 
              <button class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Back</button>
            </a>
            </div>
              <div class='col-lg-9 col-md-12 col-sm-12' style="display: block; margin-left: auto; margin-right: auto; width: 70%;">
                {{-- <div class="visible-print text-center">
                  {!! QrCode::size(300)->generate($parcel->tracking_code); !!}
                  <br>
              </div> --}}
              <p style="color: green; display: block; margin-left: auto; margin-right: auto; width: 85%;">Tracking Code: {{$parcel->tracking_code}}</p>
            </div>
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
            <form role="form">
              <div class="container">
                <div class='row' style="margin-bottom: 20px;">
                  <label class="form-label" htmlfor="grid-departure">
                    <h5>User Information</h5>
                  </label>
                  <input type="text" name="user_id" id="user_id" class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow" value="{{$parcel->user_id}}" hidden />
                  <div class="col-lg-3 col-md-6 col-sm-12 mt-3">
                    <label class="form-label" htmlfor="grid-password">
                      Name
                    </label>
                    <input type="text" name="sender_name" id="sender_name" class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow" value="{{$parcel->sender_name}}" />
                  </div>
                  <div class="col-lg-3 col-md-6 col-sm-12 mt-3">
                    <label class="form-label" htmlfor="grid-password">
                      Phone
                    </label>
                    <input type="text" name="sender_phone" id="sender_phone" class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow" value="{{$parcel->sender_phone}}" />
                  </div>
                  <div class="col-lg-3 col-md-6 col-sm-12 mt-3">
                    <label class="form-label" htmlfor="grid-password">
                      Email (OPTIONAL)
                    </label>
                    <input type="email" name="sender_email" id="sender_email" class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow" value="{{$parcel->sender_email}}" />
                  </div>
                  <div class="col-lg-3 col-md-6 col-sm-12 mt-3">
                    <label class="form-label" htmlfor="grid-password">
                      City/Town (OPTIONAL)
                    </label>
                    <select id="location" name="location" class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow">
                      <option value="{{$parcel->sender_location}}" selected>{{$parcel->sender_location}}</option>
                      @foreach ($locations as $location)
                        <option value="{{$location->location_name}}">{{$location->location_name}}</option>
                      @endforeach
                    </select> 
                  </div>
                </div>
                <div class='row' style="margin-bottom: 20px;">
                  <div class="col-lg-4 col-md-6 col-sm-12 mt-3">
                    <label class="form-label" htmlfor="grid-password">
                      Address (OPTIONAL)
                    </label>
                    <input type="address" name="sender_address" id="sender_address" class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow" value="{{$parcel->sender_address}}" />
                  </div>
                  <div class="col-lg-4 col-md-6 col-sm-12 mt-3">
                    <label class="form-label" htmlfor="grid-password">
                      ID Type (OPTIONAL)
                    </label>
                    <select id="sender_id_type" name="sender_id_type" class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow" >
                      <option selected value="{{$parcel->id_type}}" selected>{{$parcel->id_type}}</option>
                      <option value="Ghana Card">Ghana Card</option>
                      <option value="Passport">Passport</option>
                    </select> 
                  </div>
                  <div class="col-lg-4 col-md-6 col-sm-12 mt-3">
                    <label class="form-label" htmlfor="grid-password">
                      ID Number (OPTIONAL)
                    </label>
                    <input type="tel" name="sender_id_no" id="sender_id_no" class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow" value="{{$parcel->sender_id_no}}"/>
                  </div>
              </div>
              <hr><br>
              <div class='row' style="margin-bottom: 20px;">
                <label class="form-label" htmlfor="grid-departure">
                  <h5>Parcel Information</h5>
                </label>
                <div class="col-lg-3 col-md-6 col-sm-12 mt-3">
                  <label class="form-label" htmlfor="grid-password">
                    Receiver Name
                  </label>
                  <input type="text" name="receiver_name" id="receiver_name" class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow" value="{{$parcel->receiver_name}}"/>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 mt-3">
                  <label class="form-label" htmlfor="grid-password">
                    Receiver Phone
                  </label>
                  <input type="tel" name="receiver_phone" id="receiver_phone" class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow" value="{{$parcel->receiver_phone}}"/>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 mt-3">
                  <label class="form-label" htmlfor="grid-password">
                    Sending From
                  </label>
                  <select id="from_location" name="from_location" class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow" >
                    <option value="{{$parcel->from_location}}" selected >{{$parcel->from_location}}</option>
                    @foreach ($locations as $location)
                      <option value="{{$location->location_name}}">{{$location->location_name}}</option>
                    @endforeach
                  </select> 
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 mt-3">
                  <label class="form-label" htmlfor="grid-password">
                    Sending To
                  </label>
                  <select id="to_location" name="to_location" class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow" >
                    <option value="{{$parcel->to_location}}" selected>{{$parcel->to_location}}</option>
                    @foreach ($locations as $location)
                      <option value="{{$location->location_name}}">{{$location->location_name}}</option>
                    @endforeach
                  </select> 
                </div>
              </div>
              <div class='row' style="margin-bottom: 20px;">
                <div class="col">
                    <label class="form-label" htmlfor="parcel_image">
                      Parcel Image
                    </label>
                      <input id="parcel_image" type="file" class="form-control" name="parcel_image" value="{{$parcel->parcel_image}}">
                </div>
                <div class="col">
                    <img src="/parcel/{{$parcel->parcel_image}}" class="img" id="parcel-img-tag" width="200px" />   <!--for preview purpose -->
                </div>
              </div>
              <div class='row' style="margin-bottom: 20px;">
                <div class="col-lg-3 col-md-6 col-sm-12 mt-3">
                  <label class="form-label" htmlfor="grid-password">
                    Parcel Type
                  </label>
                  <select id="parcel_type" name="parcel_type" class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow" >
                    <option value="{{$parcel->parcel_type}}" selected>{{$parcel->parcel_type}}</option>
                    @foreach ($parcel_types as $type)
                      <option value="{{$type->parcel_type}}">{{$type->parcel_type}}</option>
                    @endforeach
                  </select> 
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 mt-3">
                  <label class="form-label">
                    Number of Parcels
                  </label>
                  <input type="tel" name="number_parcels" id="number_parcels" class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow" value="{{$parcel->number_parcels}}"/>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 mt-3">
                  <label class="form-label">
                    Parcel Weight(KG) (OPTIONAL)
                  </label>
                  <input type="text" name="parcel_weight" id="parcel_weight" class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow" value="{{$parcel->parcel_weight}}"/>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 mt-3">
                  <label class="form-label" htmlfor="grid-password">
                    Collection Type
                  </label>
                  <select id="collection_type" name="collection_type" class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow" >
                    <option value="{{$parcel->collection_type}}" selected>{{$parcel->collection_type}}</option>
                    <option value="Station Pick-up">Station Pick-up</option>
                    <option value="Company Delivery">Company Delivery</option>
                  </select> 
                </div>
              </div>
              <div class='row' style="margin-bottom: 20px;">
                <div class="col-lg-4 col-md-6 col-sm-12 mt-3 col-pickup">
                  <label class="form-label" htmlfor="grid-password">
                    Pickup Location
                  </label>
                  <select id="pickup_location" name="pickup_location" class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow">
                    <option value="{{$parcel->pickup_location}}" selected>{{$parcel->pickup_location}}</option>
                    @foreach ($locations as $location)
                      <option value="{{$location->location_name}}">{{$location->location_name}}</option>
                    @endforeach
                  </select> 
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 mt-3 col-landmark">
                  <label class="form-label" htmlfor="grid-password">
                    Landmark
                  </label>
                  <input type="text" name="landmark" id="landmark" class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow" value="{{$parcel->landmark}}"/>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 mt-3 col-delivery-fee">
                  <label class="form-label">
                    Company Delivery Fee
                  </label>
                  <input type="tel" name="delivery_fee" id="delivery_fee" class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow" value="{{$parcel->delivery_fee}}"/>
                </div>
              </div>
              <div class='row' style="margin-bottom: 20px;">
                <div class="col-lg-3 col-md-6 col-sm-12 mt-3">
                  <label class="form-label">
                    Parcel Fee
                  </label>
                  <input type="tel" name="parcel_fee" id="parcel_fee" class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow" value="{{$parcel->parcel_fee}}"/>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 mt-3">
                  <label class="form-label" htmlfor="grid-password">
                    Payment Status
                  </label>
                  <select id="payment_status" name="payment_status" class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow" >
                    <option value="{{$parcel->payment_status}}" selected>{{$parcel->payment_status}}</option>
                    <option value="Paid">Paid</option>
                    <option value="Not-Paid">Not-Paid</option>
                  </select> 
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 mt-3">
                  <label class="form-label" htmlfor="grid-password">
                    Assigned Bus
                  </label>
                  <select id="bus_id" name="bus_id" class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow">
                    <option value="{{$parcel->bus_id}}" selected>{{$parcel->bus_number}}</option>
                    @foreach ($buses as $bus)
                      <option value="{{$bus->bus_id}}">{{$bus->bus_number}}</option>
                    @endforeach
                  </select> 
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 mt-3">
                  <label class="form-label" htmlfor="grid-password">
                    Delivery Status
                  </label>
                  <select id="delivery_status" name="delivery_status" class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow" >
                    <option value="{{$parcel->delivery_status}}" selected>{{$parcel->delivery_status}}</option>
                    <option value="Received by Company">Received by Company</option>
                    <option value="Parcel Vehicle has set off">Parcel Vehicle has set off</option>
                    <option value="Parcel has arrived">Parcel has arrived</option>
                    <option value="Parcel in transit to Receiver"> Parcel in transit to Receiver</option>
                    <option value="Delivered to Receiver">Delivered to Receiver </option>

                  </select> 
                </div>
              </div>
              </div>
              <div class="modal-footer">
                <button type="submit" class="btn btn-success">Save Changes</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- card 2 -->

  </div>

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

    //Toggle show or hide Pickup Location or Landmark
    var collection_type_drop = $('#collection_type');
    var select = this.value;
    collection_type_drop.change(function () {
        if ($(this).val() == 'Company Delivery') {
            $('.col-pickup').show();
            $('.col-landmark').show();
            $('.col-delivery-fee').show();
        }
        else if ($(this).val() == 'Station Pick-up') {
            $('.col-pickup').hide();
            $('.col-landmark').hide();
            $('.col-delivery-fee').hide();
        }
    });
</script>
</html>
</x-app-layout>