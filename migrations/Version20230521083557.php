<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230521083557 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE test (id INT AUTO_INCREMENT NOT NULL, inputs JSON NOT NULL, outputs JSON NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE test_exercices (test_id INT NOT NULL, exercices_id INT NOT NULL, INDEX IDX_911A7D2B1E5D0459 (test_id), INDEX IDX_911A7D2B192C7251 (exercices_id), PRIMARY KEY(test_id, exercices_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE test_exercices ADD CONSTRAINT FK_911A7D2B1E5D0459 FOREIGN KEY (test_id) REFERENCES test (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE test_exercices ADD CONSTRAINT FK_911A7D2B192C7251 FOREIGN KEY (exercices_id) REFERENCES exercices (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE test_exercices DROP FOREIGN KEY FK_911A7D2B1E5D0459');
        $this->addSql('ALTER TABLE test_exercices DROP FOREIGN KEY FK_911A7D2B192C7251');
        $this->addSql('DROP TABLE test');
        $this->addSql('DROP TABLE test_exercices');
    }
}
