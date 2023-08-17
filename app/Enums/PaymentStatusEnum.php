<?php

namespace App\Enums;

use Spatie\Enum\Enum;

/**
 * @method static self Pending()
 * @method static self Paid()
 * @method static self Overdue()
 * @method static self Cancelled()
 * @method static self Refunded()
 */
class PaymentStatusEnum extends Enum
{
    protected static function values(): array
    {
        return [
            'Pending' => 1,
            'Paid' => 2,
            'Overdue' => 3,
            'Cancelled' => 4,
            'Refunded' => 5,
        ];
    }
}
