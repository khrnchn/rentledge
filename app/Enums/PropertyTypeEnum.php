<?php

namespace App\Enums;

use Spatie\Enum\Enum;

/**
 * @method static self Residential()
 * @method static self Commercial()
 * @method static self Industrial()
 * @method static self Agricultural()
 * @method static self VacantLand()
 */
class  PropertyTypeEnum extends Enum
{
    protected static function values(): array
    {
        return [
            'Residential' => 1,
            'Commercial' => 2,
            'Industrial' => 3,
            'Agricultural' => 4,
            'VacantLand' => 5,
        ];
    }

    protected static function labels(): array
    {
        return [
            'VacantLand' => 'Vacant Land',
        ];
    }
}
