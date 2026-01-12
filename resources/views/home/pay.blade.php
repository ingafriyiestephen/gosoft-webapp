<x-app-layout>
@include('layouts.home-head')

<nav class="navbar navbar-expand-custom navbar-mainbg">
   <div class="navbar-contact"><i class="fa fa-phone"></i> <span> 0544784957</span><i class="fa fa-envelope ml-5"></i><span> travel@sofrimpongtransport.com</span></div>
   <button class="navbar-toggler" type="button" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
   <i class="fas fa-bars text-white"></i>
   </button>
   <div class="collapse navbar-collapse" id="navbarSupportedContent">
       <ul class="navbar-nav ml-auto">
           <div class="hori-selector"><div class="left"></div><div class="right"></div></div>
           <li class="nav-item active">
               <a class="nav-link" href="javascript:void(0);"><i class="fa fa-home"></i>Home</a>
           </li>
           <li class="nav-item">
               <a class="nav-link" href="{{url('/hires/create')}}"><i class="fa fa-bus"></i>Hire Bus</a>
           </li>
           <li class="nav-item">
            <a class="nav-link" href="{{url('/my_bookings')}}"><i class="far fa-clone"></i>Bookings</a>
        </li>
       </ul>
   </div>
 </nav>
    <!-- body -->
    <body class="main-layout text-bg-light p-3">
     <div  class="pageLoader" id="pageLoader"></div>
     <section >
      <!--main content-->
         <div class="row justify-content-center" style="margin-top: 100px;">
         <div class="col-lg-4 col-md-4 col-sm-6">
         </div>
         <div class="col-lg-4 col-md-4 col-sm-6">

                  <form id="paymentForm" role="form" onsubmit="" action="{{ url("/pay_booking") }}" method="POST">
                    @csrf
                    <input type="text" id="booking_code" name="booking_code" value="{{$booking_code}}"
                    hidden />
                    <input type="text" id="pay_ref" name="pay_ref" value=""
                    hidden />
                    <input type="text" id="amount" name="amount" value="{{$booking_amount}}"
                    hidden />

                    <button id="pay-stack" type="button" class="btn btn-success d-block btn-block mb-3">
                        PAY GHS {{$booking_amount}} NOW <span class="ms-3 fas fa-arrow-right"></span>
                        </button><br/>

                  </form>

                  <a href="{{url('/')}}">
                  <button type="button" class="btn btn-primary d-block btn-block mb-3" onClick="window.location.reload();">
                     PAY GHS {{$booking_amount}} LATER <span class="ms-3 fas fa-arrow-right"></span>
                     </button>
                  </a>
                

            <script src="https://js.paystack.co/v1/inline.js"></script> 
            <script>                               
                  const paymentForm = document.getElementById('paymentForm');
                  const paymentOnline = document.getElementById('pay-stack');

                  paymentOnline.addEventListener("click", payWithPaystack, false);
                  function payWithPaystack(e) {
                  if($('#pass_name').val = ''){
                  alert('Passenger name cannot be null');
                  }else{
                  e.preventDefault(); 
                  let handler = PaystackPop.setup({
                  key: 'pk_test_20ef68f4f6fcfd612472d79d36d2c4f461a30b4c', // Replace with your public key
                  email: 'booking@sofrimpongtransport.com',
                  amount: document.getElementById("amount").value * 100,
                  currency: "GHS",
                  ref: ''+Math.floor((Math.random() * 1000000000) + 1), // generates a pseudo-unique reference. Please replace with a reference you generated. Or remove the line entirely so our API will generate one for you
                  // label: "Optional string that replaces customer email"
                  onClose: function(){
                     console.log('payment cancelled')
                  },
                  callback: function(response){
                        $("#pay_ref").val(response.reference);
                        document.getElementById('paymentForm').submit();

                  }
                  });
                  handler.openIframe();
                  }

                  }
                  function payWithAgent(e) {
                  e.preventDefault(); 
                  document.getElementById('paymentForm').submit();
                  }
                  
            </script>
         </div>
         <div class="col-lg-4 col-md-4 col-sm-6">
         </div>
     </div>




    </section>
    <script src="https://js.paystack.co/v1/inline.js"></script> 
    <script>
      window.onload = function() {
        $('#pageLoader').hide();
      };
    </script>
    </html>
</x-app-layout>