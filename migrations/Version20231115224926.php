<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231115224926 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE progress ADD enrollments_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE progress ADD CONSTRAINT FK_2201F2461B4748EB FOREIGN KEY (enrollments_id) REFERENCES enrollments (id)');
        $this->addSql('CREATE INDEX IDX_2201F2461B4748EB ON progress (enrollments_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE progress DROP FOREIGN KEY FK_2201F2461B4748EB');
        $this->addSql('DROP INDEX IDX_2201F2461B4748EB ON progress');
        $this->addSql('ALTER TABLE progress DROP enrollments_id');
    }
}
