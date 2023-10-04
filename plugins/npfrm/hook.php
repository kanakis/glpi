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

/**
 * Uninstall hook
 *
 * @return boolean
 */
function plugin_npfrm_uninstall() {
   //to some stuff, like removing tables, generated files, ...
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
    echo __("Plugin example displays on central page", "example");
    echo " <div style='text-align:center;color:#DB6116'> Υποβολή αιτήματος - εργασίας  </div>" ; 
     //main form 
    $out ="</td></tr><tr><td>
    <form name='AddTicketform' action='/plugins/example/front/addnpticket.form.php' method='post'>
    <input type='hidden' name='id' value=''>
    <input type='hidden' name='_glpi_csrf_token' value='".Session::getNewCSRFToken()."'>
    <input type='submit' value='submit'>  ";
    $out .="<table style = 'text-align:left;' border=1>";
    $out .="<tr><td>Τίτλος-Περιγραφή αιτήματος </td><td><input type='text' value='' maxlength='255' id='TitleTxt' title='Τίτλος-Περιγραφή αιτήματος Απαιτούμενο πεδίο'></td></tr>"; 
    $out .="<tr><td nowrap='true' valign='top' width='113px' class='ms-formlabel'><span class='ms-h3 ms-standardheader' id='_x03a0__x03b5__x03c1__x03b9__x03'>
                    <nobr>Περιγραφή</nobr></span></td><td valign='top' width='350px' class='ms-formbody'>
                <span dir='none'><span dir='ltr'><textarea rows='10' cols='120' id='RequestDescription' title='Πρόγραμμα επεξεργασίας εμπλουτισμένου κειμένου Περιγραφή' class='ms-long'></textarea><input type='hidden' id='TextField_spSave'></span><br><span class='ms-formdescription'></span><br></span>				
            </td>
        </tr>";
    $out .="<tr><td nowrap='true' valign='top' width='113px' class='ms-formlabel'><span class='ms-h3 ms-standardheader' id='_x039a__x03bb__x03ac__x03b4__x03'>
        <nobr>Κλάδος/Τμήμα<span class='ms-accentText' title='Αυτό το πεδίο είναι υποχρεωτικό.'> *</span></nobr></span></td>
        <td valign='top' width='350px' class='ms-formbody'>
        <span dir='none'><select id='Klados' title='Κλάδος/Τμήμα Απαιτούμενο πεδίο' class='ms-RadioText'><option value='' selected='selected'></option><option value='Κλάδος Αυτοκινήτων'>Κλάδος Αυτοκινήτων</option><option value='Λοιποί κλάδοι'>Λοιποί κλάδοι</option><option value='Εταιρική Διακυβέρνηση'>Εταιρική Διακυβέρνηση</option><option value='Οικονομική Διεύθυνση'>Οικονομική Διεύθυνση</option><option value='Οικονομική Διαχείριση'>Οικονομική Διαχείριση</option><option value='Τεχνική Διεύθυνση'>Τεχνική Διεύθυνση</option><option value='Τμήμα Ζημιών'>Τμήμα Ζημιών</option><option value='Πωλήσεις'>Πωλήσεις</option><option value='Νομικό τμήμα'>Νομικό τμήμα</option><option value='Γενική Διεύθυνση'>Γενική Διεύθυνση</option><option value='Τμήμα Πληροφορικής'>Τμήμα Πληροφορικής</option><option value='Υποκατάστημα Θεσσαλονίκης'>Υποκατάστημα Θεσσαλονίκης</option><option value='Κατάστημα Πάτρας'>Κατάστημα Πάτρας</option><option value='Κατάστημα Χαλκίδας'>Κατάστημα Χαλκίδας</option><option value='Κατάστημα Λυκόβρυσης'>Κατάστημα Λυκόβρυσης</option><option value='Κατάστημα Βόλου'>Κατάστημα Βόλου</option><option value='Κατάστημα Ιωαννίνων'>Κατάστημα Ιωαννίνων</option><option value='Κατάστημα Γαλατσίου'>Κατάστημα Γαλατσίου</option><option value='Κατάστημα Κιλκίς'>Κατάστημα Κιλκίς</option><option value='NP'>NP</option></select><br></span>
        </td> </tr>";
    $out .="<tr>
        <td nowrap='true' valign='top' width='113px' class='ms-formlabel'><span class='ms-h3 ms-standardheader' id=''>
        <nobr>Προτεραιότητα</nobr>
        </span></td>
        <td valign='top' width='350px' class='ms-formbody'>
            <span dir='none'><select id='priority' title='Προτεραιότητα' class='ms-RadioText'><option value='(1) Υψηλή'>(1) Υψηλή</option><option value='(2) Κανονική' selected='selected'>(2) Κανονική</option><option value='(3) Χαμηλή'>(3) Χαμηλή</option></select><br></span>
        </td>
        </tr>" ; 
    $out .="<tr><td nowrap='true' valign='top' width='113px' class='ms-formlabel'><span class='ms-h3 ms-standardheader' id='_x0395__x03af__x03b4__x03bf__x03'>
            <nobr>Είδος αίτησης<span class='ms-accentText' title='Αυτό το πεδίο είναι υποχρεωτικό.'> *</span></nobr>
            </span></td>
            <td valign='top' width='350px' class='ms-formbody'><span dir='none'><select id='RequestType' title='Είδος αίτησης Απαιτούμενο πεδίο' class='ms-RadioText'><option value='' selected='selected'></option><option value='1.Προσθήκη δικαιωμάτων χρήστη.'>1.Προσθήκη δικαιωμάτων χρήστη.</option><option value='2.Αφαίρεση δικαιωμάτων χρήστη.'>2.Αφαίρεση δικαιωμάτων χρήστη.</option><option value='3.Νέος σταθμός εργασίας/Δικαιώματα χρήστη.'>3.Νέος σταθμός εργασίας/Δικαιώματα χρήστη.</option><option value='4.Διαγραφή χρήστη/κατάργηση δικαιωμάτων.'>4.Διαγραφή χρήστη/κατάργηση δικαιωμάτων.</option></select><br></span>
            </td></tr>";
    $out .= "<tr><td nowrap='true' valign='top' width='113px' class='ms-formlabel'><span class='ms-h3 ms-standardheader' id='_x039f__x03bd__x03bf__x03bc__x00'>
            <nobr>Ονομ/νυμο χρήστη που αφορούν οι αλλαγές</nobr></span></td>
            <td valign='top' width='350px' class='ms-formbody'>
            <div dir='none'><span id='ClientPeoplePicker_InitialHelpText' class='sp-peoplepicker-initialHelpText ms-helperText'>Εισαγωγή ονομάτων ή διευθύνσεων ηλεκτρονικού ταχυδρομείου...</span>
            <input type='text' class='sp-peoplepicker-editorInput' size='1' autocomplete='off' value='' id='_EditorInput' title='Ονομ/νυμο χρήστη που αφορούν οι αλλαγές' autocorrect='off' autocapitalize='off' data-sp-peoplepickereditor='true'></div></div><span class='ms-metadata'>Για νέο χρήστη , συμπληρώστε το όνομ/νυμο μόνο στην περιγραφή.</span>
            </td>
            </tr>";
    $out .="<tr><td nowrap='true' valign='top' width='113px' class='ms-formlabel'><span class='ms-h3 ms-standardheader' id='_x0395__x03c6__x03b1__x03c1__x03'>
            <br><nobr><h3>Δικαιώματα Εφαρμογών</h3></nobr></span></td>
            <td valign='top' width='100%' class='ms-formbody'>
            <span dir='none'>
                <table id='' cellpadding='2' cellspacing='1' width='100%' border='1'>
                <tr><td><span title='IRP-Κύρια ασφαλιστική εφαρμογή'><input id='irp' type='checkbox'>&nbsp;<label for='irp'>IRP-Κύρια ασφαλιστική εφαρμογή</label></span></td>
                    <td><span title='PORTAL'><input id='portalaccess' type='checkbox'>&nbsp;<label for='portalaccess'>PORTAL</label></span></td>
                    <td><span title='NP BANK'><input id='NPBank' type='checkbox'>&nbsp;<label for='NPBank'>NP BANK</label></span></td></tr>
                <tr><td><span title='NP REPORTS'><input id='NPReports' type='checkbox' >&nbsp;<label for='NPReports'>NP REPORTS</label></span></td>
                    <td><span title='MS OUTLOOK'><input id='msoutlook' type='checkbox'>&nbsp;<label for='msoutlook'>MS OUTLOOK</label></span></td>
                    <td><span title='MS OFFICE(Word,Excel,Powerpoint)'><input id='msoffice' type='checkbox'>&nbsp;<label for='msoffice'>MS OFFICE(Word,Excel,Powerpoint)</label></span></td></tr>
                    <tr><td><span title='FAX SERVER'><input id='faxserver' type='checkbox'>&nbsp;<label for='faxserver'>FAX SERVER</label></span></td>
                    <td><span title='INTERNET'><input id='internetCheck' type='checkbox'>&nbsp;<label for='internetCheck'>INTERNET</label></span></td>
                    <td><span title='MIS(ΠΑΛΑΙΟ)'><input id='MISOldCheck' type='checkbox'>&nbsp;<label for='MISOldCheck'>MIS(ΠΑΛΑΙΟ)</label></span></td></tr>
                    <tr><td><span title='MIS(ΝΕΟ)'><input id='MISNewCheck' type='checkbox'>&nbsp;<label for='MISNewCheck'>MIS(ΝΕΟ)</label></span></td>
                    <td><span title='PAPYRUS'><input id='PapyrusCheck' type='checkbox'>&nbsp;<label for='PapyrusCheck'>PAPYRUS</label></span></td>
                    <td><span title='TEST IRP'><input id='testirp' type='checkbox'>&nbsp;<label for='testirp'>TEST IRP</label></span></td></tr>
                    <tr><td><span title='TEST PORTAL'><input id='testportalcheck' type='checkbox'>&nbsp;<label for='testportalcheck'>TEST PORTAL</label></span></td>
                    <td><span title='Πρόγραμμα μισθοδοσίας'><input id='PayrollCheck' type='checkbox'>&nbsp;<label for='PayrollCheck'>Πρόγραμμα μισθοδοσίας</label></span></td>
                    <td><span title='Solvency II - Systemic'><input id='SolvencyCheck' type='checkbox'>&nbsp;<label for='SolvencyCheck'>Solvency II - Systemic</label></span></td></tr>
                    <tr><td><span title='ΥΣΑΕ'><input id='YSAECheck' type='checkbox'>&nbsp;<label for='YSAECheck'>ΥΣΑΕ</label></span></td>
                    <td><span title='ΓΔΑ'><input id='GDACheck' type='checkbox'>&nbsp;<label for='GDACheck'>ΓΔΑ</label></span></td>
                    <td><span title='HIC'><input id='HICCheck' type='checkbox'>&nbsp;<label for='HICCheck'>HIC</label></span></td></tr>
                <tr><td><span title='Επενδυτικό πρόγραμμα'><input id='investProgrammCheck' type='checkbox'>&nbsp;<label for='investProgrammCheck'>Επενδυτικό πρόγραμμα</label></span></td>
                    <td><span title='Κοινόχρηστα αρχεία τμήματος'><input id='CommonDeptFiles' type='checkbox'>&nbsp;<label for='CommonDeptFiles'>Κοινόχρηστα αρχεία τμήματος</label></span></td>
                    <td><span title='AGENTS'><input id='agentsCheck' type='checkbox'>&nbsp;<label for='agentsCheck'>AGENTS</label></span></td></tr>
                <tr><td colspan=3><span title='Καθορίστε τη δική σας τιμή:'><input id='CustomAccessCheck' type='checkbox'>&nbsp;<label for='CustomAccessCheck'>Καθορίστε τη δική σας τιμή:</label></span>
                    &nbsp;&nbsp;&nbsp;<input type='text' maxlength='255' id='CustomAccessText' tabindex='-1' value='' title='Δικαιώματα Εφαρμογών: Καθορίστε τη δική σας τιμή:'></td></tr>
                    <tr><td colspan=2></td></tr>
          </table>
          
          </form>
          </span>
    <span class='ms-metadata'>Την πλήρη ευθύνη και έλεγχο έχει ο Προϊστάμενος/Διευθυντής του τμήματος γνωρίζοντας <br>&nbsp;τους κινδύνους που μπορεί να προκύψουν και να επηρεάσουν την λειτουργία της εταιρείας <br>&nbsp;π.χ. ιούς,μη θεμιτή μεταφορά δεδομένων.</span>   
 </td>
 </tr>";  
 $out.= "<tr><td nowrap='true' valign='top' width='50%' class='ms-formlabel'><span class='ms-h3 ms-standardheader' id='_x03a3__x03b5__x03bb__x03af__x03'>
 <br><nobr><h3>Σελίδες πρόσβασης στο internet</h3></nobr>
 </span></td>
 <td valign='top' width='50%' class='ms-formbody'>
 <span dir='none'><span dir='ltr'><textarea rows='10' cols='120' id='_x03a3__x03b5__x03bb__x03af__x03_716449f2-bcaf-4b7e-9bc6-a68c6f7db398_$TextField' title='Πρόγραμμα επεξεργασίας εμπλουτισμένου κειμένου Σελίδες πρόσβασης στο internet' class='ms-long'></textarea><input type='hidden' id='_x03a3__x03b5__x03bb__x03af__x03_716449f2-bcaf-4b7e-9bc6-a68c6f7db398_$TextField_spSave'></span><br><span class='ms-formdescription'><a href=''>Κάντε κλικ για να λάβετε βοήθεια σχετικά με την προσθήκη βασικής μορφοποίησης HTML.</a></span><br></span>
 </td>
 </tr>";   
 $out .= "<tr>
 <td nowrap='true' valign='center' width='113px' class='ms-formlabel'><span class='ms-h3 ms-standardheader' id='_x0394__x03b9__x03ba__x03b1__x03'><br>
 <nobr><h3>Δικαιώματα πρόσβασης σε hardware</h3></nobr></span></td>
 <td valign='top' width='350px' class='ms-formbody'>
    <span dir='none'>
    <table cellpadding='0' cellspacing='1'>
       <tbody>
       <tr><td><span class='ms-RadioText' title='CD/DVD'>
                 <input id='_x0394__x03b9__x03ba__x03b1__x03_1f98a32f-ff64-441c-b22a-24567571e2be_MultiChoiceOption_0' type='checkbox'><label for='_x0394__x03b9__x03ba__x03b1__x03_1f98a32f-ff64-441c-b22a-24567571e2be_MultiChoiceOption_0'>CD/DVD</label>
                </span></td>
                <td><span class='ms-RadioText' title='USB DISK'>
                  <input id='_x0394__x03b9__x03ba__x03b1__x03_1f98a32f-ff64-441c-b22a-24567571e2be_MultiChoiceOption_1' type='checkbox'><label for='_x0394__x03b9__x03ba__x03b1__x03_1f98a32f-ff64-441c-b22a-24567571e2be_MultiChoiceOption_1'>USB DISK</label>
                </span></td>
                <td><span class='ms-RadioText' title='Σύνδεση φωτογραφικής μηχανής'>
                <input id='_x0394__x03b9__x03ba__x03b1__x03_1f98a32f-ff64-441c-b22a-24567571e2be_MultiChoiceOption_2' type='checkbox'><label for='_x0394__x03b9__x03ba__x03b1__x03_1f98a32f-ff64-441c-b22a-24567571e2be_MultiChoiceOption_2'>Σύνδεση φωτογραφικής μηχανής</label>
                </span></td></tr>
                <tr><td colspan=3><span class='ms-RadioText' title='Καθορίστε τη δική σας τιμή:'>
                  <input id='_x0394__x03b9__x03ba__x03b1__x03_1f98a32f-ff64-441c-b22a-24567571e2beFillInRadio' type='checkbox'><label for='_x0394__x03b9__x03ba__x03b1__x03_1f98a32f-ff64-441c-b22a-24567571e2beFillInRadio'>Καθορίστε τη δική σας τιμή:</label>
                  </span> &nbsp;&nbsp;&nbsp;<input type='text' maxlength='255' id='_x0394__x03b9__x03ba__x03b1__x03_1f98a32f-ff64-441c-b22a-24567571e2beFillInText' tabindex='-1' value='' title='Δικαιώματα πρόσβασης σε hardware: Καθορίστε τη δική σας τιμή:'>
                  </td></tr>
                  </tbody>
                  </table>
                  </span>
    <span class='ms-metadata'>Την πλήρη ευθύνη και έλεγχο έχει ο Προϊστάμενος/Διευθυντής του τμήματος γνωρίζοντας <br>&nbsp;τους κινδύνους που μπορεί να προκύψουν και να επηρεάσουν την λειτουργία της εταιρείας <br>&nbsp;π.χ. ιούς,μη θεμιτή μεταφορά δεδομένων.</span>
 </td>
 </tr>
 <tr><td colspan=2 align='center' ><br>
 <input type='submit' name='submitbtn' class='submit' value=''._sx('button', 'Υποβολή').''>
  </td><tr>
 </table>
 </form>";
 echo $out ; 
       //alx    
       echo "<tr class='tab_bg_1'>";
       echo "<td>" . __('ID') . "</td>";
       echo "<td>ertertert ";
       echo $ID;
       echo "</td>";
 
       $this->showFormButtons($options);
 // end main form 
 
    $config->showFormExample() ;
    echo "</div>";
    echo "</th></tr>";

}