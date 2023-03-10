<?php

declare(strict_types=1);

namespace MeiliSearch\Contracts\Index;

use MeiliSearch\Contracts\Data;

class TypoTolerance extends Data implements \JsonSerializable
{
    public function jsonSerialize(): object
    {
        return (object) $this->getIterator()->getArrayCopy();
    }
}
