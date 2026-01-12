<x-app-layout>
  @include('layouts.head')
  <style>
    @import url("https://fonts.googleapis.com/css2?family=Poppins:weight@100;200;300;400;500;600;700;800&display=swap");


body{
 background-color:#eee;
 font-family: "Poppins", sans-serif;
 font-weight: 300;
}

.height{
 height: 100vh;
}


.search{
position: relative;
box-shadow: 0 0 40px rgba(51, 51, 51, .1);
  
}

.search input{

 height: 60px;
 text-indent: 25px;
 border: 2px solid #d6d4d4;


}


.search input:focus{

 box-shadow: none;
 border: 2px solid blue;


}

.search .fa-search{

 position: absolute;
 top: 20px;
 left: 16px;

}

.search button{

 position: absolute;
 top: 5px;
 right: 5px;
 height: 50px;
 width: 110px;
 background: blue;

}
  </style>
   <body class="m-0 font-sans antialiased font-normal text-base leading-default bg-gray-50 text-slate-500">
   @include('layouts.sidenav')
   

  <div class="w-full px-6 py-6 mx-auto">
    <!-- table 1 -->

    <div class="container">

      <div class="row height d-flex justify-content-center align-items-center">

        <div class="col-md-8">
        {{-- Search the details of a user for booking --}}
        <form role="form" action="{{ url("/search_booking_user") }}" method="POST">
          @csrf
          <div class="search">
            <select id="phone" name="phone" required>
              <option selected disabled>Select/Search Phone</option>
              @foreach ($users as $user)
                <option value="{{$user->phone}}">{{$user->phone}}</option>
              @endforeach
            </select> 
        </div>
        <div class='row'>
          <div class="col">
          </div>
          <div class="col">
            <button type="submit" class="btn btn-success" style="margin-top: 20px; width: 300px;">Find User</button>
          </div>
          <div class="col">
          </div>
       </div>
       <form>
      </div>
  </div>


    <!-- card 2 -->

</body>
<!-- plugin for charts  -->
<script src="http://127.0.0.1:8000/assets/js/plugins/chartjs.min.js" async></script>
<!-- plugin for scrollbar  -->
<script src="http://127.0.0.1:8000/assets/js/plugins/perfect-scrollbar.min.js" async></script>
<!-- github button -->
<script async defer src="https://buttons.github.io/buttons.js"></script>
<!-- main script file  -->
<script src="http://127.0.0.1:8000/assets/js/soft-ui-dashboard-tailwind.js?v=1.0.4" async></script>
</html>
</x-app-layout>