@include('layouts.head')
<!-- partial -->
@include('layouts.sidenav')
  <!-- partial -->
  <div class="main-panel">
    <div class="content-wrapper">
      <div class="page-header">
        <h3 class="page-title">
          <span class="page-title-icon bg-gradient-danger text-white me-2">
            <i class="fa fa-user"></i>
          </span> Customers
        </h3>
      </div>
 

      <div class="container-fluid">
    
                  <div class="card mb-4">
                    <div class="card-body">
                      <table id="dataTable" class="display no-wrap" style="width: 100%;">
                            <thead>
                                <tr>
                                  <th>Name</th>
                                  <th>Email</th>
                                  <th>Phone</th>
                                  <th>Registration Date</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                  <th>Name</th>
                                  <th>Email</th>
                                  <th>Phone</th>
                                  <th>Registration Date</th>
                              </tr>
                            </tfoot>
                            <tbody>
    
                              @foreach ($customers as $customer)
                              <tr>
                                <td>
                                  <span class="font-semibold leading-tight text-xs text-slate-400">{{$customer->customer_name}}</span>
                                </td>
                                <td>
                                  <span class="font-semibold leading-tight text-xs text-slate-400">{{$customer->customer_email}}</span>
                                </td>
                                <td>
                                  <span class="font-semibold leading-tight text-xs text-slate-400">{{$customer->customer_phone}}</span>
                                </td>  
                                <td>
                                  <span class="font-semibold leading-tight text-xs text-slate-400">{{$customer->created_at}}</span>
                                </td>
                                @endforeach
                              </tr>
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

