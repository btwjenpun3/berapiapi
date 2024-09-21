<?php

namespace App\Traits;

trait BuildEndpoint
{
    public function buildEndpoint(array $pathParameters, string $endpoint)
    {
        if (count($pathParameters) >= 1) {
            foreach ($pathParameters as $param) {
                $parameter = $param['parameter'];
                $value = $param['value'];
                $endpoint = str_replace('{' . $parameter . '}', $value, $endpoint);
            }
        } else {
            $endpoint = $endpoint;
        }
        
        return $endpoint;
    }
}