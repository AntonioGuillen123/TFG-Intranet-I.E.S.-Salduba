<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240601183733 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE booking (id INT AUTO_INCREMENT NOT NULL, user_from_id INT NOT NULL, resource_id INT NOT NULL, booking_date DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, INDEX IDX_E00CEDDE20C3C701 (user_from_id), INDEX IDX_E00CEDDE89329D25 (resource_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE resource (id INT AUTO_INCREMENT NOT NULL, resource_type_id INT NOT NULL, name VARCHAR(50) NOT NULL, INDEX IDX_BC91F41698EC6B7B (resource_type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE resource_type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE booking ADD CONSTRAINT FK_E00CEDDE20C3C701 FOREIGN KEY (user_from_id) REFERENCES session (id)');
        $this->addSql('ALTER TABLE booking ADD CONSTRAINT FK_E00CEDDE89329D25 FOREIGN KEY (resource_id) REFERENCES resource (id)');
        $this->addSql('ALTER TABLE resource ADD CONSTRAINT FK_BC91F41698EC6B7B FOREIGN KEY (resource_type_id) REFERENCES resource_type (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE booking DROP FOREIGN KEY FK_E00CEDDE20C3C701');
        $this->addSql('ALTER TABLE booking DROP FOREIGN KEY FK_E00CEDDE89329D25');
        $this->addSql('ALTER TABLE resource DROP FOREIGN KEY FK_BC91F41698EC6B7B');
        $this->addSql('DROP TABLE booking');
        $this->addSql('DROP TABLE resource');
        $this->addSql('DROP TABLE resource_type');
    }
}
