<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231115223321 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE courses ADD instructors_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE courses ADD CONSTRAINT FK_A9A55A4C8EFB301A FOREIGN KEY (instructors_id) REFERENCES users (id)');
        $this->addSql('CREATE INDEX IDX_A9A55A4C8EFB301A ON courses (instructors_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE courses DROP FOREIGN KEY FK_A9A55A4C8EFB301A');
        $this->addSql('DROP INDEX IDX_A9A55A4C8EFB301A ON courses');
        $this->addSql('ALTER TABLE courses DROP instructors_id');
    }
}
