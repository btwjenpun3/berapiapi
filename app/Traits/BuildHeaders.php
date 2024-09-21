<?php

namespace App\Traits;

trait BuildHeaders
{
    public function buildHeaders(array $headers): array
    {
        //Build Headers
        $headerParam = [];

        foreach ($headers as $header) {
            if (isset($header['parameter'], $header['value'])) {
                $headerParam[$header['parameter']] = $header['value'];
            }            
        }

        return $headerParam;
    }
}