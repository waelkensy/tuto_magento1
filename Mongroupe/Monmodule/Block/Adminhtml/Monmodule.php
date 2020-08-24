<?php

class Mongroupe_Monmodule_Block_Adminhtml_Monmodule extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        $this->_controller     = 'adminhtml_monmodule';
        $this->_blockGroup     = 'monmodule';
        $this->_headerText     = Mage::helper('monmodule')->__('Manage sales point');
        $this->_addButtonLabel = Mage::helper('monmodule')->__('Add New Sales Point');
        parent::__construct();
    }
}
