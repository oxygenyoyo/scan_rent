<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Scan;
use App\Requisition;
use Session;
use PDF;
class RequisitionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $isSearchThenUseSearchQuery = !empty($request->search);
        if($isSearchThenUseSearchQuery)
        {
            $requisitions = Requisition::join('scans', function($join) use ($request){
                $join->on('orders.id', '=', 'scans.order_id')
                ->where('scan_id', 'LIKE', '%' . $request->search . '%');    
            })
            ->select(
                'orders.id',
                'orders.created_at',
                'scans.scan_id',
                'orders.order_id',
                'orders.borrow_name',
                'orders.department',
                'orders.rent_date',
                'orders.rent_time',
                'orders.return_date',
                'orders.return_time',
                'orders.created_at'
            )
            ->with('scans')
            ->latest()
            ->orderBy('borrow_status', 'desc')
            ->orderBy('rent_date', 'desc')
            ->orderBy('rent_time', 'desc')
            ->paginate(50);
            // ->toSql();



        } else {
            $requisitions = Requisition::with('scans')
            ->latest()
            ->orderBy('borrow_status', 'desc')
            ->orderBy('rent_date', 'desc')
            ->orderBy('rent_time', 'desc')
            ->paginate(50);
            // ->toSql();

        }

        return view('admins/requisition/list', ['requisitions' => $requisitions]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $scans = Scan::where(['status' => 0])->get();

        if($scans->count() == 0)
        {
            Session::flash('error', 'คุณต้องมี Scan อยู่ในระบบก่อนอย่างน้อย 1 ตัว' );
            

            return redirect()->action('RequisitionController@index');
        }
        return view('admins/requisition/requisition', ['scans' => $scans]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $this->validate($request, [
            'order_id' => 'required',
            'rent_date' => 'required',
            'rent_time' => 'required',
            'department' => 'required',
            'borrow_name' => 'required',
            'borrow_company' => 'required',
            'borrow_role' => 'required',
            'borrow_id' => 'required',
            'borrow_tel' => 'required',
            'borrow_where' => 'required',
            'borrow_airline' => 'required',
            'borrow_flight' => 'required',
        ]);

        $requisition = new Requisition;

        
        
        $requisition->order_id = $request->order_id;
        $requisition->user_id = '1';
        $requisition->rent_date = date('Y-m-d', strtotime($request->rent_date));
        $requisition->rent_time = date('h:i', strtotime($request->rent_time));
        $requisition->department = $request->department;
        $requisition->borrow_name = $request->borrow_name;
        $requisition->borrow_company = $request->borrow_company;
        $requisition->borrow_role = $request->borrow_role;
        $requisition->borrow_id = $request->borrow_id;
        $requisition->borrow_tel = $request->borrow_tel;
        $requisition->borrow_where = $request->borrow_where;
        $requisition->borrow_airline = $request->borrow_airline;
        $requisition->borrow_flight = $request->borrow_flight;
        $requisition->borrow_status = true;
        $requisition->save();
        
        Scan::whereIn('id', array_unique($request->scan))
        ->update([
            'order_id' => $requisition->id,
            'status' => true
        ]);

        Session::flash('success', 'สร้างใบ ยืม/คืน เรียบร้อยแล้ว' );
        return redirect('admin/requisition');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $requisition = Requisition::where('id',$id)->with('scans')->first();
        
        return view('admins/requisition/show', ['data' => $requisition]);
    }

    public function showPDF($id)
    {
        $requisition = Requisition::where('id',$id)->with('scans')->first();
        
        return view('admins/requisition/pdf', ['data' => $requisition]);   
    }

    public function genPDF($id)
    {
        return PDF::loadFile("http://www.scanrent.com/admin/requisition/{$id}/pdf")->inline('scan.pdf');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $requisition = Requisition::where('id',$id)->with('scans')->first();
        $scans = Scan::where(['status' => 0])->get();   
        return view('admins/requisition/edit', 
        [
            'data' => $requisition,
            'scans' => $scans
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        
        
        // reset status scan the old group
        Scan::where('order_id', $id)
        ->update([
            'order_id' => 0,
            'status' => false
        ]);

        $this->validate($request, [
            'order_id' => 'required',
            'rent_date' => 'required',
            'rent_time' => 'required',
            'department' => 'required',
            'borrow_name' => 'required',
            'borrow_company' => 'required',
            'borrow_role' => 'required',
            'borrow_id' => 'required',
            'borrow_tel' => 'required',
            'borrow_where' => 'required',
            'borrow_airline' => 'required',
            'borrow_flight' => 'required',
        ]);

        $requisition = Requisition::where('id',$id)->first();
        $requisition->order_id = $request->order_id;
        $requisition->user_id = '1';
        $requisition->rent_date = date('Y-m-d', strtotime($request->rent_date));
        $requisition->rent_time = date('h:i', strtotime($request->rent_time));
        $requisition->department = $request->department;
        $requisition->borrow_name = $request->borrow_name;
        $requisition->borrow_company = $request->borrow_company;
        $requisition->borrow_role = $request->borrow_role;
        $requisition->borrow_id = $request->borrow_id;
        $requisition->borrow_tel = $request->borrow_tel;
        $requisition->borrow_where = $request->borrow_where;
        $requisition->borrow_airline = $request->borrow_airline;
        $requisition->borrow_flight = $request->borrow_flight;
        $requisition->borrow_status = true;
        $requisition->update();
        
        
        Scan::whereIn('id', array_unique($request->scan))
        ->update([
            'order_id' => $requisition->id,
            'status' => true
        ]);

        Session::flash('success', 'แก้ไขใบ ยืม/คืน เรียบร้อยแล้ว' );
        return redirect('admin/requisition');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Stamp Return Scan time
     */
    public function returnScan($id)
    {
        $requisition = Requisition::where('id',$id)->first();
        $requisition->return_date = date('Y-m-d');
        $requisition->return_time = date('h:i');
        $requisition->borrow_status = false;
        $requisition->update();

        Scan::where('order_id', $id)
        ->update([
            'order_id' => null,
            'status' => false
        ]);

        Session::flash('success', "ใบเบิกหมายเลข {$requisition->order_id} คืน เรียบร้อยแล้ว" );
        return redirect('admin/requisition');
    }

    public function editReturnScan($id)
    {
        $requisition = Requisition::where('id',$id)->first();
        $requisition->return_date = NULL;
        $requisition->return_time = NULL;
        $requisition->borrow_status = true;
        $requisition->update();

        Session::flash('success', "แก้ไข status {$requisition->order_id} เรียบร้อยแล้ว" );
        return redirect('admin/requisition');
    }
}
