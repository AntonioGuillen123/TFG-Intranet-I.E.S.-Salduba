<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240602235204 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE booking ADD horary_tmp_id INT NOT NULL');
        $this->addSql('ALTER TABLE booking ADD CONSTRAINT FK_E00CEDDE22D08097 FOREIGN KEY (horary_tmp_id) REFERENCES schedule (id)');
        $this->addSql('CREATE INDEX IDX_E00CEDDE22D08097 ON booking (horary_tmp_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE booking DROP FOREIGN KEY FK_E00CEDDE22D08097');
        $this->addSql('DROP INDEX IDX_E00CEDDE22D08097 ON booking');
        $this->addSql('ALTER TABLE booking DROP horary_tmp_id');
    }
}
