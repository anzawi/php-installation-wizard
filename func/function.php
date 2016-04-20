<?php 
use \Wizaraty\Classes as Wiz;

/**
 * __()
 * get $string translation from .json file useing Translate class
 * look to Translate class to more information about functionality
 * @param mixed $string
 * @return mixed
 */
function __($string, $lang = ''){
    $translate = new Wiz\Translate($lang);
    echo $translate->getTranslate($string);
}
function _x($string, $lang = ''){
    $translate = new Wiz\Translate(strtolower($lang));
    return $translate->getTranslate($string);
}



/**
 * currentLang()
 * get curren language 
 * @return string
 */
function currentLang()
{
    if(isset($_SESSION['lang']))
        return $_SESSION['lang'];
    //return isset($_GET['lang']) ? htmlentities($_GET['lang']) : defualtLang();
    $lang = rtrim($_SERVER['REQUEST_URI'] , '/');
    $lang = explode('/', $lang);
    $lang = end($lang);

    if(!in_array($lang, Wiz\Config::get('enabled_lang')))
    {
        return defualtLang();
    }
    
    return strtolower($lang);

}

function defualtLang()
{
	return Wiz\Config::get('enabled_lang')[0];
}

function languageLocalCode($lang)
{
	return (isset(Wiz\Config::get('local_lang')[$lang]) ?Wiz\Config::get('local_lang')[$lang] : Wiz\Config::get('local_lang')[defualtLang()]);
}

function rtl($lang)
{
    if(isset(Wiz\Config::get('lang_dir')[$lang]))
    	if(Wiz\Config::get('lang_dir')[$lang] == 'rtl')
    	{
    		return true;
    	}
	return false;
}

function languageName($lang)
{
    return isset(Wiz\Config::get('language_name')[$lang]) ? Wiz\Config::get('language_name')[$lang] :false;
}