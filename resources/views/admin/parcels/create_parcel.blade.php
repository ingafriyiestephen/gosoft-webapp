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
          </span> Create Parcel
        </h3>
      </div>
 

      <div class="flex flex-wrap -mx-3">
        <div class="flex-none w-full max-w-full px-3">
          <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
            <!--Add Bus form-->
            <div class="flex-auto p-6">
            <!--Back button-->
            <div class="relative w-full mb-3">
              <a href="{{ url("/parcels") }}">
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

              <div class="container">
                <form id="typeForm" name="typeForm" class="form-horizontal">
                  <div class='row' style="margin-bottom: 20px;">
                    <input type="hidden" name="parcel_type_id" id="parcel_type_id">
                    <div class="col-lg-4 col-md-6 col-sm-12 mt-3">
                      <input type="text" name="new_parcel_type" id="_new_parcel_type" placeholder="Enter New Parcel Type" class="form-control" />
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12 mt-3">
                      <button type="submit" class="btn btn-primary button" id="saveBtn" value="create">Save changes
                      </button>
                    </div>
                  </div>
                </form>

                <form role="form" action="{{ url("/store_parcel") }}" method="POST" enctype="multipart/form-data">
                  @csrf

                <div class='row' style="margin-bottom: 20px;">
                  <div class="col-lg-4 col-md-6 col-sm-12 mt-3">
                    <label class="form-label" htmlfor="grid-password">
                      Parcel Type
                    </label>
                    <select class="js-example-basic-multiple form-select" id="parcel_type" name="parcel_type[]" multiple="multiple">
                      @foreach ($parcel_types as $type)
                        <option value="{{$type}}">{{$type}}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
              </div>

                <div class="container">
                  <div class='row' style="margin-bottom: 20px;">
                    <label class="form-label" htmlfor="grid-departure">
                      <h5>Customer Information</h5>
                    </label>
                    <input type="text" name="user_id" id="user_id" class="form-control" value="" hidden />
                    <div class="col-lg-6 col-md-6 col-sm-12 mt-3">
                      <label class="form-label" htmlfor="grid-password">
                        Name
                      </label>
                      <input type="text" name="sender_name" id="sender_name" class="form-control" value=""/>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 mt-3">
                      <label class="form-label" htmlfor="grid-password">
                        Phone
                      </label>
                      <input type="text" name="sender_phone" id="sender_phone" class="form-control"/>
                    </div>
                  </div>
                  <hr><br>

                <div class='row' style="margin-bottom: 20px;">
                  <label class="form-label" htmlfor="grid-departure">
                    <h5>Parcel Information</h5>
                  </label>
                  <div class="col-lg-3 col-md-6 col-sm-12 mt-3">
                    <label class="form-label" htmlfor="grid-password">
                      Receiver Name (*)
                    </label>
                    <input type="text" name="receiver_name" id="receiver_name" class="form-control" required/>
                  </div>
                  <div class="col-lg-3 col-md-6 col-sm-12 mt-3">
                    <label class="form-label" htmlfor="grid-password">
                      Receiver Phone (*)
                    </label>
                    <input type="tel" name="receiver_phone" id="receiver_phone" class="form-control" required/>
                  </div>
                  <div class="col-lg-3 col-md-6 col-sm-12 mt-3">
                    <label class="form-label" htmlfor="grid-password">
                      Sending From (*)
                    </label>
                    <input class="form-control" list="fromLocationOptions" id="from_location" name="from_location" required placeholder="Type to search...">
                    <datalist id="fromLocationOptions">
                      @foreach ($locations as $location)
                        <option value="{{$location}}">
                      @endforeach
                    </datalist>
                  </div>
                  <div class="col-lg-3 col-md-6 col-sm-12 mt-3">
                    <label class="form-label" htmlfor="grid-password">
                      Sending To (*)
                    </label>
                    <input class="form-control" list="toLocationOptions" id="to_location" name="to_location" required placeholder="Type to search...">
                    <datalist id="toLocationOptions">
                      @foreach ($locations as $location)
                        <option value="{{$location}}">
                      @endforeach
                    </datalist>
                  </div>
                </div>
                <div class='row' style="margin-bottom: 20px;">
                  <div class="col-lg-6 col-md-6 col-sm-12 mt-3">
                      <label class="form-label" htmlfor="parcel_image">
                        Parcel Image
                      </label>
                        <input id="parcel_image" type="file" class="form-control" name="parcel_image">
                        <p id="file-result" style="color: #ff0000;"></p>
                  </div>
                  <div class="col-lg-6 col-md-6 col-sm-12 mt-3">
                      <img src="/assets/img/icons8-image-96.png" id="parcel-img-tag" width="200px" />   <!--for preview purpose -->
                  </div>
                </div>
                <div class='row' style="margin-bottom: 20px;">
                  <div class="col-lg-4 col-md-6 col-sm-12 mt-3">
                    <label class="form-label">
                      Quantity
                    </label>
                    <input type="tel" name="number_parcels" id="number_parcels" class="form-control" />
                  </div>
                  <div class="col-lg-4 col-md-6 col-sm-12 mt-3">
                    <label class="form-label">
                      Weight(KG)
                    </label>
                    <input type="text" name="parcel_weight" id="parcel_weight" class="form-control" />
                  </div>
                  <div class="col-lg-4 col-md-6 col-sm-12 mt-3">
                    <label class="form-label" htmlfor="grid-password">
                      Collection Type (*)
                    </label>
                    <select id="collection_type" name="collection_type" class="form-select" required>
                      <option value="" selected disabled>Select Type</option>
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
                    <input class="form-control" list="datalistOptions" id="pickup_location" name="pickup_location" placeholder="Type to search...">
                    <datalist id="datalistOptions">
                      @foreach ($locations as $location)
                        <option value="{{$location}}">
                      @endforeach
                    </datalist>
                  </div>
                  <div class="col-lg-4 col-md-6 col-sm-12 mt-3 col-landmark">
                    <label class="form-label" htmlfor="grid-password">
                      Landmark
                    </label>
                    <input type="text" name="landmark" id="landmark" class="form-control"/>
                  </div>
                  <div class="col-lg-4 col-md-6 col-sm-12 mt-3 col-delivery-fee">
                    <label class="form-label">
                     Company Delivery Fee
                    </label>
                    <input type="tel" name="delivery_fee" id="delivery_fee" class="form-control" value="0.00"/>
                  </div>
                </div>
                <div class='row' style="margin-bottom: 20px;">
                  <div class="col-lg-3 col-md-6 col-sm-12 mt-3">
                    <label class="form-label">
                      Parcel Fee
                    </label>
                    <input type="tel" name="parcel_fee" id="parcel_fee" class="form-control"/>
                  </div>
                  <div class="col-lg-3 col-md-6 col-sm-12 mt-3">
                    <label class="form-label" htmlfor="grid-password">
                      Payment Status (*)
                    </label>
                    <select id="payment_status" name="payment_status" class="form-select" required>
                      <option value="" selected disabled>Select Payment Status</option>
                      <option value="Paid">Paid</option>
                      <option value="Not-Paid">Not-Paid</option>
                      <option value="Paid-For">Paid For</option>
                      <option value="Refunded">Refunded</option>
                    </select> 
                  </div>
                  <div class="col-lg-3 col-md-6 col-sm-12 mt-3">
                    <label class="form-label" htmlfor="grid-password">
                      Assigned Trip (*)
                    </label>
                    <select id="trip_name" name="trip_name" class="form-select" required>
                      <option selected value="">Select</option>
                       @foreach ($trips as $trip)
                        <option value="{{$trip->trip_name}}">{{$trip->trip_name}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="col-lg-3 col-md-6 col-sm-12 mt-3">
                    <label class="form-label" htmlfor="grid-password">
                      Delivery Status (*)
                    </label>
                    <select id="delivery_status" name="delivery_status" class="form-select" required>
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
                  <button id="fileSubmit" type="submit" class="btn btn-success save-button" style="margin-right: 10px;">Save Changes</button>
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
    let fileInput = document.getElementById("parcel_image");
    let fileSubmit = document.getElementById("fileSubmit");
    let fileResult = document.getElementById("file-result");
    fileInput.addEventListener("change", function () {
      if (fileInput.files.length > 0) {
        const fileSize = fileInput.files.item(0).size;
        const fileMb = fileSize / 1024 ** 2;
        if (fileMb >= 20) {
          fileResult.innerHTML = "Please select a file less than 20MB.";
          fileInput.value = "";
          fileSubmit.disabled = true;
          $('#parcel-img-tag').attr('src', "");
        } else {
          readURL(this);
          fileResult.innerHTML = "";
          fileSubmit.disabled = false;
        }
      }
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
            $('.col-delivery-fee').val = 0.00;
        }
    });

    $(document).ready(function() {
      $('.js-example-basic-multiple').select2();
    });
</script>
<script type="text/javascript">
  $(function () {
      
    /*------------------------------------------
     --------------------------------------------
     Pass Header Token
     --------------------------------------------
     --------------------------------------------*/ 
    $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
    });
      
    /*------------------------------------------
    --------------------------------------------
    Create Farmer Code
    --------------------------------------------
    --------------------------------------------*/
    $('#saveBtn').click(function (e) {
        e.preventDefault();
        // $(this).html('Sending..');
      
        $.ajax({
          data: $('#typeForm').serialize(),
          url: "{{ route('parcel_types.store') }}",
          type: "POST",
          dataType: 'json',
          success: function (data) {
       
              $('#typeForm').trigger("reset");
              alert("Parcel Type Added")
              location.reload();
              //$('#ajaxModel').modal('hide');
           
          },
          error: function (data) {
              console.log('Error:', data);
              $('#saveBtn').html('Save Changes');
          }
      });
    });
      

       
  });
</script>

