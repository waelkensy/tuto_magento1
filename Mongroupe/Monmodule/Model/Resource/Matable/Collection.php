<?php


class Mongroupe_MonModule_Model_Resource_Matable_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract
{
    public function _construct()
    {
        $this->_init('monmodule/matable');
    }
}
