<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'occupation',
        'income_range',
        'nric_path',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function properties()
    {
        return $this->belongsToMany(Property::class);
    }
}
