<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order_Detail extends Model
{
    use HasFactory;
    protected $table = 'order_details';
    protected $fillable = ['order_id','product_id','quantity','unitprice','amount','discount'];

    //creating relationship
    public function product(){
        return $this->belongsTo('App\Models\Product');

    }

    public function order(){
        return $this->belongsTo('App\Models\Order');

    }
}
