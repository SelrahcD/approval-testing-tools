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
            $paramList = [$value];

            if ($rightResults === []) {
                $result[] = $paramList;
            } else {
                foreach ($rightResults as $rightResult) {
                    $paramList = array_merge($paramList, $rightResult);
                    $result[] = $paramList;
                    $paramList = [$value];
                }
            }
        }

        return $result;
    }

}