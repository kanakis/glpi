<?php
/**
 * Install hook
 *
 * @return boolean
 */
function plugin_npfrm_install() {
   //do some stuff like instantiating databases, default values, ...

   global $DB;
   $config = new Config();
   $config->setConfigurationValues('plugin:NPFrm', ['configuration' => false]);

   ProfileRight::addProfileRights(['npfrm:read']);
   spl_autoload_register('plugin_npforms_autoload');

   $config = new Config();
   $config->setConfigurationValues('plugin:NPfrm', ['configuration' => false]);

   ProfileRight::addProfileRights(['npfrm:read']);

//    $default_charset = DBConnection::getDefaultCharset();
//    $default_collation = DBConnection::getDefaultCollation();
//    $default_key_sign = DBConnection::getDefaultPrimaryKeySignOption();

//    CronTask::Register(NPFrm::class, 'Sample', DAY_TIMESTAMP, ['param' => 50]);
   return true;
}

function plugin_example_install() {
    global $DB;
 
    $config = new Config();
    $config->setConfigurationValues('plugin:Example', ['configuration' => false]);
 
    ProfileRight::addProfileRights(['example:read']);
 
    $default_charset = DBConnection::getDefaultCharset();
    $default_collation = DBConnection::getDefaultCollation();
    $default_key_sign = DBConnection::getDefaultPrimaryKeySignOption();
 
    if (!$DB->tableExists("glpi_plugin_example_examples")) {
       $query = "CREATE TABLE `glpi_plugin_example_examples` (
                   `id` int {$default_key_sign} NOT NULL auto_increment,
                   `name` varchar(255) default NULL,
                   `serial` varchar(255) NOT NULL,
                   `plugin_example_dropdowns_id` int {$default_key_sign} NOT NULL default '0',
                   `is_deleted` tinyint NOT NULL default '0',
                   `is_template` tinyint NOT NULL default '0',
                   `template_name` varchar(255) default NULL,
                 PRIMARY KEY (`id`)
                ) ENGINE=InnoDB DEFAULT CHARSET={$default_charset} COLLATE={$default_collation} ROW_FORMAT=DYNAMIC;";
 
       $DB->query($query) or die("error creating glpi_plugin_example_examples ". $DB->error());
 
       $query = "INSERT INTO `glpi_plugin_example_examples`
                        (`id`, `name`, `serial`, `plugin_example_dropdowns_id`, `is_deleted`,
                         `is_template`, `template_name`)
                 VALUES (1, 'example 1', 'serial 1', 1, 0, 0, NULL),
                        (2, 'example 2', 'serial 2', 2, 0, 0, NULL),
                        (3, 'example 3', 'serial 3', 1, 0, 0, NULL)";
       $DB->query($query) or die("error populate glpi_plugin_example ". $DB->error());
    }
 
    if (!$DB->tableExists("glpi_plugin_example_dropdowns")) {
       $query = "CREATE TABLE `glpi_plugin_example_dropdowns` (
                   `id` int {$default_key_sign} NOT NULL auto_increment,
                   `name` varchar(255) default NULL,
                   `comment` text,
                 PRIMARY KEY  (`id`),
                 KEY `name` (`name`)
                ) ENGINE=InnoDB DEFAULT CHARSET={$default_charset} COLLATE={$default_collation} ROW_FORMAT=DYNAMIC;";
 
       $DB->query($query) or die("error creating glpi_plugin_example_dropdowns". $DB->error());
 
       $query = "INSERT INTO `glpi_plugin_example_dropdowns`
                        (`id`, `name`, `comment`)
                 VALUES (1, 'dp 1', 'comment 1'),
                        (2, 'dp2', 'comment 2')";
 
       $DB->query($query) or die("error populate glpi_plugin_example_dropdowns". $DB->error());
 
    }
 
    if (!$DB->tableExists('glpi_plugin_example_devicecameras')) {
       $query = "CREATE TABLE `glpi_plugin_example_devicecameras` (
                   `id` int {$default_key_sign} NOT NULL AUTO_INCREMENT,
                   `designation` varchar(255) DEFAULT NULL,
                   `comment` text,
                   `manufacturers_id` int {$default_key_sign} NOT NULL DEFAULT '0',
                   PRIMARY KEY (`id`),
                   KEY `designation` (`designation`),
                   KEY `manufacturers_id` (`manufacturers_id`)
                ) ENGINE=InnoDB DEFAULT CHARSET={$default_charset} COLLATE={$default_collation} ROW_FORMAT=DYNAMIC;";
 
       $DB->query($query) or die("error creating glpi_plugin_example_examples ". $DB->error());
    }
 
    if (!$DB->tableExists('glpi_plugin_example_items_devicecameras')) {
       $query = "CREATE TABLE `glpi_plugin_example_items_devicecameras` (
                   `id` int {$default_key_sign} NOT NULL AUTO_INCREMENT,
                   `items_id` int {$default_key_sign} NOT NULL DEFAULT '0',
                   `itemtype` varchar(255) DEFAULT NULL,
                   `plugin_example_devicecameras_id` int {$default_key_sign} NOT NULL DEFAULT '0',
                   `is_deleted` tinyint NOT NULL DEFAULT '0',
                   `is_dynamic` tinyint NOT NULL DEFAULT '0',
                   PRIMARY KEY (`id`),
                   KEY `computers_id` (`items_id`),
                   KEY `plugin_example_devicecameras_id` (`plugin_example_devicecameras_id`),
                   KEY `is_deleted` (`is_deleted`),
                   KEY `is_dynamic` (`is_dynamic`)
                ) ENGINE=InnoDB DEFAULT CHARSET={$default_charset} COLLATE={$default_collation} ROW_FORMAT=DYNAMIC;";
 
       $DB->query($query) or die("error creating glpi_plugin_example_examples ". $DB->error());
    }
 
    // To be called for each task the plugin manage
    // task in class
    CronTask::Register(Example::class, 'Sample', DAY_TIMESTAMP, ['param' => 50]);
    return true;
 }

 

