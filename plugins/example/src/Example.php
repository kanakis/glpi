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

namespace GlpiPlugin\Example;

use CommonDBTM;
use CommonGLPI;
use Computer;
use Html;
use Log;
use MassiveAction;
use Session;
use Ticket ;
use User;

// Class of the defined type
class Example extends CommonDBTM {

   static $tags = '[EXAMPLE_ID]';

   // Should return the localized name of the type
   static function getTypeName($nb = 0) {
      return 'Υποβολή Αιτήματος';
   }


   static function canCreate() {

      if (isset($_SESSION["glpi_plugin_example_profile"])) {
         return ($_SESSION["glpi_plugin_example_profile"]['example'] == 'w');
      }
      return false;
   }


   static function canView() {

      if (isset($_SESSION["glpi_plugin_example_profile"])) {
         return ($_SESSION["glpi_plugin_example_profile"]['example'] == 'w'
                 || $_SESSION["glpi_plugin_example_profile"]['example'] == 'r');
      }
      return false;
   }


   /**
    * @see CommonGLPI::getMenuName()
   **/
   static function getMenuName() {
      return __('NP Example plugin');
   }


   /**
    * @see CommonGLPI::getAdditionalMenuLinks()
   **/
   static function getAdditionalMenuLinks() {
      global $CFG_GLPI;
      $links = [];

      $links['config'] = '/plugins/example/index.php';
      $links["<img  src='".$CFG_GLPI["root_doc"]."/pics/menu_showall.png' title='".__s('Show all')."' alt='".__s('Show all')."'>"] = '/plugins/example/index.php';
      $links[__s('Test link', 'example')] = '/plugins/example/index.php';

      return $links;
   }

   function defineTabs($options = []) {

      $ong = [];
      $this->addDefaultFormTab($ong);
      $this->addStandardTab('Link', $ong, $options);

      return $ong;
   }


   public function returnUsers()
   {
      global $CFG_GLPI, $DB;
      global $LANG;

      ini_set( "display_errors",1) ;
      error_reporting(E_ALL); 
      $query = "SELECT * FROM glpi.glpi_users " ; // where "; // user_dn <> '' and is_active=1 ";
      $result = $DB->query($query);
      $numberOfRows = $DB->numrows($result);
      $data = $DB->fetch_array($result);

      return ; 
   }

   function showForm_Exp($ID, array $options = []) {
      
      global $CFG_GLPI ,$DB;
      global $LANG;
      $pmContact = new PluginMonitoringContact();
      $this->initForm($ID, $options);
      $this->showFormHeader($options);

      
      $this->showFormButtons(); 
      $this->showFormFooter($options);

      return TRUE; 
   }

