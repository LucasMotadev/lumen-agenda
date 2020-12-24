<?php

namespace App\Utils;

class Url
{

    private $url;
    public $baseUrl = false;
    public $resource = false;

    public function __construct($url)
    {
        $this->url = $url;
        $this->setBaseUrl();
    }

    public  function setBaseUrl()
    {
        $count = preg_match('/(?<=^\/)\w{1,}/i', $this->url, $base);
        if ($count)  $this->baseUrl = $base[0];
    }


    public function setResourceUrl()
    {
        $count = preg_match('/(?<=\/' . $this->baseUrl . '\/)(\w{1,}-\w{1,}|\w{1,})/i', $this->url, $resource);
        if ($count) $this->resource =  $resource[0];
    }

    public function getRouteFileName()
    {
        if ($this->resource) {
            return '/' . $this->baseUrl . '/' . To::snackCaseToCamelCase($this->resource) . '.php';
        }
    }
}