/**
 * Uninstall hook
 *
 * @return boolean
 */
function plugin_npfrm_uninstall() {
    global $DB;
 
    $config = new Config();
    $config->deleteConfigurationValues('plugin:NPFrm', ['configuration' => false]);
 
    ProfileRight::deleteProfileRights(['npfrm:read']);
 
    $notif = new Notification();
    $options = ['itemtype' => 'Ticket',
                'event'    => 'plugin_example',
                'FIELDS'   => 'id'];
    foreach ($DB->request('glpi_notifications', $options) as $data) {
       $notif->delete($data);
    }
    // Old version tables
    if ($DB->tableExists("glpi_dropdown_plugin_npfrm")) {
       $query = "DROP TABLE `glpi_dropdown_plugin_npfrm`";
       $DB->query($query) or die("error deleting glpi_dropdown_plugin_npfrm");
    }
    if ($DB->tableExists("glpi_plugin_npfrm")) {
       $query = "DROP TABLE `glpi_plugin_npfrm`";
       $DB->query($query) or die("error deleting glpi_plugin_npfrm");
    }
    // Current version tables
    if ($DB->tableExists("glpi_plugin_npfrm_npfrm")) {
       $query = "DROP TABLE `glpi_plugin_npfrm_npfrm`";
       $DB->query($query) or die("error deleting glpi_plugin_npfrm_npfrm");
    }
    if ($DB->tableExists("glpi_plugin_npfrm_dropdowns")) {
       $query = "DROP TABLE `glpi_plugin_npfrm_dropdowns`;";
       $DB->query($query) or die("error deleting glpi_plugin_npfrm_dropdowns");
    }
    
    return true;
 }

function plugin_npfrm_display_central()
{
    $config = new Config();
    global $CFG_GLPI;
 
    //$this->initForm($ID, $options);
    //$this->showFormHeader($options);
 
    echo "<tr><th colspan='2'>";
   echo "<div style='text-align:center; font-size:1em'>";
   //echo __("Plugin example displays on central page", "example");
   echo " <div style='text-align:center;color:#DB6116'><a href='/plugins/example/front/example.form.php' title='Πατήστε εδώ για να υποβάλετε αίτημα ή εργασία' onhover=''> Υποβολή αιτήματος - εργασίας </spa> </div>" ; 
   
   //main form 
   
 
//echo $out ; 
      //alx    
      echo "<tr class='tab_bg_1'>";
      echo "<td>" . __('ID') . "</td>";
      echo "<td> ";
      //echo $ID;
      echo "</td>";
    // echo "<tr><th colspan='2'>";
    // echo "<div style='text-align:center; font-size:1em'>";
    // echo __("Plugin example displays on central page", "example");
    // echo " <div style='text-align:center;color:#DB6116'> Υποβολή αιτήματος - εργασίας  </div>" ; 
      
    //    //alx    
    //    echo "<tr class='tab_bg_1'>";
    //    echo "<td>" . __('ID') . "</td>";
    //    echo "<td>ertertert ";
    //    echo $ID;
    //    echo "</td>";
 
       $this->showFormButtons($options);
 // end main form 
 
    $config->showFormExample() ;
    echo "</div>";
    echo "</th></tr>";

}