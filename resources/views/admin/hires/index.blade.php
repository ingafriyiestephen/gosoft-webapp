@include('layouts.head')
<!-- partial -->
@include('layouts.sidenav')
  <!-- partial -->
  <div class="main-panel">
    <div class="content-wrapper">
      <div class="page-header">
        <h3 class="page-title">
          <span class="page-title-icon bg-gradient-danger text-white me-2">
            <i class="fa fa-bus"></i>
          </span> Bus Hiring
        </h3>
      </div>
 

      <div class="row">

        <div class="container-fluid">
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
                    <div class="card-body">
                      <table id="dataTable" class="display no-wrap" style="width: 100%;">
                            <thead>
                                <tr>
                                  <th >ID</th>
                                  <th >Company Deatails</th>
                                  <th >Contact Phone</th>
                                  <th >From - To</th>
                                  <th >Purpose</th>
                                  <th >No. of Days/People</th>
                                  <th >Date</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                  <th >ID</th>
                                  <th >Company Deatails</th>
                                  <th >Contact Phone</th>
                                  <th >From - To</th>
                                  <th >Purpose</th>
                                  <th >No. of Days/People</th>
                                  <th >Date</th>
                              </tr>
                            </tfoot>
                            <tbody>
                              @foreach ($data as $bus)
                              <tr>
                                <td>
                                  <div class="flex px-2 py-1">
                                    <div class="flex flex-col justify-center">
                                        <h6 class="mb-0 leading-normal text-sm">{{$bus->hire_id}}</h6>
                                    </div>
                                  </div>
                                </td>
                                <td>
                                    <h6 class="mb-0 leading-normal text-sm">{{$bus->company_name}}</h6>
                                    <h6 class="mb-0 leading-normal text-sm">{{$bus->company_phone}}</h6>
                                    <h6 class="mb-0 leading-normal text-sm">{{$bus->company_email}}</h6>
                                </td>
                                <td>
                                    <h6 class="mb-0 leading-normal text-sm">{{$bus->contact_phone}}</h6>
                                </td>
                                <td>
                                    <h6 class="mb-0 leading-normal text-sm">{{$bus->from_location}}</h6>
                                    <h6 class="mb-0 leading-normal text-sm">{{$bus->to_location}}</h6>
                                </td>
                                <td>
                                  <p>
                                    {{$bus->purpose}}
                                  </p>
                                </td>
                                <td>
                                  <h6 class="mb-0 leading-normal text-sm">{{$bus->number_days}}</h6>
                                  <h6 class="mb-0 leading-normal text-sm">{{$bus->number_people}}</h6>
                                </td>
                                <td>
                                  <h6 class="mb-0 leading-normal text-sm">{{$bus->hire_date}}</h6>
                                </td>
                                {{-- <td >
                                  <a href="{{ url("/edit_bus/{$bus->bus_id}") }}" class="btn btn-sm btn-warning"> 
                                    <i class="bi bi-pencil-square"></i>
                                  </a>
                                  <br><br>
                                  <form method="POST" action="{{ url("/delete_bus/{$bus->bus_id}") }}">
                                    @csrf
                                    <input name="_method" type="hidden" value="DELETE">
                                    <button type="submit" class="btn btn-sm btn-danger show_confirm"><i class="bi bi-trash-fill"></i></button>
                                </form>
                                </td> --}}
                              </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
              </div>
            </div>
          </div>
          <!-- card 2 -->
        </div>


      </div>


    </div>
    <!-- content-wrapper ends -->

  </div>
  <!-- main-panel ends -->
</div>
<!-- page-body-wrapper ends -->
</div>
@include('layouts.script')

