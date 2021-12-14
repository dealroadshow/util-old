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

namespace Granule\Util\Map;

use Granule\Util\Map;
use Granule\Util\MutableMap;

class MutableObjectMap extends ObjectMap implements MutableMap
{
    public function clear(): void
    {
        throw new \BadMethodCallException('Not Implemented method');
    }

    public function forEachApply(callable $callback): void
    {
        throw new \BadMethodCallException('Not Implemented method');
    }

    public function put($key, $value)
    {
        throw new \BadMethodCallException('Not Implemented method');
    }

    public function putAll(Map $map): void
    {
        throw new \BadMethodCallException('Not Implemented method');
    }

    public function putIfAbsent($key, $value): void
    {
        throw new \BadMethodCallException('Not Implemented method');
    }

    public function remove($key)
    {
        throw new \BadMethodCallException('Not Implemented method');
    }

    public function removeIfEqual($key, $value): bool
    {
        throw new \BadMethodCallException('Not Implemented method');
    }

    public function replace($key, $value)
    {
        throw new \BadMethodCallException('Not Implemented method');
    }

    public function replaceIfEqual($key, $oldValue, $newValue): bool
    {
        throw new \BadMethodCallException('Not Implemented method');
    }

    public function replaceAll(callable $replacer): void
    {
        throw new \BadMethodCallException('Not Implemented method');
    }
}
