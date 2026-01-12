<x-app-layout>
  @include('layouts.head')
   <body class="m-0 font-sans antialiased font-normal text-base leading-default bg-gray-50 text-slate-500">
   @include('layouts.sidenav')
   @include('layouts.mobile-nav')

  <div class="container-fluid">
    <!-- Modal -->
    <div class="modal fade" id="modalParcelType" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modalLocationTitle">Add New Parcel Type</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
              <!--Add Parcel Type form-->
              <form role="form" action="{{ url("/store_parcel_type") }}" method="POST" style="margin-block: 20px; margin-left: 20px;">
                @csrf
                <div class="w-full lg:w-4/12 px-4">
                  <div class="relative w-full mb-3">
                    <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2" htmlfor="grid-password">
                      Parcel Type Name
                    </label>
                    <input type="text" name="parcel_type" id="parcel_type" class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow" placeholder="Enter Parcel Type Name" required/>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                  <button type="submit" class="btn btn-success">Save</button>
                </div>
              </form>
          <!--/Add Parcel Type form-->
          </div>

        </div>
      </div>
    </div>

  <div class="w-full px-6 py-6 mx-auto">
    <!-- table 1 -->

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
                <i class="fa leading-none fa-gift me-1"></i>
                Parcel Types
                <button type="button" class="btn btn-primary btn-sm" style="width: 200px; margin-left: 17px;"  data-toggle="modal" data-target="#modalParcelType">New Parcel Type</button>
            </div>
            <div class="card-body">
              <table id="dataTable" class="display no-wrap" style="width: 100%;">
                    <thead>
                        <tr>
                          <th>ID</th>
                          <th >Parcel Type</th>
                          <th >Created</th>
                          <th >Updated</th>
                          <th >Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                          <th>ID</th>
                          <th >Parcel Type</th>
                          <th >Created</th>
                          <th >Updated</th>
                          <th >Action</th>
                      </tr>
                    </tfoot>
                    <tbody>
                      @foreach ($parcel_types as $parcel_type)
                      <tr>
                        <td >
                          <div class="flex px-2 py-1">
                            <div class="flex flex-col justify-center">
                                <h6 class="mb-0 leading-normal text-sm">{{$parcel_type->parcel_type_id}}</h6>
                            </div>
                          </div>
                        </td>
                        <td >
                            <h6 class="mb-0 leading-normal text-sm">{{$parcel_type->parcel_type}}</h6>
                        </td>
                        <td >
                            <h6 class="mb-0 leading-normal text-sm">{{$parcel_type->created_at}}</h6>
                        </td>
                        <td >
                            <h6 class="mb-0 leading-normal text-sm">{{$parcel_type->updated_at}}</h6>
                        </td>
                        <td >
                        <form method="POST" action="{{ url("/delete_ptype/{$parcel_type->parcel_type_id}") }}">
                          @csrf
                          <input name="_method" type="hidden" value="DELETE">
                          <button type="submit" class="btn btn-danger btn-sm show_confirm" data-toggle="tooltip" title='Delete'><i class="bi bi-trash-fill"></i></button>
                        </td>
                      </form>
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
  @include('layouts.script')
</body>
</html>
</x-app-layout>