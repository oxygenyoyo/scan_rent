@extends('admins/layout')


@section('css')
<link rel="stylesheet" href="{{URL::asset('plugins/timepicker/bootstrap-timepicker.min.css')}}">
<link rel="stylesheet" href="{{URL::asset('plugins/select2/select2.min.css')}}">

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
            <div class="box-body">
              <div class="form-group">
                <label for="order_id">ลำดับการยืม</label>
                {{$data->id}}
              </div>
              <!-- /.form-group --> 
              <!-- Date -->
              <div class="form-group">
                <label>วันที่ยืม</label>

                <div class="input-group date">
                  {{date('d-m-Y', strtotime($data->rent_date))}}
                </div>
                <!-- /.input group -->
                <!-- time Picker -->
                <div class="bootstrap-timepicker">
                  <div class="form-group">
                    <label>เวลา</label>

                    <div class="input-group">
                      {{date('H:i', strtotime($data->rent_time))}}
                    </div>
                    <!-- /.input group -->
                  </div>
                  <!-- /.form group -->
                </div>
              </div>
              <!-- /.form-group --> 
              <div class="form-group">
                <label>สังกัด</label>
                <div class="form-group">
                  {{$data->department}}
                </div>
              </div>
              <!-- /.form-group -->
              <div class="form-group">
                <label>
                  Scanner
                  
                </label>
                
                
                  @foreach($data->scans as $scan)
                    <div class="">
                      {{$scan->scan_id}}
                    </div>  
                  @endforeach
                
              </div>
              <!-- /.form-group -->
              <hr>
              <h4>รายละเอียดผู้ยืม</h4>  
              <hr>
              <div class="form-group">
                <label for="borrow_name">ชื่อ</label>
                {{$data->borrow_name}}
              </div>
              <!-- /.form-group --> 
              <div class="form-group">
                <label for="borrow_company">บริษัท</label>
                {{$data->borrow_company}}
              </div>
              <!-- /.form-group --> 
              <div class="form-group">
                <label for="borrow_role">ตำแหน่ง</label>
                {{$data->borrow_role}}
              </div>
              <!-- /.form-group --> 
              <div class="form-group">
                <label for="borrow_id">รหัสพนักงาน</label>
                {{$data->borrow_id}}
              </div>
              <!-- /.form-group --> 
              <div class="form-group">
                <label for="borrow_tel">หมายเลขโทรศัพท์</label>
                {{$data->borrow_tel}}
              </div>
              <!-- /.form-group --> 
              <div class="form-group">
                <label for="borrow_where">นำไปใช้งานที่บริเวณ</label>
                {{$data->borrow_where}}
              </div>
              <!-- /.form-group --> 
              <div class="form-group">
              
                <label>
                  Sorting MTB
                </label>
              
              </div>
              <!-- /.form-group --> 
              <div class="form-group">
                <label for="borrow_airline">สำหรับสายการบิน</label>
                {{$data->borrow_airline}}
                
              </div>
              <!-- /.form-group --> 
              <div class="form-group">
                <label for="borrow_flight">เที่ยวบิน</label>
                {{$data->borrow_flight}}
                
              </div>
              <!-- /.form-group --> 
              
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
              <a href="{{action('RequisitionController@genPDF',['id' => $data->id])}}" type="submit" class="btn btn-primary">สร้าง PDF</a>
            </div>
          
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