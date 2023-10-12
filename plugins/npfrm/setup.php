<?php 

use Glpi\Plugin\Hooks;
use GlpiPlugin\Example\Computer;
use GlpiPlugin\Example\Config;
use GlpiPlugin\Example\Dropdown;
use GlpiPlugin\Example\DeviceCamera;
use GlpiPlugin\Example\Example;
use GlpiPlugin\Example\Filters\ComputerModelFilter;
use GlpiPlugin\Example\ItemForm;
use GlpiPlugin\Example\Centralform ; 
use GlpiPlugin\Example\RuleTestCollection;
use GlpiPlugin\Example\Showtabitem;

define('NPFRM_VERSION', '0.1.1');

/**
 * Init the hooks of the plugins - Needed
 *
 * @return void
 */
function plugin_init_npfrm() {
   global $PLUGIN_HOOKS;

   //required!
   $PLUGIN_HOOKS['csrf_compliant']['npfrm'] = true;

   $PLUGIN_HOOKS[Hooks::DISPLAY_CENTRAL]['npfrm'] ="plugin_npfrm_display_central";
   //some code here, like call to Plugin::registerClass(), populating PLUGIN_HOOKS, ...
}

/**
 * Get the name and the version of the plugin - Needed
 *
 * @return array
 */
function plugin_version_npfrm() {
   return [
      'name'           => 'NPFrm ',
      'version'        => NPFRM_VERSION,
      'author'         => 'it@np-asfalistiki.gr',
      'license'        => 'GLPv3',
      'homepage'       => 'http://np-asfalistiki.gr',
      'requirements'   => [
         'glpi'   => [
            'min' => '9.1'
         ]
      ]
   ];
}

/**
 * Optional : check prerequisites before install : may print errors or add to message after redirect
 *
 * @return boolean
 */
function plugin_npfrm_check_prerequisites() {
   //do what the checks you want
   return true;
}

/**
 * Check configuration process for plugin : need to return true if succeeded
 * Can display a message only if failure and $verbose is true
 *
 * @param boolean $verbose Enable verbosity. Default to false
 *
 * @return boolean
 */
function plugin_npfrm_check_config($verbose = false) {
   if (true) { // Your configuration check
      return true;
   }

   if ($verbose) {
      echo "Installed, but not configured";
   }
   return false;
}

/**
 * Optional: defines plugin options.
 *
 * @return array
 */
function plugin_npfrm_options() {
   return [
      Plugin::OPTION_AUTOINSTALL_DISABLED => true,
   ];
}