   /*
   * Example form 
   *   *    * 
   *    */
   /**
    * Summary of showForm
    * @param mixed $ID
    * @param array $options
    * @return bool|string
    */
   function showForm($ID, array $options = []) {
      
      global $CFG_GLPI , $DB;
      
      $this->initForm($ID, $options);
      $this->showFormHeader($options);

      // $backtrace = debug_backtrace();
      // print_r( $backtrace );

      //alx
      if (!isset($options['display'])) {
         //display per default
         $options['display'] = true;
      }
      ini_set( "display_errors",1) ;
      error_reporting(E_ALL); 
      //returnUsers(); 
      $query = "SELECT * FROM glpi.glpi_users where  user_dn <> '' and is_active=1 ";
      $result = $DB->query($query);
      $numberOfRows = $DB->numrows($result);
      //echo "Rows:".$numberOfRows ;
     //print_r($result);
      //$data = $DB->fetch_array($result);

      $params = $options;
      //do not display called elements per default; they'll be displayed or returned here
      $params['display'] = false ;
      // ***************************************************************************************
      $out ="</td></tr><tr><td>
      <script>
      var jsAccessRights=false ; 
      //console.log 'ACR :' + jsAccessRights ;
      function handleChange(checkbox) {
         if(checkbox.checked == true){
            jsAccessRights= true; 
            //console.log 'ACR :' + jsAccessRights ;
             //document.getElementById('submit').removeAttribute('disabled');
         }else{
            if(jsAccessRights==false){}

            //document.getElementById('submit').setAttribute('disabled', 'disabled');
        }
     }
     // function setACR(){jsAccessRights= True ; return }
      function showBlocks(){
          console.log('showBlocks');
          var getSelectValue = document.getElementById('RequestType').value;
          if(getSelectValue !==''){
            if((getSelectValue == '1.Προσθήκη δικαιωμάτων χρήστη.')||
               (getSelectValue == '2.Αφαίρεση δικαιωμάτων χρήστη.')||
               (getSelectValue == '3.Νέος σταθμός εργασίας/Δικαιώματα χρήστη.')){
               //document.getElementById('UserName').style.display='block';
               document.getElementById('UserRights').style.display='table-row';
               document.getElementById('InternetPages').style.display='table-row';
               document.getElementById('HWRights').style.display='table-row';
               document.getElementById('PassRequestTypeVar').value  = '1' ;
               }else{ 
               // document.getElementById('UserName').style.display='block';
                  document.getElementById('UserRights').style.display='none';
                  document.getElementById('InternetPages').style.display='none';
                  document.getElementById('HWRights').style.display='none';
               }   
            if(
               (getSelectValue == '4.Διαγραφή χρήστη/κατάργηση δικαιωμάτων.')){
                  document.getElementById('UserName').style.display='table-row';
                  document.getElementById('PassRequestTypeVar').value  = '2';
               }else{
                  document.getElementById('UserName').style.display='block';
               7}
         
         }
          //alert(getSelectValue);
          if(getSelectValue ===''){
            getSelectValue = '1.Προσθήκη δικαιωμάτων χρήστη.' ; 
            document.getElementById('PassRequestTypeVar').value  = '1' ; 
          }
          
          //document.getElementById('PassValue').style.display='block';
          
      }
      function validateForm() {
         var jsTitleTxt = document.getElementById('TitleTxt').value;
         var jsRequestType = document.getElementById('RequestType').value;
         var jsKlados = document.getElementById('Klados').value;
         var jsUserFor = document.getElementById('UserFor').value;
         
         if( jsRequestType == ''){ alert('Παρακαλώ επιλέξτε είδος αίτησης!'); return false;}
         if( jsTitleTxt == ''){ alert('Παρακαλώ δώστε ένα Τίτλο/ Περιγραφή για το αίτημα'); return false;}
         if( jsKlados == ''){ alert('Παρακαλώ επιλέξτε κλάδο!'); return false;}
         if( (jsUserFor == '') &&(jsRequestType !='3.Νέος σταθμός εργασίας/Δικαιώματα χρήστη.') ){ alert('Παρακαλώ επιλέξτε χρήστη!'); return false;}
         //if( (jsAccessRights ==false )&& (jsRequestType !='4.Διαγραφή χρήστη/κατάργηση δικαιωμάτων.')){alert('Παρακαλώ επιλέξτε τουλάχιστον 1 δικαίωμα !'); return false;} 
       }
   </script>
       <form name='AddTicketform' action='/plugins/example/front/addnpticket.form.php' onsubmit='return validateForm()' method='post'>
       <input type='hidden' name='id' value='23'>
       <Input type='hidden' name='item' value='32'>
       <input type='hidden' name='_glpi_csrf_token' value='".Session::getNewCSRFToken()."'>
       <input type='hidden' name='PassRequestTypeVar' value=''>
       <input type='hidden' name='GroupAssignID' value='11'>       
       ";
       $out .="<div id='MainFormTable' style='display:block;'>";
       $out .="<table style = 'text-align:left;' border=1 >";
       $out .="<tr><td nowrap='true' valign='top' width='113px' ><span  id='_x0395__x03af__x03b4__x03bf__x03'>
       <nobr>Είδος αίτησης<span class='ms-accentText' title='Αυτό το πεδίο είναι υποχρεωτικό.'> *</span></nobr>
       </span></td><td>
                <select name='requestType' id='RequestType' title='Είδος αίτησης Απαιτούμενο πεδίο' onchange='showBlocks()'>
                   <option value='' selected='selected'></option>
                   <option value='1.Προσθήκη δικαιωμάτων χρήστη.'>1.Προσθήκη δικαιωμάτων χρήστη.</option>
                   <option value='2.Αφαίρεση δικαιωμάτων χρήστη.'>2.Αφαίρεση δικαιωμάτων χρήστη.</option>
                   <option value='3.Νέος σταθμός εργασίας/Δικαιώματα χρήστη.'>3.Νέος σταθμός εργασίας/Δικαιώματα χρήστη.</option>
                   <option value='4.Διαγραφή χρήστη/κατάργηση δικαιωμάτων.'>4.Διαγραφή χρήστη/κατάργηση δικαιωμάτων.</option>
               </select>
       </td></tr>
       <tr><td>Τίτλος-Περιγραφή αιτήματος </td><td><input type='text' value='' maxlength='255' name='TitleTxt' id='TitleTxt' title='Τίτλος-Περιγραφή αιτήματος Απαιτούμενο πεδίο'></td></tr>"; 
       $out .="<tr><td nowrap='true' valign='top' width='113px' ><span  id='_x03a0__x03b5__x03c1__x03b9__x03'>
                       <nobr>Περιγραφή</nobr></span></td><td valign='top' width='350px' class='ms-formbody'>
                   <span dir='none'><span dir='ltr'><textarea rows='10' cols='120' name='RequestDescription' title='Πρόγραμμα επεξεργασίας εμπλουτισμένου κειμένου Περιγραφή' class='ms-long'></textarea><input type='hidden' id='TextField_spSave'></span><br><span class='ms-formdescription'></span><br></span>				
               </td>
           </tr>";
       $out .="<tr><td nowrap='true' valign='top' width='113px' ><span  id='_x039a__x03bb__x03ac__x03b4__x03'>
           <nobr>Κλάδος/Τμήμα<span class='ms-accentText' title='Αυτό το πεδίο είναι υποχρεωτικό.'> *</span></nobr></span></td>
           <td valign='top' width='350px' class='ms-formbody'>
           <span dir='none'><select name='klados' id='Klados' title='Κλάδος/Τμήμα Απαιτούμενο πεδίο' class='ms-RadioText'><option value='' selected='selected'></option><option value='Κλάδος Αυτοκινήτων'>Κλάδος Αυτοκινήτων</option><option value='Λοιποί κλάδοι'>Λοιποί κλάδοι</option><option value='Εταιρική Διακυβέρνηση'>Εταιρική Διακυβέρνηση</option><option value='Οικονομική Διεύθυνση'>Οικονομική Διεύθυνση</option><option value='Οικονομική Διαχείριση'>Οικονομική Διαχείριση</option><option value='Τεχνική Διεύθυνση'>Τεχνική Διεύθυνση</option><option value='Τμήμα Ζημιών'>Τμήμα Ζημιών</option><option value='Πωλήσεις'>Πωλήσεις</option><option value='Νομικό τμήμα'>Νομικό τμήμα</option><option value='Γενική Διεύθυνση'>Γενική Διεύθυνση</option><option value='Τμήμα Πληροφορικής'>Τμήμα Πληροφορικής</option><option value='Υποκατάστημα Θεσσαλονίκης'>Υποκατάστημα Θεσσαλονίκης</option><option value='Κατάστημα Πάτρας'>Κατάστημα Πάτρας</option><option value='Κατάστημα Χαλκίδας'>Κατάστημα Χαλκίδας</option><option value='Κατάστημα Λυκόβρυσης'>Κατάστημα Λυκόβρυσης</option><option value='Κατάστημα Βόλου'>Κατάστημα Βόλου</option><option value='Κατάστημα Ιωαννίνων'>Κατάστημα Ιωαννίνων</option><option value='Κατάστημα Γαλατσίου'>Κατάστημα Γαλατσίου</option><option value='Κατάστημα Κιλκίς'>Κατάστημα Κιλκίς</option><option value='NP'>NP</option></select><br></span>
           </td> </tr>";
       $out .="<tr>
           <td nowrap='true' valign='top' width='113px' ><span  id=''>
           <nobr>Προτεραιότητα</nobr>
           </span></td>
           <td valign='top' width='350px' class='ms-formbody'>
               <span dir='none'><select name='priority' id='priority' title='Προτεραιότητα' class='ms-RadioText'><option value='(1) Υψηλή'>(1) Υψηλή</option><option value='(2) Κανονική' selected='selected'>(2) Κανονική</option><option value='(3) Χαμηλή'>(3) Χαμηλή</option></select><br></span>
           </td>
           </tr>" ; 
      
       $out .= "<tr ><td nowrap='true' valign='top' width='113px' ><span  id='_x039f__x03bd__x03bf__x03bc__x00'>
               <nobr>Ονομ/νυμο χρήστη που αφορούν οι αλλαγές</nobr></span></td>
               <td valign='top' width='350px' class='ms-formbody'>
               <div dir='none'>
                  <select name='UserFor' id='UserFor' class='ms-RadioText'>
                  <option value='' selected='selected'></option>";
                  foreach ($result as $row) {   
                   $out .= "<option value='".$row["firstname"]." ".$row["realname"] ."'>".$row["firstname"]." ".$row["realname"] ."</option>" ; 
                  }

                  //<input type='text' name='UserFor' id='UserFor' class='sp-peoplepicker-editorInput' size='50' autocomplete='off' value='' id='_EditorInput' title='Ονομ/νυμο χρήστη που αφορούν οι αλλαγές' autocorrect='off' autocapitalize='off' data-sp-peoplepickereditor='true'></div>
              $out .= " </div>" ;
               //echo Dropdown::getDropdownName("glpi_entities", $data['entities_id']) . "</td>";
//                ini_set( "display_errors",1) ;
// error_reporting(E_ALL); 
    //  $out .=  Dropdown::getDropdownName("glpi_entities", $data['name']) ; 
      $out .="<span id='InitialHelpText' class=''>Εισαγωγή ονομάτων ή διευθύνσεων ηλεκτρονικού ταχυδρομείου...<br>Για νέο χρήστη , συμπληρώστε το όνομ/νυμο μόνο στην περιγραφή.</span>
               </td>
               </tr>";
       $out .=" <tr id='UserRights' style='display:none;'><td nowrap='true' valign='top' width='113px' >
               <br><nobr><h3>Δικαιώματα Εφαρμογών</h3></nobr></td>
               <td valign='top' width='100%' class='ms-formbody'>
               <span dir='none'>
                   <table id='' cellpadding='2' cellspacing='1' width='100%' border='1'>
                   <tr><td><span title='IRP-Κύρια ασφαλιστική εφαρμογή'>
                       <input name='irp' type='hidden' value='ΟΧΙ'>
                       <input name='irp' type='checkbox' value='ΝΑΙ' onchange='handleChange(this);' >&nbsp;<label for='irp'>IRP-Κύρια ασφαλιστική εφαρμογή</label></span></td>
                       <td><span title='PORTAL'>
                       <input name='portalaccess' type='hidden' value='ΟΧΙ'>
                       <input name='portalaccess' type='checkbox' Value='Ναι'>&nbsp;<label for='portalaccess'>PORTAL</label></span></td>
                       <td><span title='NP BANK'>
                       <input name='NPBank' type='hidden' value='ΟΧΙ'>
                       <input name='NPBank' type='checkbox' value='Ναι'>&nbsp;<label for='NPBank'>NP BANK</label></span></td></tr>
                   <tr><td><span title='NP REPORTS'>
                        <input name='NPReports' type='hidden' value='ΟΧΙ'>
                        <input name='NPReports' type='checkbox' value='Ναι'>&nbsp;<label for='NPReports'>NP REPORTS</label></span></td>
                       <td><span title='MS OUTLOOK'>
                       <input name='msoutlook' type='hidden' value='ΟΧΙ'>
                       <input name='msoutlook' type='checkbox' value='Ναι' >&nbsp;<label for='msoutlook'>MS OUTLOOK</label></span></td>
                       <td><span title='MS OFFICE(Word,Excel,Powerpoint)'>
                       <input name='msoffice' type='hidden' value='ΟΧΙ'>
                       <input name='msoffice' type='checkbox' value='Ναι'>&nbsp;<label for='msoffice'>MS OFFICE(Word,Excel,Powerpoint)</label></span></td></tr>
                       <tr><td><span title='FAX SERVER'>
                       <input name='faxserver' type='hidden' value='ΟΧΙ'>
                       <input name='faxserver' type='checkbox' value='Ναι'>&nbsp;<label for='faxserver'>FAX SERVER</label></span></td>
                       <td><span title='INTERNET'>
                       <input name='internetCheck' type='hidden' value='ΟΧΙ'>
                       <input name='internetCheck' type='checkbox' value='Ναι'>&nbsp;<label for='internetCheck'>INTERNET</label></span></td>
                       <td><span title='MIS(ΠΑΛΑΙΟ)'>
                       <input name='MISOldCheck' type='hidden' value='ΟΧΙ'>
                       <input name='MISOldCheck' type='checkbox' value='Ναι'>&nbsp;<label for='MISOldCheck'>MIS(ΠΑΛΑΙΟ)</label></span></td></tr>
                       <tr><td><span title='MIS(ΝΕΟ)'>
                       <input name='MISNewCheck' type='hidden' value='ΟΧΙ'>
                       <input name='MISNewCheck' type='checkbox' value='Ναι'>&nbsp;<label for='MISNewCheck'>MIS(ΝΕΟ)</label></span></td>
                       <td><span title='PAPYRUS'>
                       <input name='PapyrusCheck' type='hidden' value='ΟΧΙ'>
                       <input name='PapyrusCheck' type='checkbox' value='Ναι'>&nbsp;<label for='PapyrusCheck'>PAPYRUS</label></span></td>
                       <td><span title='TEST IRP'>
                       <input name='testirp' type='hidden' value='ΟΧΙ'>
                       <input name='testirp' type='checkbox' value='Ναι'>&nbsp;<label for='testirp'>TEST IRP</label></span></td></tr>
                       <tr><td><span title='TEST PORTAL'>
   
                       <input name='testportalcheck' type='hidden' value='ΟΧΙ'>
                       <input name='testportalcheck' type='checkbox' value='Ναι'>&nbsp;<label for='testportalcheck'>TEST PORTAL</label></span></td>
                       <td><span title='Πρόγραμμα μισθοδοσίας'>
                       
                       <input name='PayrollCheck' type='hidden' value='ΟΧΙ'>
                       <input name='PayrollCheck' type='checkbox' value='Ναι'>&nbsp;<label for='PayrollCheck'>Πρόγραμμα μισθοδοσίας</label></span></td>
                       <td><span title='Solvency II - Systemic'>
   
                       <input name='SolvencyCheck' type='hidden' value='ΟΧΙ'>
                       <input name='SolvencyCheck' type='checkbox' value='Ναι'>&nbsp;<label for='SolvencyCheck'>Solvency II - Systemic</label></span></td></tr>
                       <tr><td><span title='ΥΣΑΕ'>
   
                       <input name='YSAECheck' type='hidden' value='ΟΧΙ'>
                       <input name='YSAECheck' type='checkbox' value='Ναι'>&nbsp;<label for='YSAECheck'>ΥΣΑΕ</label></span></td>
                       <td><span title='ΓΔΑ'>
                       
                       <input name='GDACheck' type='hidden' value='ΟΧΙ'>
                       <input name='GDACheck' type='checkbox' value='Ναι'>&nbsp;<label for='GDACheck'>ΓΔΑ</label></span></td>
                       <td><span title='HIC'>
                       
                       <input name='HICCheck' type='hidden' value='ΟΧΙ'>
                       <input name='HICCheck' type='checkbox' value='Ναι'>&nbsp;<label for='HICCheck'>HIC</label></span></td></tr>
                   <tr><td><span title='Επενδυτικό πρόγραμμα'>
                   
                   <input name='investProgrammCheck' type='hidden' value='ΟΧΙ'>
                      <input name='investProgrammCheck' type='checkbox' value='Ναι'>&nbsp;<label for='investProgrammCheck'>Επενδυτικό πρόγραμμα</label></span></td>
                       <td><span title='Κοινόχρηστα αρχεία τμήματος'>
                       
                       <input name='CommonDeptFiles' type='hidden' value='ΟΧΙ'>
                       <input name='CommonDeptFiles' type='checkbox' value='Ναι'>&nbsp;<label for='CommonDeptFiles'>Κοινόχρηστα αρχεία τμήματος</label></span></td>
                       <td><span title='AGENTS'>
                       
                       <input name='agentsCheck' type='hidden' value='ΟΧΙ'>
                       <input name='agentsCheck' type='checkbox' value='Ναι'>&nbsp;<label for='agentsCheck'>AGENTS</label></span></td></tr>
                   <tr><td colspan=3><span title='Καθορίστε τη δική σας τιμή:'>
                   
                   <label for='CustomAccessText'>Καθορίστε τη δική σας τιμή:</label></span>
                       &nbsp;&nbsp;&nbsp;
                       <input type='text' maxlength='255' name='CustomAccessText' tabindex='-1' value='' title='Δικαιώματα Εφαρμογών: Καθορίστε τη δική σας τιμή:'></td></tr>
                       <tr><td colspan=2></td></tr>
                      
             </table>
             
             
             </span>
       <span class='ms-metadata'>Την πλήρη ευθύνη και έλεγχο έχει ο Προϊστάμενος/Διευθυντής του τμήματος γνωρίζοντας <br>&nbsp;τους κινδύνους που μπορεί να προκύψουν και να επηρεάσουν την λειτουργία της εταιρείας <br>&nbsp;π.χ. ιούς,μη θεμιτή μεταφορά δεδομένων.</span>   
    </td>
    </tr>";  
    $out.= "<tr id='InternetPages'  style='display:none;'><td nowrap='true' valign='top' width='50%' ><span  id='_x03a3__x03b5__x03bb__x03af__x03'>
    <br><nobr><h3>Σελίδες πρόσβασης στο internet</h3></nobr>
    </span></td>
    <td valign='top' width='50%' class='ms-formbody'>
    <span dir='none'><span dir='ltr'><textarea rows='10' cols='120' name='InternetPages' title='Πρόγραμμα επεξεργασίας εμπλουτισμένου κειμένου Σελίδες πρόσβασης στο internet' class='ms-long'></textarea></span><br><span class='ms-formdescription'><a href=''>Κάντε κλικ για να λάβετε βοήθεια σχετικά με την προσθήκη βασικής μορφοποίησης HTML.</a></span><br></span>
    </td>
    </tr>";   
    $out .= "<tr id='HWRights' style='display:none;' >
    <td nowrap='true' valign='center' width='113px' ><span  id='_x0394__x03b9__x03ba__x03b1__x03'><br>
    <nobr><h3>Δικαιώματα πρόσβασης σε hardware</h3></nobr></span></td>
    <td valign='top' width='350px' class='ms-formbody'>
       <span dir='none'>
       <table cellpadding='0' cellspacing='1'>
          <tbody>
          <tr><td><span class='ms-RadioText' title='CD/DVD'>
                    <input name='cddvd' type='hidden' value='ΟΧΙ'>
                    <input name='cddvd' type='checkbox' value='Ναι'><label for='_x0394__x03b9__x03ba__x03b1__x03_1f98a32f-ff64-441c-b22a-24567571e2be_MultiChoiceOption_0'>CD/DVD</label>
                   </span></td>
                   <td><span class='ms-RadioText' title='USB DISK'>
                     <input name='usbdisk' type='hidden' value='ΟΧΙ'>
                     <input name='usbdisk' type='checkbox' value='Ναι'><label for='_x0394__x03b9__x03ba__x03b1__x03_1f98a32f-ff64-441c-b22a-24567571e2be_MultiChoiceOption_1'>USB DISK</label>
                   </span></td>
                   <td><span class='ms-RadioText' title='Σύνδεση φωτογραφικής μηχανής'>
                   <input name='camera' type='hidden' value='ΟΧΙ'>
                   <input name='camera' type='checkbox' value='Ναι'><label for='_x0394__x03b9__x03ba__x03b1__x03_1f98a32f-ff64-441c-b22a-24567571e2be_MultiChoiceOption_2'>Σύνδεση φωτογραφικής μηχανής</label>
                   </span></td></tr>
                   <tr><td colspan=3><span class='ms-RadioText' title='Καθορίστε τη δική σας τιμή:'>
                     <label for='_x0394__x03b9__x03ba__x03b1__x03_1f98a32f-ff64-441c-b22a-24567571e2beFillInRadio'>Καθορίστε τη δική σας τιμή:</label>
                     </span> &nbsp;&nbsp;&nbsp;<input type='text' maxlength='255' name='customhw' tabindex='-1' value='' title='Δικαιώματα πρόσβασης σε hardware: Καθορίστε τη δική σας τιμή:'>
                     </td></tr>
                     </tbody>
                     </table>
                     </span>
       <span class='ms-metadata'>Την πλήρη ευθύνη και έλεγχο έχει ο Προϊστάμενος/Διευθυντής του τμήματος γνωρίζοντας <br>&nbsp;τους κινδύνους που μπορεί να προκύψουν και να επηρεάσουν την λειτουργία της εταιρείας <br>&nbsp;π.χ. ιούς,μη θεμιτή μεταφορά δεδομένων.</span>
    </td>
    </tr>
    <tr><td colspan=2 align='center' ><br>
    <input type='submit' name='submitbtn' class='submit' value='Υποβολή'>
     </td><tr>
    </table>
    </div>
    </form>";

      //**************************************************************************************** */

      $out .= '<tr>';
      $out .= '<th>' . __('Φόρμα υποβολής Αιτήματος', 'myexampleplugin') . '</th>';

      echo "<tr class='tab_bg_1'>";
      //echo "<td>" . __('ID') . "</td>";
      echo "<td></td>";
      echo "<td>";
      //echo $ID;
      echo "</td>";

      //$this->showFormButtons($options);

      if ($options['display'] == true) {
         echo $out;
      } else {
         return $out;
      }

      return true;
   }

