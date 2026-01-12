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
          <!--Add Bus form-->
          <div class="flex-auto p-6">
            <!--Back button-->
            <div class="relative w-full mb-3">
              <a href="{{ url("/notifications") }}"> 
                <button class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Back</button>
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
            <form role="form" action="{{ url("/update_notification/{$notification->notification_id}") }}" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="container">
                <div class='row' style="margin-bottom: 20px;">
                  <div class="col-lg-12 col-md-4 col-sm-12 mt-3">
                    <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2" htmlfor="notification_title">
                      Notification Title
                    </label>
                    <input type="text" name="notification_title" id="notification_title" class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow" value="{{$notification->notification_title}}" placeholder="Notification title" required/>
                  </div>
                </div>
                <div class='row' style="margin-bottom: 20px;">
                  <div class="col-lg-12 col-md-4 col-sm-12 mt-3">
                    <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2" htmlfor="notification_body">
                      Notification Body
                    </label>
                    <textarea name="notification_body" id="notification_body" class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow" placeholder="Notification body" required>
                      {{$notification->notification_body}}
                    </textarea>
                  </div>
                </div>
                <div class='row' style="margin-bottom: 20px;">
                  <div class="col-lg-12 col-md-4 col-sm-12 mt-3">
                    <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2" htmlfor="notification_title">
                      Notification Image
                    </label>
                    <input type="file" name="notification_image" id="notification_image" accept="image/png, image/jpeg" class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow"/>
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
</html>
</x-app-layout>