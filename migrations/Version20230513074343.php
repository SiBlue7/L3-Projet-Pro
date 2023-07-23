<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230513074343 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE test DROP FOREIGN KEY FK_D87F7E0C89D40298');
        $this->addSql('DROP TABLE test');
        $this->addSql('ALTER TABLE exercices ADD resultat VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE test (id INT AUTO_INCREMENT NOT NULL, exercice_id INT NOT NULL, inputs JSON NOT NULL, outputs JSON NOT NULL, INDEX IDX_D87F7E0C89D40298 (exercice_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE test ADD CONSTRAINT FK_D87F7E0C89D40298 FOREIGN KEY (exercice_id) REFERENCES exercices (id)');
        $this->addSql('ALTER TABLE exercices DROP resultat');
    }
}
