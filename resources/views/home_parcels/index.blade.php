
@include('layouts.home-head')
<style>
  .btn-outline {
  color: #4fbfa8;
  background-color: #ffffff;
  border-color: #4fbfa8;
  font-weight: bold;
  letter-spacing: 0.05em;
}

.btn-outline {
  color: #4fbfa8;
  background-color: #ffffff;
  border-color: #4fbfa8;
  font-weight: bold;
  border-radius: 0;
}

.btn-outline:hover,
.btn-outline:active,
.btn-outline:focus,
.btn-outline.active {
  background: #4fbfa8;
  color: #ffffff;
  border-color: #4fbfa8;
  
}


.btn-colour-1 {
  color: #fff;
  background-color: #004E64;
  border-color: #004E64;
  font-weight: bold;
  letter-spacing: 0.05em;
  border-radius: 0;
}

.btn-colour-1:hover,
.btn-colour-1:active,
.btn-colour-1:focus,
.btn-colour-1.active {
  /* let's darken #004E64 a bit for hover effect */
  background: #003D4F;
  color: #ffffff;
  border-color: #003D4F;
}
</style>
   <!-- body -->
   <x-app-layout>
   <body class="main-layout text-bg-light p-3">
      <section >
         <!--main content-->
         <div class="container-fluid text-bg-light" style="background: -webkit-linear-gradient(left, #F02800, #FF5757">
            <div class="row justify-content-center">
                <div class="col-12 col-md-12" style="background: -webkit-linear-gradient(left, #F02800, #FF5757">
                    <div class="card p-3 text-bg-light">
                        <div class="row justify-content-center">
                            <div class="col-12">
                                <h2 class="heading text-center">Track Your Parcel</h2>
                            </div>
                        </div>
                        <form role="form" action="{{ url("/search_parcel") }}" class="form-card" method="POST" enctype="multipart/form-data">
                          @csrf
                            <div class="container">
                                    <div class="row">
                                        <div class="col-lg-4 col-sm-12" class="form-control">
                                          <div class="col">
                                            <input type="text" name="phone_number" id="phone_number" class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow" placeholder="Enter Phone Number"/>
                                          </div>
                                        </div>
                                        <div class="col-lg-4 col-sm-12" class="form-control">
                                          <div class="col">
                                            <input type="text" name="tracking_code" id="tracking_code" class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow" placeholder="Enter Tracking Code"/>
                                          </div>
                                        </div>
                                       <div class="col-lg-4 col-sm-12" style="mar">                                   
                                          <button type="submit" class="btn btn-primary" style="background-color:blue; width: 200px; background-image: linear-gradient(to right, rgba(255,0,0,0), rgba(255,0,0,1));">Search</button>
                                       </div>
                                    </div>
                            </div>
                            <div class="row justify-content-center" style="margin-top: 20px;">
                              <div class="header-row" id="header-row" style="padding: 0px;">
                                <!-- container-fluid is the same as container but spans a wider viewport, 
                                  it still has padding though so you need to remove this either by adding 
                                  another class with no padding or inline as I did below -->
                                <div class="container-fluid" style="padding: 0px;">
                                    <div class="row"> 
                                      <!-- You originally has it set up for two columns, remove the second 
                                  column as it is unneeded and set the first to always span all 12 columns 
                                  even when at its smallest (xs). Set the overflow to hidden so no matter 
                                  the height of your image it will never show outside this div-->
                                      <div class="col-xs-12"> 
                                          <a class="navbar-brand logo" href="index.html">
                                      <!-- place your image here -->
                                            <img src="/assets/img/banner.jpg" alt="company logo" style="width: 100%;">
                                          </a> 
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
</x-app-layout>
</html>

