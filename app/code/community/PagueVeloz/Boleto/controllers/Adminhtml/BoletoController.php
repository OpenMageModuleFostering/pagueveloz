<?php

class PagueVeloz_Boleto_Adminhtml_BoletoController extends Mage_Adminhtml_Controller_Action
{

    public function indexAction()
    {
        $this->loadLayout();
        $this->renderLayout();
    }

    public function regerarAction()
    {
        if ($this->getRequest()->getParam('isAjax')) {
            $response = array('msg' => '', 'success' => false);

            $boleto_id = $this->getRequest()->getParam('boleto_id');
            if ($boleto_id) {
                try {
                    $boleto = Mage::getModel('pagueveloz_boleto/boleto')->load($boleto_id);

                    if ($boleto) {
                        /** Gerar novo boleto **/
                        $response['url'] = $boleto->regenerate();
                        $response['success'] = true;
                    } else {
                        $response['msg'] = 'Boleto não encontrado';
                    }
                } catch (Exception $e) {
                    $response['msg'] = $e->getMessage();
                }
            } else {
                $order_id = $boleto_id = $this->getRequest()->getParam('order_id');
                $boleto = Mage::getModel('pagueveloz_boleto/boleto')->generate(Mage::getModel('sales/order')->load($order_id));
                if ($boleto->getUrl()) {
                    $response['url'] = $boleto->getUrl();
                    $response['boleto_id'] = $boleto->getId();
                    $response['success'] = true;
                } else {
                    $response['msg'] = 'Boleto não informado.';
                }
            }

            $this->getResponse()->setHeader('Content-type', 'application/json');
            $this->getResponse()->setBody(Mage::helper('core')->jsonEncode($response));
        }
    }

    public function verificarAction()
    {
        if ($this->getRequest()->getParam('isAjax')) {
            $response = array('msg' => '', 'success' => false);

            $boleto_id = $this->getRequest()->getParam('boleto_id');
            if ($boleto_id) {
                try {
                    $boleto = Mage::getModel('pagueveloz_boleto/boleto')->load($boleto_id);

                    if ($boleto) {
                        $pagamento = $boleto->getPagamento();
                        if ($pagamento) {
                            $response['success'] = true;
                            $response['pagamento'] = $pagamento;
                        } else {
                            $response['msg'] = 'Pagamento não efetuado';
                        }
                    } else {
                        $response['msg'] = 'Boleto não encontrado';
                    }
                } catch (Exception $e) {
                    $response['msg'] = $e->getMessage();
                }
            } else {
                $response['msg'] = 'Boleto não informado.';
            }

            $this->getResponse()->setHeader('Content-type', 'application/json');
            $this->getResponse()->setBody(Mage::helper('core')->jsonEncode($response));
        }
    }
} 