   function rawSearchOptions() {

      $tab = [];

      $tab[] = [
         'id'                 => 'common',
         'name'               => __('Header Needed')
      ];

      $tab[] = [
         'id'                 => '1',
         'table'              => 'glpi_plugin_example_examples',
         'field'              => 'name',
         'name'               => __('Name'),
      ];

      $tab[] = [
         'id'                 => '2',
         'table'              => 'glpi_plugin_example_dropdowns',
         'field'              => 'name',
         'name'               => __('Dropdown'),
      ];

      $tab[] = [
         'id'                 => '3',
         'table'              => 'glpi_plugin_example_examples',
         'field'              => 'serial',
         'name'               => __('Serial number'),
         'usehaving'          => true,
         'searchtype'         => 'equals',
      ];

      $tab[] = [
         'id'                 => '30',
         'table'              => 'glpi_plugin_example_examples',
         'field'              => 'id',
         'name'               => __('ID'),
         'usehaving'          => true,
         'searchtype'         => 'equals',
      ];

      return $tab;
   }

   // This function to obtain all the groups of a user
   function getUserGroups($userID){
      global $DB;

      $query="SELECT DISTINCT FK_groups
            FROM glpi_users_groups
            WHERE FK_users='$userID';";
      $result=$DB->query($query);
      if ($DB->numrows($result)>0){
         $groups=array();
         while ($data=$DB->fetch_assoc($result)){
            $groups[]=$data['FK_groups'];
         }
      }
      return $groups;
   }
   public static function showMiniDashboard(): void {
      Plugin::doHook(Hooks::DISPLAY_CENTRAL);

      if (PluginExampleEntityconfig::getUsedConfig('is_dashboard_visible', Session::getActiveEntity()) == PluginFormcreatorEntityconfig::CONFIG_DASHBOARD_VISIBLE) {
         if (version_compare(GLPI_VERSION, '10.0.3') > 0) {
            $dashboard = new Glpi\Dashboard\Grid('plugin_formcreator_issue_counters', 33, 2, 'mini_core');
         } else {
            $dashboard = new Glpi\Dashboard\Grid('plugin_formcreator_issue_counters', 33, 0, 'mini_core');
         }
         echo "<div class='formcreator_dashboard_container'>";
         $dashboard->show(true);
         echo "</div>";
      }
   }

