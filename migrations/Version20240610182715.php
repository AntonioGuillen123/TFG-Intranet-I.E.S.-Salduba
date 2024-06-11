<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240610182715 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE crime (id INT AUTO_INCREMENT NOT NULL, severity_id INT DEFAULT NULL, name LONGTEXT NOT NULL, INDEX IDX_730BE205F7527401 (severity_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE crime_measure (id INT AUTO_INCREMENT NOT NULL, name LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE crime_severity (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(25) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE discipline_part (id INT AUTO_INCREMENT NOT NULL, student_id INT NOT NULL, crime_id INT NOT NULL, measure_id INT DEFAULT NULL, teacher_id INT NOT NULL, part_date DATETIME DEFAULT "CURRENT_TIMESTAMP" NOT NULL, INDEX IDX_9C734728CB944F1A (student_id), INDEX IDX_9C7347289B104F4E (crime_id), INDEX IDX_9C7347285DA37D00 (measure_id), INDEX IDX_9C73472841807E1D (teacher_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE crime ADD CONSTRAINT FK_730BE205F7527401 FOREIGN KEY (severity_id) REFERENCES crime_severity (id)');
        $this->addSql('ALTER TABLE discipline_part ADD CONSTRAINT FK_9C734728CB944F1A FOREIGN KEY (student_id) REFERENCES student (id)');
        $this->addSql('ALTER TABLE discipline_part ADD CONSTRAINT FK_9C7347289B104F4E FOREIGN KEY (crime_id) REFERENCES crime (id)');
        $this->addSql('ALTER TABLE discipline_part ADD CONSTRAINT FK_9C7347285DA37D00 FOREIGN KEY (measure_id) REFERENCES crime_measure (id)');
        $this->addSql('ALTER TABLE discipline_part ADD CONSTRAINT FK_9C73472841807E1D FOREIGN KEY (teacher_id) REFERENCES teacher (id)');
        $this->addSql('ALTER TABLE news CHANGE image image LONGTEXT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE crime DROP FOREIGN KEY FK_730BE205F7527401');
        $this->addSql('ALTER TABLE discipline_part DROP FOREIGN KEY FK_9C734728CB944F1A');
        $this->addSql('ALTER TABLE discipline_part DROP FOREIGN KEY FK_9C7347289B104F4E');
        $this->addSql('ALTER TABLE discipline_part DROP FOREIGN KEY FK_9C7347285DA37D00');
        $this->addSql('ALTER TABLE discipline_part DROP FOREIGN KEY FK_9C73472841807E1D');
        $this->addSql('DROP TABLE crime');
        $this->addSql('DROP TABLE crime_measure');
        $this->addSql('DROP TABLE crime_severity');
        $this->addSql('DROP TABLE discipline_part');
        $this->addSql('ALTER TABLE news CHANGE image image LONGTEXT DEFAULT NULL');
    }
}
