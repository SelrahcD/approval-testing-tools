<?php

namespace Selrahcd\ApprovalTestingTools\Combination\fixtures;

final class ObjectWithToString
{

    public function __toString(): string
    {
        return 'Name from to string';
    }
}