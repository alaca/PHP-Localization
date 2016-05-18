Setting it up, dont forget to include the class first

<?php 

Localization::settings([
   'path'  => 'translations', // translations directory path
   'input' => 'language',     // url parameter
   'languages' => [           // languages, first language is default
      'en' => 'English',
      'de' => 'Deutsch',
      'it' => 'Italiano'
   ]   
]);

?>

If translation file not exists, it will be created automatically


Translating strings

<?php echo __('Site title'); ?>

or

<?php echo __('Site %s', ['title']); ?>

or

<?php echo Localization::instance()->translate('Site %s', ['title']); ?> 
