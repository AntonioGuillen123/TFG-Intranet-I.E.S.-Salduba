<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240606222646 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE session ADD CONSTRAINT FK_D044D5D441807E1D FOREIGN KEY (teacher_id) REFERENCES teacher (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_D044D5D441807E1D ON session (teacher_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE session DROP FOREIGN KEY FK_D044D5D441807E1D');
        $this->addSql('DROP INDEX UNIQ_D044D5D441807E1D ON session');
        $this->addSql('ALTER TABLE session DROP teacher_id');
    }
}
