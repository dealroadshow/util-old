<?php

/**
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

class MapBuilder
{
    /** @var array */
    protected $elements = [];
    /** @var string */
    protected $mapClass;
    /** @var string|null */
    protected $mappingType;
    /** @var string|null */
    protected $keyType;

    public function __construct(string $mapClass, ?string $mappingType = null, ?string $keyType = null)
    {
        $this->mapClass = $mapClass;
        $this->mappingType = $mappingType;
        $this->keyType = $keyType;
    }

    public function add($key, $value): MapBuilder
    {
        if ($this->keyType) {
            TypeHelper::validate($key, $this->keyType);
        }

        if ($this->mappingType) {
            TypeHelper::validate($value, $this->mappingType);
        }

        $this->elements[$key] = $value;

        return $this;
    }

    public function addAll(Map $map): MapBuilder
    {
        foreach ($map as $key => $value) {
            $this->add($key, $value);
        }

        return $this;
    }

    public function getElements(): array
    {
        return $this->elements;
    }

    public function build(): Map
    {
        $class = $this->mapClass;
        /** @var Map $map */
        $map = new $class($this);

        return $map;
    }
}
