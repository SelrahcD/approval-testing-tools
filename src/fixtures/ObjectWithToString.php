<?php

namespace Selrahcd\ApprovalTestingTools\fixtures;

final class ObjectWithToString
{

    public function __toString(): string
    {
        return 'Name from to string';
    }
}