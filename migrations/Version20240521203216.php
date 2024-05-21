<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240521203216 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE notification (id INT AUTO_INCREMENT NOT NULL, user_from_id INT NOT NULL, user_to_id INT NOT NULL, title VARCHAR(255) NOT NULL, INDEX IDX_BF5476CA20C3C701 (user_from_id), INDEX IDX_BF5476CAD2F7B13D (user_to_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE notification ADD CONSTRAINT FK_BF5476CA20C3C701 FOREIGN KEY (user_from_id) REFERENCES session (id)');
        $this->addSql('ALTER TABLE notification ADD CONSTRAINT FK_BF5476CAD2F7B13D FOREIGN KEY (user_to_id) REFERENCES session (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE notification DROP FOREIGN KEY FK_BF5476CA20C3C701');
        $this->addSql('ALTER TABLE notification DROP FOREIGN KEY FK_BF5476CAD2F7B13D');
        $this->addSql('DROP TABLE notification');
    }
}
