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
            $key = ValuePrinter::valueAsString($value);

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

}