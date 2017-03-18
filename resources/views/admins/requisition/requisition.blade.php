@extends('admins/layout')


@section('css')
<link rel="stylesheet" href="{{URL::asset('plugins/timepicker/bootstrap-timepicker.min.css')}}">
<link rel="stylesheet" href="{{URL::asset('plugins/select2/select2.min.css')}}">
<style>
  .margin-top.select2 {
    margin-top:10px !important;
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
            <h3 class="box-title">แบบการยืม/คืนอุปกรณ์ PBRS</h3>
          </div>
          <!-- /.box-header -->
          <!-- form start -->
          <form role="form" method="post" action="{{action('RequisitionController@store')}}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="box-body">
              <div class="form-group">
                <label for="order_id">ลำดับการยืม</label>
                <input type="text" name="order_id" class="form-control" id="order_id" placeholder="">
              </div>
              <!-- /.form-group --> 
              <!-- Date -->
              <div class="form-group">
                <label>วันที่ยืม</label>

                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" name="rent_date" class="form-control pull-right" id="datepicker" value="{{date('m/d/Y')}}">
                </div>
                <!-- /.input group -->
                <!-- time Picker -->
                <div class="bootstrap-timepicker">
                  <div class="form-group">
                    <label>เวลา</label>

                    <div class="input-group">
                      <input type="text" name="rent_time" class="form-control timepicker">

                      <div class="input-group-addon">
                        <i class="fa fa-clock-o"></i>
                      </div>
                    </div>
                    <!-- /.input group -->
                  </div>
                  <!-- /.form group -->
                </div>
              </div>
              <!-- /.form-group --> 
              <div class="form-group">
                <label>สังกัด</label>
                <select name="department" class="form-control select2" style="width: 100%;">
                  <option selected="selected" value="tg">TG</option>
                  <option value="bfs">BFS</option>
                  <option value="ws">WS</option>
                  <option value="px">PX</option>
                </select>
              </div>
              <!-- /.form-group -->
              <div class="form-group">
                <label>
                  Scanner
                  <input type="button" class="btn btn-primary" id="add-more-scan" value="Add more scanner">
                  <p class="text-muted" style="margin-top:6px">
                    หากเลือกซ้ำไม่เป็นไรระบบจะคัดแยกที่ซ้ำออกให้
                  </p>
                  
                </label>
                <div id="scaner-select-wrap">
                  <select class="form-control select2" name="scan[]" style="width: 100%;">
                    @foreach($scans as $scan)
                      <option {{ $loop->first ? 'selected="selected"' : '' }} value="{{$scan->id}}">{{$scan->scan_id}}</option>
                    @endforeach
                  </select>

                  
                </div>
              </div>
              <!-- /.form-group -->
              <hr>
              <h4>รายละเอียดผู้ยืม</h4>  
              <hr>
              <div class="form-group">
                <label for="borrow_name">ชื่อ</label>
                <input type="text" name="borrow_name" class="form-control" id="borrow_name" placeholder="">
              </div>
              <!-- /.form-group --> 
              <div class="form-group">
                <label for="borrow_company">บริษัท</label>
                <input type="text" name="borrow_company" class="form-control" id="borrow_company" placeholder="">
              </div>
              <!-- /.form-group --> 
              <div class="form-group">
                <label for="borrow_role">ตำแหน่ง</label>
                <input type="text" name="borrow_role" class="form-control" id="borrow_role" placeholder="">
              </div>
              <!-- /.form-group --> 
              <div class="form-group">
                <label for="borrow_id">รหัสพนักงาน</label>
                <input type="text" name="borrow_id" class="form-control" id="borrow_id" placeholder="">
              </div>
              <!-- /.form-group --> 
              <div class="form-group">
                <label for="borrow_tel">หมายเลขโทรศัพท์</label>
                <input type="text" name="borrow_tel" class="form-control" id="borrow_tel" placeholder="">
              </div>
              <!-- /.form-group --> 
              <div class="form-group">
                <label for="borrow_where">นำไปใช้งานที่บริเวณ</label>
                <input type="text" name="borrow_where" class="form-control" id="borrow_where" placeholder="">
              </div>
              <!-- /.form-group --> 
             <!--  <div class="form-group">
                <div class="checkbox">
                  <label>
                    <input name="sort[]" type="checkbox">
                    Sorting MTB
                  </label>
                </div>
                <div class="checkbox">
                  <label>
                    <input type="checkbox">
                    TBT
                  </label>
                </div>
              </div> -->
              <!-- /.form-group --> 
              <div class="form-group">
                <label for="borrow_airline">สำหรับสายการบิน</label>
                <input type="text" name="borrow_airline" class="form-control" id="borrow_airline" placeholder="">
              </div>
              <!-- /.form-group --> 
              <div class="form-group">
                <label for="borrow_flight">เที่ยวบิน</label>
                <input type="text" name="borrow_flight" class="form-control" id="borrow_flight" placeholder="">
              </div>
              <!-- /.form-group --> 
              
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
              <button type="submit" class="btn btn-primary">สร้างใบเบิก</button>
            </div>
          
          </form>
        </div>
        <!-- /.box -->
      </div>
    </div>
  </section>
</div>

<!-- for append -->
<select class="form-control hidden prototype" name="scan[]" style="width: 100%;">
  @foreach($scans as $scan)
    <option {{ $loop->first ? 'selected="selected"' : '' }} value="{{$scan->id}}">{{$scan->scan_id}}</option>
  @endforeach
</select>
@endsection

@section('js')

<script src="{{URL::asset('plugins/select2/select2.full.min.js')}}"></script>
<script src="{{URL::asset('plugins/timepicker/bootstrap-timepicker.min.js')}}"></script>
<script>
  
  $('#add-more-scan').on('click', function(event) {
    $('.prototype')
    .clone()  
    .addClass('select2')
    .removeClass('hidden prototype')
    .appendTo($('#scaner-select-wrap'));
    $(".select2").select2();


    $('.select2-container')
    .addClass('margin-top');
  });

  $(".select2").select2();
  //Date picker
  $('#datepicker').datepicker({
    autoclose: true,
    formatDate: 'yy-mm-dd'
  });
  //Timepicker
  $(".timepicker").timepicker({
    showInputs: false
  });
</script>
@endsection