   /**
    * Give localized information about 1 task
    *
    * @param $name of the task
    *
    * @return array of strings
    */
   static function cronInfo($name) {

      switch ($name) {
         case 'Sample' :
            return ['description' => __('Cron description for example', 'example'),
                    'parameter'   => __('Cron parameter for example', 'example')];
      }
      return [];
   }


   /**
    * Execute 1 task manage by the plugin
    *
    * @param $task Object of CronTask class for log / stat
    *
    * @return interger
    *    >0 : done
    *    <0 : to be run again (not finished)
    *     0 : nothing to do
    */
   static function cronSample($task) {

      $task->log("Example log message from class");
      $r = mt_rand(0, $task->fields['param']);
      usleep(1000000+$r*1000);
      $task->setVolume($r);

      return 1;
   }


   // Hook done on before add item case (data from form, not altered)
   static function pre_item_add_computer(Computer $item) {
      if (isset($item->input['name']) && empty($item->input['name'])) {
         Session::addMessageAfterRedirect("Pre Add Computer Hook KO (name empty)", true);
         return $item->input = false;
      } else {
         Session::addMessageAfterRedirect("Pre Add Computer Hook OK", true);
      }
   }

   // Hook done on before add item case (data altered by object prepareInputForAdd)
   static function post_prepareadd_computer(Computer $item) {
      Session::addMessageAfterRedirect("Post prepareAdd Computer Hook", true);
   }


