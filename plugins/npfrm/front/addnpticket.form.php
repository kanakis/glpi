<?php

/**
 * -------------------------------------------------------------------------
 * Example plugin for GLPI
 * -------------------------------------------------------------------------
 *
 * LICENSE
 *
 * This file is part of Example.
 *
 * Example is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * Example is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Example. If not, see <http://www.gnu.org/licenses/>.
 * -------------------------------------------------------------------------
 * @copyright Copyright (C) 2006-2022 by Example plugin team.
 * @license   GPLv2 https://www.gnu.org/licenses/gpl-2.0.html
 * @link      https://github.com/pluginsGLPI/example
 * -------------------------------------------------------------------------
 */

// ----------------------------------------------------------------------
// Original Author of file:
// Purpose of file:
// ----------------------------------------------------------------------

//use GlpiPlugin\Example\AddNPTicket;
use  Glpi\Event ;
use GlpiPlugin\Example\Centralform;
use glpi\Debug ;
use DbUtils ; 
ini_set( "display_errors",1) ;
error_reporting(E_ALL);

//echo('Got In!'); 
//echo pathinfo('../../../inc/includes.php')['dirname'];
//include ('/inc/includes.php');
include ('../../../inc/includes.php');
//print_r($_POST); 
//echo('Get ');
//print_r($_GET); 
//echo('Got In 2!');
$typeOfSubmition = $_POST['requestType']; 

$contentToAdd =  $_POST['RequestDescription']."<br>";
$contentToAdd .= "Κλάδος/Τμήμα :".$_POST['klados']."<br>";
$contentToAdd .= "Προτεραιότητα :".$_POST['priority']."<br>"  ;
$contentToAdd .= "Είδος αίτησης :".$_POST['requestType']."<br>"; 
$contentToAdd .= "Ονομ/νυμο χρήστη που αφορούν οι αλλαγές :".$_POST['UserFor']."<br>";
if(($typeOfSubmition=='1.Προσθήκη δικαιωμάτων χρήστη.')||
   ($typeOfSubmition=='2.Αφαίρεση δικαιωμάτων χρήστη.')||
   ($typeOfSubmition=='3.Νέος σταθμός εργασίας/Δικαιώματα χρήστη.'))
   {
      if($_POST['irp']=='Ναι') {$contentToAdd .= "IRP-Κύρια ασφαλιστική εφαρμογή : ".$_POST['irp']."<br>" ; }
      if($_POST['portalaccess']=='Ναι') {$contentToAdd .= "PORTAL : ".$_POST['portalaccess']."<br>" ; } 
      if($_POST['NPBank']=='Ναι') {$contentToAdd .= "NP BANK : ".$_POST['NPBank']."<br>" ; } 
      if($_POST['NPReports']=='Ναι') {$contentToAdd .= "NP REPORTS : ".$_POST['NPReports']."<br>" ; } 
      if($_POST['msoutlook']=='Ναι') {$contentToAdd .= "MS OUTLOOK : ".$_POST['msoutlook']."<br>" ; } 
      if($_POST['msoffice']=='Ναι') {$contentToAdd .= "MS OFFICE : ".$_POST['msoffice']."<br>" ; } 
      if($_POST['faxserver']=='Ναι') {$contentToAdd .= "FAX SERVER : ".$_POST['faxserver']."<br>" ; } 
      if($_POST['internetCheck']=='Ναι') {$contentToAdd .= "INTERNET : ".$_POST['internetCheck']."<br>" ; } 
      if($_POST['MISOldCheck']=='Ναι') { $contentToAdd .= "MIS(ΠΑΛΑΙΟ) : ".$_POST['MISOldCheck']."<br>" ; } 
      if($_POST['MISNewCheck']=='Ναι') {$contentToAdd .= "MIS(ΝΕΟ) : ".$_POST['MISNewCheck']."<br>" ; } 
      if($_POST['PapyrusCheck']=='Ναι') {$contentToAdd .= "PAPYRUS : ".$_POST['PapyrusCheck']."<br>" ; } 
      if($_POST['testirp']=='Ναι') {$contentToAdd .= "TEST IRP : ".$_POST['testirp']."<br>" ; } 
      if($_POST['testportalcheck']=='Ναι') {$contentToAdd .= "TEST PORTAL : ".$_POST['testportalcheck']."<br>" ; } 
      if($_POST['PayrollCheck']=='Ναι') {$contentToAdd .= "Πρόγραμμα μισθοδοσίας : ".$_POST['PayrollCheck']."<br>" ; } 
      if($_POST['SolvencyCheck']=='Ναι') {$contentToAdd .= "Solvency II - Systemic : ".$_POST['SolvencyCheck']."<br>" ; } 
      if($_POST['YSAECheck']=='Ναι') {$contentToAdd .= "ΥΣΑΕ : ".$_POST['YSAECheck']."<br>" ; } 
      if($_POST['GDACheck']=='Ναι') {$contentToAdd .= "ΓΔΑ : ".$_POST['GDACheck']."<br>" ; } 
      if($_POST['HICCheck']=='Ναι') {$contentToAdd .= " HIC : ".$_POST['HICCheck']."<br>" ; } 
      if($_POST['investProgrammCheck']=='Ναι') {$contentToAdd .= "Επενδυτικό πρόγραμμα : ".$_POST['investProgrammCheck']."<br>" ; } 
      if($_POST['CommonDeptFiles']=='Ναι') {$contentToAdd .= "Κοινόχρηστα αρχεία τμήματος : ".$_POST['CommonDeptFiles']."<br>" ; } 
      if($_POST['agentsCheck']=='Ναι') {$contentToAdd .= "AGENTS : ".$_POST['agentsCheck']."<br>" ; } 
      if($_POST['CustomAccessText']=='Ναι') {$contentToAdd .= "Custom SW : ".$_POST['CustomAccessText']."<br>" ; } 
      if($_POST['InternetPages']=='Ναι') {$contentToAdd .= "Σελίδες Internet : ".$_POST['InternetPages']."<br>" ; } 
      if($_POST['cddvd']=='Ναι') {$contentToAdd .= "CD\DVD : ".$_POST['cddvd']."<br>" ; } 
      if($_POST['usbdisk']=='Ναι') {$contentToAdd .= "Usb Disk : ".$_POST['usbdisk']."<br>" ; } 
      if($_POST['camera']=='Ναι') {$contentToAdd .= "Camera : ".$_POST['camera']."<br>" ; } 
      if($_POST['customhw']=='Ναι') {$contentToAdd .= "Custom HW : ".$_POST['customhw']."<br>" ; } 
    }
     
 
