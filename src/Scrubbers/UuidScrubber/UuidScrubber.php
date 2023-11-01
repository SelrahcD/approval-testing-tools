<?php

namespace Selrahcd\ApprovalTestingTools\Scrubbers\UuidScrubber;

final class UuidScrubber
{
    public function scrub(string $inputString): string
    {
        preg_match_all('/[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}/', $inputString, $matches);

        $uuids = $matches[0];

        $uuidToId = array_flip(array_unique($uuids));

        $uuidToNameId = array_map(fn ($id) => 'UUID_' . $id, $uuidToId);

        return str_replace(array_keys($uuidToNameId), $uuidToNameId, $inputString);
    }
}