<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $fillable = ['product_name', 'description', 'brand', 'price', 'product_code', 'barcode', 'qrcode', 'product_image', 'quantity', 'alert_stock'];

    //creating relationship
    public function orderdetails()
    {
        return $this->hasMany('App\Models\Order_Detail');
    }
    //creating relationship
    public function cart()
    {
        return $this->hasMany('App\Models\Cart');
    }
}