   // Hook done on add item case
   static function item_add_computer(Computer $item) {

      Session::addMessageAfterRedirect("Add Computer Hook, ID=".$item->getID(), true);
      return true;
   }


   function getTabNameForItem(CommonGLPI $item, $withtemplate = 0) {

      if (!$withtemplate) {
         switch ($item->getType()) {
            case 'Profile' :
               if ($item->getField('central')) {
                  return __('Example', 'example');
               }
               break;

            case 'Phone' :
               if ($_SESSION['glpishow_count_on_tabs']) {
                  return self::createTabEntry(__('Example', 'example'),
                                              countElementsInTable($this->getTable()));
               }
               return __('Example', 'example');

            case 'ComputerDisk' :
            case 'Supplier' :
               return [1 => __("Test Plugin", 'example'),
                       2 => __("Test Plugin 2", 'example')];

            case 'Computer' :
            case 'Central' :
            case 'Preference':
            case 'Notification':
               return [1 => __("Test Plugin", 'example')];

         }
      }
      return '';
   }


   static function displayTabContentForItem(CommonGLPI $item, $tabnum = 1, $withtemplate = 0) {

      switch ($item->getType()) {
         case 'Phone' :
            echo __("Plugin Example on Phone", 'example');
            break;

         case 'Central' :
            echo __("Plugin central action", 'example');
            break;

         case 'Preference' :
            // Complete form display
            $data = plugin_version_example();

            echo "<form action='Where to post form'>";
            echo "<table class='tab_cadre_fixe'>";
            echo "<tr><th colspan='3'>".$data['name']." - ".$data['version'];
            echo "</th></tr>";

            echo "<tr class='tab_bg_1'><td>Name of the pref</td>";
            echo "<td>Input to set the pref</td>";

            echo "<td><input class='submit' type='submit' name='submit' value='submit'></td>";
            echo "</tr>";

            echo "</table>";
            echo "</form>";
            break;

         case 'Notification' :
            echo __("Plugin mailing action", 'example');
            break;

         case 'ComputerDisk' :
         case 'Supplier' :
            if ($tabnum==1) {
               echo __('First tab of Plugin example', 'example');
            } else {
               echo __('Second tab of Plugin example', 'example');
            }
            break;

         default :
            //TRANS: %1$s is a class name, %2$d is an item ID
            printf(__('Plugin example CLASS=%1$s id=%2$d', 'example'), $item->getType(), $item->getField('id'));
            break;
      }
      return true;
   }

