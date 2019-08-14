<?php

// here are the table creation for this module e.g.:
$this->startSetup();
$this->run("
-- DROP TABLE IF EXISTS {$this->getTable('pagueveloz_sms_template')};
CREATE TABLE {$this->getTable('pagueveloz_sms_template')} (
  `sms_template_id` int(11) unsigned NOT NULL auto_increment,
  `template` TEXT NOT NULL,
  `enabled` int(1) default 0,
  `status_code` VARCHAR(250) NOT NULL,
  `created_time` TIMESTAMP default CURRENT_TIMESTAMP,
  `updated_time` datetime NULL,
  PRIMARY KEY (`sms_template_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
");
$this->endSetup();
