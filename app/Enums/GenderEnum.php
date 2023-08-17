<?php

namespace App\Enums;

use Spatie\Enum\Enum;

/**
 * @method static self Male()
 * @method static self Female()
 */
class GenderEnum extends Enum
{
    protected static function values(): array
    {
        return [
            'Male' => 1,
            'Female' => 2,
        ];
    }
}
