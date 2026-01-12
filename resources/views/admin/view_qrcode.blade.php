
   <body class="m-0 font-sans antialiased font-normal text-base leading-default bg-gray-50 text-slate-500">
  
    <div class="flex flex-wrap -mx-3">
      <div class="flex-none w-full max-w-full px-3">
        <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
          <!--Add Parcel form-->
          <div class="flex-auto p-6">
          <!--Back button-->
          <div class="row">
              <div class='col' style="display: block; margin-left: auto; margin-right: auto; width: 40%;">
                <div class="visible-print text-center">
                  {!! QrCode::size(500)->generate(url("/parcel_receipt/{$parcel->parcel_id}")); !!}
                  <br>
              </div>
              <p>{{$parcel->tracking_code}} - {{$parcel->collection_type}}</p>
            </div>
          </div>
          </div>
        </div>
      </div>
    </div>

</body>
</html>