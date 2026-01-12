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
          </span> Parcels
        </h3>
      </div>
 

      <div class="container-fluid">
        <div class="flex-none w-full max-w-full px-3" style="margin-top: 20PX;">
          <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
            @if (session('message'))
            <div class="alert alert-success w-1/2 max-w-full px-12">
                    {{ session('message') }}
                </div>
            @endif
  
            <div class="card mb-4">
              <div class="card-header">
                  <a href="{{ url("/create_parcel") }}">
                  <button type="button" class="btn btn-success btn-sm" style="width: 200px; margin-left: 17px;" >New Parcel</button>
                  </a>
              </div>
              <div class="card-body">
                <table id="dataTable" class="display no-wrap" style="width: 100%;">
                      <thead>
                          <tr>
                            <th></th>
                            <th>Tracking Code</th>
                            <th>Sender/Receiver</th>
                            <th>Route/Bus</th>
                            <th>Parcel/No.</th>
                            <th>Parcel/Delivery Fee</th>
                            <th>Date</th>
                            {{-- <th>Staff</th> --}}
                            <th>Status</th>
                            <th>Action</th>
                          </tr>
                      </thead>
                      <tfoot>
                          <tr>
                            <th></th>
                            <th>Tracking Code</th>
                            <th>Sender/Receiver</th>
                            <th>Route/Bus</th>
                            <th>Parcel/No.</th>
                            <th>Parcel/Delivery Fee</th>
                            <th>Date</th>
                            {{-- <th>Staff</th> --}}
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                      </tfoot>
                      <tbody>
                        @foreach ($parcels as $parcel)
                        {{--Remove the unwanted characters in the parcel type--}}
                        <?php 
                        $str_parcel_type= str_replace('[',"",$parcel->parcel_type);
                        $str_parcel_type= str_replace(']',"",$str_parcel_type);
                        $str_parcel_type= str_replace('"'," ",$str_parcel_type);
                        ?>
                        <tr>
                          <td >
                              <div class="visible-print text-center">
                                <a href="{{url("/parcel/{$parcel->parcel_image}")}}" target="blank">
                                  <img class="img" style="width: 100px;" src="/parcel/{{$parcel->parcel_image}}"/>
                                </a>
                                {{-- <img class="img" style="width: 100px;" src="/signature/{{$parcel->receiver_signature}}"/>
                                <span class="font-semibold leading-tight text-xs text-slate-400">{{$parcel->delivery_staff}}</span> --}}
                            </div>
                          </td>
                          <td>
                            <div class="flex px-2 py-1">
                              <div class="flex flex-col justify-center">
                                <p class="mb-0 leading-tight text-xs text-slate-400">{{$parcel->tracking_code}}</p>
                                <hr>
                                <p class="mb-0 leading-tight text-xs text-slate-400">{{$parcel->collection_type}}</p>
                              </td>
                              </div>
                            </div>
                          </td>
                          <td>
                            <p class="mb-0 font-semibold leading-tight text-xs">{{$parcel->sender_name}}</p>
                            <p class="mb-0 leading-tight text-xs text-slate-400">{{$parcel->sender_phone}}</p>
                            <hr>
                            <p class="mb-0 font-semibold leading-tight text-xs">{{$parcel->receiver_name}}</p>
                            <p class="mb-0 leading-tight text-xs text-slate-400">{{$parcel->receiver_phone}}</p>
                          </td>
                          <td>
                            <p class="mb-0 leading-tight text-xs">{{$parcel->from_location}} - {{$parcel->to_location}}</p>
                            {{-- <p class="mb-0 leading-tight text-xs text-slate-400">{{$parcel->to_location}}</p> --}}
                            <p class="mb-0 font-semibold leading-tight text-xs">{{$parcel->bus_number}}</p>
                          </td>
                          <td>
                            <p class="mb-0 font-semibold leading-tight text-xs">{{$str_parcel_type}}</p>
                            <p class="mb-0 leading-tight text-xs text-slate-400">{{$parcel->number_parcels}}</p>
                          </td>
                          <td>
                            <p class="mb-0 font-semibold leading-tight text-xs">{{$parcel->delivery_location}}</p>
                            <p class="mb-0 leading-tight text-xs text-slate-400">GHS ₵ {{$parcel->parcel_fee}}/{{$parcel->delivery_fee}}</p>
                            <span class="font-semibold leading-tight text-xs text-slate-400">{{$parcel->payment_status}}</span>
                          </td>
                          <td>
                            <p class="mb-0 font-semibold leading-tight text-xs">{{$parcel->created_at}}</p>
                          </td>
                          {{-- <td>
                            <span class="font-semibold leading-tight text-xs text-slate-400">{{$parcel->staff_name}}</span>
                          </td> --}}
                          <td>
                            <span class="font-semibold leading-tight text-xs text-slate-400">{{$parcel->delivery_status}}</span>
                          </td> 
                          <td >
                            <div class="row">
                  
                                @if($user_role == 0 || $user_role == 1 || $user_role == 3)
                                <a href="{{ url("/edit_parcel/{$parcel->parcel_id}") }}" title="Edit parcel">
                                  <button type="submit" class="btn btn-warning btn-sm" title='Edit' title="Edit parcel"> <i class="bi bi-pencil-square"></i></button>
                                </a>
                                @endif
                              </br>
                                @if($user_role == 0 || $user_role == 1)
                                <form method="POST" action="{{ url("/delete_parcel/{$parcel->parcel_id}") }}">
                                  @csrf
                                  <input name="_method" type="hidden" value="DELETE">
                                  <button type="submit" class="btn btn-danger btn-sm show_confirm" title='Delete' title="Delete parcel"> <i class="bi bi-trash-fill"></i></button>
                                </form>
                                @endif

                              {{-- @if($user_role == 0 || $user_role == 1 || $user_role == 3)
                              <div class="col-lg-3">
                                <a href="{{url("/parcel_receipt/{$parcel->parcel_id}")}}" class="btn btn-sm btn-warning" title="Print receipt">
                                  <i class="bi bi-receipt-cutoff"></i>
                                </a>
                              </div>
                              @endif --}}
                              {{-- <div class="col-lg-3 mr-3 mt-1">
                                @if($user_role == 0 || $user_role == 1 || $user_role == 4)
                                <a href="{{ url("/sign_parcel/{$parcel->parcel_id}") }}" class="btn btn-sm btn-primary">
                                  <i class="bi bi-pen-fill" title="Sign parcel"></i>
                                </a>
                                @endif
                              </div> --}}
                            </div>
                          </td> 
                        </tr>
                          @endforeach
                      </tbody>
                  </table>
              </div>
          </div>
        </div>
 


    </div>
    <!-- content-wrapper ends -->

  </div>
  <!-- main-panel ends -->
<!-- page-body-wrapper ends -->
</div>
@include('layouts.script')



