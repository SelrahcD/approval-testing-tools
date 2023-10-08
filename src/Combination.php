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

            if ($rightResults === []) {
                $result[] = [$value];
            } else {
                foreach ($rightResults as $rightResult) {
                    $result[] = array_merge([$value], $rightResult);
                }
            }
        }

        return $result;
    }

}