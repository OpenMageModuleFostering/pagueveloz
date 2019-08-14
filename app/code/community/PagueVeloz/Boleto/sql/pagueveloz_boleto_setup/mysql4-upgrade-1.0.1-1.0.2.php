<?php

// here are the table creation for this module e.g.:
$this->startSetup();
$this->run("
ALTER TABLE {$this->getTable('pagueveloz_boleto')} ADD qty_regerado int;
ALTER TABLE {$this->getTable('pagueveloz_boleto')} ADD seu_numero text;
");
$this->endSetup();
