<x-app-layout>
  @include('layouts.head')
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
   <body class="m-0 font-sans antialiased font-normal text-base leading-default bg-gray-50 text-slate-500">
   @include('layouts.sidenav')
   
  <div class="container-fluid">

    <main>
      <div class="container-fluid px-4">
          <ol class="breadcrumb mb-4">
              <li class="breadcrumb-item active">Dashboard</li>
          </ol>
          <div class="row">
            <div class="row">
            <div class="col-md-3 col-sm-4">
              <a href="{{url('/users')}}" style="text-decoration: none; color: inherit;">
               <div class="wrimagecard wrimagecard-topimage">
                    <div class="wrimagecard-topimage_header" style="background-color:rgba(187, 120, 36, 0.1) ">
                      <center><i class="fa leading-none fa-user" style="color:#BB7824"></i></center>
                    </div>
                    <div class="wrimagecard-topimage_title">
                      <h4>All Users&nbsp;&nbsp;&nbsp;<span class="pull-right badge badge-secondary">{{$users}}</span></h4>
                    </div>
                </div>
              </a>
              </div>
              <div class="col-md-3 col-sm-4">
                <a href="#sessions" style="text-decoration: none; color: inherit;">
                <div class="wrimagecard wrimagecard-topimage">
                        <div class="wrimagecard-topimage_header" style="background-color:rgba(162, 36, 187, 0.1) ">
                          <center><i class="fa leading-none fa-users" style="color:#bb2489"></i></center>
                        </div>
                        <div class="wrimagecard-topimage_title">
                          <h4>Sessions&nbsp;&nbsp;&nbsp;<span class="pull-right badge badge-danger">{{$session_count}}</span></h4>
                        </div>
                  </div>
                </a>
              </div>
              <div class="col-md-3 col-sm-4">
                <a href="{{url('/locations')}}" style="text-decoration: none; color: inherit;">
                <div class="wrimagecard wrimagecard-topimage">
                    <div class="wrimagecard-topimage_header" style="background-color: rgba(22, 160, 133, 0.1)">
                      <center><i class = "fa leading-none fa-globe" style="color:#16A085"></i></center>
                    </div>
                    <div class="wrimagecard-topimage_title">
                      <h4>Locations&nbsp;&nbsp;&nbsp;<span class="pull-right badge badge-success">{{$locations}}</span></h4>
                    </div>
                </div>
                </a>
              </div>
              <div class="col-md-3 col-sm-4">
              <a href="{{url('/buses')}}" style="text-decoration: none; color: inherit;">
                <div class="wrimagecard wrimagecard-topimage">
                    <div class="wrimagecard-topimage_header" style="background-color:  rgba(213, 15, 37, 0.1)">
                      <center><i class="fa leading-none fa-bus" style="color:#d50f25"> </i></center>
                    </div>
                    <div class="wrimagecard-topimage_title" >
                      <h4>Buses&nbsp;&nbsp;&nbsp;<span class="pull-right badge badge-danger">{{$buses}}</span></h4>
                    </div>
                </div>
                </a>
            </div>
            <div class="col-md-3 col-sm-4">
              <a href="{{url('/drivers')}}" style="text-decoration: none; color: inherit;">
                <div class="wrimagecard wrimagecard-topimage">
                    <div class="wrimagecard-topimage_header" style="background-color:  rgba(51, 105, 232, 0.1)">
                       <center><i class="fa leading-none fa-drivers-license-o" style="color:#3369e8"> </i></center>
                    </div>
                    <div class="wrimagecard-topimage_title">
                      <h4>Drivers&nbsp;&nbsp;&nbsp;<span class="pull-right badge badge-primary">{{$drivers}}</span></h4>
                    </div>
                </div>
              </a>
            </div>
            <div class="col-md-3 col-sm-4">
              <a href="{{url('/trips')}}" style="text-decoration: none; color: inherit;">
                <div class="wrimagecard wrimagecard-topimage">
                    <div class="wrimagecard-topimage_header" style="background-color:  rgba(250, 188, 9, 0.1)">
                       <center><i class="fa leading-none fa-road" style="color:#fabc09"> </i></center>
                    </div>
                    <div class="wrimagecard-topimage_title">
                      <h4>Trips&nbsp;&nbsp;&nbsp;<span class="pull-right badge badge-warning">{{$trips}}</span></h4>
                    </div>
                </div>
              </a>
            </div>
            <div class="col-md-3 col-sm-4">
              <a href="{{url('/admin_bookings')}}" style="text-decoration: none; color: inherit;">
                <div class="wrimagecard wrimagecard-topimage">
                      <div class="wrimagecard-topimage_header" style="background-color: rgba(121, 90, 71, 0.1)">
                     <center><i class="fa leading-none fa-book" style="color:#795a47"> </i></center> 
                    </div>
                    <div class="wrimagecard-topimage_title" style="text-decoration: none;">
                      <h4>Bookings&nbsp;&nbsp;&nbsp;<span class="pull-right badge badge-secondary">{{$bookings}}</span></h4>
                    </div>
                </div>
              </a>
            </div>
            <div class="col-md-3 col-sm-4">
                <div class="wrimagecard wrimagecard-topimage">
                    <a href="{{url('/parcels')}}">
                   <div class="wrimagecard-topimage_header" style="background-color: rgba(130, 93, 9, 0.1)">
                      <center><i class="fa fa-gift" style="color:#825d09"></i></center>
                    </div>
                    <div class="wrimagecard-topimage_title" style="text-decoration: none;">
                      <h4>Parcels&nbsp;&nbsp;&nbsp;<span class="pull-right badge badge-secondary">{{$parcels}}</span></h4>
                    </div>
                  </a>
                </div>
            </div>
          </div>
          </div>
          <div id="sessions" class="card mb-4">
              <div class="card-header">
                  <i class="fas fa-users me-1"></i>
                  User Sessions
              </div>
              <div class="card-body">
                <table id="dataTable" class="display no-wrap" style="width: 100%;">
                      <thead>
                          <tr>
                              <th>ID</th>
                              <th>Name</th>
                              <th>Email</th>
                              <th>IP Address</th>
                              <th>User Agent</th>
                              <th>Last Activity</th>
                          </tr>
                      </thead>
                      <tfoot>
                          <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>IP Address</th>
                            <th>User Agent</th>
                            <th>Last Activity</th>
                        </tr>
                      </tfoot>
                      <tbody>
                         @foreach ($sessions as $user)
                          <tr>
                            <td>{{$user->id}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->ip_address}}</td>
                            <td>{{$user->user_agent}}</td>
                            <td>{{$user->last_activity}}</td>
                        </tr>
                          @endforeach
                      </tbody>
                  </table>
              </div>
          </div>
      </div>
  </main>

  </div>

  @include('layouts.script')
  </body>
  </html>
  </x-app-layout>
