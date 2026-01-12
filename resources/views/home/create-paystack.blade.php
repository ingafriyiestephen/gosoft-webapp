<?php
$cnt_bkns = count($trips) + 1;
$avail_seats = count($trips);
?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.css">
@include('layouts.home-pay-head')
   <!-- body -->
   <body class="main-layout text-bg-light p-3">
      <section >
          <!-- MultiStep Form -->
        <div class="container-fluid" id="grad1">
          <div class="row justify-content-center mt-0">
              <div class="col-11 col-sm-9 col-md-7 col-lg-6 text-center p-0 mt-3 mb-2">
                  <div class="card px-0 pt-4 pb-0 mt-3 mb-3">
                      <h2><strong>Booking Information</strong></h2>
                      <p>Fill all form field to go to next step</p>
                      <div class="row">
                          <div class="col-md-12 mx-0">
                              <form id="paymentForm" role="form" onsubmit="" action="{{ url("/store_booking") }}" method="POST">
                                @csrf
                                <input type="text" id="trip_id" name="trip_id" value="{{$trip->trip_id}}"  hidden/>
                                <input type="text" id="booking_code" name="booking_code" value="{{$trip->trip_name}}-{{$trip->trip_id}}-{{$cnt_bkns}}" hidden/>
                                <input type="text" id="booking_seat" name="booking_seat" value="" hidden/>
                                <input type="text" id="booking_fare" name="booking_fare" value="{{$trip->fare}}" hidden/>
                                <input type="text" id="bus_number" name="bus_number" value="{{$trip->bus_number}}" hidden/>
                                  <!-- progressbar -->
                                  <ul id="progressbar">
                                      <li class="active" id="account"><strong>Account</strong></li>
                                      <li id="personal"><strong>Personal</strong></li>
                                      <li id="payment"><strong>Payment</strong></li>
                                      <li id="confirm"><strong>Finish</strong></li>
                                  </ul>
                                  <!-- fieldsets -->
                                  <fieldset>
                                      <div class="form-card">
                                          <h2 class="fs-title">Account Information</h2>
                                          <label>Name*</label>
                                          <input type="text" name="name" value="{{$user_name}}" required/>
                                          <label>Email*</label>
                                          <input type="email" name="email" id="email" value="{{$user_email}}" required/>
                                          <label>Phone*</label>
                                          <input type="tel" id="phone" name="phone" maxlength="10" value="{{$user_phone}}"/>                        
                                      </div>
                                      <input type="button" name="next" class="next action-button" value="Next Step"/>
                                  </fieldset>
                                  <fieldset>
                                      <div class="form-card">
                                          <h2 class="fs-title">Personal Information</h2>
                                          <label>Next of Kin/Contact Person Number*</label>
                                          <input type="tel" name="contact_person" id="contact_person" maxlength="10"/>
                                          <label>Number of Passengers*</label>
                                          <input type="tel" name="number_passengers" id="number_passengers" value="1" required/>

                                          <div class="row">
                                            <div class="col">
                                              <label>No. of Children (0-5yrs)</label>
                                              <select id="number_children" name="number_children" class="form-control">
                                                <option value="0" selected>0</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                              </select>
                                            </div>
                                          </div>
                                          <br>
                                          <div class="row">
                                            <div class="col">
                                              <label>Luggage (over 10kg)</label>
                                              <select id="luggage_over" name="luggage_over" class="form-control">
                                                <option value="Yes">Yes</option>
                                                <option value="No" selected>No</option>
                                              </select>
                                            </div>
                                          </div>
                                          <br>
                                      </div>
                                      <input type="button" name="previous" class="previous action-button-previous" value="Previous"/>
                                      <input type="button" name="next" onclick="bill_calc()" class="next action-button" value="Next Step"/>
                                  </fieldset>
                                  <fieldset>
                                      <div class="form-card">
                                          <h2 class="fs-title">Payment Information</h2>
                                           <img src="https://portmoni.com/wp-content/uploads/2018/02/payment-methods-mtn-airtel-tigo-visa-mastercard.png"/>
                                            <br>
                                          <label class="pay">Name*</label>
                                          <input type="text" id="payer_name" name="payer_name" value="{{$user_name}}" required/>
                                          <label class="pay">Amount*</label>
                                          <input type="tel" id='fare' value="{{$trip_amount->fare}}" hidden/>
                                          <input type="tel" id="amount" name="amount" value="" required/>
                                          <script>
                                            function bill_calc(){
                                              // alert('Hello');
                                              var momo_pay =   document.getElementById('number_passengers').value * document.getElementById('fare').value;
                                              document.getElementById('amount').value = momo_pay;
                                            }
                                          </script>
                                          
                                          <label class="pay">Mobile Money Number*</label>
                                          <input type="text" id="momo_number" minlength="10" maxlength="10" name="momo_number" title="Invalid number" minlength="10" maxlength="10" value="{{$user_phone}}" required/>
                                      </div>
                                      <input type="button" name="previous" class="previous action-button-previous" value="Previous"/>
                                      <input type="submit" class="action-button" style="background-color:#008000;" value="Book"/>
                                      <script src="https://js.paystack.co/v1/inline.js"></script> 
                                      <script>                                    
                                          const paymentForm = document.getElementById('paymentForm');
                                          paymentForm.addEventListener("submit", payWithPaystack, false);
                                          function payWithPaystack(e) {
                                          e.preventDefault();
                                          if (document.getElementById('phone').value == "") {
                                                swal({
                                                    title: "Phone number cannot be empty.",
                                                    text: "Please provide a phone number.",
                                                    icon: "warning",
                                                    button: "Ok",
                                                })
                                            }
                                            
                                            else if(document.getElementById('contact_person').value == ""){
                                              swal({
                                                title: "Next of Kin/Contact Person number cannot be empty.",
                                                    text: "Please provide a valid number.",
                                                    icon: "warning",
                                                    button: "Ok",
                                                })
                                            }

                                            else if(document.getElementById('momo_number').value == ""){
                                              swal({
                                                title: "Mobile Money number cannot be empty.",
                                                    text: "Please provide a valid number.",
                                                    icon: "warning",
                                                    button: "Ok",
                                                })
                                            }
                                            
                                            else{
                                              let handler = PaystackPop.setup({
                                            key: 'pk_test_20ef68f4f6fcfd612472d79d36d2c4f461a30b4c', // Replace with your public key
                                            email: document.getElementById("email").value,
                                            amount: document.getElementById("amount").value * 100,
                                            currency: "GHS",
                                            ref: ''+Math.floor((Math.random() * 1000000000) + 1), // generates a pseudo-unique reference. Please replace with a reference you generated. Or remove the line entirely so our API will generate one for you
                                            // label: "Optional string that replaces customer email"
                                            onClose: function(){
                                              console.log('payment cancelled')
                                            },
                                            callback: function(response){
                                                // alert(response.reference);
                                                document.getElementById("pay_ref").value = response.reference;
                                                document.getElementById("ref_span").innerHTML = response.reference;
                                                document.getElementById('paymentForm').submit();

                                            }
                                          });
                                      
                                          handler.openIframe();
                                            }

                                          }
                                          
                                      </script>
                                  </fieldset>
                                  <fieldset>
                                      <div class="form-card">
                                          <h2 class="fs-title text-center">Booking Complete !</h2>
                                          <br><br>
                                          <div class="row justify-content-center">
                                              <div class="col-3">
                                                  <img src="https://img.icons8.com/color/96/000000/ok--v2.png" class="fit-image">
                                              </div>
                                          </div>
                                          <br><br>
                                          <div class="row justify-content-center">
                                              <div class="col-7 text-center">
                                                  <h5>Reference: <span id="ref_span" style="font-weight: bold;">No Reference</span></h5>
                                                  <input id="pay_ref" name="pay_ref" value="No Reference" hidden/>
                                              </div>
                                          </div>
                                      </div>
                                  </fieldset>
                              </form>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
        </div>
        <!-- end our blog -->
      </section>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
    <script>
        if(document.getElementById('seat_0').value == "true"){
          document.getElementById('seat_0').disabled = true;
        }
        if(document.getElementById('seat_1').value == "true"){
          document.getElementById('seat_1').disabled = true;
        }
        if(document.getElementById('seat_2').value == "true"){
          document.getElementById('seat_2').disabled = true;
        }
        if(document.getElementById('seat_3').value == "true"){
          document.getElementById('seat_3').disabled = true;
        }
        if(document.getElementById('seat_4').value == "true"){
          document.getElementById('seat_4').disabled = true;
        }
        if(document.getElementById('seat_5').value == "true"){
          document.getElementById('seat_5').disabled = true;
        }
        if(document.getElementById('seat_6').value == "true"){
          document.getElementById('seat_6').disabled = true;
        }
        if(document.getElementById('seat_7').value == "true"){
          document.getElementById('seat_7').disabled = true;
        }
        if(document.getElementById('seat_8').value == "true"){
          document.getElementById('seat_8').disabled = true;
        }
        if(document.getElementById('seat_9').value == "true"){
          document.getElementById('seat_9').disabled = true;
        }
        if(document.getElementById('seat_10').value == "true"){
          document.getElementById('seat_10').disabled = true;
        }
        
        

      var elem = document.getElementsByClassName('selected_seat');
      for(var i=0; i<elem.length; i++)
      {
        elem[i].addEventListener('click', function(){
          document.getElementById('seat_number').innerHTML = this.value;
          document.getElementById('booking_seat').value = document.getElementById('trip_id').value + "-" + this.value;
        })
      } 

      function handleClick(cb) {
        // display(cb.checked);
        document.getElementById('seat_number').innerHTML = cb.checked;
      }    
      
      document.getElementById('pay_later').addEventListener("click", function() {
    // use 'that' instead of 'this'
        alert('hello');
    });
      </script>
    <script>
      $(document).ready(function(){
    
    var current_fs, next_fs, previous_fs; //fieldsets
    var opacity;
    
    $(".next").click(function(){
        
        current_fs = $(this).parent();
        next_fs = $(this).parent().next();
        
        //Add Class Active
        $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");
        
        //show the next fieldset
        next_fs.show(); 
        //hide the current fieldset with style
        current_fs.animate({opacity: 0}, {
            step: function(now) {
                // for making fielset appear animation
                opacity = 1 - now;
    
                current_fs.css({
                    'display': 'none',
                    'position': 'relative'
                });
                next_fs.css({'opacity': opacity});
            }, 
            duration: 600
        });
    });
    
    $(".previous").click(function(){
        
        current_fs = $(this).parent();
        previous_fs = $(this).parent().prev();
        
        //Remove class active
        $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");
        
        //show the previous fieldset
        previous_fs.show();
    
        //hide the current fieldset with style
        current_fs.animate({opacity: 0}, {
            step: function(now) {
                // for making fielset appear animation
                opacity = 1 - now;
    
                current_fs.css({
                    'display': 'none',
                    'position': 'relative'
                });
                previous_fs.css({'opacity': opacity});
            }, 
            duration: 600
        });
    });
    
    $('.radio-group .radio').click(function(){
        $(this).parent().find('.radio').removeClass('selected');
        $(this).addClass('selected');
    });
    
    $(".submit").click(function(){
        return false;
    })
        
    });

    </script>
</html>

