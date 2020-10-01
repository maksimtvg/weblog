<?php

namespace App\Services\Log;

interface WeblogSortInterface
{
    /**
     * @param string $fileName
     * @return array
     */
    public function sort(string $fileName): array;
}
