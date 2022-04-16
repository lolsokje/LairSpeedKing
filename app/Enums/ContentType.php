<?php

namespace App\Enums;

use Illuminate\Support\Collection;

enum ContentType: int
{
    case BASE = 1;
    case DLC = 2;
    case MOD = 3;

    public static function forRepresentation(): array
    {
        $types = [];

        foreach (self::cases() as $case) {
            $types[$case->value] = $case->getName();
        }
        return $types;
    }

    public function getName(): string
    {
        return match ($this) {
            self::BASE => 'Base',
            self::DLC => 'DLC',
            self::MOD => 'Mod',
        };
    }
}
