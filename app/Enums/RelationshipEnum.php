<?php

namespace App\Enums;

use Spatie\Enum\Enum;

/**
 * @method static self Father()
 * @method static self Mother()
 * @method static self Brother()
 * @method static self Sister()
 * @method static self Son()
 * @method static self Daughter()
 * @method static self Other()
 */
class RelationshipEnum extends Enum
{
    protected static function values(): array
    {
        return [
            'Father' => 1,
            'Mother' => 2,
            'Brother' => 3,
            'Sister' => 4,
            'Son' => 5,
            'Daughter' => 6,
            'Other' => 7,
        ];
    }
}
