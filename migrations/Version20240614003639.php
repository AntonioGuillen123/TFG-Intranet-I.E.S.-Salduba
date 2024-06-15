<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240614003639 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE news CHANGE title title LONGTEXT NOT NULL, CHANGE image image LONGTEXT NOT NULL');
        $this->addSql('ALTER TABLE notification DROP FOREIGN KEY notification_ibfk_1');
        $this->addSql('ALTER TABLE notification ADD CONSTRAINT FK_BF5476CAC54C8C93 FOREIGN KEY (type_id) REFERENCES notification_type (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE news CHANGE title title VARCHAR(75) NOT NULL, CHANGE image image LONGTEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE notification DROP FOREIGN KEY FK_BF5476CAC54C8C93');
        $this->addSql('ALTER TABLE notification ADD CONSTRAINT notification_ibfk_1 FOREIGN KEY (type_id) REFERENCES notification_type (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
    }
}
