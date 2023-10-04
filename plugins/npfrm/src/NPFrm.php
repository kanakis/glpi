<?php
namespace GlpiPlugin\NPFrmplugin;

class NPFrmObject extends CommonDBTM {
   public function showForm($ID, array $options = []) {
      global $CFG_GLPI;

      $this->initForm($ID, $options);
      $this->showFormHeader($options);

      if (!isset($options['display'])) {
         //display per default
         $options['display'] = true;
      }

      $params = $options;
      //do not display called elements per default; they'll be displayed or returned here
      $params['display'] = false;

      $out = '<tr>';
      $out .= '<th>' . __('My label', 'npfrmplugin') . '</th>';

      $objectName = autoName(
         $this->fields["name"],
         "name",
         (isset($options['withtemplate']) && $options['withtemplate']==2),
         $this->getType(),
         $this->fields["entities_id"]
      );

      $out .= '<td>';
      $out .= Html::autocompletionTextField(
         $this,
         'name',
         [
            'value'     => $objectName,
            'display'   => false
         ]
      );
      $out .= '</td>';

      $out .= $this->showFormButtons($params);

      if ($options['display'] == true) {
         echo $out;
      } else {
         return $out;
      }
   }
}