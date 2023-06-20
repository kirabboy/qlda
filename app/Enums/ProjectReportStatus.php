<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;
use BenSampo\Enum\Contracts\LocalizedEnum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class ProjectReportStatus extends Enum implements LocalizedEnum
{
    const approved = 0;
    const rejected = 1;
    const submitted = 2;
}
