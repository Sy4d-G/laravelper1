<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['category_id', 'code', 'name', 'unit', 'price', 'stock'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function transactionDetails()
    {
        return $this->hasMany(TransactionDetail::class);
    }

    // Accessor untuk format Rupiah (Latihan Modul 6)
    public function getFormattedPriceAttribute()
    {
        return 'Rp ' . number_format($this->price, 0, ',', '.');
    }
}
