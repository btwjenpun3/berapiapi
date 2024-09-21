<?php

namespace App\Traits;

trait BuildQueries
{
    public function buildQueries(array $queries): array
    {
        $queryParam = [];

        foreach ($queries as $query) {
            $queryParam[$query['parameter']] = $query['value'];
        }

        return $queryParam;
    }
}