<x-app-layout>
@include('layouts.home-head')
<style>
  .card-0 {
    min-height: 110vh;
    background: linear-gradient(-20deg, rgb(255, 255, 255) 50%, #F02800 50%);
    color: white;
    border: 0px;
}

p {
    font-size: 15px;
    line-height: 25px !important;
    font-weight: 500;


}

.container {
    padding-top: 100px !important;
    border-radius: 20px;
}



.btn {
    letter-spacing: 1px;
}

select:active{
    box-shadow: none !important;
    outline-width: 0 !important;

}
select:after{
    box-shadow: none !important;
    outline-width: 0 !important;

}
input,
textarea {
    padding: 10px 12px 10px 12px;
    border: 1px solid lightgrey;
    border-radius: 0px !important;
    margin-bottom: 5px;
    margin-top: 2px;
    width: 100%;
    box-sizing: border-box;
    color: #2C3E50;
    font-size: 14px;
    letter-spacing: 1px;
    resize: none;

}

select:focus,
input:focus {
    box-shadow: none !important;
    border: 1px solid #2196F3 !important;
    outline-width: 0 !important;
    font-weight: 400
}

label {
    margin-bottom: 2px;
    font-weight: bolder;
    font-size: 14px;
}

input:focus,
textarea:focus {
    -moz-box-shadow: none !important;
    -webkit-box-shadow: none !important;
    box-shadow: none !important;
    border: 1px solid #304FFE;
    outline-width: 0
}

button:focus {
    -moz-box-shadow: none !important;
    -webkit-box-shadow: none !important;
    box-shadow: none !important;
    outline-width: 0
}

.form-control {
    height: calc(2em + .75rem + 3px);
}

.inner-card {
    margin: 79px 0px 70px 0px;
}

.card-0 {
    margin-top: 100px;
    margin-bottom: 100px;
}

.card-1 {
    border-radius: 17px;
    color: black;
    box-shadow: 2px 4px 15px 0px rgb(0, 0, 0 , 0.5) !important;
}

#file {
    border: 2px dashed #92b0b3 !important;

}

.color input {
    background-color: #f1f1f1;
}

.files:before {
    position: absolute;
    bottom: 60px;
    left: 0;
    width: 100%;
    content: attr(data-before);
    color: #000;
    font-size: 12px;
    font-weight: 600;
    text-align: center;
}


#file {
    display: inline-block;
    width: 100%;
    padding: 95px 0 0 100%;
    background: url('https://i.imgur.com/VXWKoBD.png') top center no-repeat #fff;
    background-size: 55px 55px;
}

</style>
   <!-- body -->
   <body class="main-layout text-bg-light p-3">
    <div  class="pageLoader" id="pageLoader"></div>
      <section >
         <!--main content-->
            <div class="row justify-content-center">
                    <div class="card p-3 text-bg-light">
                      <div class="container card-0 justify-content-center ">
                        <div class="card-body px-sm-4 px-0">
                            <div class="row justify-content-center mb-5">
                                <div class="col-md-10 col"><h3 class="font-weight-bold ml-md-0 mx-auto text-center text-sm-left"> Request a Quote </h3><p class="mt-md-4  ml-md-0 ml-2 text-center text-sm-left"> This is a regular customer request to the company. Bus hire requests include funeral, religious programmes, wedding functions and other activities. Customers’ requests are for domestic and international destinations . These services range from a day’s trip to a couple of days. Prominent on the corporate bus hire calendar is the annual National Farmers’ celebrations</p></div>
                            </div>
                            <form role="form" name="hire_bus" id="hire_bus" action="{{url('/hires')}}" class="form-card" method="POST">
                              @csrf
                            <div class="row justify-content-center round">
                                <div class="col-lg-10 col-md-12 ">
                                    <div class="card shadow-lg card-1">
                                        <div class="card-body inner-card">
                                            <div class="row justify-content-center">
                                                @if (session('message'))
                                                <div class="alert alert-success w-1/2 max-w-full px-12">
                                                        {{ session('message') }}
                                                    </div>
                                                @endif
                                                <div class="col-lg-5 col-md-6 col-sm-12">
                                                    <div class="form-group"><label for="company_name">Company Name</label><input type="text" class="form-control" name="company_name" placeholder=""> </div>
                                                    <div class="form-group"> <label for="company_phone">Company Phone</label> <input type="text" class="form-control" name="company_phone" placeholder=""> </div>
                                                    <div class="form-group"> <label for="from_location">From Location</label> <input type="text" class="form-control" name="from_location" placeholder="">  </div>
                                                    <div class="form-group"> <label for="number_days">No. of Days</label> <input type="number" class="form-control" name="number_days" placeholder="">  </div>
                                                    <div class="form-group"> <label for="purpose">Purpose</label> <select class="form-control" name="purpose"><option>Event</option><option>Tourism</option> <option>Relisgious/Education</option> <option>Others</option></select> </div>
                                                </div>
                                                <div class="col-lg-5 col-md-6 col-sm-12">
                                                    <div class="form-group"> <label for="company_email">Company Email</label>  <input type="email" class="form-control" name="company_email" placeholder=""> </div>
                                                    <div class="form-group"> <label for="contact_phone">Contact Number</label> <input type="text" class="form-control" name="contact_phone" placeholder=""> </div>
                                                    <div class="form-group"> <label for="to_location">To Location</label> <input type="text" class="form-control" name="to_location" placeholder="">  </div>
                                                    <div class="form-group"> <label for="number_people">No. of People</label> <input type="number" class="form-control" name="number_people" placeholder="">  </div>
                                                    <div class="form-group"> <label for="hire_date">Date</label> <input type="date" class="form-control" name="hire_date" placeholder="">  </div>
                                                </div>
                                            </div>
                                            <div class="row justify-content-center">
                                                <div class="col-md-12 col-lg-10 col-12"><div class="form-group"> <label for="note">Additional Note</label> <textarea class="form-control rounded-0" name="note" rows="3"></textarea></div>
                                                    <div class="row justify-content-end mb-5">
                                                        <div class="col-lg-4 col-auto "><button type="submit" class="btn btn-secondary btn-block"><small class="font-weight-bold">Request a Quote</small></button> </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>
                    </div>                             
            </div>
        <!--/end main content-->
      </section>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
      <script>
        window.onload = function() {
          $('#pageLoader').hide();
        };
        //Block earlier and some later dates
        var today = new Date().toISOString().split('T')[0];
        document.getElementsByName("trip_date")[0].setAttribute('min', today);
        //Ensure that From and To are selected
        function selectLocation() {
              var x = document.getElementById("departure").value;
              var y = document.getElementById("destination").value;
              if (x==="location_from"){
                  swal({
                      title: "Please select a departure point",
                      icon: "warning",
                      button: "Ok",
                  })
              }else if (y==="location_to"){
                swal({
                      title: "Please select a destination point",
                      icon: "warning",
                      button: "Ok",
                  })
              }
            }

            function getSelectValue(departure) {
              if(departure != ' '){
                  $("#destination option[value='"+departure+"']").hide();
                  $("#destination option[value!='"+departure+"']").show();

              }
            };
      </script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
  @include('layouts.home-footer')
</html>
</x-app-layout>

