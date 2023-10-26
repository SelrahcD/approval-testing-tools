<?php

namespace Selrahcd\ApprovalTestingTools\Fixtures;

final class ObjectWithToString
{

    public function __toString(): string
    {
        return 'Name from to string';
    }
}