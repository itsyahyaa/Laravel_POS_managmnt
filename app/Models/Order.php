<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = 'orders';
    protected $fillable = ['name','address'];

    //creating relationship
    public function orderdetails(){
        return $this->hasMany('App\Models\Order_Detail');
    }

}
