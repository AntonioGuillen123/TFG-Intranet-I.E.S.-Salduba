<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240521224816 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        // $this->addSql('ALTER TABLE notification ADD type_id INT NOT NULL');
        $this->addSql('ALTER TABLE notification ADD FOREIGN KEY (type_id) REFERENCES notification_type (id)');
        //$this->addSql('CREATE INDEX IDX_BF5476CAC54C8C93 ON notification (type_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE notification DROP FOREIGN KEY FK_BF5476CAC54C8C93');
        $this->addSql('DROP INDEX IDX_BF5476CAC54C8C93 ON notification');
        $this->addSql('ALTER TABLE notification DROP type_id');
    }
}
