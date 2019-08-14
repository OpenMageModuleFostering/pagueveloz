<?php

// here are the table creation for this module e.g.:
$this->startSetup();
$this->run("
-- DROP TABLE IF EXISTS {$this->getTable('pagueveloz_boleto')};
CREATE TABLE {$this->getTable('pagueveloz_boleto')} (
  `boleto_id` int(11) unsigned NOT NULL auto_increment,
  `order_id` int(11) NOT NULL,
  `data_vencimento` datetime NOT NULL,
  `url` TEXT NOT NULL,
  `valor` float NOT NULL,
  `status` varchar(20) NOT NULL default 'novo',
  `created_time` TIMESTAMP default CURRENT_TIMESTAMP,
  `updated_time` datetime NULL,
  PRIMARY KEY (`boleto_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
");
$this->endSetup();
