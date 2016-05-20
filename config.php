<?php 

return [
   'path'  => 'translations',  // translations directory path
   'input' => 'language',      // url parameter
   'language' => null,         // set current language 'en','de', etc. if null input param will be used to get current language 
   'languages' => [
      'en' => 'English'        // first element is default language 
   ]
];
