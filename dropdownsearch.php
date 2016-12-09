<?php
/**
* 2007-2016 PrestaShop
*
* NOTICE OF LICENSE
*
* This source file is subject to the Academic Free License (AFL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/afl-3.0.php
* If you did not receive a copy of the license and are unable to
* obtain it through the world-wide-web, please send an email
* to license@prestashop.com so we can send you a copy immediately.
*
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade PrestaShop to newer
* versions in the future. If you wish to customize PrestaShop for your
* needs please refer to http://www.prestashop.com for more information.
*
*  @author    PrestaShop SA <contact@prestashop.com>
*  @copyright 2007-2015 PrestaShop SA
*  @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*/

if (!defined('_PS_VERSION_')) {
    exit;
}

class Dropdownsearch extends Module
{
    protected $config_form = false;

    public function __construct()
    {
        $this->name = 'dropdownsearch';
        $this->tab = 'search_filter';
        $this->version = '1.0.0';
        $this->author = 'Kostas Setzas';
        $this->need_instance = 0;

        /**
         * Set $this->bootstrap to true if your module is compliant with bootstrap (PrestaShop 1.6)
         */
        $this->bootstrap = true;

        parent::__construct();

        $this->displayName = $this->l('Dropdown Search and Filter');
        $this->description = $this->l('Search and filter with dropdown menu, provides dynamic results');

		    $this->confirmUninstall = $this->l('Are you sure you want to uninstall?');
    }

    /**
     * Don't forget to create update methods if needed:
     * http://doc.prestashop.com/display/PS16/Enabling+the+Auto-Update
     */
    public function install()
    {
        //Configuration::updateValue('DROPDOWNSEARCH_LIVE_MODE', false);

        return parent::install() &&
            $this->registerHook('header') &&
            $this->registerHook('backOfficeHeader') &&
            $this->registerHook('displayLeftColumn');
    }

    public function uninstall()
    {
        //Configuration::deleteByName('DROPDOWNSEARCH_LIVE_MODE');

        return parent::uninstall();
    }

    /**
     * Load the configuration form
     */
    public function getContent()
    {
        /**
         * If values have been submitted in the form, process.
         */
        if (((bool)Tools::isSubmit('submitDropdownsearchModule')) == true) {
            $this->postProcess();
        }

        $this->context->smarty->assign('module_dir', $this->_path);

        $output = $this->context->smarty->fetch($this->local_path.'views/templates/admin/configure.tpl');

        return $output.$this->renderForm();
    }

    /**
     * Create the form that will be displayed in the configuration of your module.
     */
    protected function renderForm()
    {
        $helper = new HelperForm();

		    // Module, token and currentIndex
        $helper->module = $this;
        $helper->token = Tools::getAdminTokenLite('AdminModules');
		    $helper->currentIndex = $this->context->link->getAdminLink('AdminModules', false)
            .'&configure='.$this->name.'&tab_module='.$this->tab.'&module_name='.$this->name;

    		// Language
    		$helper->default_form_language = $this->context->language->id;
            $helper->allow_employee_form_lang = Configuration::get('PS_BO_ALLOW_EMPLOYEE_FORM_LANG', 0);

    		// Title and toolbar
    		$helper->show_toolbar = false;

        $helper->table = $this->table;
        $helper->identifier = $this->identifier;
        $helper->submit_action = 'submitDropdownsearchModule';


        $helper->tpl_vars = array(
            'fields_value' => $this->getConfigFormValues(), /* Add values for your inputs */
            'languages' => $this->context->controller->getLanguages(),
            'id_language' => $this->context->language->id,
        );

        return $helper->generateForm(array($this->getConfigForm()));
    }

