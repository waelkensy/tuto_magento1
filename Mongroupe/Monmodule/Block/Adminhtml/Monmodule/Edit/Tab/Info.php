<?php

class Mongroupe_Monmodule_Block_Adminhtml_Monmodule_Edit_Tab_Info extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        $form           = new Varien_Data_Form();
        $monmoduleModel = Mage::registry('current_monmodule');
        $fieldset       = $form->addFieldset('base_fieldset',
            array('legend' => Mage::helper('customer')->__('Sales Point Information'))
        );
        $fieldset->addField('nom', 'text',
            array(
                'label'    => Mage::helper('monmodule')->__('Name'),
                'class'    => 'required-entry',
                'required' => true,
                'name'     => 'nom',
            ));
        $fieldset->addField('nombre_commandes', 'text',
            array(
                'label'    => Mage::helper('monmodule')->__('Nombre commande'),
                'class'    => 'required-entry',
                'required' => true,
                'name'     => 'nombre commandes',
            ));
        $form->setValues($monmoduleModel->getData());
        $this->setForm($form);

        return parent::_prepareForm();
    }
}
