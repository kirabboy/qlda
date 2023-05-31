<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class Projectstatus extends Enum
{
    const approved = 0;
    const rejected = 1;
    const submitted = 2;
}
