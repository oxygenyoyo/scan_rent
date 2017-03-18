<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Scan;
use Session;
class ScanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $scans = Scan::where('scan_id', 'LIKE', '%' . $request->search . '%')
        ->orderBy('status')
        ->orderBy('updated_at', 'DESC')
        ->paginate(50);
        return view('admins/scan/scan_list',['scans' => $scans]);   
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admins/scan/register_scan');
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
            'scan_id' => 'required|unique:scans',
            'scan_ip' => '',
        ]);

        $scan = new Scan;

        $scan->scan_id = $request->scan_id;
        $scan->scan_ip = $request->scan_ip;

        $scan->save();
        Session::flash('success', 'ลงทะเบียน Scaner เรียบร้อยแล้ว' );
        return redirect('admin/scan/create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $scan = Scan::where('id',$id)->first();
        
        return view('admins/scan/edit',['data' => $scan]);   
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
        $this->validate($request, [
            'scan_id' => 'required|unique:scans',
            'scan_ip' => 'required',
        ]);

        $scan = Scan::where('id',$id)->first();

        $scan->scan_id = $request->scan_id;
        $scan->scan_ip = $request->scan_ip;

        $scan->update();
        Session::flash('success', 'แก้ไข Scaner เรียบร้อยแล้ว' );
        return redirect('admin/scan/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Scan::destroy($id);
        return json_encode(['success' => 'true']);
    }



}
