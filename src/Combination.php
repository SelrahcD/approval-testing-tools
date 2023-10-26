<?php

declare(strict_types=1);

namespace Selrahcd\ApprovalTestingTools;

final class Combination
{
    /**
     * @param list<list<mixed>> ...$lists
     * @return array<list<mixed>>
     */
    public static function generate(...$lists): array
    {

        if ($lists === []) {
            return [];
        }

        $firstList = array_shift($lists);

        $rightResults = self::generate(...$lists);

        $result = [];
        foreach ($firstList as $value) {
            $key = self::valueAsString($value);

            if ($rightResults === []) {
                $result[$key] = [$value];
            } else {
                foreach ($rightResults as $rightResultKey => $rightResult) {
                    $result[$key . ' ' . $rightResultKey] = array_merge([$value], $rightResult);
                }
            }
        }

        return $result;
    }

    private static function valueAsString(mixed $value): string
    {
        return match (gettype($value)) {
            'boolean' => static::convertBoolean($value),
            'object' => static::convertObject($value),
            'string' => $value,
            'integer' => (string) $value,
            'double' => (string) $value,
            'NULL' => 'NULL',
            'array' => static::convertArray($value)
//            default => throw new \Exception("Couldn't convert value to string")
        };
    }

    private static function convertBoolean(bool $value): string
    {
        return $value ? 'true' : 'false';
    }

    private static function convertObject(object $value): string
    {
        if(method_exists($value, '__toString')) {
            return $value->__toString();
        }
        return (new \ReflectionClass($value))->getShortName();
    }

    private static function convertArray(array $value): string
    {
        $res = '[';

        $res .= implode(', ', array_map(fn($x) => static::valueAsString($x), $value));

        $res .= ']';
        return $res;
    }

}