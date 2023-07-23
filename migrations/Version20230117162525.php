<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230117162525 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE thematique_category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE thematique_category_exercices (thematique_category_id INT NOT NULL, exercices_id INT NOT NULL, INDEX IDX_E1A9AB71FDADAFD (thematique_category_id), INDEX IDX_E1A9AB71192C7251 (exercices_id), PRIMARY KEY(thematique_category_id, exercices_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE thematique_category_exercices ADD CONSTRAINT FK_E1A9AB71FDADAFD FOREIGN KEY (thematique_category_id) REFERENCES thematique_category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE thematique_category_exercices ADD CONSTRAINT FK_E1A9AB71192C7251 FOREIGN KEY (exercices_id) REFERENCES exercices (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE thematique_category_exercices DROP FOREIGN KEY FK_E1A9AB71FDADAFD');
        $this->addSql('ALTER TABLE thematique_category_exercices DROP FOREIGN KEY FK_E1A9AB71192C7251');
        $this->addSql('DROP TABLE thematique_category');
        $this->addSql('DROP TABLE thematique_category_exercices');
    }
}
