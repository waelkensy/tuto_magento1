<?php


class Mongroupe_Monmodule_Block_Adminhtml_Monmodule_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        parent::__construct();
        $this->_objectId   = 'id';
        $this->_controller = 'adminhtml_monmodule';
        $this->_blockGroup = 'monmodule';
        $this->_updateButton('save', 'label', 'Save sales point');
        $this->_updateButton('delete', 'label', 'Delete sales point');
    }

    public function getHeaderText()
    {
        if (Mage::registry('current_monmodule')->getId()) {
            return $this->htmlEscape(Mage::registry('current_monmodule')->getNom());
        } else {
            return Mage::helper('monmodule')->__('New sales point');
        }
    }
}
