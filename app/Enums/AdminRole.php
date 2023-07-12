<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class AdminRole extends Enum
{
    const employee = 1;
    const admin_project = 2;
    const supper_admin = 3;
}