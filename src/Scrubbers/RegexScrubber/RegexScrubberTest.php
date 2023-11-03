<?php

declare(strict_types=1);

namespace Selrahcd\ApprovalTestingTools\Scrubbers\RegexScrubber;

use PHPUnit\Framework\TestCase;
use Spatie\Snapshots\MatchesSnapshots;

class RegexScrubberTest extends TestCase
{

    use MatchesSnapshots;

    public static function replacementExamples()
    {
        return [
            [
                'Lucky 7',
                '/\d+/',
                '[number]',
                'Lucky [number]',
            ],
            [
                'Lucky 7',
                '/\d+/',
                'You',
                'Lucky You',
            ],

            [
                'Lucky 7',
                '/\p{L}+/',
                'Hello',
                'Hello 7',
            ],

            [
                '127.0.0.1',
                '/\d+/',
                '[number]',
                '[number].[number].[number].[number]',
            ],
            [
                'My ip is 127.0.0.1',
                '/([0-9]{1,3}.){3}[0-9]{1,3}/',
                '[ip]',
                'My ip is [ip]',
            ],
        ];
    }


    /**
     * @test
     */
    public function replaces_regex_matches_with_a_replacement_string(): void
    {
        $regexScrubber = new RegexScrubber('/\d+/', '[number]');

        $scrubbedText = $regexScrubber->scrub('There is 12 cats leaving at the number 10.');

        $this->assertMatchesSnapshot($scrubbedText);
    }

    /**
     * @test
     * @dataProvider replacementExamples
     */
    public function replaces_regex_matches_with_a_replacement_string_multiple_examples(
        string $originalString,
        string $regexPattern,
        string $replacement,
        string $expectedScrubbedString
    ): void {
        $regexScrubber = new RegexScrubber($regexPattern, $replacement);

        $actualScrubbedString = $regexScrubber->scrub($originalString);

        $this->assertEquals($expectedScrubbedString, $actualScrubbedString);
    }

}
