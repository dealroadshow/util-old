<?php
/*
 * MIT License
 *
 * Copyright (c) 2017 Eugene Bogachov
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 */

namespace Granule\Util;

use Granule\Util\Exception\InvalidEnumWordingException;

abstract class EnumWording extends Enum implements Hashable
{
    private string $wording;

    public static function isExistingByWording(string $wording, $strict = false): bool
    {
        return in_array($wording, self::getValues(), $strict);
    }

    public static function fromWording(string $wording)
    {
        foreach (self::getValues() as $key => $value) {
            if ($value === $wording) {
                return self::fromValue($key);
            }
        }

        throw new InvalidEnumWordingException(sprintf('Wrong wording: %s', $wording));
    }

    public function getWording(): string
    {
        return $this->wording;
    }

    protected function __init(string $wording)
    {
        $this->wording = $wording;
    }

    public function __toString(): string
    {
        return $this->getWording();
    }

    public function hash(): string
    {
        return md5((string)$this);
    }
}
