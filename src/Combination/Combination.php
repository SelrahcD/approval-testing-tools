<?php

declare(strict_types=1);

namespace Selrahcd\ApprovalTestingTools\Combination;

use Selrahcd\ApprovalTestingTools\ValuePrinter;

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
        return ValuePrinter::valueAsString($value);
    }

    private static function convertBoolean(bool $value): string
    {
        return ValuePrinter::convertBoolean($value);
    }

    private static function convertObject(object $value): string
    {
        return ValuePrinter::convertObject($value);
    }

    /**
     * @param mixed[] $value
     */
    private static function convertArray(array $value): string
    {
        return ValuePrinter::convertArray($value);
    }

}