    /**
     * Create the structure of your form.
     */
    protected function getConfigForm()
    {
        return array(
            'form' => array(
                'legend' => array(
                'title' => $this->l('Settings'),
                'icon' => 'icon-cogs',
                ),
                'input' => array(
                    array(
                        'type' => 'switch',
                        'label' => $this->l('Live mode'),
                        'name' => 'DROPDOWNSEARCH_LIVE_MODE',
                        'is_bool' => true,
                        'desc' => $this->l('Use this module in live mode'),
                        'values' => array(
                            array(
                                'id' => 'active_on',
                                'value' => true,
                                'label' => $this->l('Enabled')
                            ),
                            array(
                                'id' => 'active_off',
                                'value' => false,
                                'label' => $this->l('Disabled')
                            )
                        ),
                    ),
                    array(
                        'col' => 3,
                        'type' => 'text',
                        'prefix' => '<i class="icon icon-envelope"></i>',
                        'desc' => $this->l('Enter a valid email address'),
                        'name' => 'DROPDOWNSEARCH_ACCOUNT_EMAIL',
                        'label' => $this->l('Email'),
                    ),
                    array(
                        'type' => 'password',
                        'name' => 'DROPDOWNSEARCH_ACCOUNT_PASSWORD',
                        'label' => $this->l('Password'),
                    ),
                ),
                'submit' => array(
                    'title' => $this->l('Save'),
                ),
            ),
        );
    }

    /**
     * Set values for the inputs.
     */
    protected function getConfigFormValues()
    {
        return array(
            'DROPDOWNSEARCH_LIVE_MODE' => Configuration::get('DROPDOWNSEARCH_LIVE_MODE', true),
            'DROPDOWNSEARCH_ACCOUNT_EMAIL' => Configuration::get('DROPDOWNSEARCH_ACCOUNT_EMAIL', 'contact@prestashop.com'),
            'DROPDOWNSEARCH_ACCOUNT_PASSWORD' => Configuration::get('DROPDOWNSEARCH_ACCOUNT_PASSWORD', null),
        );
    }

    /**
     * Save form data.
     */
    protected function postProcess()
    {
        $form_values = $this->getConfigFormValues();

        foreach (array_keys($form_values) as $key) {
            Configuration::updateValue($key, Tools::getValue($key));
        }
    }

    /**
    * Add the CSS & JavaScript files you want to be loaded in the BO.
    */
    public function hookBackOfficeHeader()
    {
        if (Tools::getValue('module_name') == $this->name) {
            $this->context->controller->addJS($this->_path.'views/js/back.js');
            $this->context->controller->addCSS($this->_path.'views/css/back.css');
        }
    }

    /**
     * Add the CSS & JavaScript files you want to be added on the FO.
     */
    public function hookHeader()
    {
        $this->context->controller->addJS($this->_path.'/views/js/front.js');
        $this->context->controller->addCSS($this->_path.'/views/css/front.css');
    }

    public function hookDisplayLeftColumn()
    {

      $sql2 = new DbQuery();
      $sql2->select('cl.name');
      $sql2->from('category_lang', 'cl');
      $sql2->innerJoin('category_product', 'cp', 'cl.id_category = cp.id_category');
      $sql2->where('cl.id_lang='.$this->context->language->id);
      $sql2->groupBy('cl.name');
      $sql2->orderBy('cl.name ASC');
      $categories = Db::getInstance()->executeS($sql2);

      $sql3 = new DbQuery();
      $sql3->select('m.name');
      $sql3->from('manufacturer', 'm');
      $sql3->innerJoin('product', 'p', 'm.id_manufacturer = p.id_manufacturer');
      $sql3->where('1');
      $sql3->groupBy('m.name');
      $sql3->orderBy('m.name ASC');
      $manufacturers = Db::getInstance()->executeS($sql3);

  		$this->context->smarty->assign(
  			  array(
            //'dropdownsearch_makes' => $makes,
            'dropdownsearch_categories' => $categories,
            'dropdownsearch_manufacturers' => $manufacturers,
  			  )
  		  );
		  return $this->display(__FILE__, '/views/templates/front/dropdownsearch.tpl');

    }
}