   static function getSpecificValueToDisplay($field, $values, array $options = []) {

      if (!is_array($values)) {
         $values = [$field => $values];
      }
      switch ($field) {
         case 'serial' :
            return "S/N: ".$values[$field];
      }
      return '';
   }

   // Parm contains begin, end and who
   // Create data to be displayed in the planning of $parm["who"] or $parm["who_group"] between $parm["begin"] and $parm["end"]
   static function populatePlanning($parm) {

      // Add items in the output array
      // Items need to have an unique index beginning by the begin date of the item to display
      // needed to be correcly displayed
      $output = [];
      $key = $parm["begin"]."$$$"."plugin_example1";
      $output[$key]["begin"]  = date("Y-m-d 17:00:00");
      $output[$key]["end"]    = date("Y-m-d 18:00:00");
      $output[$key]["name"]   = __("test planning example 1", 'example');
      // Specify the itemtype to be able to use specific display system
      $output[$key]["itemtype"] = Example::class;
      // Set the ID using the ID of the item in the database to have unique ID
      $output[$key][getForeignKeyFieldForItemType(Example::class)] = 1;
      return $output;
   }

   /**
    * Display a Planning Item
    *
    * @param $val Array of the item to display
    * @param $who ID of the user (0 if all)
    * @param $type position of the item in the time block (in, through, begin or end)
    * @param $complete complete display (more details)
    *
    * @return Nothing (display function)
    **/
   static function displayPlanningItem(array $val, $who, $type = "", $complete = 0) {

      // $parm["type"] say begin end in or from type
      // Add items in the items fields of the parm array
      switch ($type) {
         case "in" :
            //TRANS: %1$s is the start time of a planned item, %2$s is the end
            printf(__('From %1$s to %2$s :'),
                   date("H:i", strtotime($val["begin"])), date("H:i", strtotime($val["end"])));
            break;

         case "through" :
            echo Html::resume_text($val["name"], 80);
            break;

         case "begin" :
            //TRANS: %s is the start time of a planned item
            printf(__('Start at %s:'), date("H:i", strtotime($val["begin"])));
            break;

         case "end" :
            //TRANS: %s is the end time of a planned item
            printf(__('End at %s:'), date("H:i", strtotime($val["end"])));
         break;
      }
      echo "<br>";
      echo Html::resume_text($val["name"], 80);
   }

