@extends('admins/layout')


@section('css')

<style>
  #show-time {
    display: inline-block;
  }
</style>
@endsection


@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Dashboard
      <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="treeview active">Dashboard</li>
    </ol>
    <div class="">
      <label for="">Date:</label> {{date('d-m-Y')}}
      <label for="">Time:</label> <div id="show-time"></div>  
    </div>
    
  </section>

  <section class="content">

    <!-- Small boxes (Stat box) -->
    <div class="row">
      <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
          <span class="info-box-icon bg-aqua"><i class="fa fa-print"></i></span>

          <div class="info-box-content">
            <h4>TG</h4>
            <span class="info-box-number">จำนวนที่ยืม {{$tg}}</span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
      <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
          <span class="info-box-icon bg-green"><i class="fa fa-print"></i></span>

          <div class="info-box-content">
            <h4>BFS</h4>
            <span class="info-box-number">จำนวนที่ยืม {{$bfx}}</span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
      <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
          <span class="info-box-icon bg-yellow"><i class="fa fa-print"></i></span>

          <div class="info-box-content">
            <h4>WS</h4>
            <span class="info-box-number">จำนวนที่ยืม {{$ws}}</span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
      <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
          <span class="info-box-icon bg-red"><i class="fa fa-print"></i></span>

          <div class="info-box-content">
            <h4>PX</h4>
            <span class="info-box-number">จำนวนที่ยืม {{$px}}</span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->

      

      <?php /*
      <div class="col-md-12">
        <!-- AREA CHART -->
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Area Chart</h3>

            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
              </button>
              <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
            </div>
          </div>
          <div class="box-body">
            <div class="chart">
              <canvas id="areaChart" style="height: 249px; width: 555px;" height="249" width="555"></canvas>
            </div>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
      <!-- /.col-md-12 -->
      */ ?>
    </div>

    
    <!-- /.row -->
  </section>
  <!-- /.section -->
</div>

  
@endsection


@section('js')


<script src="{{URL::asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{URL::asset('plugins/datatables/dataTables.bootstrap.min.js')}}"></script>
<script src="{{URL::asset('plugins/chartjs/Chart.min.js')}}"></script>
<!-- page script -->
<script>
  $(function() {
      startTime();
  });
  
  /**
   * Show time 
   */
  function startTime() {
      var today = new Date();
      var h = today.getHours();
      var m = today.getMinutes();
      var s = today.getSeconds();
      m = checkTime(m);
      s = checkTime(s);
      $('#show-time').html(h + ":" + m + ":" + s);
      var t = setTimeout(startTime, 500);
  }
  function checkTime(i) {
      if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
      return i;
  }

  $(function () { 
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });
  });

  //--------------
  //- AREA CHART -
  //--------------

  /*
  // Get context with jQuery - using jQuery's .get() method.
  var areaChartCanvas = $("#areaChart").get(0).getContext("2d");
  // This will get the first returned node in the jQuery collection.
  var areaChart = new Chart(areaChartCanvas);

  var areaChartData = {
    labels: ["January", "February", "March", "April", "May", "June", "July"],
    datasets: [
      {
        label: "TG",
        fillColor: "rgba(210, 214, 222, 1)",
        strokeColor: "rgba(210, 214, 222, 1)",
        pointColor: "rgba(210, 214, 222, 1)",
        pointStrokeColor: "#c1c7d1",
        pointHighlightFill: "#fff",
        pointHighlightStroke: "rgba(220,220,220,1)",
        data: [65, 59, 80, 81, 56, 55, 40]
      },
      {
        label: "BFS",
        fillColor: "rgba(60,141,188,0.9)",
        strokeColor: "rgba(60,141,188,0.8)",
        pointColor: "#3b8bba",
        pointStrokeColor: "rgba(60,141,188,1)",
        pointHighlightFill: "#fff",
        pointHighlightStroke: "rgba(60,141,188,1)",
        data: [28, 48, 40, 19, 86, 27, 90]
      },
      {
        label: "WS",
        fillColor: "rgba(60,200,133,0.8)",
        strokeColor: "rgba(60,141,188,0.8)",
        pointColor: "#3b8b44",
        pointStrokeColor: "rgba(60,141,188,1)",
        pointHighlightFill: "#fff",
        pointHighlightStroke: "rgba(60,141,188,1)",
        data: [33, 48, 22, 10, 50, 60, 66]
      },
      {
        label: "PS",
        fillColor: "rgba(60,70,233,0.9)",
        strokeColor: "rgba(60,141,10,0.8)",
        pointColor: "#4F58EB",
        pointStrokeColor: "rgba(60,141,188,1)",
        pointHighlightFill: "#fff",
        pointHighlightStroke: "rgba(60,141,188,1)",
        data: [10, 23, 33, 44, 56, 61, 88]
      }
    ]
  };

  var areaChartOptions = {
    //Boolean - If we should show the scale at all
    showScale: true,
    //Boolean - Whether grid lines are shown across the chart
    scaleShowGridLines: false,
    //String - Colour of the grid lines
    scaleGridLineColor: "rgba(0,0,0,.05)",
    //Number - Width of the grid lines
    scaleGridLineWidth: 1,
    //Boolean - Whether to show horizontal lines (except X axis)
    scaleShowHorizontalLines: true,
    //Boolean - Whether to show vertical lines (except Y axis)
    scaleShowVerticalLines: true,
    //Boolean - Whether the line is curved between points
    bezierCurve: true,
    //Number - Tension of the bezier curve between points
    bezierCurveTension: 0.3,
    //Boolean - Whether to show a dot for each point
    pointDot: false,
    //Number - Radius of each point dot in pixels
    pointDotRadius: 4,
    //Number - Pixel width of point dot stroke
    pointDotStrokeWidth: 1,
    //Number - amount extra to add to the radius to cater for hit detection outside the drawn point
    pointHitDetectionRadius: 20,
    //Boolean - Whether to show a stroke for datasets
    datasetStroke: true,
    //Number - Pixel width of dataset stroke
    datasetStrokeWidth: 2,
    //Boolean - Whether to fill the dataset with a color
    datasetFill: true,
    //String - A legend template
    legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].lineColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
    //Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
    maintainAspectRatio: true,
    //Boolean - whether to make the chart responsive to window resizing
    responsive: true
  };
  
  //Create the line chart
  areaChart.Line(areaChartData, areaChartOptions);
  */
</script>

@endsection
