<?php

class PagueVeloz_Boleto_Adminhtml_ContaController extends Mage_Adminhtml_Controller_Action
{

    public function cadastrarAction()
    {
        if ($this->getRequest()->getParam('isAjax')) {
            $response = array('msg' => '', 'success' => false);

            $codigo_barras = $this->getRequest()->getParam('codigo_barras');
            $nome_titulo = $this->getRequest()->getParam('nome_titulo');
            $titulo = $this->getRequest()->getParam('titulo');
            $valor = $this->getRequest()->getParam('valor');
            $vencimento = $this->getRequest()->getParam('vencimento');

            if ($codigo_barras && $valor && $vencimento) {
                try {
                    $webservice = Mage::getModel('pagueveloz_api/webservice');

                    $result = $webservice->cadastrarConta($codigo_barras, $nome_titulo, $titulo, $valor, $vencimento);
                    if (is_array($result)) {
                        $response['error'] =  $result;
                    } else if ($result) {
                      $response['msg'] = $result;
                    } else {
                        $response['success'] = true;
                    }
                } catch (Exception $e) {
                    $response['msg'] = $e->getMessage();
                }
            } else {
                $response['msg'] = 'Campos não informado corretamente.';
            }

            $this->getResponse()->setHeader('Content-type', 'application/json');
            $this->getResponse()->setBody(Mage::helper('core')->jsonEncode($response));
        }
    }
}