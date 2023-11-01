<?php

namespace Selrahcd\ApprovalTestingTools;

final class ValuePrinter
{
    public static function valueAsString(mixed $value): string
    {
        return match (gettype($value)) {
            'boolean' => self::convertBoolean($value),
            'object' => self::convertObject($value),
            'string' => $value,
            'integer' => (string)$value,
            'double' => (string)$value,
            'NULL' => 'NULL',
            'array' => self::convertArray($value),
            default => throw new \Exception("Couldn't convert value to string")
        };
    }

    /**
     * @param mixed[] $value
     */
    private static function convertArray(array $value): string
    {
        $res = '[';

        $res .= implode(', ', array_map(fn($x) => self::valueAsString($x), $value));

        $res .= ']';
        return $res;
    }

    private static function convertObject(object $value): string
    {
        if (method_exists($value, '__toString')) {
            return $value->__toString();
        }
        return (new \ReflectionClass($value))->getShortName();
    }

    private static function convertBoolean(bool $value): string
    {
        return $value ? 'true' : 'false';
    }
}