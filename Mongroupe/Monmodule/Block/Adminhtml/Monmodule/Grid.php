<?php

class Mongroupe_Monmodule_Block_Adminhtml_Monmodule_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('monmoduleGrid');
        $this->setUseAjax(true);
        $this->setDefaultSort('id');
        $this->setDefaultDir('desc');
        $this->setSaveParametersInSession(true);
    }

    protected function _prepareCollection()
    {
        $collection = Mage::getModel('monmodule/matable')->getCollection()
            ->addFieldToSelect('*');
        $this->setCollection($collection);
        parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $this->addColumn('id',
            array(
                'header' => Mage::helper('monmodule')->__('ID'),
                'width'  => '50px',
                'index'  => 'id',
                'type'   => 'number'
            ));
        $this->addColumn('nom',
            array(
                'header' => Mage::helper('monmodule')->__('Name'),
                'width'  => '150px',
                'index'  => 'nom',
                'type'   => 'text',
            ));
        $this->addColumn('num commandes',
            array(
                'header' => Mage::helper('monmodule')->__('num commande'),
                'width'  => '150px',
                'index'  => 'nombre_commandes',
                'type'   => 'text',
            ));

        return parent::_prepareColumns();
    }

    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', array('id' => $row->getId()));
    }
}
