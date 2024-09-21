<?php

namespace App\Traits;

trait BuildHttpQuery
{
    public function buildHttpQuery(array $queryParam): string
    {  
        if (count($queryParam) >= 1) {
            // Filter parameter yang bernilai null
            $filteredQueryParam = array_filter($queryParam, function($value) {
                return !is_null($value) && !($value === ''); // Hanya menyertakan yang bukan null
            });
        
            // Jika ada parameter yang tersisa setelah filtering
            if (count($filteredQueryParam) >= 1) {
                // Bangun query string dari query parameters yang telah difilter
                $queryString = '?' . http_build_query($filteredQueryParam);
        
                // Gabungkan endpoint dengan query string
                return $queryString;
            } else {
                // Jika tidak ada parameter setelah filtering
                return '';
            }
        } else {
            // Jika array kosong
            return '';
        }
    }
}