   /**
    * Get an history entry message
    *
    * @param $data Array from glpi_logs table
    *
    * @since GLPI version 0.84
    *
    * @return string
   **/
   static function getHistoryEntry($data) {

      switch ($data['linked_action'] - Log::HISTORY_PLUGIN) {
         case 0:
            return __('History from plugin example', 'example');
      }

      return '';
   }


   //////////////////////////////
   ////// SPECIFIC MODIF MASSIVE FUNCTIONS ///////
   /**
    * @since version 0.85
    *
    * @see CommonDBTM::getSpecificMassiveActions()
   **/
   function getSpecificMassiveActions($checkitem = null) {

      $actions = parent::getSpecificMassiveActions($checkitem);

      $actions['Document_Item'.MassiveAction::CLASS_ACTION_SEPARATOR.'add']  =
                                        _x('button', 'Add a document');         // GLPI core one
      $actions[__CLASS__.MassiveAction::CLASS_ACTION_SEPARATOR.'do_nothing'] =
                                        __('Do Nothing - just for fun', 'example');  // Specific one

      return $actions;
   }


   /**
    * @since version 0.85
    *
    * @see CommonDBTM::showMassiveActionsSubForm()
   **/
   static function showMassiveActionsSubForm(MassiveAction $ma) {

      switch ($ma->getAction()) {
         case 'DoIt':
            echo "&nbsp;<input type='hidden' name='toto' value='1'>".
                 Html::submit(_x('button', 'Post'), ['name' => 'massiveaction']).
                 " ".__('Write in item history', 'example');
            return true;
         case 'do_nothing' :
            echo "&nbsp;".Html::submit(_x('button', 'Post'), ['name' => 'massiveaction']).
                 " ".__('but do nothing :)', 'example');
            return true;
      }
      return parent::showMassiveActionsSubForm($ma);
   }


