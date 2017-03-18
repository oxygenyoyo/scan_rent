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
            <h3 class="box-title">ลงทะเบียนเครื่อง Scaner ใหม่</h3>
          </div>
          <!-- /.box-header -->
          <!-- form start -->
          <form role="form" method="post" action="{{action('ScanController@store')}}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            @if (Session::has('success'))
              <div class="box-body">
                <div class="callout callout-success">
                  <h4><i class="icon fa fa-check"></i> สำเร็จ</h4>
                    <p> {!! Session::get('success') !!}</p>
                </div>
              </div>
            @endif
            @if (count($errors) > 0)
              <div class="box-body">
                <div class="callout callout-danger">
                  <h4><i class="icon fa fa-ban"></i> เกิดข้อผิดพลาด</h4>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach 
                    </ul>
                </div>
              </div>
            @endif
            <div class="box-body">
              <div class="form-group">
                <label for="scan_id">หมายเลขเครื่อง</label>
                <input type="text" autofocus class="form-control" name="scan_id" id="scan_id" placeholder="">
              </div>
              <!-- /.form-group --> 
              <div class="form-group">
                <label for="scan_ip">IP ของเครื่อง</label>
                <input type="text" class="form-control" name="scan_ip" id="scan_ip" placeholder="">
              </div>
              <!-- /.form-group --> 
              
            <!-- /.box-body -->
            <div class="box-footer">
              <button type="submit" class="btn btn-primary">ลงทะเบียน</button>
            </div>
          </form>
        </div>
        <!-- /.box -->
      </div>
    </div>
  </section>
</div>

@endsection
