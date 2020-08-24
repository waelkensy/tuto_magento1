<?php

/**
 * Class Mongroupe_Monmodule_AccountController
 *
 * @author Yannick Waelkens <yannick.waelkens@cgi.com>
 */
require_once("Mage/Customer/controllers/AccountController.php");

class Mongroupe_Monmodule_AccountController extends Mage_Customer_AccountController
{

    /**
     * Customer login form page
     */
    public function loginAction()
    {
        if ($this->_getSession()->isLoggedIn()) {
            $this->_redirect('*/*/');
            return;
        }
        $this->getResponse()->setHeader('Login-Required', 'true');
        $this->loadLayout();
        $this->_initLayoutMessages('customer/session');
        $this->_initLayoutMessages('catalog/session');
        $this->_getSession()->addNotice($this->__('Bonjour ici c\'est le ma surcharge on peut modifier.'));

        $this->renderLayout();
    }

}
