<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230207121208 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commentary ADD actif TINYINT(1) DEFAULT NULL, ADD is_deleted TINYINT(1) DEFAULT NULL, ADD created_at DATETIME DEFAULT NULL, ADD updated_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE figure ADD actif TINYINT(1) DEFAULT NULL, ADD is_deleted TINYINT(1) DEFAULT NULL, ADD created_at DATETIME DEFAULT NULL, ADD updated_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE media DROP actif, DROP is_deleted, DROP created_at, DROP updated_at');
        $this->addSql('ALTER TABLE user ADD actif TINYINT(1) DEFAULT NULL, ADD is_deleted TINYINT(1) DEFAULT NULL, ADD created_at DATETIME DEFAULT NULL, ADD updated_at DATETIME DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commentary DROP actif, DROP is_deleted, DROP created_at, DROP updated_at');
        $this->addSql('ALTER TABLE figure DROP actif, DROP is_deleted, DROP created_at, DROP updated_at');
        $this->addSql('ALTER TABLE media ADD actif TINYINT(1) DEFAULT NULL, ADD is_deleted TINYINT(1) DEFAULT NULL, ADD created_at DATETIME DEFAULT NULL, ADD updated_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE user DROP actif, DROP is_deleted, DROP created_at, DROP updated_at');
    }
}
