<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'tenant_id',
        'payment_status',
        'amount',
        'due_at',
        'paid_at',
        'cancelled_at',
    ];

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }
}
