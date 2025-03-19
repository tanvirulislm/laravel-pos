<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;

class InvoiceProduct extends Model
{
    protected $fillable = ['invoice_id', 'product_id', 'quantity'];

    public function product(){
        return $this->belongsTo(Product::class);
    }
}
