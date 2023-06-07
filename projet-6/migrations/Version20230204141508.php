<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230204141508 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE commentary (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, figure_id INT DEFAULT NULL, title VARCHAR(255) DEFAULT NULL, message LONGTEXT DEFAULT NULL, INDEX IDX_1CAC12CAA76ED395 (user_id), INDEX IDX_1CAC12CA5C011B5 (figure_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE figure (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, groupe_id INT DEFAULT NULL, media_id INT DEFAULT NULL, name VARCHAR(255) DEFAULT NULL, description LONGTEXT DEFAULT NULL, INDEX IDX_2F57B37AA76ED395 (user_id), INDEX IDX_2F57B37A7A45358C (groupe_id), INDEX IDX_2F57B37AEA9FDD75 (media_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE groupe (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE media (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(255) DEFAULT NULL, picture VARCHAR(255) DEFAULT NULL, video LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) DEFAULT NULL, first_name VARCHAR(255) DEFAULT NULL, mail VARCHAR(255) DEFAULT NULL, password VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE commentary ADD CONSTRAINT FK_1CAC12CAA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE commentary ADD CONSTRAINT FK_1CAC12CA5C011B5 FOREIGN KEY (figure_id) REFERENCES figure (id)');
        $this->addSql('ALTER TABLE figure ADD CONSTRAINT FK_2F57B37AA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE figure ADD CONSTRAINT FK_2F57B37A7A45358C FOREIGN KEY (groupe_id) REFERENCES groupe (id)');
        $this->addSql('ALTER TABLE figure ADD CONSTRAINT FK_2F57B37AEA9FDD75 FOREIGN KEY (media_id) REFERENCES media (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commentary DROP FOREIGN KEY FK_1CAC12CAA76ED395');
        $this->addSql('ALTER TABLE commentary DROP FOREIGN KEY FK_1CAC12CA5C011B5');
        $this->addSql('ALTER TABLE figure DROP FOREIGN KEY FK_2F57B37AA76ED395');
        $this->addSql('ALTER TABLE figure DROP FOREIGN KEY FK_2F57B37A7A45358C');
        $this->addSql('ALTER TABLE figure DROP FOREIGN KEY FK_2F57B37AEA9FDD75');
        $this->addSql('DROP TABLE commentary');
        $this->addSql('DROP TABLE figure');
        $this->addSql('DROP TABLE groupe');
        $this->addSql('DROP TABLE media');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
