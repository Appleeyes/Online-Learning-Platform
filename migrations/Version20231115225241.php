<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231115225241 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE progress ADD lessons_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE progress ADD CONSTRAINT FK_2201F246FED07355 FOREIGN KEY (lessons_id) REFERENCES lessons (id)');
        $this->addSql('CREATE INDEX IDX_2201F246FED07355 ON progress (lessons_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE progress DROP FOREIGN KEY FK_2201F246FED07355');
        $this->addSql('DROP INDEX IDX_2201F246FED07355 ON progress');
        $this->addSql('ALTER TABLE progress DROP lessons_id');
    }
}
