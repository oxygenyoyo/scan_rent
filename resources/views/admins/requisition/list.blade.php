@extends('admins/layout')


@section('css')
<link rel="stylesheet" href="{{URL::asset('plugins/timepicker/bootstrap-timepicker.min.css')}}">
<link rel="stylesheet" href="{{URL::asset('plugins/select2/select2.min.css')}}">
<style>
  .callout a {
    text-decoration: none;
  }
</style>
@endsection

@section('content')


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <section class="content">
    <div class="row">
      <!-- left column -->
      <div class="col-md-12">
        <!-- general form elements -->
        <div class="box box-primary">
          <div class="box-header with-border">
            <div class="col-md-4">
              <h3 class="box-title">รายการใบยืม/คืนทั้งหมด</h3>
            </div>
            <div class="col-md-8">
              <form action="" method="get">
                <div class="box-tools">
                  <div class="input-group input-group-sm">
                    <input type="text" name="search" class="form-control pull-right" placeholder="Search">

                    <div class="input-group-btn">
                      <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
          @if (Session::has('success'))
            <div class="box-body">
              <div class="callout callout-success">
                <h4><i class="icon fa fa-check"></i> สำเร็จ</h4>
                  <p> {!! Session::get('success') !!}</p>
              </div>
            </div>
          @endif
          @if (Session::has('error'))
            <div class="box-body">
              <div class="callout callout-danger">
                <h4><i class="icon fa fa-ban"></i> มีข้อผิดพลาด</h4>
                  <p> {!! Session::get('error') !!}</p>
                  <a href="{{action('ScanController@create')}}" class="btn btn-info">กดปุ่มไปเพิ่ม Scan เข้าระบบ</a>
              </div>
            </div>
          @endif
          <!-- /.box-header -->
          <div class="box">
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tbody><tr>
                  <th>ID</th>
                  <th>สังกัด</th>
                  <th>ชื่อผู้ยืม</th>
                  <th>Scan</th>
                  <th>เวลายืม</th>
                  <th>เวลาคืน</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
                @foreach($requisitions as $requisition)
                  <tr>
                    <td>{{$requisition->order_id}}</td>
                    <td>{{$requisition->department}}</td>
                    <td>{{$requisition->borrow_name}}</td>
                    <td>
                      @foreach($requisition->scans as $scan)
                        {!!$scan->scan_id . '</br>'!!}
                      @endforeach
                      
                    </td>
                    <td>
                      {{date('d-m-Y', strtotime($requisition->rent_date))}}
                      {{date('H:i', strtotime($requisition->rent_time))}}
                    </td>
                    <td>
                      @if($requisition->return_date)
                        {{date('d-m-Y', strtotime($requisition->return_date))}}
                        {{date('H:i', strtotime($requisition->return_time))}}
                      @endif
                    </td>

                    <td>
                      @if($requisition->borrow_status == 1)
                        <span class="label label-danger">ถูกยืม</span></td>
                      @else
                        <span class="label label-success">คืนแล้ว</span></td>
                      @endif
                    <td>
                      <a href="{{ action('RequisitionController@edit', ['id' => $requisition->id]) }}" class="btn btn-default">Edit</a>
                      @if($requisition->borrow_status == 1)
                        <a data-id="{{$requisition->order_id}}" href="{{ action('RequisitionController@returnScan', ['id' => $requisition->id]) }}" class="btn btn-primary btn-return">คืน</a>
                      @else
                        <a href="{{ action('RequisitionController@editReturnScan', ['id' => $requisition->id]) }}" class="btn btn-danger">ยกเลิกการคืน</a>
                      @endif
                      
                      <a target="_blank" href="{{ url('admin/requisition/' . $requisition->id . '/genpdf')}}" class="btn btn-info">
                        PDF
                      </a>
                      

                    </td>
                  </tr>
                @endforeach
              </tbody></table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.box -->
      </div>
    </div>
  </section>
</div>

@endsection

@section('js')

<script src="{{URL::asset('plugins/select2/select2.full.min.js')}}"></script>
<script src="{{URL::asset('plugins/timepicker/bootstrap-timepicker.min.js')}}"></script>
<script>
  $('.btn-return').on('click', function(e){
    e.preventDefault();
    e.stopPropagation();
    let orderId = $(this).data('id');
    let url = $(this).attr('href');
    if(confirm('ยืนยันที่จะทำการเปลี่ยนสถานะใบยืมหมายเลข ' + orderId + '\r\n\r\n ใบยืมเป็นคืนแล้ว'))
    {
      window.location = url;
    }
  });
  $(".select2").select2();
  //Date picker
  $('#datepicker').datepicker({
    autoclose: true
  });
  //Timepicker
  $(".timepicker").timepicker({
    showInputs: false
  });
</script>
@endsection