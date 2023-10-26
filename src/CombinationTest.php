<?php

declare(strict_types=1);

namespace Selrahcd\ApprovalTestingTools;

use PHPUnit\Framework\TestCase;
use Selrahcd\ApprovalTestingTools\fixtures\ObjectWithoutToString;

class CombinationTest extends TestCase
{
    public static function combinationExamples(): \Generator
    {
        yield [
            [],
            []
        ];

        yield [
            [
                [1]
            ],
            [
                [1]
            ]
        ];

        yield [
            [
                [1],
                [2]
            ],
            [
                [1, 2]
            ]
        ];

        yield [
            [
                [1, 'A']
            ],
            [
                [1],
                ['A']
            ]
        ];

        yield [
            [
                [1, 'A'],
                [2, 'A']
            ],
            [
                [1, 2],
                ['A']
            ]
        ];

        yield [
            [
                [1, 'A'],
                [2, 'A'],
                [3, 'A']
            ]
            ,
            [
                [1, 2, 3],
                ['A']
            ]
        ];

        yield [
            [
                [1, 'A'],
                [1, 'B'],
                [2, 'A'],
                [2, 'B']
            ]
            ,
            [
                [1, 2],
                ['A', 'B']
            ]
        ];

        yield [
            [
                [1, 'A', 'X'],
                [2, 'A', 'X']
            ]
            ,
            [
                [1, 2],
                ['A'],
                ['X']
            ]
        ];

        yield [
            [
                [1, 'A', 'X'],
                [2, 'A', 'X'],
                [3, 'A', 'X']
            ],
            [
                [1, 2, 3],
                ['A'],
                ['X']
            ]
        ];

        yield [
            [
                [1, 'A', 'X'],
                [1, 'B', 'X'],
                [2, 'A', 'X'],
                [2, 'B', 'X']
            ],
            [
                [1, 2],
                ['A', 'B'],
                ['X']
            ]
        ];

        yield [
            [
                [1, 'A', 'X'],
                [1, 'A', 'Y'],
                [1, 'A', 'Z'],
                [1, 'B', 'X'],
                [1, 'B', 'Y'],
                [1, 'B', 'Z'],
                [1, 'C', 'X'],
                [1, 'C', 'Y'],
                [1, 'C', 'Z'],
                [2, 'A', 'X'],
                [2, 'A', 'Y'],
                [2, 'A', 'Z'],
                [2, 'B', 'X'],
                [2, 'B', 'Y'],
                [2, 'B', 'Z'],
                [2, 'C', 'X'],
                [2, 'C', 'Y'],
                [2, 'C', 'Z'],
                [3, 'A', 'X'],
                [3, 'A', 'Y'],
                [3, 'A', 'Z'],
                [3, 'B', 'X'],
                [3, 'B', 'Y'],
                [3, 'B', 'Z'],
                [3, 'C', 'X'],
                [3, 'C', 'Y'],
                [3, 'C', 'Z']
            ],
            [
                [1, 2, 3],
                ['A', 'B', 'C'],
                ['X', 'Y', 'Z']
            ]
        ];
    }

    /**
     * @test
     * @dataProvider combinationExamples
     * @param array<list<mixed>> $lists
     * @param array<list<mixed>> $combinations
     */
    public function generates_all_combinations_based_on_lists_of_values(array $combinations, array $lists): void
    {
        $this->assertEquals($combinations, array_values(Combination::generate(...$lists)));
    }


    /**
     * @test
     * @dataProvider listToCombinationKeyExamples
     * @param array<list<mixed>> $lists
     * @param array<list<mixed>> $keys
     */
    public function indexes_the_generated_combinations_by_a_key_indicating_what_combination_is_generated(array $keys, array $lists): void
    {

        $this->assertEquals($keys, array_keys(Combination::generate(...$lists)));
    }

    public static function listToCombinationKeyExamples(): \Generator
    {
        yield [
            [
                '0',
            ],
            [
                [0],
            ]
        ];

        yield [
            [
                'A',
            ],
            [
                ['A'],
            ]
        ];

        yield [
            [
                'true',
                'false',
            ],
            [
                [true, false],
            ]
        ];

        yield [
            [
                '1.8',
                '-1.8',
            ],
            [
                [1.8, -1.8],
            ]
        ];

        yield [
            [
                'ObjectWithoutToString',
            ],
            [
                [new ObjectWithoutToString],
            ]
        ];

        yield [
            [
                '1 A',
            ],
            [
                [1],
                ['A'],
            ]
        ];

        yield [
            [
                '1 A',
                '2 A',
            ],
            [
                [1, 2],
                ['A'],
            ]
        ];

        yield [
            [
                '1 A',
                '1 B',
            ],
            [
                [1],
                ['A', 'B'],
            ]
        ];

        yield [
            [
                '1 A',
                '1 B',
                '2 A',
                '2 B',
            ],
            [
                [1, 2],
                ['A', 'B'],
            ]
        ];

        yield [
            [
                '1 A X',
                '1 A Y',
                '1 A Z',
                '1 B X',
                '1 B Y',
                '1 B Z',
                '1 C X',
                '1 C Y',
                '1 C Z',
                '2 A X',
                '2 A Y',
                '2 A Z',
                '2 B X',
                '2 B Y',
                '2 B Z',
                '2 C X',
                '2 C Y',
                '2 C Z',
                '3 A X',
                '3 A Y',
                '3 A Z',
                '3 B X',
                '3 B Y',
                '3 B Z',
                '3 C X',
                '3 C Y',
                '3 C Z',
            ],
            [
                [1, 2, 3],
                ['A', 'B', 'C'],
                ['X', 'Y', 'Z']
            ]
        ];


    }
}
