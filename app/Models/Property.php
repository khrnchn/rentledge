<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;

    protected $fillable = [
        'landlord_id',
        'name',
        'address',
        'type',
        'category',
        'rental_fee',
        'deposit_fee',
        'availability_status',
        'least_agreement',
        'terms_and_conditions',
    ];

    public function tenants()
    {
        return $this->belongsToMany(Tenant::class);
    }

    public function propertyImages()
    {
        return $this->hasMany(PropertyImage::class);
    }
}
