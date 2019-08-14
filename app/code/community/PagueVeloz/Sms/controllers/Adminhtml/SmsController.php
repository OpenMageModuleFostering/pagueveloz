<?php

class PagueVeloz_Sms_Adminhtml_SmsController extends Mage_Adminhtml_Controller_Action
{

    public function indexAction()
    {
        $this->loadLayout();
        $this->renderLayout();
    }

    /*
     * Retorno do result:
     * object(stdClass)#282 (5) {
     *  ["Codigo"]=>
     *  string(36) "74f68154-011a-43c9-9190-0fa9a9c59add"
     *  ["Creditos"]=>
     *  int(780)
     *  ["Valor"]=>
     *  float(117)
     *  ["UrlBoleto"]=>
     *  string(77) "https://x.credinet.com.br/Boleto/01698616500000117000001001000738900000009801"
     *  ["Id"]=>
     *  int(58)
     * }
     *
     */

    public function comprarAction()
    {
        if ($this->getRequest()->getParam('isAjax')) {
            $response = array('msg' => '', 'success' => false);

            $payment_type = $this->getRequest()->getParam('payment_type');
            $buy_type = $this->getRequest()->getParam('buy_type');
            $value = $this->getRequest()->getParam('value');

            if ($value) {
                try {
                    $webservicePagueveloz = Mage::getModel('pagueveloz_api/webservice');
                    $result = $webservicePagueveloz->comprarCreditosSMS($payment_type, $buy_type, $value);
                    $response['success'] = true;
                    $response['urlBoleto'] = $result->UrlBoleto;
                } catch (Exception $e) {
                    $response['msg'] = $e->getMessage();
                }
            } else {
                $response['msg'] = 'Valor não informado.';
            }

            $this->getResponse()->setHeader('Content-type', 'application/json');
            $this->getResponse()->setBody(Mage::helper('core')->jsonEncode($response));
        }
    }

    public function saveTemplatesAction()
    {
        if ($this->getRequest()->getParam('isAjax')) {
            $response = array('msg' => '', 'success' => false);

            try {
                $templates = $this->getRequest()->getParam('templates');
                foreach ($templates as $statusCode => $template) {
                    $smsTemplate = Mage::getModel('pagueveloz_sms/template')->loadByStatusCode($statusCode);
                    $smsTemplate->setTemplate($template['template'])
                            ->setEnabled($template['enabled'])
                            ->setStatusCode($statusCode)
                            ->save();
                }
                $response['success'] = true;
            } catch (Exception $e) {
                $response['msg'] = $e->getMessage();
            }

            $this->getResponse()->setHeader('Content-type', 'application/json');
            $this->getResponse()->setBody(Mage::helper('core')->jsonEncode($response));
        }
    }

    public function smsListAction()
    {
        $limit = $this->_getLimit();

        $smsCollection = Mage::getModel('pagueveloz_sms/sms')->getCollection()
                ->setOrder('created_time')
                ->addFieldToSelect('*')
                ->setPageSize($limit);

        if ($name = $this->_getName()) {
            $smsCollection->addFieldToFilter('name', array('like' => "%" . $name . "%"));
        }

        $total = $smsCollection->getSize();
        $total_pages = $total / $limit;
        $total_pages = ceil($total_pages);

        $smsCollection->setCurPage($this->_getPage()); // Set cur page after calculate total pages

        foreach ($smsCollection as $sms) {
            $smsList[$sms->getId()] = array(
                'id' => $sms->getId(),
                'result' => $sms->getResult(),
                'message' => $sms->getTemplate()->getMessage(),
                'order_id' => $sms->getOrderId(),
                'status' => $sms->getStatus(),
                'created_at' => $sms->getCreatedTime(),
            );
        }

        $response = array('total_sms' => $total, 'total_pages' => $total_pages, 'smsList' => $smsList);
        $this->getResponse()->setHeader('Content-type', 'application/json');
        $this->getResponse()->setBody(Mage::helper('core')->jsonEncode($response));
    }

    private function _getPage()
    {
        return $this->getRequest()->getParam('page', 1);
    }

    private function _getLimit()
    {
        return $this->getRequest()->getParam('limit', 10);
    }

    private function _getName()
    {
        return $this->getRequest()->getParam('name', '');
    }

    protected function _validateFormKey()
    {
        return true;
    }

    protected function _validateSecretKey()
    {
        return true;
    }

}
