<?php

namespace DoctrineORMModule\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Default administrator@case-inc.com user
 */
class Version20140306070805 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("INSERT INTO `users` (`id`, `username`, `email`, `display_name`, `password`, `state`) VALUES (1, NULL, 'administrator@case-inc.com', NULL, '$2y$14$.swG3.PhGTYybcd6PDfHpOYzfbHn5g5QbGGR7GxZVSRL2L6S9c9Re', 0);");
        $this->addSql("INSERT INTO `user_role_linker` (`user_id`, `role_id`) VALUES (1, 3);");

    }

    public function down(Schema $schema)
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("DELETE FROM `base`.`user_role_linker` WHERE `user_role_linker`.`user_id` = 1 AND `user_role_linker`.`role_id` = 3;");
        $this->addSql("DELETE FROM `base`.`users` WHERE `users`.`id` = 1;");
    }
}
