<?php


class Mongroupe_Monmodule_Adminhtml_MonmoduleController extends Mage_Adminhtml_Controller_Action
{
    public function indexAction()
    {
        if ($this->getRequest()->getQuery('ajax')) {
            $this->_forward('grid');

            return;
        }
        $this->loadLayout();
        $this->_setActiveMenu('monmodule/item1'); // Marquage du menu actif
        // Ajout du block monmodule dans le contenu
        $this->_addContent($this->getLayout()
            ->createBlock('monmodule/adminhtml_monmodule', 'monmodule.container.grid'));

        // Ajout breadcrumb
        $this->_addBreadcrumb(Mage::helper('monmodule')->__('Manage sales point'), Mage::helper('monmodule')
            ->__('Manage sales point')
        );
        $this->renderLayout();
    }

    public function gridAction()
    {
        $this->loadLayout();
        $this->getResponse()->setBody($this->getLayout()->createBlock('monmodule/adminhtml_monmodule_grid')->toHtml());
    }

    public function editAction()
    {
        $monmoduleId    = $this->getRequest()->getParam('id');
        $monmoduleModel = Mage::getModel('monmodule/matable')->load($monmoduleId);

        if ($monmoduleModel->getId() || $monmoduleId == 0) {
            $this->_title($monmoduleModel->getId() ? $monmoduleModel->getNom() : $this->__('New sales point'));
            Mage::register('current_monmodule', $monmoduleModel);
            $this->loadLayout();
            $this->_setActiveMenu('monmodule/item1');
            $this->_addBreadcrumb(Mage::helper('monmodule')
                ->__('Sales Point Manager'), Mage::helper('monmodule')
                ->__('Sales Point Manager'), $this->getUrl('*/*/'));
            $this->_addBreadcrumb(Mage::helper('monmodule')->__('Edit sales point'),
                Mage::helper('monmodule')->__('Edit sales point'));
            $this->getLayout()->getBlock('head')->setCanLoadExtJs(true);
            $this->_addContent($this->getLayout()->createBlock('monmodule/adminhtml_monmodule_edit'))
                ->_addLeft($this->getLayout()->createBlock('monmodule/adminhtml_monmodule_edit_tabs'));
            $this->renderLayout();
        } else {
            Mage::getSingleton('adminhtml/session')->addError(
                Mage::helper('monmodule')->__('The sales point does not exist.'));
            $this->_redirect('*/*/');
        }
    }

    public function newAction()
    {
        $this->getRequest()->setParam('id', 0);
        $this->_forward('edit');
    }


    public function saveAction()
    {
        if ($this->getRequest()->getPost()) {
            try {
                $data           = $this->getRequest()->getPost();
                $monmoduleModel = Mage::getModel('monmodule/matable');
                if ($this->getRequest()->getParam('id') > 0) {
                    $monmoduleModel->setId($this->getRequest()->getParam('id'));
                }
                $monmoduleModel->addData($data)->save();
                Mage::getSingleton('adminhtml/session')->addSuccess(
                    Mage::helper('adminhtml')->__('The sales point has been saved.')
                );
            } catch (Mage_Core_Exception $e) {
                $this->_getSession()->addError($e->getMessage());
                $this->getResponse()->setRedirect($this->getUrl('*/monmodule/edit',
                    array('id' => $monmodule->getId())));

                return;
            }
        }
        $this->_redirect('*/*/');

        return;
    }

    public function deleteAction()
    {
        if ($id = $this->getRequest()->getParam('id')) {
            try {
                $monmoduleModel = Mage::getModel('monmodule/matable');
                $monmoduleModel->setId($id);
                $monmoduleModel->delete();
                Mage::getSingleton('adminhtml/session')->addSuccess(
                    Mage::helper('adminhtml')->__('The sales point has been deleted.')
                );
                $this->_redirect('*/*/');
                return;
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
                return;
            }
        }
        Mage::getSingleton('adminhtml/session')->addError(
            Mage::helper('adminhtml')->__('Unable to find a sales point to delete.')
        );
        $this->_redirect('*/*/');
    }

}
