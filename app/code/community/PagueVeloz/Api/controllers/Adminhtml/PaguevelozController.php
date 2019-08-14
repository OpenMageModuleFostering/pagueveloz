<?php

class PagueVeloz_Api_Adminhtml_PaguevelozController extends Mage_Adminhtml_Controller_Action
{

    public function indexAction()
    {
        $this->loadLayout();
        $this->renderLayout();
    }

    public function assinarAction()
    {
        $response = array('msg' => '', 'success' => false);


        $cidade = $this->getRequest()->getParam('Cidade');
        $estado = $this->getRequest()->getParam('Estado');
        $rua = $this->getRequest()->getParam('Logradouro');
        $numero = $this->getRequest()->getParam('Numero');
        $nome = $this->getRequest()->getParam('Nome');
        $cep = $this->getRequest()->getParam('CEP');
        $doc = $this->getRequest()->getParam('Documento');
        $tipoPessoa = $this->getRequest()->getParam('TipoPessoa');
        $email = $this->getRequest()->getParam('Email');
        $login = $this->getRequest()->getParam('LoginUsuarioDefault');
        $isProduction = $this->getRequest()->getParam('isProduction', 0);

        $config = new Mage_Core_Model_Config();
        $config->saveConfig('pagueveloz/pagueveloz_configuration/production', $isProduction);

        try {
            $webservice = Mage::getModel('pagueveloz_api/webservice');

            $result = $webservice->assinar($nome, $doc, $tipoPessoa, $email, $login, $estado, $cidade, $rua, $cep, $numero);
            $response['result'] = $result;
            if ($result && is_object($result) && isset($result->Token)) {
                $response['success'] = true;
                $config->saveConfig('pagueveloz/pagueveloz_configuration/token', $result->Token);
                $config->saveConfig('pagueveloz/pagueveloz_configuration/email', $email);
                $config->saveConfig('pagueveloz/pagueveloz_configuration/id', $result->Id);
            }
        } catch (Exception $e) {
            $response['msg'] = $e->getMessage();
        }

        $this->getResponse()->setHeader('Content-type', 'application/json');
        $this->getResponse()->setBody(Mage::helper('core')->jsonEncode($response));
    }

}
