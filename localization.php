<?php
/**
 * PHP Localization Library
 * 
 * Translate application texts using INI files
 * 
 * @copyright 2016
 * @author Ante Laca <ante.laca@gmail.com>
 * 
 */

class Localization {

    private static 
	$instance = null,
	$settings = [],
	$translations = [];

    private $translationFile;	  	  	  


    private function __construct()
    {

	static::$settings = require 'config.php';

	$this->translationFile = static::$settings['path'] . '/' . $this->getCurrentLanguage() . '.ini';

	if (is_dir(dirname($this->translationFile))) {
         
	    if (file_exists($this->translationFile)) {
		static::$translations = parse_ini_file($this->translationFile);
	    } else {
		if (file_exists($default = static::$settings['path'] . '/' . $this->getDefaultLanguage() . '.ini')) {
		    copy($default, $this->translationFile);
		}
	    }  

	} else {

	    printf('Directory <strong>%s</strong> not exists, check path setting', dirname($this->translationFile)); 
	    exit;

        }  
    }

    /**
    * Localization instance
    * 
    */
    public static function instance()
    {
	if (null === static::$instance) {
	    static::$instance = new self();
	}

	return static::$instance;
    }


    /**
    * Get default language
    * first element in the languages array
    * 
    * @return string 
    */
    public function getDefaultLanguage()
    {
        $languages = static::$settings['languages'];

	reset($languages);

	return key($languages);
    }


    /**
    * Get current language
    * 
    * @return string
    */
    public function getCurrentLanguage()
    {
	if (isset($_GET[static::$settings['input']])) {

	    if (array_key_exists($_GET[static::$settings['input']], $this->getLanguages())) {
	        return $_GET[static::$settings['input']];     
	    }

	}

	return $this->getDefaultLanguage(); 
     }

    /**
    * Get all languages
    * 
    * @return array
    */
    public function getLanguages()
    {
	return static::$settings['languages'];
    }

    /**
    * Get translations
    * 
    * @param array $strings
    * @return {$string|$string[]}
    */
    public function getTranslations($strings = [])
    {
	if (empty($strings)) {
	    return static::$translations;
	}

	$translations = [];

	foreach ($strings as $string) {
	    $translations[$string] = isset(static::$translations[$string]) ? static::$translations[$string] : $this->translate($string);            
	}

	return $translations;

    }

    /**
    * Get json
    * 
    * @return json
    */ 
    public function getJson($strings = [], $options = JSON_UNESCAPED_UNICODE)
    {
	return json_encode($this->getTranslations($strings), $options);   
    }

    /**
    * Translate string
    * 
    * @param string $string
    * @param array $args
    */
    public function translate($string, $args = null)
    {      
	if (array_key_exists($string, static::$translations)) {
	    return is_array($args) ? vsprintf(static::$translations[$string], $args) : static::$translations[$string];
	}

	file_put_contents(static::$translationFile, PHP_EOL . "{$string} = \"{$string}\"", FILE_APPEND | LOCK_EX);      

	return is_array($args) ? vsprintf($string, $args) : static::$translations[$string] = $string;    
    }

}

/**
* helper function
*/
function __($string, $args = null)
{   
    return Localization::instance()->translate($string, $args);
}
