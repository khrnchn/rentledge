<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentInfo extends Model
{
    use HasFactory;

    protected $fillable = [
        'landlord_id',
        'account_name',
        'bank_name',
        'account_no',
    ];

    public function landlord()
    {
        return $this->belongsTo(Landlord::class);
    }
}
