<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231115224318 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE enrollments ADD courses_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE enrollments ADD CONSTRAINT FK_CCD8C132F9295384 FOREIGN KEY (courses_id) REFERENCES courses (id)');
        $this->addSql('CREATE INDEX IDX_CCD8C132F9295384 ON enrollments (courses_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE enrollments DROP FOREIGN KEY FK_CCD8C132F9295384');
        $this->addSql('DROP INDEX IDX_CCD8C132F9295384 ON enrollments');
        $this->addSql('ALTER TABLE enrollments DROP courses_id');
    }
}
