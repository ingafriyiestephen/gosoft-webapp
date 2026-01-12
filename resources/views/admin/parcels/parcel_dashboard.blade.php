
   <x-app-layout>
    @include('layouts.head')
     <body class="m-0 font-sans antialiased font-normal text-base leading-default bg-gray-50 text-slate-500">
     @include('layouts.sidenav')
     @include('layouts.mobile-nav')
   
  <div class="container-fluid">
    <div class="page-title">
      <div style="font-weight: 500;" class="fs-3">Parcel Dashboard</div>
    </div>
          <div class="container">
            <!--Start Row-->
            <div class="row">
              <div class="col-lg-4 col-md-6 col-sm-12 mt-5">
                <a href="#" style="text-decoration: none; color: inherit;">
                <div class="wrimagecard wrimagecard-topimage">
                        <div class="wrimagecard-topimage_header" style="background-color:rgba(162, 36, 187, 0.1) ">
                          <center><i class="fa leading-none fa-gift" style="color:#825d09"></i></center>
                        </div>
                        <div class="wrimagecard-topimage_title" style="text-decoration: none;">
                          <h5>Parcels &nbsp; {{$parcels}}</h5>
                        </div>
                  </div>
                </a>
              </div>
              <div class="col-lg-4 col-md-6 col-sm-12 mt-5">
                <a href="#" style="text-decoration: none; color: inherit;">
                  <div class="wrimagecard wrimagecard-topimage">
                      <div class="wrimagecard-topimage_header" style="background-color:  rgba(89, 193, 207, 0.1)">
                         <center><i class="material-icons" style="font-size:48px;color:green">local_shipping</i></center>
                      </div>
                      <div class="wrimagecard-topimage_title">
                        <h5>Parcel Revenue:&nbsp; GHS {{$parcel_fee}}</h5>
                      </div>
                  </div>
                </a>
              </div>
              <div class="col-lg-4 col-md-6 col-sm-12 mt-5">
                <a href="#" style="text-decoration: none; color: inherit;">
                  <div class="wrimagecard wrimagecard-topimage">
                      <div class="wrimagecard-topimage_header" style="background-color:  rgba(250, 188, 9, 0.1)">
                         <center><i class="material-icons" style="font-size:48px;color:green">directions_bike</i></center>
                      </div>
                      <div class="wrimagecard-topimage_title">
                        <h5>Delivery Revenue:&nbsp; GHS {{ $delivery_fee}}</h5>
                      </div>
                  </div>
                </a>
              </div>
            </div>
            <!--/End Row-->
            <!--Start Row-->
            <div class="padding">
              <div class="row">
                  <div class="container-fluid d-flex justify-content-center">
                      <div class="col-sm-8 col-md-6">
                          <div class="card">
                              <div class="card-header">Parcel Revenue</div>
                              <div class="card-body" style="height: 420px">
                                  <div class="chartjs-size-monitor" style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;">
                                      <div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                                          <div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div>
                                      </div>
                                      <div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                                          <div style="position:absolute;width:200%;height:200%;left:0; top:0"></div>
                                      </div>
                                  </div> <canvas id="chart-parcel-fee" width="299" height="200" class="chartjs-render-monitor" style="display: block; width: 299px; height: 200px;"></canvas>
                              </div>
                          </div>
                      </div>
                      <div class="col-sm-8 col-md-6">
                        <div class="card">
                            <div class="card-header">Total Revenue (Parcel + Delivery)</div>
                            <div class="card-body" style="height: 420px">
                               <i class="material-icons" style="font-size:48px;color:green; font-size: 300px;">trending_up</i>
                              <div class="wrimagecard-topimage_title" style="text-decoration: none; text-align:center;">
                                <h4>GHS {{ $total_fee}}</h4>
                              </div>
                            </div>
                        </div>
                    </div>
                  </div>
              </div>
          </div>
          <!--/End Row-->
          </div>
          <div class="row">
            <div class="col-md-6 col-sm-6">
              <div id="chart_collection"></div>
            </div>
            <div class="col-md-6 col-sm-6">
              <div id="chart_pay"></div>
            </div>
          </div>
          <br><br>
          <div class="row">
            <div class="col-md-6 col-sm-6">
              <div id="chart_delivery"></div>
            </div>
            <div class="col-md-6 col-sm-6">
              <div id="chart_parceltype"></div>
            </div>
          </div>
      </div>

  </div>

  @include('layouts.script')
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
</script>
<script>
  google.charts.load('current', {packages: ['corechart', 'bar']});
  google.charts.setOnLoadCallback(drawBasic);
  
  function drawBasic() {
  
        var data = google.visualization.arrayToDataTable([
          ['Collection Type', 'Number',],
          ['Station Pickup', {{$station_pickup}}],
          ['Company Delivery', {{$company_delivery}}]
        ]);
  
        var options = {
          title: 'Parcel Collection Type Count',
          chartArea: {width: '50%'},
          hAxis: {
            title: 'Number',
            minValue: 0
          },
          vAxis: {
            title: 'Collection Type'
          }
        };
  
        var chart = new google.visualization.BarChart(document.getElementById('chart_collection'));
  
        chart.draw(data, options);
      }
      </script>
  <script>
