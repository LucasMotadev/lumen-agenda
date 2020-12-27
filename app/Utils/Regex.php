<?php

namespace App\Utils;

class Regex
{

    private $regex = '/(';

    //retorna a regex string
    public function get(string $flags = ''): string
    {
        #i - case insensitive
        #m - multiple 
        # etc...
        return substr($this->regex, 0, -1) .  ')/' . $flags;
    }

    public  function pattern(string $pattern, $separetor = '')
    {
        $this->regex .= $pattern . $separetor;

        return $this;
    }

    public function email($position = null)
    {
        $patternEmail =  [
            '.com.br' => '.+@\w+\.com\.br',
            '.com' => '.+@\w+\.com',
            '.edu.br' => '.+@\w+\.edu\.br',
            'defalt' => '.+@\w+(\.\w+\.\w+|\.\w+)'
        ];


        $this->regex .= $this->onePositonOrAll($position, $patternEmail);
        return $this;
    }


    public function cpf()
    {
        $this->regex  .= '\d{3}\.\d{3}\.\d{3}-\d{2}|';
        return $this;
    }

    public function date($position = null)
    {
        $patterDate = [
            'pt' => '^\d{2}(-|\/)\d{2}(-|\/)\d{4}',
            'en' => '^\d{4}(-|\/)\d{2}(-|\/)\d{2}'
        ];
        $this->regex .= $this->onePositonOrAll($position, $patterDate);
        return $this;
    }

    public function dateTime($position = null)
    {
        $patterDateTime = [
            '^\d{2}(-|\/)\d{2}(-|\/)\d{4}\s\d{2}:\d{2}:\d{2}',
            '^\d{4}(-|\/)\d{2}(-|\/)\d{2}\s\d{2}:\d{2}:\d{2}'
        ];
        $this->regex .= $this->onePositonOrAll($position, $patterDateTime);
        return $this;
    }


    public function onePositonOrAll($position = null, array $arrRegex)
    {

        if (!empty($position)) {

            if (!key_exists($position, $arrRegex)) throw new \Exception("positon $position not found ", 1);

            return $arrRegex[$position] . '|';
        }

        return  implode('|', $arrRegex) . '|';
    }
}
