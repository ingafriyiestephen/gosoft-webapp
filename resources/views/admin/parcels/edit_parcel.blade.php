{{--Remove the unwanted characters in the parcel type--}}
<?php 
$str_parcel_type= str_replace('[',"",$parcel->parcel_type);
$str_parcel_type= str_replace(']',"",$str_parcel_type);
$str_parcel_type= str_replace('"'," ",$str_parcel_type);
?>
@include('layouts.head')
<!-- partial -->
@include('layouts.sidenav')
  <!-- partial -->
  <div class="main-panel">
    <div class="content-wrapper">
      <div class="page-header">
        <h3 class="page-title">
          <span class="page-title-icon bg-gradient-danger text-white me-2">
            <i class="fa fa-gift"></i>
          </span> Edit Parcel
        </h3>
      </div>
 

      <div class="flex flex-wrap -mx-3">
        <div class="flex-none w-full max-w-full px-3">
          <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
            <!--Add Parcel form-->
            <div class="flex-auto p-6">
            <!--Back button-->
            <div class="row">
              <div class="col-lg-3 col-md-12 col-sm-12">
              <a href="{{ url("/parcels") }}"> 
                <button class="btn btn-secondary back-button"><i class="fas fa-arrow-left"></i> Back</button>
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
              <form role="form" action="{{ url("/update_parcel/{$parcel->parcel_id}") }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="container">
                  <div class='row' style="margin-bottom: 20px;">
                    <label class="form-label" htmlfor="grid-departure">
                      <h5>Customer Information</h5>
                    </label>
                    <input type="text" name="user_id" id="user_id" class="form-control" value="{{$parcel->user_id}}" hidden />
                    <div class="col-lg-6 col-md-6 col-sm-12 mt-3">
                      <label class="form-label" htmlfor="grid-password">
                        Name
                      </label>
                      <input type="text" name="sender_name" id="sender_name" class="form-control" value="{{$parcel->sender_name}}" />
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 mt-3">
                      <label class="form-label" htmlfor="grid-password">
                        Phone
                      </label>
                      <input type="text" name="sender_phone" id="sender_phone" class="form-control" value="{{$parcel->sender_phone}}" />
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
                    <input type="text" name="receiver_name" id="receiver_name" class="form-control" value="{{$parcel->receiver_name}}"/>
                  </div>
                  <div class="col-lg-3 col-md-6 col-sm-12 mt-3">
                    <label class="form-label" htmlfor="grid-password">
                      Receiver Phone
                    </label>
                    <input type="tel" name="receiver_phone" id="receiver_phone" class="form-control" value="{{$parcel->receiver_phone}}"/>
                  </div>
                  <div class="col-lg-3 col-md-6 col-sm-12 mt-3">
                    <label class="form-label" htmlfor="grid-password">
                      Sending From
                    </label>
                    <input class="form-control" list="fromLocationOptions" id="from_location" name="from_location" required value="{{$parcel->from_location}}" placeholder="Type to search...">
                    <datalist id="fromLocationOptions">
                      @foreach ($locations as $location)
                        <option value="{{$location}}">
                      @endforeach
                    </datalist>
                  </div>
                  <div class="col-lg-3 col-md-6 col-sm-12 mt-3">
                    <label class="form-label" htmlfor="grid-password">
                      Sending To
                    </label>
                    <input class="form-control" list="toLocationOptions" id="to_location" name="to_location" required value="{{$parcel->to_location}}" placeholder="Type to search...">
                    <datalist id="toLocationOptions">
                      @foreach ($locations as $location)
                        <option value="{{$location}}">
                      @endforeach
                    </datalist>
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
                  <div class="col-lg-4 col-md-6 col-sm-12 mt-3">
                    <label class="form-label" htmlfor="grid-password">
                      Parcel Type: 
                      <b>{{$str_parcel_type}}</b>
                    </label>
                    <select class="js-example-basic-multiple" id="parcel_type" name="parcel_type[]" multiple="multiple">
                      @foreach ($parcel_types as $type)
                        <option value="{{$type}}">{{$type}}</option>
                      @endforeach
                    </select>
                  </div>
  
                  <div class="col-lg-2 col-md-6 col-sm-12 mt-3">
                    <label class="form-label">
                      Quantity
                    </label>
                    <input type="tel" name="number_parcels" id="number_parcels" class="form-control" value="{{$parcel->number_parcels}}"/>
                  </div>
                  <div class="col-lg-3 col-md-6 col-sm-12 mt-3">
                    <label class="form-label">
                      Weight(KG) (OPTIONAL)
                    </label>
                    <input type="text" name="parcel_weight" id="parcel_weight" class="form-control" value="{{$parcel->parcel_weight}}"/>
                  </div>
                  <div class="col-lg-3 col-md-6 col-sm-12 mt-3">
                    <label class="form-label" htmlfor="grid-password">
                      Collection Type
                    </label>
                    <select id="collection_type" name="collection_type" class="form-control" >
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
                    <input class="form-control" list="datalistOptions" id="pickup_location" name="pickup_location" value="{{$parcel->pickup_location}}" placeholder="Type to search...">
                    <datalist id="datalistOptions">
                      @foreach ($locations as $location)
                        <option value="{{$location}}">
                      @endforeach
                    </datalist>
                    {{-- <select id="pickup_location" name="pickup_location" class="form-control">
                      <option value="{{$parcel->pickup_location}}" selected>{{$parcel->pickup_location}}</option>
                      @foreach ($locations as $location)
                        <option value="{{$location->location_name}}">{{$location->location_name}}</option>
                      @endforeach
                    </select>  --}}
                  </div>
                  <div class="col-lg-4 col-md-6 col-sm-12 mt-3 col-landmark">
                    <label class="form-label" htmlfor="grid-password">
                      Landmark
                    </label>
                    <input type="text" name="landmark" id="landmark" class="form-control" value="{{$parcel->landmark}}"/>
                  </div>
                  <div class="col-lg-4 col-md-6 col-sm-12 mt-3 col-delivery-fee">
                    <label class="form-label">
                      Company Delivery Fee
                    </label>
                    <input type="tel" name="delivery_fee" id="delivery_fee" class="form-control" value="{{$parcel->delivery_fee}}"/>
                  </div>
                </div>
                <div class='row' style="margin-bottom: 20px;">
                  <div class="col-lg-3 col-md-6 col-sm-12 mt-3">
                    <label class="form-label">
                      Parcel Fee
                    </label>
                    <input type="tel" name="parcel_fee" id="parcel_fee" class="form-control" value="{{$parcel->parcel_fee}}"/>
                  </div>
                  <div class="col-lg-3 col-md-6 col-sm-12 mt-3">
                    <label class="form-label" htmlfor="grid-password">
                      Payment Status
                    </label>
                    <select id="payment_status" name="payment_status" class="form-control" >
                      <option value="{{$parcel->payment_status}}" selected>{{$parcel->payment_status}}</option>
                      <option value="Paid">Paid</option>
                      <option value="Not-Paid">Not-Paid</option>
                      <option value="Paid-For">Paid For</option>
                      <option value="Refunded">Refunded</option>
                    </select> 
                  </div>
                  <div class="col-lg-3 col-md-6 col-sm-12 mt-3">
                    <label class="form-label" htmlfor="grid-password">
                      Assigned Bus
                    </label>
                    <input class="form-control" list="busOptions" id="bus_number" name="bus_number" value="{{$parcel->bus_number}}" placeholder="Type to search...">
                    <datalist id="busOptions">
                       @foreach ($buses as $bus)
                        <option value="{{$bus}}">
                      @endforeach
                    </datalist>
                  </div>
                  <div class="col-lg-3 col-md-6 col-sm-12 mt-3">
                    <label class="form-label" htmlfor="grid-password">
                      Delivery Status
                    </label>
                    <select id="delivery_status" name="delivery_status" class="form-control" >
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

<!-- github button -->
<script async defer src="https://buttons.github.io/buttons.js"></script>
<!-- main script file  -->
<script src="/assets_2/js/soft-ui-dashboard-tailwind.js?v=1.0.4" async></script>
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

    $(document).ready(function() {
      $('.js-example-basic-multiple').select2();
    });
</script>