//echo($contentToAdd) ; 
$ticket = new Ticket();
$ticket->add([
  'name' => $_POST['TitleTxt'],
  'description' => $_POST['RequestDescription'] ,
  'content' => $contentToAdd,
  'Assigned' => 'a.charonitakis@np-asfalistiki.gr'
]);

if ($_SESSION["glpiactiveprofile"]["interface"] == "central") {
   //echo('Got In 3'); 
   Html::header("TITRE", $_SERVER['PHP_SELF'], "plugins", Example::class, "");
} else {
  // echo('Got In! 4'); 
   Html::helpHeader("TITRE", $_SERVER['PHP_SELF']);
}
//echo "before Post IF!"; 
//echo var_dump($_POST); 
// if ($_POST && isset($_POST['addnpticket']) && isset($_POST['id']))
// {
//    echo('Got In! 5'); 
//    if(!isset($_POST['title'])or empty($_POST['title']))
//    {
//       echo('Got In! 6'); 
//       Html:displayErrorAndDie('Παρακαλώ δώστε έναν τίτλο');
//    }
// }
// echo('dssdfdfdsfdsfdfds');
//echo('Got In! 7 '); 

//$result = $DB =>$query("Select * from glpi_plugin_example_examples") ; 

ini_set( "display_errors",1) ;
error_reporting(E_ALL); 
$newexample = new \GlpiPlugin\Example\Centralform;
//echo "rrrrr";
$newexample->testCC(); 
//$example->display($_POST);
//$example->canCreate() ; 
$newexample->centralrequestform($_POST) ; 
//$example->display($_GET);
echo('Got In! 8'); 
Html::footer();
 
//echo('Got In! 10'); 
include (GLPI_ROOT . "/front/dropdown.common.form.php");