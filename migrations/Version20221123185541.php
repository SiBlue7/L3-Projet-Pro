<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221123185541 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE exercices (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, enonce LONGTEXT NOT NULL, created_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE language_category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE language_category_exercices (language_category_id INT NOT NULL, exercices_id INT NOT NULL, INDEX IDX_C6C20F2E7100E850 (language_category_id), INDEX IDX_C6C20F2E192C7251 (exercices_id), PRIMARY KEY(language_category_id, exercices_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE language_category_exercices ADD CONSTRAINT FK_C6C20F2E7100E850 FOREIGN KEY (language_category_id) REFERENCES language_category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE language_category_exercices ADD CONSTRAINT FK_C6C20F2E192C7251 FOREIGN KEY (exercices_id) REFERENCES exercices (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE language_category_exercices DROP FOREIGN KEY FK_C6C20F2E7100E850');
        $this->addSql('ALTER TABLE language_category_exercices DROP FOREIGN KEY FK_C6C20F2E192C7251');
        $this->addSql('DROP TABLE exercices');
        $this->addSql('DROP TABLE language_category');
        $this->addSql('DROP TABLE language_category_exercices');
    }
}
