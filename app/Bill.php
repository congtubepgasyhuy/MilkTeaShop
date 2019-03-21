<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    protected $table = "bills";

    public function billDetail(){
		return $this->hasMany('App\BillDetail', 'id_bill', 'id');
	}

	public function customer(){
		return $this->belongsTo('App\Customer', 'id_customer', 'id');
	}
}
