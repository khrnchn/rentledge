<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wealth extends Model
{
    use HasFactory;

    protected $fillable = [
        'tenant_id',
        'assets',
        'investments',
        'liabilities'
    ];

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }
}
