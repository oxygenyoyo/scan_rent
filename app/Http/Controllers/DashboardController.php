<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Scan;
use App\Requisition;
use DB;
class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $tg = Scan::join('orders', function($join){
            $join->on('orders.id', '=', 'scans.order_id')
                ->where('orders.department', 'tg');    
        })
        ->count();

        $bfx = Scan::join('orders', function($join){
            $join->on('orders.id', '=', 'scans.order_id')
                ->where('orders.department', 'bfx');    
        })
        ->count();
        
        $ws = Scan::join('orders', function($join){
            $join->on('orders.id', '=', 'scans.order_id')
                ->where('orders.department', 'ws');    
        })
        ->count();

        $px = Scan::join('orders', function($join){
            $join->on('orders.id', '=', 'scans.order_id')
                ->where('orders.department', 'px');    
        })
        ->count();
        
        return view('admins/index', [
            'tg' => $tg,
            'bfx' => $bfx,
            'ws' => $ws,
            'px' => $px,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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
}
