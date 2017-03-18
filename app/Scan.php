<?php

namespace App;

use Illuminate\Database\Eloquent\Model;



class Scan extends Model
{
	

	protected $table = 'scans';
    protected $fillable = [
        'scan_id', 'scan_ip'
    ];

    public function requisition()
	{
	   return $this->belongsTo('App\Requisition', 'order_id', 'id');
	}

	/**
     * Get the index name for the model.
     *
     * @return string
     */
    public function searchableAs()
    {
        return 'id';
    }
}
