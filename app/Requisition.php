<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Requisition extends Model
{
	

   protected $table = 'orders';

   public function scans()
   {
       return $this->hasMany('App\Scan','order_id','id');
   }
}
