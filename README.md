# PHP Localization Library

### Setting it up config.php
```php

return [
   'path'  => 'translations', // translation files directory path | translations is default
   'input' => 'language',     // url parameter | language is default
   'languages' => [           // languages, first language is default
      'en' => 'English',
      'de' => 'Deutsch',
      'it' => 'Italiano'
   ]   
];

```

### Translating strings
```php
 echo __('Site title'); 

 echo __('Site %s', ['title']); 

 echo Localization::instance()->translate('Site %s', ['title']); 
```
