<?php

namespace DoctrineORMModule\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * BjyAuthorize main schema
 */
class Version20140306063845 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("CREATE TABLE role (id INT AUTO_INCREMENT NOT NULL, parent_id INT DEFAULT NULL, roleId VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_57698A6AB8C2FD88 (roleId), INDEX IDX_57698A6A727ACA70 (parent_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE user_role_linker (user_id INT NOT NULL, role_id INT NOT NULL, INDEX IDX_61117899A76ED395 (user_id), INDEX IDX_61117899D60322AC (role_id), PRIMARY KEY(user_id, role_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("ALTER TABLE role ADD CONSTRAINT FK_57698A6A727ACA70 FOREIGN KEY (parent_id) REFERENCES role (id)");
        $this->addSql("ALTER TABLE user_role_linker ADD CONSTRAINT FK_61117899A76ED395 FOREIGN KEY (user_id) REFERENCES users (id)");
        $this->addSql("ALTER TABLE user_role_linker ADD CONSTRAINT FK_61117899D60322AC FOREIGN KEY (role_id) REFERENCES role (id)");
    }

    public function down(Schema $schema)
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("ALTER TABLE role DROP FOREIGN KEY FK_57698A6A727ACA70");
        $this->addSql("ALTER TABLE user_role_linker DROP FOREIGN KEY FK_61117899D60322AC");
        $this->addSql("DROP TABLE role");
        $this->addSql("DROP TABLE user_role_linker");
    }
}
