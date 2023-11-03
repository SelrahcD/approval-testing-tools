<?php

namespace Selrahcd\ApprovalTestingTools\Scrubbers\RegexScrubber;

final class RegexScrubber
{
    public function __construct(
        private readonly string $regexPattern,
        private readonly string $replacement)
    {
    }

    public function scrub(string $inputString): string
    {
        return preg_replace($this->regexPattern, $this->replacement, $inputString);
    }
}