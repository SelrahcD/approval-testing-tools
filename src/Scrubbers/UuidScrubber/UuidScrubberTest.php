<?php

declare(strict_types=1);

namespace Selrahcd\ApprovalTestingTools\Scrubbers\UuidScrubber;

use PHPUnit\Framework\TestCase;

class UuidScrubberTest extends TestCase
{

    /**
     * @test
     */
    public function removes_uuids_from_a_string(): void
    {
        $inputString = <<<EOS
Here is a 5c2068a8-7213-42f6-81d7-ef3a270d7bd1,
and here is another one 52276882-9853-4e3d-9e8d-c54c77db03a4
EOS;

        $uuidScrubber = new UuidScrubber;

        $actualScrubbedText = $uuidScrubber->scrub($inputString);

        $expectedScrubbedText = <<<EOS
Here is a UUID_0,
and here is another one UUID_1
EOS;
;
        $this->assertEquals($expectedScrubbedText, $actualScrubbedText);
    }
}
