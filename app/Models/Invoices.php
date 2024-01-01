<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invoices extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'client_id',
        'invoice_number',
        'invoice_date',
        'deadline',
        'payment_method',
        'payment_status',
    ];

    public function cari()
    {
        return $this->belongsToMany(Clients::class, Invoices::class,'id','clients_id');
    }

    public function stok()
    {
        return $this->belongsToMany(Items::class, InvoiceItems::class,'id','items_id');
    }
    public function faturaurun()
    {
        return $this->belongsToMany(Invoices::class, InvoiceItems::class,'id','invoices_id');
    }
}
