<?php

namespace Selrahcd\ApprovalTestingTools\Scrubbers\RegexScrubber;

final class CouldNotScrubUsingRegex extends \Exception
{

    public static function becauseAnErrorOccurred(string $inputString, string $regexPattern, string $replacement): self
    {
        $exceptionMessage = <<<EOM
An error occurred while scrubbing string using a regex.
Input string: $inputString
Regex pattern : $regexPattern
Replacement: $replacement
EOM;
;
        return new self($exceptionMessage);
    }
}