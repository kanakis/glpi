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

namespace GlpiPlugin\Example;
use Html;
use Ticket;

/**
 * Summary of GlpiPlugin\Example\ItemForm
 * Example of *_item_form implementation
 * @see http://glpi-developer-documentation.rtfd.io/en/master/plugins/hooks.html#items-display-related
 * */
class ItemForm {

   /**
    * Display contents at the begining of item forms.
    *
    * @param array $params Array with "item" and "options" keys
    *
    * @return void
    */
   static public function preItemForm($params) {
      $item = $params['item'];
      $options = $params['options'];

      $firstelt = ($item::getType() == Ticket::class ? 'th' : 'td');

      $out = '<tr><th colspan="' . (isset($options['colspan']) ? $options['colspan'] * 2 : '4') . '">';
      $out .= sprintf(
         __('Start %1$s hook call for %2$s type'),
         'pre_item_form',
         $item::getType()
      );
      $out .= '</th></tr>';

      $out .= "<tr><$firstelt>";
      $out .= '<label for="example_pre_form_hook">' . __('First pre form hook') . ' GGGGG</label>';
      $out .= "</$firstelt><td>";
      $out .= '<input type="text" name="example_pre_form_hook" id="example_pre_form_hook"/>';
      $out .= "</td><$firstelt>";
      $out .= '<label for="example_pre_form_hook2">' . __('Second pre form hook') . ' FFFF </label>';
      $out .= "</$firstelt><td>";
      $out .= '<input type="text" name="example_pre_form_hook2" id="example_pre_form_hook2"/>';
      $out .= ' fffffff </td></tr>';

      $out .= '<tr><th colspan="' . (isset($options['colspan']) ? $options['colspan'] * 2 : '4') . '">';
      $out .= sprintf(
         __('End %1$s hook call for %2$s type'),
         'pre_item_form',
         $item::getType()
      );
      $out .= '</th></tr>';

      echo $out;
   }

