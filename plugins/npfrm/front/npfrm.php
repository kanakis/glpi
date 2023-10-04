<?php
use GlpiPlugin\NPFrmplugin\NPFrmObject;
include ("../../../inc/includes.php");

// Check if plugin is activated...
$plugin = new Plugin();
if (!$plugin->isInstalled('npfrmplugin') || !$plugin->isActivated('npfrmplugin')) {
   Html::displayNotFoundError();
}

//check for ACLs
if (MyObject::canView()) {
   //View is granted: display the list.

   //Add page header
   Html::header(
      __('My example plugin', 'npfrmplugin'),
      $_SERVER['PHP_SELF'],
      'assets',
      MyObject::class,
      'myobject'
   );

   Search::show(MyObject::class);

   Html::footer();
} else {
   //View is not granted.
   Html::displayRightError();
}