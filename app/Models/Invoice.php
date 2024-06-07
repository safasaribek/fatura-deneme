<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invoice extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'client_id',
        'invoice_number',
        'invoice_date',
        'deadline',
        'payment_method',
        'payment_status',
        'total',
        'discount_total',
        'vat_total',
        'grand_total',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

//    public function stok()
//    {
//        return $this->belongsToMany(Item::class, InvoiceItem::class);
//    }

    public function invoiceItem()
    {
        return $this->hasMany(InvoiceItem::class);
    }
}
