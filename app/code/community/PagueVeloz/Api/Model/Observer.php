<?php

class PagueVeloz_Api_Model_Observer {

    public function savePaguevelozConfig($object)
    {
        $event = $object->getEvent();

        $fields  = array(
            'name' => 'setNome',
            'email' => 'setEmail',
            'send_boleto_pago' => 'setEnviarEmailBoletosPagos',
            'cidade' => 'setCidade',
            'estado' => 'setEstado',
            'logradouro' => 'setRua',
            'numero' => 'setNumero',
            'cep' => 'setCep'
        );

        $hasData = false;
        $webservice = Mage::getModel('pagueveloz_api/webservice');
        $clienteDto = Mage::getModel('pagueveloz_api/dto_clienteDTO');
        foreach ($fields as $field => $setMethod) {
            if (Mage::getStoreConfig("pagueveloz/pagueveloz_cliente/{$field}")) {
                $hasData = true;
                $clienteDto->$setMethod(Mage::getStoreConfig("pagueveloz/pagueveloz_cliente/{$field}"));
            }
        }

        // Se a configuracao de endereco não é alterado/cadastrado
        if (!$hasData)
            return;

        $result = $webservice->atualizaCliente($clienteDto);
        if (!$result)
            Mage::getSingleton('core/session')->addNotice('Cliente salvo no pagueveloz com sucesso');
    }
} 