google.charts.load('current', {packages: ['corechart', 'bar']});
google.charts.setOnLoadCallback(drawBasic);

function drawBasic() {

      var data = google.visualization.arrayToDataTable([
        ['Parcel Status', 'Number', { role: 'style' }],
        ['Received by Company', {{$count_received}}, '#b87333'],
        ['Vehicle has set off', {{$count_setoff}}, 'red'],
        ['Parcel has arrived', {{$count_arrived}}, 'yellow'],
        ['In-transit', {{$count_intransit}}, 'orange'],
        ['Delivered', {{$count_delivered}}, 'black']
      ]);

      var options = {
        title: 'Parcel Status Count',
        chartArea: {width: '50%'},
        hAxis: {
          title: 'Number',
          minValue: 0
        },
        vAxis: {
          title: 'Status Type'
        }
      };

      var chart = new google.visualization.BarChart(document.getElementById('chart_delivery'));

      chart.draw(data, options);
    }
    </script>
  <script>
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);
    
    function drawChart() {
    var data = google.visualization.arrayToDataTable([
      ['Payment', 'Status'],
      ['Paid',{{$count_paid}}],
      ['Un-Paid',{{$count_unpaid}}]
    ]);
    
    var options = {
      title:'Payment Status Count'
    };
    
    var chart = new google.visualization.PieChart(document.getElementById('chart_pay'));
      chart.draw(data, options);
    }
    </script>
    <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Type', 'Count'],
          ['Books', 12.2],
          ['Clothing', 9.1],
          ['Electronic', 12.2],
          ['Jewellery', 22.9]]);

        var options = {
          title: 'Parcel Type',
          legend: { position: 'none' },
        };

        var chart = new google.visualization.BarChart(document.getElementById('chart_parceltype'));
        chart.draw(data, options);
      }
    </script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.4/Chart.bundle.min.js'></script>
    <script>
        $(document).ready(function() {
            var ctx = $("#chart-parcel-fee");
            var myLineChart = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: ["Paid", "Not-Paid"],
                    datasets: [{
                        data: [{{ $sum_payment['Paid']}}, {{ $sum_payment['Not-Paid']}}],
                        backgroundColor: ["rgba(100, 255, 0, 0.5)", "rgba(255, 0, 0, 0.5)"]
                    }]
                },
                options: {
                    title: {
                        display: true,
                        text: 'Payment Amount'
                    }
                }
            });
        });
    </script>
    <script type='text/javascript' src='https://www.gstatic.com/charts/loader.js'></script>
    <script type='text/javascript'>
     google.charts.load('current', {
       'packages': ['geochart'],
       // Note: Because markers require geocoding, you'll need a mapsApiKey.
       // See: https://developers.google.com/chart/interactive/docs/basic_load_libs#load-settings
       'mapsApiKey': 'AIzaSyD-9tSrke72PouQMnMX-a7eZSW0jkFMBWY'
     });
     google.charts.setOnLoadCallback(drawMarkersMap);

      function drawMarkersMap() {
      var data = google.visualization.arrayToDataTable([
        ['City',   'Population', 'Area'],
        ['Rome',      2761477,    1285.31],
        ['Milan',     1324110,    181.76],
        ['Naples',    959574,     117.27],
        ['Turin',     907563,     130.17],
        ['Palermo',   655875,     158.9],
        ['Genoa',     607906,     243.60],
        ['Bologna',   380181,     140.7],
        ['Florence',  371282,     102.41],
        ['Fiumicino', 67370,      213.44],
        ['Anzio',     52192,      43.43],
        ['Ciampino',  38262,      11]
      ]);

      var options = {
        region: 'IT',
        displayMode: 'markers',
        colorAxis: {colors: ['green', 'blue']}
      };

      var chart = new google.visualization.GeoChart(document.getElementById('chart-geo'));
      chart.draw(data, options);
    };
    </script>
  </body>
  </html>
  </x-app-layout>
