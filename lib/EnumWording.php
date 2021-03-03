<?php

namespace Granule\Util;

use Granule\Util\Exception\InvalidEnumWordingException;

abstract class EnumWording extends Enum implements Hashable {

    private $wording;

    public static function isExistingByWording(string $wording, $strict = false): bool {
        return in_array($wording, self::getValues(), $strict);
    }

    public static function fromWording(string $wording): Enum {
        foreach (self::getValues() as $key => $value) {
            if ($value === $wording) {
                return self::fromValue($key);
            }
        }

        throw new InvalidEnumWordingException(sprintf('Wrong wording: %s', $wording));
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

    public function hash(): string {
        return md5((string)$this);
    }
}
