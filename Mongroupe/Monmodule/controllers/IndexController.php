<?php

class Mongroupe_Monmodule_IndexController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
        echo 'Cas: appel action par défaut LOL';
    }

    public function testAction()
    {
        echo "test";
    }

    public function chargeLayoutAction()
    {
        $this->loadLayout();
        $data         = ['nom' => 'toto', 'nombre_commandes' => '2'];
        $modelMatable = Mage::getModel('monmodule/matable');
        $modelMatable->setData($data);
        $modelMatable->save();

        $this->renderLayout();
    }

    public function sansParamAction()
    {
        echo 'Cas: appel autre action sans paramètres';
    }

    public function avecParamAction()
    {
// retourne un tableau contenant tous les paramètres avec leurs valeurs
        $params = $this->getRequest()->getParams();
        echo 'Cas: appel action avec ' . sizeof($params) . ' paramètres';
        foreach ($params as $param => $value) {
            echo '<br/>' . $param . '=>' . $value;
        }
    }


}
