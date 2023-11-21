<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231121114712 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE courses DROP FOREIGN KEY FK_A9A55A4C8EFB301A');
        $this->addSql('DROP INDEX IDX_A9A55A4C8EFB301A ON courses');
        $this->addSql('ALTER TABLE courses DROP instructors_id');
        $this->addSql('ALTER TABLE courses ADD CONSTRAINT FK_A9A55A4C8C4FC193 FOREIGN KEY (instructor_id) REFERENCES users (id)');
        $this->addSql('CREATE INDEX IDX_A9A55A4C8C4FC193 ON courses (instructor_id)');
        $this->addSql('ALTER TABLE enrollments DROP FOREIGN KEY FK_CCD8C13267B3B43D');
        $this->addSql('ALTER TABLE enrollments DROP FOREIGN KEY FK_CCD8C132F9295384');
        $this->addSql('DROP INDEX IDX_CCD8C132F9295384 ON enrollments');
        $this->addSql('DROP INDEX IDX_CCD8C13267B3B43D ON enrollments');
        $this->addSql('ALTER TABLE enrollments DROP users_id, DROP courses_id, CHANGE student_id user_id INT NOT NULL');
        $this->addSql('ALTER TABLE enrollments ADD CONSTRAINT FK_CCD8C132A76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE enrollments ADD CONSTRAINT FK_CCD8C132591CC992 FOREIGN KEY (course_id) REFERENCES courses (id)');
        $this->addSql('CREATE INDEX IDX_CCD8C132A76ED395 ON enrollments (user_id)');
        $this->addSql('CREATE INDEX IDX_CCD8C132591CC992 ON enrollments (course_id)');
        $this->addSql('ALTER TABLE lessons DROP FOREIGN KEY FK_3F4218D9F9295384');
        $this->addSql('DROP INDEX IDX_3F4218D9F9295384 ON lessons');
        $this->addSql('ALTER TABLE lessons DROP courses_id');
        $this->addSql('ALTER TABLE lessons ADD CONSTRAINT FK_3F4218D9591CC992 FOREIGN KEY (course_id) REFERENCES courses (id)');
        $this->addSql('CREATE INDEX IDX_3F4218D9591CC992 ON lessons (course_id)');
        $this->addSql('ALTER TABLE progress DROP FOREIGN KEY FK_2201F2461B4748EB');
        $this->addSql('DROP INDEX IDX_2201F2461B4748EB ON progress');
        $this->addSql('ALTER TABLE progress DROP enrollments_id, DROP lesson_id, CHANGE lessons_id lessons_id INT NOT NULL');
        $this->addSql('ALTER TABLE progress ADD CONSTRAINT FK_2201F2468F7DB25B FOREIGN KEY (enrollment_id) REFERENCES enrollments (id)');
        $this->addSql('CREATE INDEX IDX_2201F2468F7DB25B ON progress (enrollment_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE courses DROP FOREIGN KEY FK_A9A55A4C8C4FC193');
        $this->addSql('DROP INDEX IDX_A9A55A4C8C4FC193 ON courses');
        $this->addSql('ALTER TABLE courses ADD instructors_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE courses ADD CONSTRAINT FK_A9A55A4C8EFB301A FOREIGN KEY (instructors_id) REFERENCES users (id)');
        $this->addSql('CREATE INDEX IDX_A9A55A4C8EFB301A ON courses (instructors_id)');
        $this->addSql('ALTER TABLE enrollments DROP FOREIGN KEY FK_CCD8C132A76ED395');
        $this->addSql('ALTER TABLE enrollments DROP FOREIGN KEY FK_CCD8C132591CC992');
        $this->addSql('DROP INDEX IDX_CCD8C132A76ED395 ON enrollments');
        $this->addSql('DROP INDEX IDX_CCD8C132591CC992 ON enrollments');
        $this->addSql('ALTER TABLE enrollments ADD users_id INT DEFAULT NULL, ADD courses_id INT DEFAULT NULL, CHANGE user_id student_id INT NOT NULL');
        $this->addSql('ALTER TABLE enrollments ADD CONSTRAINT FK_CCD8C13267B3B43D FOREIGN KEY (users_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE enrollments ADD CONSTRAINT FK_CCD8C132F9295384 FOREIGN KEY (courses_id) REFERENCES courses (id)');
        $this->addSql('CREATE INDEX IDX_CCD8C132F9295384 ON enrollments (courses_id)');
        $this->addSql('CREATE INDEX IDX_CCD8C13267B3B43D ON enrollments (users_id)');
        $this->addSql('ALTER TABLE lessons DROP FOREIGN KEY FK_3F4218D9591CC992');
        $this->addSql('DROP INDEX IDX_3F4218D9591CC992 ON lessons');
        $this->addSql('ALTER TABLE lessons ADD courses_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE lessons ADD CONSTRAINT FK_3F4218D9F9295384 FOREIGN KEY (courses_id) REFERENCES courses (id)');
        $this->addSql('CREATE INDEX IDX_3F4218D9F9295384 ON lessons (courses_id)');
        $this->addSql('ALTER TABLE progress DROP FOREIGN KEY FK_2201F2468F7DB25B');
        $this->addSql('DROP INDEX IDX_2201F2468F7DB25B ON progress');
        $this->addSql('ALTER TABLE progress ADD enrollments_id INT DEFAULT NULL, ADD lesson_id INT NOT NULL, CHANGE lessons_id lessons_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE progress ADD CONSTRAINT FK_2201F2461B4748EB FOREIGN KEY (enrollments_id) REFERENCES enrollments (id)');
        $this->addSql('CREATE INDEX IDX_2201F2461B4748EB ON progress (enrollments_id)');
    }
}
