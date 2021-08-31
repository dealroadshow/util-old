<?php

namespace Granule\Tests\Util\Collection\_fixtures;

use Granule\Util\Collection\ArrayCollection;
use Granule\Util\StrictTypedValue;

class DateIntervalCollection extends ArrayCollection implements StrictTypedValue
{
    public function getValueType(): string
    {
        return \DateInterval::class;
    }
}
