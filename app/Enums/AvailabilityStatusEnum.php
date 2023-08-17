<?php

namespace App\Enums;

use Spatie\Enum\Enum;

/**
 * @method static self Available()
 * @method static self Rented()
 * @method static self Closed()
 */
class AvailabilityStatusEnum extends Enum
{
    protected static function values(): array
    {
        return [
            'Available' => 1,
            'Rented' => 2,
            'Closed' => 3,
        ];
    }
}
