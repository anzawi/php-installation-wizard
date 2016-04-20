<?php namespace Wizaraty\Classes;

class Url
{
	private $_sitePath = '';
    
    public function __construct($sitePath = null)
    {
        $this->_sitePath = $this->removeSlash($sitePath);
    }

    function __toString()
    {
        if(is_null($this->_sitePath))
        {
            return "NULL";
        }
        return $this->_sitePath;
    }

    private function removeSlash($string)
    {
        if($string[strlen($string) - 1] == '/')
        {
            $string = rtrim($string, '/');
        }

        return $string;
    }

     public function segment($segment)
    {
        $url = str_replace($this->_sitePath, "", $_SERVER['REQUEST_URI']);

        $url = explode('/', $url);
        
        if(in_array(end($url), Config::get('enabled_lang')))
        {
            unset($url[end($url)]);
        }

        if(isset($url[$segment]) && !empty($url[$segment]))
        {
           
            return $url[$segment];
        }

        return false;
    }


    public function getassets()
    {
        return $this->_sitePath . '/assets/';
    }
}