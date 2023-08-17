<?php

namespace App\Enums;

use Spatie\Enum\Enum;

/**
 * @method static self Pending()
 * @method static self Accepted()
 * @method static self Rejected()
 */
class ApplicationStatusEnum extends Enum
{
    protected static function values(): array
    {
        return [
            'Pending' => 1,
            'Accepted' => 2,
            'Rejected' => 3,
        ];
    }
}