   /**
    * @since version 0.85
    *
    * @see CommonDBTM::processMassiveActionsForOneItemtype()
   **/
   static function processMassiveActionsForOneItemtype(MassiveAction $ma, CommonDBTM $item,
                                                       array $ids) {
      global $DB;

      switch ($ma->getAction()) {
         case 'DoIt' :
            if ($item->getType() == 'Computer') {
               Session::addMessageAfterRedirect(__("Right it is the type I want...", 'example'));
               Session::addMessageAfterRedirect(__('Write in item history', 'example'));
               $changes = [0, 'old value', 'new value'];
               foreach ($ids as $id) {
                  if ($item->getFromDB($id)) {
                     Session::addMessageAfterRedirect("- ".$item->getField("name"));
                     Log::history($id, 'Computer', $changes, Example::class,
                                  Log::HISTORY_PLUGIN);
                     $ma->itemDone($item->getType(), $id, MassiveAction::ACTION_OK);
                  } else {
                     // Example of ko count
                     $ma->itemDone($item->getType(), $id, MassiveAction::ACTION_KO);
                  }
               }
            } else {
               // When nothing is possible ...
               $ma->itemDone($item->getType(), $ids, MassiveAction::ACTION_KO);
            }
            return;

         case 'do_nothing' :
            If ($item->getType() == Example::class) {
               Session::addMessageAfterRedirect(__("Right it is the type I want...", 'example'));
               Session::addMessageAfterRedirect(__("But... I say I will do nothing for:",
                                                   'example'));
               foreach ($ids as $id) {
                  if ($item->getFromDB($id)) {
                     Session::addMessageAfterRedirect("- ".$item->getField("name"));
                     $ma->itemDone($item->getType(), $id, MassiveAction::ACTION_OK);
                  } else {
                     // Example for noright / Maybe do it with can function is better
                     $ma->itemDone($item->getType(), $id, MassiveAction::ACTION_KO);
                  }
               }
            } else {
               $ma->itemDone($item->getType(), $ids, MassiveAction::ACTION_KO);
            }
            Return;
      }
      parent::processMassiveActionsForOneItemtype($ma, $item, $ids);
   }

   static function generateLinkContents($link, CommonDBTM $item) {

      if (strstr($link, "[EXAMPLE_ID]")) {
         $link = str_replace("[EXAMPLE_ID]", $item->getID(), $link);
         return [$link];
      }

      return parent::generateLinkContents($link, $item);
   }


   static function dashboardTypes() {
      return [
         'example' => [
            'label'    => __("Plugin Example", 'example'),
            'function' => Example::class . "::cardWidget",
            'image'    => "https://via.placeholder.com/100x86?text=example",
         ],
         'example_static' => [
            'label'    => __("Plugin Example (static)", 'example'),
            'function' => Example::class . "::cardWidgetWithoutProvider",
            'image'    => "https://via.placeholder.com/100x86?text=example+static",
         ],
      ];
   }


   static function dashboardCards($cards = []) {
      if (is_null($cards)) {
         $cards = [];
      }
      $new_cards =  [
         'plugin_example_card' => [
            'widgettype'   => ["example"],
            'label'        => __("Plugin Example card"),
            'provider'     => Example::class . "::cardDataProvider",
         ],
         'plugin_example_card_without_provider' => [
            'widgettype'   => ["example_static"],
            'label'        => __("Plugin Example card without provider"),
         ],
         'plugin_example_card_with_core_widget' => [
            'widgettype'   => ["bigNumber"],
            'label'        => __("Plugin Example card with core provider"),
            'provider'     => Example::class . "::cardBigNumberProvider",
         ],
      ];

      return array_merge($cards, $new_cards);
   }


   static function cardWidget(array $params = []) {
      $default = [
         'data'  => [],
         'title' => '',
         // this property is "pretty" mandatory,
         // as it contains the colors selected when adding widget on the grid send
         // without it, your card will be transparent
         'color' => '',
      ];
      $p = array_merge($default, $params);

      // you need to encapsulate your html in div.card to benefit core style
      $html = "<div class='card' style='background-color: {$p["color"]};'>";
      $html.= "<h2>{$p['title']}</h2>";
      $html.= "<ul>";
      foreach ($p['data'] as $line) {
         $html.= "<li>$line</li>";
      }
      $html.= "</ul>";
      $html.= "</div>";

      return $html;
   }

   static function cardDataProvider(array $params = []) {
      $default_params = [
         'label' => null,
         'icon'  => "fas fa-smile-wink",
      ];
      $params = array_merge($default_params, $params);

      return [
         'title' => $params['label'],
         'icon'  => $params['icon'],
         'data'  => [
            'test1',
            'test2',
            'test3',
         ]
      ];
   }

   static function cardWidgetWithoutProvider(array $params = []) {
      $default = [
         // this property is "pretty" mandatory,
         // as it contains the colors selected when adding widget on the grid send
         // without it, your card will be transparent
         'color' => '',
      ];
      $p = array_merge($default, $params);

      // you need to encapsulate your html in div.card to benefit core style
      $html = "<div class='card' style='background-color: {$p["color"]};'>
                  static html (+optional javascript) as card is not matched with a data provider

                  <img src='https://www.linux.org/images/logo.png'>
               </div>";

      return $html;
   }

   static function cardBigNumberProvider(array $params = []) {
      $default_params = [
         'label' => null,
         'icon'  => null,
      ];
      $params = array_merge($default_params, $params);

      return [
         'number' => rand(),
         'url'    => "https://www.linux.org/",
         'label'  => "plugin example - some text",
         'icon'   => "fab fa-linux", // font awesome icon
      ];
   }
}
