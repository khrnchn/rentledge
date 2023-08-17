<?php

namespace App\Enums;

use Spatie\Enum\Enum;

/**
 * @method static self SingleFamilyHome()
 * @method static self Townhouse()
 * @method static self Condominium()
 * @method static self Duplex()
 * @method static self Apartment()
 * @method static self Room()
 */
class  PropertyCategoryEnum extends Enum
{
    protected static function values(): array
    {
        return [
            'SingleFamilyHome' => 1,
            'Townhouse' => 2,
            'Condominium' => 3,
            'Duplex' => 4,
            'Apartment' => 5,
            'Room' => 6,
        ];
    }

    protected static function labels(): array
    {
        return [
            'SingleFamilyHome' => 'Single Family Home',
        ];
    }
}
