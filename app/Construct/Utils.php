<?php

namespace App\Construct;

class Utils 
{

    public function methodToCamelcase($name)
    {

        $arrName = explode('_', strtolower($name));
        $newName = '';
        foreach ($arrName as $key => $value) {

            if ($key === 0) {
                $newName = $value;
            } else {

                $newName .= ucfirst($value);
            }
        }

        return $newName;
    }

    public function classToCamelcase($name)
    {
  
      $arrName = explode('_', strtolower($name));
      $newName = '';
  
      foreach ($arrName as  $value) {
        $newName .= ucfirst($value);
      }
  
      return $newName;
    }
}
