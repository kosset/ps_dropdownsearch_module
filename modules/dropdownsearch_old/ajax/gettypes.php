<?php
require_once(dirname(__FILE__).'../../../../config/config.inc.php');
require_once(dirname(__FILE__).'../../../../init.php');

$dropdownsearch_type = Tools::getValue('dropdownsearch_type');

$sql = new DbQuery();
$sql->select('al.name, al.id_attribute');
$sql->from('attribute_lang', 'al');
$sql->innerJoin('attribute', 'a', 'al.id_attribute = a.id_attribute');
$sql->where('a.id_attribute_group=6 AND al.id_lang=1 AND
            a.id_attribute IN (SELECT id_attribute
                  FROM ps_product_attribute_combination
                  WHERE id_product_attribute IN (SELECT id_product_attribute
                                                FROM ps_product_attribute_combination
                                                WHERE id_attribute ='.$dropdownsearch_type.')
                                                GROUP BY id_attribute)'
            );
$sql->orderBy('al.name ASC');
$results = Db::getInstance()->executeS($sql);

echo json_encode($results);

?>
