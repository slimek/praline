<?php
namespace Praline\Utils;

class LetterCase
{
                       //              首字    字頭     分隔
    const CAMEL  = 1;  // camelCase   lower   Upper   (無)
    const PASCAL = 2;  // PascalCase  Upper   Upper
    const KEBAB  = 3;  // kebab-case  lower   Lower   - (dash)
    const SNAKE  = 4;  // snake_case  lower   lower   _ (underscore)

    // 通用轉換函式
    public static function convert(string $name, int $fromStyle, int $toStyle): string
    {
        $words = static::split($name, $fromStyle);
        return static::join($words, $toStyle);
    }

    // 將複合字串按照指定的形式來分割，並全部轉成小寫之後，組成陣列傳回
    public static function split(string $name, int $fromStyle): array
    {
        if ($name === '') {
            return [];
        }

        switch ($fromStyle) {
            case static::KEBAB:
                return explode('-', $name);

            case static::SNAKE:
                return explode('_', $name);
        }

        throw new \Exception('Unsupported style: ' . $fromStyle);
    }

    public static function join(array $words, int $toStyle): string
    {
        switch ($toStyle) {
            case static::CAMEL:
                $name = '';
                if (empty($words)) {
                    return $name;
                }

                $name = $words[0];
                for ($i = 1; $i < count($words); $i++) {
                    $name .= ucfirst($words[$i]);
                }

                return $name;

            case static::PASCAL:
                $name = '';
                if (empty($words)) {
                    return $name;
                }

                for ($i = 0; $i < count($words); $i++) {
                    $name .= ucfirst($words[$i]);
                }

                return $name;
        }

        throw new \Exception('Unsupported style: ' . $toStyle);
    }

    // 特化轉換函式

    // 將 kebab-case 轉換為 camelCase
    public static function kebabToCamel(string $name): string
    {
        if ($name === '') {
            return $name;
        }

        return static::convert($name, static::KEBAB, static::CAMEL);
    }

    // 將 kebab-case 轉換為 PascalCase
    public static function kebabToPascal(string $name): string
    {
        if ($name === '') {
            return $name;
        }

        return static::convert($name, static::KEBAB, static::PASCAL);
    }

    // 將 snake_case 轉換為 camelCase
    public static function snakeToCamel(string $name): string
    {
        if ($name === '') {
            return $name;
        }

        return static::convert($name, static::SNAKE, static::CAMEL);
    }

    // 特化轉換函式：轉換物件的屬性名稱
    // - 注意：如果屬性是陣列或物件，其下的屬性將不受影響

    public static function snakeToCamelAllProperties($obj): \StdClass
    {
        if (is_null($obj)) {
            return null;
        }

        $result = new \StdClass();
        foreach ($obj as $propName => $value) {
            $newPropName = static::snakeToCamel($propName);
            $result->{$newPropName} = $value;
        }

        return $result;
    }
}
