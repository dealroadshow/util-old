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
use Granule\Util\TypeHelper;

class ObjectMapBuilder extends MapBuilder
{
    /** @var \SplObjectStorage */
    protected $items;

    public function __construct($mapClass, $mappingType, $keyType)
    {
        parent::__construct($mapClass, $mappingType, $keyType);
        $this->items = new \SplObjectStorage();
    }

    public function add($key, $value): MapBuilder
    {
        if ($this->keyType) {
            TypeHelper::validate($key, $this->keyType);
        }

        if ($this->mappingType) {
            TypeHelper::validate($value, $this->mappingType);
        }

        $this->items->attach($key, $value);

        return $this;
    }

    public function getElements(): array
    {
        throw new \BadMethodCallException('Not supported method');
    }

    public function build(): Map
    {
        return call_user_func([$this->mapClass, 'fromStorage'], $this->items);
    }
}