   /**
    * Display contents at the begining of item forms.
    *
    * @param array $params Array with "item" and "options" keys
    *
    * @return void
    */
   static public function postItemForm($params) {
      $item = $params['item'];
      $options = $params['options'];

      $firstelt = ($item::getType() == Ticket::class ? 'th' : 'td');

      $out = '<tr><th colspan="' . (isset($options['colspan']) ? $options['colspan'] * 2 : '4') . '">';
      $out .= sprintf(
         __('Start %1$s hook call for %2$s type'),
         'post_item_form',
         $item::getType()
      );
      $out .= '</th></tr>';

      $out .= "<tr><$firstelt>";
      $out .= '<label for="example_post_form_hook">' . __('First post form hook') . '</label>';
      $out .= "</$firstelt><td>";
      $out .= '<input type="text" name="example_post_form_hook" id="example_post_form_hook"/>';
      $out .= "</td><$firstelt>";
      $out .= '<label for="example_post_form_hook2">' . __('Second post form hook') . ' </label>';
      $out .= "</$firstelt><td>";
      $out .= '<input type="text" name="example_post_form_hook2" id="example_post_form_hook2"/>';
      $out .= '</td></tr>';

      $out .= '<tr><th colspan="' . (isset($options['colspan']) ? $options['colspan'] * 2 : '4') . '">';

      
      $out .= sprintf(
         __('End %1$s hook call for %2$s type'),
         'post_item_form',
         $item::getType()
      );
      $out .= '</th></tr>';


      $out .='<tr><th colspan="' . (isset($options['colspan']) ? $options['colspan'] * 2 : '4') . '">';
//       $out .='<span style="color:Orange; font-size:15pt;">Εισαγωγή Εργασίας !</span> </th></tr>';
//       $out .='<tr><td>Τίτλος-Περιγραφή αιτήματος </td><td><input type="text" value="" maxlength="255" id="Title_fa564e0f-0c70-4ab9-b863-0177e6ddd247_$TextField" title="Τίτλος-Περιγραφή αιτήματος Απαιτούμενο πεδίο" style="ime-mode : " class="ms-long ms-spellcheck-true"></td></tr>'; 
//       $out .= '<tr><td nowrap="true" valign="top" width="113px" class="ms-formlabel"><span class="ms-h3 ms-standardheader" id="_x03a0__x03b5__x03c1__x03b9__x03">
// 		             <nobr>Περιγραφή</nobr></span></td><td valign="top" width="350px" class="ms-formbody">
// 			          <span dir="none"><span dir="ltr"><textarea rows="10" cols="120" id="_x03a0__x03b5__x03c1__x03b9__x03_9bcf3adb-d632-4c3f-a8dd-07ee7903268e_$TextField" title="Πρόγραμμα επεξεργασίας εμπλουτισμένου κειμένου Περιγραφή" class="ms-long"></textarea><input type="hidden" id="_x03a0__x03b5__x03c1__x03b9__x03_9bcf3adb-d632-4c3f-a8dd-07ee7903268e_$TextField_spSave"></span><br><span class="ms-formdescription"></span><br></span>				
// 		         </td>
// 	         </tr>';
//       $out .='<tr><td nowrap="true" valign="top" width="113px" class="ms-formlabel"><span class="ms-h3 ms-standardheader" id="_x039a__x03bb__x03ac__x03b4__x03">
// 		<nobr>Κλάδος/Τμήμα<span class="ms-accentText" title="Αυτό το πεδίο είναι υποχρεωτικό."> *</span></nobr></span></td>
// 		<td valign="top" width="350px" class="ms-formbody">
// 			<span dir="none"><select id="_x039a__x03bb__x03ac__x03b4__x03_0defce26-0711-4305-b1cf-b2adee9a7548_$DropDownChoice" title="Κλάδος/Τμήμα Απαιτούμενο πεδίο" class="ms-RadioText"><option value="" selected="selected"></option><option value="Κλάδος Αυτοκινήτων">Κλάδος Αυτοκινήτων</option><option value="Λοιποί κλάδοι">Λοιποί κλάδοι</option><option value="Εταιρική Διακυβέρνηση">Εταιρική Διακυβέρνηση</option><option value="Οικονομική Διεύθυνση">Οικονομική Διεύθυνση</option><option value="Οικονομική Διαχείριση">Οικονομική Διαχείριση</option><option value="Τεχνική Διεύθυνση">Τεχνική Διεύθυνση</option><option value="Τμήμα Ζημιών">Τμήμα Ζημιών</option><option value="Πωλήσεις">Πωλήσεις</option><option value="Νομικό τμήμα">Νομικό τμήμα</option><option value="Γενική Διεύθυνση">Γενική Διεύθυνση</option><option value="Τμήμα Πληροφορικής">Τμήμα Πληροφορικής</option><option value="Υποκατάστημα Θεσσαλονίκης">Υποκατάστημα Θεσσαλονίκης</option><option value="Κατάστημα Πάτρας">Κατάστημα Πάτρας</option><option value="Κατάστημα Χαλκίδας">Κατάστημα Χαλκίδας</option><option value="Κατάστημα Λυκόβρυσης">Κατάστημα Λυκόβρυσης</option><option value="Κατάστημα Βόλου">Κατάστημα Βόλου</option><option value="Κατάστημα Ιωαννίνων">Κατάστημα Ιωαννίνων</option><option value="Κατάστημα Γαλατσίου">Κατάστημα Γαλατσίου</option><option value="Κατάστημα Κιλκίς">Κατάστημα Κιλκίς</option><option value="NP">NP</option></select><br></span>
// 		</td> </tr>';
//       $out .='<tr>
// 		<td nowrap="true" valign="top" width="113px" class="ms-formlabel"><span class="ms-h3 ms-standardheader" id="_x03a0__x03c1__x03bf__x03c4__x03">
// 		<nobr>Προτεραιότητα</nobr>
// 	</span></td>
// 		<td valign="top" width="350px" class="ms-formbody">
// 		<span dir="none"><select id="_x03a0__x03c1__x03bf__x03c4__x03_effed118-e810-40eb-8085-6f9609eb347a_$DropDownChoice" title="Προτεραιότητα" class="ms-RadioText"><option value="(1) Υψηλή">(1) Υψηλή</option><option value="(2) Κανονική" selected="selected">(2) Κανονική</option><option value="(3) Χαμηλή">(3) Χαμηλή</option></select><br></span>
// 		</td>
// 	</tr>' ; 
// $out .='<tr><td nowrap="true" valign="top" width="113px" class="ms-formlabel"><span class="ms-h3 ms-standardheader" id="_x0395__x03af__x03b4__x03bf__x03">
//      <nobr>Είδος αίτησης<span class="ms-accentText" title="Αυτό το πεδίο είναι υποχρεωτικό."> *</span></nobr>
//       </span></td>
//       <td valign="top" width="350px" class="ms-formbody"><span dir="none"><select id="_x0395__x03af__x03b4__x03bf__x03_b43f22ad-98a5-4c2b-a49d-03f7c49c4b4a_$DropDownChoice" title="Είδος αίτησης Απαιτούμενο πεδίο" class="ms-RadioText"><option value="" selected="selected"></option><option value="1.Προσθήκη δικαιωμάτων χρήστη.">1.Προσθήκη δικαιωμάτων χρήστη.</option><option value="2.Αφαίρεση δικαιωμάτων χρήστη.">2.Αφαίρεση δικαιωμάτων χρήστη.</option><option value="3.Νέος σταθμός εργασίας/Δικαιώματα χρήστη.">3.Νέος σταθμός εργασίας/Δικαιώματα χρήστη.</option><option value="4.Διαγραφή χρήστη/κατάργηση δικαιωμάτων.">4.Διαγραφή χρήστη/κατάργηση δικαιωμάτων.</option></select><br></span></td></tr>';
// $out .= '<tr><td nowrap="true" valign="top" width="113px" class="ms-formlabel"><span class="ms-h3 ms-standardheader" id="_x039f__x03bd__x03bf__x03bc__x00">
//           <nobr>Ονομ/νυμο χρήστη που αφορούν οι αλλαγές</nobr></span></td>
//          <td valign="top" width="350px" class="ms-formbody">
//          <div dir="none"><div class="sp-peoplepicker-topLevel" id="_x039f__x03bd__x03bf__x03bc__x00_aaebe08f-0ce8-4883-9689-f954a426cf7c_$ClientPeoplePicker" title="Ονομ/νυμο χρήστη που αφορούν οι αλλαγές" spclientpeoplepicker="true"><input id="_x039f__x03bd__x03bf__x03bc__x00_aaebe08f-0ce8-4883-9689-f954a426cf7c_$ClientPeoplePicker_HiddenInput" name="_x039f__x03bd__x03bf__x03bc__x00_aaebe08f-0ce8-4883-9689-f954a426cf7c_$ClientPeoplePicker_HiddenInput" type="hidden"><div id="_x039f__x03bd__x03bf__x03bc__x00_aaebe08f-0ce8-4883-9689-f954a426cf7c_$ClientPeoplePicker_AutoFillDiv" aria-live="assertive" class="sp-peoplepicker-autoFillContainer"></div><span id="_x039f__x03bd__x03bf__x03bc__x00_aaebe08f-0ce8-4883-9689-f954a426cf7c_$ClientPeoplePicker_InitialHelpText" class="sp-peoplepicker-initialHelpText ms-helperText">Εισαγωγή ονομάτων ή διευθύνσεων ηλεκτρονικού ταχυδρομείου...</span><img class="sp-peoplepicker-waitImg" id="_x039f__x03bd__x03bf__x03bc__x00_aaebe08f-0ce8-4883-9689-f954a426cf7c_$ClientPeoplePicker_WaitImage" alt="Αυτή η κίνηση υποδεικνύει ότι η λειτουργία είναι σε εξέλιξη. Κάντε κλικ για να καταργήσετε την κινούμενη εικόνα." src="/_layouts/15/images/gears_anv4.gif?rev=43"><span id="_x039f__x03bd__x03bf__x03bc__x00_aaebe08f-0ce8-4883-9689-f954a426cf7c_$ClientPeoplePicker_ResolvedList" class="sp-peoplepicker-resolveList"></span><span id="_x039f__x03bd__x03bf__x03bc__x00_aaebe08f-0ce8-4883-9689-f954a426cf7c_$ClientPeoplePicker_NotificationSpan" aria-live="polite" style="visibility:hidden;position:absolute;width:0px;display:inline-block;"></span><input type="text" class="sp-peoplepicker-editorInput" size="1" autocomplete="off" value="" id="_x039f__x03bd__x03bf__x03bc__x00_aaebe08f-0ce8-4883-9689-f954a426cf7c_$ClientPeoplePicker_EditorInput" title="Ονομ/νυμο χρήστη που αφορούν οι αλλαγές" autocorrect="off" autocapitalize="off" data-sp-peoplepickereditor="true"></div></div><span class="ms-metadata">Για νέο χρήστη , συμπληρώστε το όνομ/νυμο μόνο στην περιγραφή.</span>
//          </td>
//          </tr>';
// $out .='<tr><td nowrap="true" valign="top" width="113px" class="ms-formlabel"><span class="ms-h3 ms-standardheader" id="_x0395__x03c6__x03b1__x03c1__x03">
// <br><nobr><h3>Δικαιώματα Εφαρμογών</h3></nobr></span></td>
// <td valign="top" width="100%" class="ms-formbody">
//    <span dir="none">
//    <table id="" cellpadding="2" cellspacing="1" width="100%" border="1">
      
//          <tr><td><span title="IRP-Κύρια ασφαλιστική εφαρμογή"><input id="_x0395__x03c6__x03b1__x03c1__x03_5f98d345-4a47-4abd-81ca-a74e62c5fb9f_MultiChoiceOption_0" type="checkbox">&nbsp;<label for="_x0395__x03c6__x03b1__x03c1__x03_5f98d345-4a47-4abd-81ca-a74e62c5fb9f_MultiChoiceOption_0">IRP-Κύρια ασφαλιστική εφαρμογή</label></span></td>
//          <td><span title="PORTAL"><input id="_x0395__x03c6__x03b1__x03c1__x03_5f98d345-4a47-4abd-81ca-a74e62c5fb9f_MultiChoiceOption_1" type="checkbox">&nbsp;<label for="_x0395__x03c6__x03b1__x03c1__x03_5f98d345-4a47-4abd-81ca-a74e62c5fb9f_MultiChoiceOption_1">PORTAL</label></span></td>
//          <td><span title="NP BANK"><input id="_x0395__x03c6__x03b1__x03c1__x03_5f98d345-4a47-4abd-81ca-a74e62c5fb9f_MultiChoiceOption_2" type="checkbox">&nbsp;<label for="_x0395__x03c6__x03b1__x03c1__x03_5f98d345-4a47-4abd-81ca-a74e62c5fb9f_MultiChoiceOption_2">NP BANK</label></span></td></tr>
//          <tr><td><span title="NP REPORTS"><input id="_x0395__x03c6__x03b1__x03c1__x03_5f98d345-4a47-4abd-81ca-a74e62c5fb9f_MultiChoiceOption_3" type="checkbox">&nbsp;<label for="_x0395__x03c6__x03b1__x03c1__x03_5f98d345-4a47-4abd-81ca-a74e62c5fb9f_MultiChoiceOption_3">NP REPORTS</label></span></td>
//          <td><span title="MS OUTLOOK"><input id="_x0395__x03c6__x03b1__x03c1__x03_5f98d345-4a47-4abd-81ca-a74e62c5fb9f_MultiChoiceOption_4" type="checkbox">&nbsp;<label for="_x0395__x03c6__x03b1__x03c1__x03_5f98d345-4a47-4abd-81ca-a74e62c5fb9f_MultiChoiceOption_4">MS OUTLOOK</label></span></td>
//          <td><span title="MS OFFICE(Word,Excel,Powerpoint)"><input id="_x0395__x03c6__x03b1__x03c1__x03_5f98d345-4a47-4abd-81ca-a74e62c5fb9f_MultiChoiceOption_5" type="checkbox">&nbsp;<label for="_x0395__x03c6__x03b1__x03c1__x03_5f98d345-4a47-4abd-81ca-a74e62c5fb9f_MultiChoiceOption_5">MS OFFICE(Word,Excel,Powerpoint)</label></span></td></tr>
//          <tr><td><span title="FAX SERVER"><input id="_x0395__x03c6__x03b1__x03c1__x03_5f98d345-4a47-4abd-81ca-a74e62c5fb9f_MultiChoiceOption_6" type="checkbox">&nbsp;<label for="_x0395__x03c6__x03b1__x03c1__x03_5f98d345-4a47-4abd-81ca-a74e62c5fb9f_MultiChoiceOption_6">FAX SERVER</label></span></td>
//          <td><span title="INTERNET"><input id="_x0395__x03c6__x03b1__x03c1__x03_5f98d345-4a47-4abd-81ca-a74e62c5fb9f_MultiChoiceOption_7" type="checkbox">&nbsp;<label for="_x0395__x03c6__x03b1__x03c1__x03_5f98d345-4a47-4abd-81ca-a74e62c5fb9f_MultiChoiceOption_7">INTERNET</label></span></td>
//          <td><span title="MIS(ΠΑΛΑΙΟ)"><input id="_x0395__x03c6__x03b1__x03c1__x03_5f98d345-4a47-4abd-81ca-a74e62c5fb9f_MultiChoiceOption_8" type="checkbox">&nbsp;<label for="_x0395__x03c6__x03b1__x03c1__x03_5f98d345-4a47-4abd-81ca-a74e62c5fb9f_MultiChoiceOption_8">MIS(ΠΑΛΑΙΟ)</label></span></td></tr>
//          <tr><td><span title="MIS(ΝΕΟ)"><input id="_x0395__x03c6__x03b1__x03c1__x03_5f98d345-4a47-4abd-81ca-a74e62c5fb9f_MultiChoiceOption_9" type="checkbox">&nbsp;<label for="_x0395__x03c6__x03b1__x03c1__x03_5f98d345-4a47-4abd-81ca-a74e62c5fb9f_MultiChoiceOption_9">MIS(ΝΕΟ)</label></span></td>
//          <td><span title="PAPYRUS"><input id="_x0395__x03c6__x03b1__x03c1__x03_5f98d345-4a47-4abd-81ca-a74e62c5fb9f_MultiChoiceOption_10" type="checkbox">&nbsp;<label for="_x0395__x03c6__x03b1__x03c1__x03_5f98d345-4a47-4abd-81ca-a74e62c5fb9f_MultiChoiceOption_10">PAPYRUS</label></span></td>
//          <td><span title="TEST IRP"><input id="_x0395__x03c6__x03b1__x03c1__x03_5f98d345-4a47-4abd-81ca-a74e62c5fb9f_MultiChoiceOption_11" type="checkbox">&nbsp;<label for="_x0395__x03c6__x03b1__x03c1__x03_5f98d345-4a47-4abd-81ca-a74e62c5fb9f_MultiChoiceOption_11">TEST IRP</label></span></td></tr>
//          <tr><td><span title="TEST PORTAL"><input id="_x0395__x03c6__x03b1__x03c1__x03_5f98d345-4a47-4abd-81ca-a74e62c5fb9f_MultiChoiceOption_12" type="checkbox">&nbsp;<label for="_x0395__x03c6__x03b1__x03c1__x03_5f98d345-4a47-4abd-81ca-a74e62c5fb9f_MultiChoiceOption_12">TEST PORTAL</label></span></td>
//          <td><span title="Πρόγραμμα μισθοδοσίας"><input id="_x0395__x03c6__x03b1__x03c1__x03_5f98d345-4a47-4abd-81ca-a74e62c5fb9f_MultiChoiceOption_13" type="checkbox">&nbsp;<label for="_x0395__x03c6__x03b1__x03c1__x03_5f98d345-4a47-4abd-81ca-a74e62c5fb9f_MultiChoiceOption_13">Πρόγραμμα μισθοδοσίας</label></span></td>
//          <td><span title="Solvency II - Systemic"><input id="_x0395__x03c6__x03b1__x03c1__x03_5f98d345-4a47-4abd-81ca-a74e62c5fb9f_MultiChoiceOption_14" type="checkbox">&nbsp;<label for="_x0395__x03c6__x03b1__x03c1__x03_5f98d345-4a47-4abd-81ca-a74e62c5fb9f_MultiChoiceOption_14">Solvency II - Systemic</label></span></td></tr>
//          <tr><td><span title="ΥΣΑΕ"><input id="_x0395__x03c6__x03b1__x03c1__x03_5f98d345-4a47-4abd-81ca-a74e62c5fb9f_MultiChoiceOption_15" type="checkbox">&nbsp;<label for="_x0395__x03c6__x03b1__x03c1__x03_5f98d345-4a47-4abd-81ca-a74e62c5fb9f_MultiChoiceOption_15">ΥΣΑΕ</label></span></td>
//          <td><span title="ΓΔΑ"><input id="_x0395__x03c6__x03b1__x03c1__x03_5f98d345-4a47-4abd-81ca-a74e62c5fb9f_MultiChoiceOption_16" type="checkbox">&nbsp;<label for="_x0395__x03c6__x03b1__x03c1__x03_5f98d345-4a47-4abd-81ca-a74e62c5fb9f_MultiChoiceOption_16">ΓΔΑ</label></span></td>
//          <td><span title="HIC"><input id="_x0395__x03c6__x03b1__x03c1__x03_5f98d345-4a47-4abd-81ca-a74e62c5fb9f_MultiChoiceOption_17" type="checkbox">&nbsp;<label for="_x0395__x03c6__x03b1__x03c1__x03_5f98d345-4a47-4abd-81ca-a74e62c5fb9f_MultiChoiceOption_17">HIC</label></span></td></tr>
//          <tr><td><span title="Επενδυτικό πρόγραμμα"><input id="_x0395__x03c6__x03b1__x03c1__x03_5f98d345-4a47-4abd-81ca-a74e62c5fb9f_MultiChoiceOption_18" type="checkbox">&nbsp;<label for="_x0395__x03c6__x03b1__x03c1__x03_5f98d345-4a47-4abd-81ca-a74e62c5fb9f_MultiChoiceOption_18">Επενδυτικό πρόγραμμα</label></span></td>
//          <td><span title="Κοινόχρηστα αρχεία τμήματος"><input id="_x0395__x03c6__x03b1__x03c1__x03_5f98d345-4a47-4abd-81ca-a74e62c5fb9f_MultiChoiceOption_19" type="checkbox">&nbsp;<label for="_x0395__x03c6__x03b1__x03c1__x03_5f98d345-4a47-4abd-81ca-a74e62c5fb9f_MultiChoiceOption_19">Κοινόχρηστα αρχεία τμήματος</label></span></td>
//          <td><span title="AGENTS"><input id="_x0395__x03c6__x03b1__x03c1__x03_5f98d345-4a47-4abd-81ca-a74e62c5fb9f_MultiChoiceOption_20" type="checkbox">&nbsp;<label for="_x0395__x03c6__x03b1__x03c1__x03_5f98d345-4a47-4abd-81ca-a74e62c5fb9f_MultiChoiceOption_20">AGENTS</label></span></td></tr>
//          <tr><td colspan=3><span title="Καθορίστε τη δική σας τιμή:"><input id="_x0395__x03c6__x03b1__x03c1__x03_5f98d345-4a47-4abd-81ca-a74e62c5fb9fFillInRadio" type="checkbox">&nbsp;<label for="_x0395__x03c6__x03b1__x03c1__x03_5f98d345-4a47-4abd-81ca-a74e62c5fb9fFillInRadio">Καθορίστε τη δική σας τιμή:</label></span>
//          &nbsp;&nbsp;&nbsp;<input type="text" maxlength="255" id="_x0395__x03c6__x03b1__x03c1__x03_5f98d345-4a47-4abd-81ca-a74e62c5fb9fFillInText" tabindex="-1" value="" title="Δικαιώματα Εφαρμογών: Καθορίστε τη δική σας τιμή:"></td></tr>
         
//          </table>
//          </span>
//          <span class="ms-metadata">Την πλήρη ευθύνη και έλεγχο έχει ο Προϊστάμενος/Διευθυντής του τμήματος γνωρίζοντας <br>&nbsp;τους κινδύνους που μπορεί να προκύψουν και να επηρεάσουν την λειτουργία της εταιρείας <br>&nbsp;π.χ. ιούς,μη θεμιτή μεταφορά δεδομένων.</span>   
//       </td>
//       </tr>';  
//    $out.= '<tr><td nowrap="true" valign="top" width="50%" class="ms-formlabel"><span class="ms-h3 ms-standardheader" id="_x03a3__x03b5__x03bb__x03af__x03">
//          <br><nobr><h3>Σελίδες πρόσβασης στο internet</h3></nobr>
//          </span></td>
//          <td valign="top" width="50%" class="ms-formbody">
//          <span dir="none"><span dir="ltr"><textarea rows="10" cols="120" id="_x03a3__x03b5__x03bb__x03af__x03_716449f2-bcaf-4b7e-9bc6-a68c6f7db398_$TextField" title="Πρόγραμμα επεξεργασίας εμπλουτισμένου κειμένου Σελίδες πρόσβασης στο internet" class="ms-long"></textarea><input type="hidden" id="_x03a3__x03b5__x03bb__x03af__x03_716449f2-bcaf-4b7e-9bc6-a68c6f7db398_$TextField_spSave"></span><br><span class="ms-formdescription"><a href="">Κάντε κλικ για να λάβετε βοήθεια σχετικά με την προσθήκη βασικής μορφοποίησης HTML.</a></span><br></span>
//          </td>
//          </tr>';   
//    $out .= '<tr>
//       <td nowrap="true" valign="center" width="113px" class="ms-formlabel"><span class="ms-h3 ms-standardheader" id="_x0394__x03b9__x03ba__x03b1__x03"><br>
//       <nobr><h3>Δικαιώματα πρόσβασης σε hardware</h3></nobr></span></td>
//       <td valign="top" width="350px" class="ms-formbody">
//          <span dir="none">
//          <table cellpadding="0" cellspacing="1">
//             <tbody>
//             <tr><td><span class="ms-RadioText" title="CD/DVD">
//                 <input id="_x0394__x03b9__x03ba__x03b1__x03_1f98a32f-ff64-441c-b22a-24567571e2be_MultiChoiceOption_0" type="checkbox"><label for="_x0394__x03b9__x03ba__x03b1__x03_1f98a32f-ff64-441c-b22a-24567571e2be_MultiChoiceOption_0">CD/DVD</label>
//                </span></td>
//                <td><span class="ms-RadioText" title="USB DISK">
//                  <input id="_x0394__x03b9__x03ba__x03b1__x03_1f98a32f-ff64-441c-b22a-24567571e2be_MultiChoiceOption_1" type="checkbox"><label for="_x0394__x03b9__x03ba__x03b1__x03_1f98a32f-ff64-441c-b22a-24567571e2be_MultiChoiceOption_1">USB DISK</label>
//                </span></td>
//                <td><span class="ms-RadioText" title="Σύνδεση φωτογραφικής μηχανής">
//                <input id="_x0394__x03b9__x03ba__x03b1__x03_1f98a32f-ff64-441c-b22a-24567571e2be_MultiChoiceOption_2" type="checkbox"><label for="_x0394__x03b9__x03ba__x03b1__x03_1f98a32f-ff64-441c-b22a-24567571e2be_MultiChoiceOption_2">Σύνδεση φωτογραφικής μηχανής</label>
//                </span></td></tr>
//                <tr><td colspan=3><span class="ms-RadioText" title="Καθορίστε τη δική σας τιμή:">
//                  <input id="_x0394__x03b9__x03ba__x03b1__x03_1f98a32f-ff64-441c-b22a-24567571e2beFillInRadio" type="checkbox"><label for="_x0394__x03b9__x03ba__x03b1__x03_1f98a32f-ff64-441c-b22a-24567571e2beFillInRadio">Καθορίστε τη δική σας τιμή:</label>
//                  </span> &nbsp;&nbsp;&nbsp;<input type="text" maxlength="255" id="_x0394__x03b9__x03ba__x03b1__x03_1f98a32f-ff64-441c-b22a-24567571e2beFillInText" tabindex="-1" value="" title="Δικαιώματα πρόσβασης σε hardware: Καθορίστε τη δική σας τιμή:">
//                  </td></tr>
//                </tbody>
//          </table>
//          </span>
      
//                   <span class="ms-metadata">Την πλήρη ευθύνη και έλεγχο έχει ο Προϊστάμενος/Διευθυντής του τμήματος γνωρίζοντας <br>&nbsp;τους κινδύνους που μπορεί να προκύψουν και να επηρεάσουν την λειτουργία της εταιρείας <br>&nbsp;π.χ. ιούς,μη θεμιτή μεταφορά δεδομένων.</span>
   
//          </td>
//          </tr>
//          </table>';


      //$this->showFormButtons();
      echo $out;
   }

   static public function timelineActions($params = []) {
      $rand   = $params['rand'];
      $ticket = $params['item'];

      if (get_class($ticket) !== "Ticket") {
         return false;
      }

      $edit_panel = "viewitem".$ticket->fields['id'].$rand;
      $JS = <<<JAVASCRIPT
      $(function() {
         $(document).on('click', '#email_transfer_{$rand}', function(event) {
            $('#{$edit_panel}').html('email send');
         });
      });
JAVASCRIPT;

      echo "<li class='followup' id='email_transfer_$rand'>
            <i class='far fa-envelope'></i>".
            __("Send a notification").
            Html::scriptBlock($JS)."
        </li>";
   }
}
