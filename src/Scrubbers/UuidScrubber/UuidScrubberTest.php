<?php

declare(strict_types=1);

namespace Selrahcd\ApprovalTestingTools\Scrubbers\UuidScrubber;

use PHPUnit\Framework\TestCase;
use Spatie\Snapshots\MatchesSnapshots;

class UuidScrubberTest extends TestCase
{

    use MatchesSnapshots;

    /**
     * @test
     */
    public function removes_uuids_from_a_string(): void
    {
        // tag::removes_uuids_from_string_code[]
        $inputString = <<<EOS
Here is a 5c2068a8-7213-42f6-81d7-ef3a270d7bd1,
and here is another one 52276882-9853-4e3d-9e8d-c54c77db03a4
EOS;

        $uuidScrubber = new UuidScrubber();

        $scrubbedText = $uuidScrubber->scrub($inputString);
        // end::removes_uuids_from_string_code[]

        $this->assertMatchesSnapshot($scrubbedText);
    }

    /**
     * @test
     */
    public function reuses_id_for_a_uuid_found_multiple_times(): void
    {
        // tag::reuses_id_for_a_uuid_found_multiple_times[]
        $inputString = <<<EOS
Here is a 5c2068a8-7213-42f6-81d7-ef3a270d7bd1,
and here is another one 52276882-9853-4e3d-9e8d-c54c77db03a4,
and here is the first one again 5c2068a8-7213-42f6-81d7-ef3a270d7bd1
EOS;

        $uuidScrubber = new UuidScrubber();

        $scrubbedText = $uuidScrubber->scrub($inputString);
        // end::reuses_id_for_a_uuid_found_multiple_times[]

        $this->assertMatchesSnapshot($scrubbedText);
    }
}
