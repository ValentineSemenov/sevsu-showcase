<?php

namespace App\Contracts;

interface TagContract
{
    public function getTags(string $taskId): array;
}
