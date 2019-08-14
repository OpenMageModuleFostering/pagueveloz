<?php

// here are the table creation for this module e.g.:
$this->startSetup();
$this->run("
ALTER TABLE {$this->getTable('pagueveloz_boleto')} ADD valor_pago float;
");
$this->endSetup();
