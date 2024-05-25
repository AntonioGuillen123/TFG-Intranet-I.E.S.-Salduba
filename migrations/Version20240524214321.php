<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240524214321 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE message (id INT AUTO_INCREMENT NOT NULL, user_from_id INT NOT NULL, user_to_id INT NOT NULL, affair VARCHAR(25) NOT NULL, content LONGTEXT NOT NULL, send_date DATETIME NOT NULL, INDEX IDX_B6BD307F20C3C701 (user_from_id), INDEX IDX_B6BD307FD2F7B13D (user_to_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE message_upload_file_message (message_id INT NOT NULL, upload_file_message_id INT NOT NULL, INDEX IDX_22BAC2CD537A1329 (message_id), INDEX IDX_22BAC2CD87EC6CF2 (upload_file_message_id), PRIMARY KEY(message_id, upload_file_message_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE upload_file_message (id INT AUTO_INCREMENT NOT NULL, name LONGTEXT NOT NULL, extension VARCHAR(15) NOT NULL, path LONGTEXT NOT NULL, upload_date DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307F20C3C701 FOREIGN KEY (user_from_id) REFERENCES session (id)');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307FD2F7B13D FOREIGN KEY (user_to_id) REFERENCES session (id)');
        $this->addSql('ALTER TABLE message_upload_file_message ADD CONSTRAINT FK_22BAC2CD537A1329 FOREIGN KEY (message_id) REFERENCES message (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE message_upload_file_message ADD CONSTRAINT FK_22BAC2CD87EC6CF2 FOREIGN KEY (upload_file_message_id) REFERENCES upload_file_message (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE notification RENAME INDEX type_id TO IDX_BF5476CAC54C8C93');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307F20C3C701');
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307FD2F7B13D');
        $this->addSql('ALTER TABLE message_upload_file_message DROP FOREIGN KEY FK_22BAC2CD537A1329');
        $this->addSql('ALTER TABLE message_upload_file_message DROP FOREIGN KEY FK_22BAC2CD87EC6CF2');
        $this->addSql('DROP TABLE message');
        $this->addSql('DROP TABLE message_upload_file_message');
        $this->addSql('DROP TABLE upload_file_message');
        $this->addSql('ALTER TABLE notification RENAME INDEX idx_bf5476cac54c8c93 TO type_id');
    }
}
