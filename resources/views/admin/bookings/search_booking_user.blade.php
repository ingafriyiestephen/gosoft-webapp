<x-app-layout>
  @include('layouts.head')
   <body class="m-0 font-sans antialiased font-normal text-base leading-default bg-gray-50 text-slate-500">
   @include('layouts.sidenav')
   @include('layouts.mobile-nav')
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
              <button class="btn btn-secondary" onclick="history.back()"><i class="fas fa-arrow-left"></i> Back</button>
          </div>
            @if (session('message'))
            <div class="alert alert-success w-1/2 max-w-full px-12">
                    {{ session('message') }}
                </div>
            @endif
            {{-- Search the details of a user for booking --}}
            <form role="form" action="{{ url("/search_booking_user") }}" method="POST">
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
            </form>
            <form role="form" action="{{ url("/store_user_booking") }}" method="POST">
              @csrf
              <div class="row">
                <div class='row' style="margin-bottom: 20px;">
                  <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2" htmlfor="grid-departure">
                    <b>User Information</b>
                  </label>
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
                      <option selected>{{$user->location}}</option>
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
                    <select id="id_type" name="id_type" class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow">
                      <option selected>{{$user->id_type}}</option>
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
              <hr>
              <div class='row' style="margin-bottom: 20px;">
                <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2" htmlfor="grid-departure">
                  <b>Trip Information</b>
                </label>
                <div class="col">
                  <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2" htmlfor="grid-password">
                    Contact Person Number*
                  </label>
                  <input type="tel" name="contact_person" id="contact_person" class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow" value=""/>
                </div>
                <div class="col">
                  <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2" htmlfor="grid-password">
                    Number of Passengers*
                  </label>
                  <input type="tel" name="number_passengers" id="number_passengers" class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow" contenteditable="false" value="1"/>
                </div>
                <div class="col">
                  <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2" htmlfor="grid-password">
                    No. of Children (0-5yrs)
                  </label>
                  <select id="number_children" name="number_children" class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow">
                      <option value="0" selected>0</option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                    </select>
                </div>
                <div class="col">
                  <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2" htmlfor="grid-password">
                    Luggage (over 10kg)
                  </label>
                  <select id="luggage_over" name="luggage_over" class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow">
                    <option value="Yes">Yes</option>
                    <option value="No" selected>No</option>
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
</html>
</x-app-layout>