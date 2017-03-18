<!DOCTYPE html>
<html lang="en">
<head>

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>


	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<!-- Bootstrap 3.3.6 -->
  	<link rel="stylesheet" href="http://www.scanrent.com/bootstrap/css/bootstrap.min.css">
  
	
	<title>:: ใบยืม/คืน ::</title>
	<style>
	body{
		font-family: 'trirong';
	}
	.dot{
	    border-bottom: dotted 1px;
	    width: 100%;
	    height: 14px;
	}
	.table-without-border.table td {
		border: 0;
	}
	
		
	</style>
</head>
<body>
	<div class="container">
		<div class="row">
			<table class="table table-without-border">
				<tr>
					<td>
						<img src="{{URL::asset('images/aot_logo.jpg')}}" alt="">
					</td>
					<td>
						<div class="">
							<label class="">ลำดับการยืม: </label>
							{{$data->order_id}}	
						</div>
						<div class="">
							วันที่ยืม: {{date('d/m/Y', strtotime($data->rent_date))}} {{date('H:i', strtotime($data->rent_time))}} 
						</div>
					</td>
				</tr>
			</table>
			<!-- <div class="col-md-8">
				<img src="{{URL::asset('images/aot_logo.jpg')}}" alt="">
			</div>
			<div class="col-md-4">
				<div class="">
					<label class="">ลำดับการยืม: </label>
					{{$data->order_id}}	
				</div>
				<div class="">
					วันที่ยืม: {{date('d/m/Y', strtotime($data->rent_date))}} {{date('H:i', strtotime($data->rent_time))}} 
				</div>
			</div> -->
		</div><!-- .row -->
		<div class="row">
			<div class="col-md-12 text-center">
				แบบยืม/คืน อุปกรณ์ PBRS
			</div>
			<div class="col-md-12 text-center">
				{{strtoupper($data->department)}}
			</div>
			<div class="col-md-12">
				<h3>
					1. ยืม	
				</h3>
				
			</div>
		</div><!-- .row -->
		<div class="row">
			<h4 class="text-center">อุปกรณ์ระบบ PBRS</h4>
			<div class="col-md-12">
				<table class="table table-bordered">
					<thead>
						<tr class="text-center">
							<td>Scan ID</td>
							<td>Battery</td>
							<td>หมายเหตุ</td>
						</tr>
					</thead>
					<tbody>
						@foreach($data->scans as $scan)
						<tr class="text-center">
							<td>{{$scan->scan_id}}</td>
							<td>1</td>
							<td></td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div><!-- .col-md-12 -->
		</div><!-- .row -->
		<div class="row">
			<div class="col-md-12">
				<h4>ผู้ยืม</h4>
				<table class="table table-bordered">
					<tr>
						<td>ชื่อ(ตัวบรรจง): {{$data->borrow_name}}</td>
						<td>บริษัท: {{$data->borrow_company}}</td>
					</tr>
					<tr>
						<td>ตำแหน่ง: {{$data->borrow_role}}</td>
						<td>รหัสพนักงาน: {{$data->borrow_id}}</td>
					</tr>
					<tr>
						<td colspan="2">หมายเลขโทรศัพท์: {{$data->borrow_tel}}</td>
					</tr>
					<tr>
						<td colspan="2">เวลาในการยืม: {{date('d-m-Y', strtotime($data->rent_date))}} {{date('H:i', strtotime($data->rent_time))}} </td>
					</tr>
				</table>
				
				<h4>เพื่อ</h4>
				<table class="table table-bordered">
					<tr>
						<td>นำไปใช้ในบริเวณ: {{$data->borrow_where}}</td>
						<td>Sorting MTB</td>
					</tr>
					<tr>
						<td>สำหรับสายการบิน: {{strtoupper($data->borrow_airline)}}</td>
						<td>เที่ยวบิน: {{$data->borrow_flight}}</td>
					</tr>
				</table>
				<p>
					ผู้ยืมได้รับอุปกรณ์ทั้งหมดในสภาพสมบูรณ์พร้อมใช้งานทั้งนี้หากอุปกรณ์เสียหายจากการใช้งานไม่ถูกต้องระหว่างที่ยืมไปใช้งานผู้ยืมยินดีเป็นผู้รับผิดชอบค่าเสียหายทั้งหมด
				</p>
				<table class="table-without-border table">
					<tr>
						<td>
							<table class="table table-without-border">
								<tr>
									<td>ลงชื่อ</td>
									<td>........................................................</td>
								</tr>
								<tr>
									<td colspan="2">
										( ........................................................................... )
									</td>
								</tr>
								<tr>
									<tr>
										<td>ตำแหน่ง</td>
										<td>........................................................</td>
									</tr>
								</tr>
								<tr>
									<td colspan="2" class="text-center">ผู้ยืม</td>
								</tr>
							</table>
						</td>
						<td>
							<table class="table table-without-border">
								<tr>
									<td>ลงชื่อ</td>
									<td>........................................................</td>
								</tr>
								<tr>
									<td colspan="2">
										( ........................................................................... )
									</td>
								</tr>
								<tr>
									<tr>
										<td>ตำแหน่ง</td>
										<td>........................................................</td>
									</tr>
								</tr>
								<tr>
									<td colspan="2" class="text-center">เจ้าหน้าที่ให้ยืมอุปกรณ์ (TTI)</td>
								</tr>
							</table>
						</td>
						<td>
							<table class="table table-without-border">
								<tr>
									<td>ลงชื่อ</td>
									<td>........................................................</td>
								</tr>
								<tr>
									<td colspan="2">
										( ........................................................................... )
									</td>
								</tr>
								<tr>
									<tr>
										<td>ตำแหน่ง</td>
										<td>........................................................</td>
									</tr>
								</tr>
								<tr>
									<td colspan="2" class="text-center">เจ้าหน้าที่ผู้ให้ยืมอุปกรณ์ (AOT)</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
				
				<!-- <div class="col-md-4">
					<div class="row">
						<div class="col-md-2">
							<div class="sign-name">ลงชื่อ</div>		
						</div>
						<div class="col-md-10">
							<div class="dot"></div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="row">
								<div class="col-md-1">
									<div class="backet-left">(</div>	
								</div>
								<div class="col-md-10">
									<div class="dot"></div>			
								</div>
								<div class="col-md-1">
									<div class="backet-right">)</div>	
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-2">
							<div class="role">ตำแหน่ง</div>	
						</div>
						<div class="col-md-10">
							<div class="dot"></div>		
						</div>
					</div>
					<div class="row">
						<div class="col-md-12 text-center">
							<div class="other">เจ้าหน้าที่ผู้ให้ยืมอุปกรณ์ (TTI)</div>		
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="row">
						<div class="col-md-2">
							<div class="sign-name">ลงชื่อ</div>		
						</div>
						<div class="col-md-10">
							<div class="dot"></div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="row">
								<div class="col-md-1">
									<div class="backet-left">(</div>	
								</div>
								<div class="col-md-10">
									<div class="dot"></div>			
								</div>
								<div class="col-md-1">
									<div class="backet-right">)</div>	
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-2">
							<div class="role">ตำแหน่ง</div>	
						</div>
						<div class="col-md-10">
							<div class="dot"></div>		
						</div>
					</div>
					<div class="row">
						<div class="col-md-12 text-center">
							<div class="other">เจ้าหน้าที่ผู้ให้ยืมอุปกรณ์ (AOT)</div>		
						</div>
					</div>
				</div> -->
			</div><!-- .col-md-12 -->
		</div><!-- .row -->
		<!-- <div class="row">
			<div class="col-md-12">
				<h3>คืน</h3>
			</div>
			<p>ได้รับอุปกรณ์ระบบ PBRS ซึ่งได้ยืมไปตามรายละเอียดในข้อ 1 คืนจาก</p>
			<h3>ผู้คืน</h3>
			<p>ชื่อ(ตัวบรรจง): <span class="dot"></span></p>
			<p>บริษัท: {{$data->borrow_company}}</p>
			<p>ตำแหน่ง: {{$data->borrow_role}}</p>
			<p>รหัสพนักงาน: {{$data->borrow_id}}</p>
			<p>หมายเลขโทรศัพท์: {{$data->borrow_tel}}</p>
			<p>เวลาการคืน {{date('d/m/Y', strtotime($data->return_date))}} {{date('H:i', strtotime($data->return_time))}} </p>
			<p>คิดเป็นระยะเวลายืม-คืน {{date('d/m/Y', strtotime($data->diff_date))}} {{date('H:i', strtotime($data->diff_time))}} </p>

			<p>
				<input type="checkbox">ยืมคืนในเวลา 24 ชม.
				<input type="checkbox">ยืมคืนเกินเวลา 24 ชม.
			</p>
		</div> -->
	</div><!-- .container -->

</body>
</html>