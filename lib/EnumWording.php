<?php

namespace Granule\Util;

abstract class EnumWording extends Enum {

    private $wording;

    public static function fromWording(string $wording) {
        foreach (self::getValues() as $key => $value) {
            if ($value === $wording) {
                return self::fromValue($key);
            }
        }

        throw new \InvalidArgumentException(sprintf('Wrong wording: %s', $wording));
    }

    public function getWording(): string {
        return $this->wording;
    }

    protected function __init(string $wording) {
        $this->wording = $wording;
    }

    public function __toString(): string {
        return $this->getWording();
    }
}