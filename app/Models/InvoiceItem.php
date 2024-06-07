<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InvoiceItem extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'item_id',
        'invoice_id',
        'quantity',
        'price',
        'vat_rate',
        'vat_total',
        'discount_rate',
        'discount_total',
        'currency',
        'currency_rate',
        'total',
        'grand_total',
    ];

}
