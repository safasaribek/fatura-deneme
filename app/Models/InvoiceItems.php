<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceItems extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_id',
        'invoice_id',
        'amount',
        'price',
        'vat',
        'discount',
        'currency',
        'rate',
    ];

}
