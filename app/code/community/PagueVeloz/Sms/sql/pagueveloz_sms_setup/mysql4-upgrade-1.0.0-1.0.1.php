<?php

// here are the table creation for this module e.g.:
$this->startSetup();
$this->run("
-- DROP TABLE IF EXISTS {$this->getTable('pagueveloz_sms')};
CREATE TABLE {$this->getTable('pagueveloz_sms')} (
  `sms_id` int(11) unsigned NOT NULL auto_increment,
  `order_id` int(11) NOT NULL,
  `result` TEXT NULL,
  `template_id` int(11) unsigned NOT NULL,
  `status` varchar(20) NOT NULL default 'novo',
  `created_time` TIMESTAMP default CURRENT_TIMESTAMP,
  `updated_time` datetime NULL,
  CONSTRAINT `FK__pagueveloz_sms_template` FOREIGN KEY (`template_id`) REFERENCES {$this->getTable('pagueveloz_sms_template')} (`sms_template_id`),
  PRIMARY KEY (`sms_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
");
$this->endSetup();
