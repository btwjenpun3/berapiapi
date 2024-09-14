<?php

namespace App\Traits;

trait ConvertArrayEmptyStringToNull
{
    /**
     * Convert empty strings in an array to null.
     *
     * @param array $array
     * @return array
     */
    public function convertArrayEmptyStringToNull(array $array): array
    {
        try {
            $result = $array; 

            foreach ($result as $key => &$value) {
                
                if ($value['value'] === "") {
                    $value['value'] = null;
                }

                
                if ($value['parameter'] === "") {
                    $value['parameter'] = null;
                }
            }

            unset($value); 

            return $result;
            
        } catch (\Exception $e) {
            throw new \Exception('Theres an error while trying converting array');
        }        
    }
}