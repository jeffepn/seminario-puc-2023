<?php

namespace App\Enums;

final class TypeUser
{
    public const TYPE_SELLER = 1;
    public const TYPE_CLIENT = 2;
    public const TYPE_USER = 3;

    public static function all(): array
    {
        return [
            self::TYPE_SELLER => self::TYPE_SELLER,
            self::TYPE_CLIENT => self::TYPE_CLIENT,
            self::TYPE_USER => self::TYPE_USER,
        ];
    }

    public static function getNameResourceUser(int $type): string
    {
        $names = [
            self::TYPE_SELLER => NameResource::SELLER,
            self::TYPE_CLIENT => NameResource::CLIENT,
            self::TYPE_USER => NameResource::USER,
        ];

        return $names[$type];
    }
}
