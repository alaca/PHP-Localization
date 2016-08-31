# PHP Localization Library


It can determine the current page language from a given request variable or default to the first language in an array of supported language settings defined in the config.php script.

The class loads the texts for the current language from a INI file.

It also returns the application strings translated for the current language. The string may be formatted with optional parameters as defined for sprintf.

If the chosen language translations file does not exist, the class writes a new file for that language based on the default language texts.

###Setting it up
```php

Localization::settings([
   'path'  => 'translations', // translation files directory path | translations is default
   'input' => 'language',     // url parameter | language is default
   'languages' => [           // languages, first language is default
      'en' => 'English',
      'de' => 'Deutsch',
      'it' => 'Italiano'
   ]   
]);

```

###Translating strings
```php
 echo __('Site title'); 

 echo __('Site %s', ['title']); 

 echo Localization::instance()->translate('Site %s', ['title']); 
```
