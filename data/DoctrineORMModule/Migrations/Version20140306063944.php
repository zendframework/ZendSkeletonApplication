<?php
namespace DoctrineORMModule\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Base Roles
 */
class Version20140306063944 extends AbstractMigration
{

    public function up(Schema $schema)
    {
        $this->abortIf($this->connection->getDatabasePlatform()
            ->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        $this->addSql("
            INSERT INTO `role` (`id`, `parent_id`, `roleId`) VALUES
        (1, NULL, 'guest'),
        (2, 1, 'user'),
        (3, 2, 'administrator');
            ");
    }

    public function down(Schema $schema)
    {
        $this->abortIf($this->connection->getDatabasePlatform()
            ->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("DELETE FROM `base`.`role` WHERE `role`.`id` = 3;
DELETE FROM `base`.`role` WHERE `role`.`id` = 2;
DELETE FROM `base`.`role` WHERE `role`.`id` = 1;");
    }
}
