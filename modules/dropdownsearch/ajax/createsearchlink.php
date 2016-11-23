<?php
require_once(dirname(__FILE__).'../../../../config/config.inc.php');
require_once(dirname(__FILE__).'../../../../init.php');

$dropdownsearch_query = "";
$dropdownsearch_where = "";
if(Tools::getValue('dropdownsearch_make')){
  $dropdownsearch_where .= 'id_attribute='.Tools::getValue('dropdownsearch_make');
  if(Tools::getValue('dropdownsearch_model')){
    $dropdownsearch_where .= ' OR id_attribute='.Tools::getValue('dropdownsearch_model');
    if(Tools::getValue('dropdownsearch_type')){
      $dropdownsearch_where .= ' OR id_attribute='.Tools::getValue('dropdownsearch_type');
    }
  }
  $sql = new DbQuery();
  $sql->select('name');
  $sql->from('attribute_lang');
  $sql->where('id_lang=1 AND ('.$dropdownsearch_where.')');
  $results = Db::getInstance()->executeS($sql);
  foreach ($results as $result) {
    $dropdownsearch_query .= $result['name']." ";
  }
}
if(Tools::getValue('dropdownsearch_category')){
  $dropdownsearch_query .= Tools::getValue('dropdownsearch_category')." ";
}
if(Tools::getValue('dropdownsearch_manufacturer')){
  $dropdownsearch_query .= Tools::getValue('dropdownsearch_manufacturer')." ";
}
if(Tools::getValue('dropdownsearch_keyword')){
  $dropdownsearch_query .= Tools::getValue('dropdownsearch_keyword')." ";
}
$dropdownsearch_query = preg_replace('/\s+/', '+', rtrim($dropdownsearch_query));

echo $dropdownsearch_query;

?>
