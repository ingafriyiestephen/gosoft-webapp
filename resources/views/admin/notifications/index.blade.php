<x-app-layout>
    @include('layouts.head')
     <body class="m-0 font-sans antialiased font-normal text-base leading-default bg-gray-50 text-slate-500">
     @include('layouts.sidenav')
     @include('layouts.mobile-nav')
     <div class="container-fluid">
          <!-- Modal -->
          <div class="modal fade bd-example-modal-lg" id="modalnotification" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="modalBusTitle">Add New Notification</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                    <!--Add Bus form-->
                    <form role="form" action="{{ url("/store_notification") }}" method="POST" enctype="multipart/form-data">
                      @csrf
                      <div class="container">
                        <div class='row' style="margin-bottom: 20px;">
                          <div class="col-lg-12 col-md-4 col-sm-12 mt-3">
                            <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2" htmlfor="notification_title">
                              Notification Title
                            </label>
                            <input type="text" name="notification_title" id="notification_title" class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow" placeholder="Notification title" required/>
                          </div>
                        </div>
                        <div class='row' style="margin-bottom: 20px;">
                          <div class="col-lg-12 col-md-4 col-sm-12 mt-3">
                            <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2" htmlfor="notification_body">
                              Notification Body
                            </label>
                            <textarea name="notification_body" id="notification_body" class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow" placeholder="Notification body" required></textarea>
                          </div>
                        </div>
                        <div class='row' style="margin-bottom: 20px;">
                          <div class="col-lg-12 col-md-4 col-sm-12 mt-3">
                            <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2" htmlfor="notification_title">
                              Notification Image
                            </label>
                            <input type="file" name="notification_image" id="notification_image" accept="image/png, image/jpeg" class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow" required/>
                          </div>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success">Save</button>
                      </div>
                    </form>
                <!--/Add Bus Form-->
      
              </div>
            </div>
          </div>
          </div>
      
  
      <div class="flex flex-wrap -mx-3">
        <div class="flex-none w-full max-w-full px-3">
          <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
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
                <div class="card mb-4">
                  <div class="card-header">
                    <i class="fa leading-none fas fa-bell me-1"></i>
                    Notifications
                    <button type="button" class="btn btn-success btn-sm" style="width: 200px; margin-left: 17px;"  data-toggle="modal" data-target="#modalnotification">New Notification</button>
                </div>
                  <div class="card-body">
                    <table id="dataTable" class="display no-wrap" style="width: 100%;">
                          <thead>
                              <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Image</th>
                                <th>Body</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                                <th>Action</th>
                              </tr>
                          </thead>
                          <tfoot>
                              <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Image</th>
                                <th>Body</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                                <th>Action</th>
                            </tr>
                          </tfoot>
                          <tbody>
                            @foreach ($notifications as $notification)
                            <tr>
                              <td>
                                <span class="font-semibold leading-tight text-xs text-slate-400">{{$notification->notification_id}}</span>
                              </td>
                              <td>
                                <span class="font-semibold leading-tight text-xs text-slate-400">{{$notification->notification_title}}</span>
                              </td>
                              <td>
                                <span class="font-semibold leading-tight text-xs text-slate-400">
                                  <a href="{{url("/images/notification/{$notification->notification_image}")}}" target="blank">
                                    <img src="images/notification/{{$notification->notification_image}}" style="width: 150px;"/>
                                  </a>
                                </span>
                              </td>
                              <td>
                                <span class="font-semibold leading-tight text-xs text-slate-400">
                                    {{substr($notification->notification_body,0,100)}}...
                                </span>
                              </td>
                              <td>
                                <span class="font-semibold leading-tight text-xs text-slate-400">{{$notification->created_at}}</span>
                              </td>
                              <td>
                                <span class="font-semibold leading-tight text-xs text-slate-400">{{$notification->updated_at}}</span>
                              </td>
                              <td >
                                <a href="{{ url("/edit_notification/{$notification->notification_id}") }}" class="btn btn-sm btn-warning">
                                  <i class="bi bi-pencil-square"></i>
                                </a>
                                <br><br>
                                <form method="POST" action="{{ url("/delete_notification/{$notification->notification_id}") }}">
                                  @csrf
                                  <input name="_method" type="hidden" value="DELETE">
                                  <button type="submit" class="btn btn-danger btn-sm show_confirm"><i class="bi bi-trash-fill"></i></button>
                              </form>
                              </td>             
                              @endforeach
                            </tr>
                          </tbody>
                      </table>
                  </div>
              </div>
              </div>
            </div>
          </div>
        </div>
      </div>
  
      <!-- card 2 -->
  
    </main>
  
  </body>
  @include('layouts.script')
  </html>
  </x-app-layout>