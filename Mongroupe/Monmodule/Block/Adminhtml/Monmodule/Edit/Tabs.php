<?php
class Mongroupe_Monmodule_Block_Adminhtml_Monmodule_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('monmodule_info_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(Mage::helper('monmodule')->__('Sales Point Information'));
    }
    protected function _beforeToHtml()
    {
        $this->addTab('info', array(
            'label' => 'Sales Point Information',
            'title' => 'Sales Point Information',
            'content' => $this->getLayout()->createBlock('monmodule/adminhtml_monmodule_edit_tab_info')->toHtml()
        ));
        return parent::_beforeToHtml();
    }
}
