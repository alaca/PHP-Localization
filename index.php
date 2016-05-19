<?php

// include localization class
include 'localization.php';

// settings
$localization = Localization::settings([
   'languages' => [           // languages, first language is default
      'en' => 'English',
      'de' => 'Deutsch',
      'it' => 'Italiano'
   ]   
]);

?>
<html lang="<?php echo $localization->getCurrentLanguage(); ?>">
<head>
   <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
   <title><?php echo __('Site title'); ?></title>
</head>
<body>
   <h1><?php echo __('Welcome to our site'); ?></h1>
   <hr />
      
   <ul>
      <?php foreach($localization->getLanguages() as $code => $name): ?>
         <li>
            <a href="?language=<?php echo $code; ?>"><?php echo $name; ?></a>
         </li>
      <?php endforeach; ?>
   </ul>
      
   <hr />
      
   <?php echo __('Current language key code is %s', [$localization->getCurrentLanguage()]); ?>
   <br /><br />
      
   <?php echo __('Translate function can take multiple params like %s and %s', ['this', 'that']); ?>
   <br /><br />
      
   <?php echo Localization::instance()->translate('You can call it like this'); ?> ;
   <br /><br />
      
      
      
</body>
</html>
