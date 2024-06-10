<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240610092727 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE absence ADD covered_by_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE absence ADD CONSTRAINT FK_765AE0C96F6814AE FOREIGN KEY (covered_by_id) REFERENCES teacher (id)');
        $this->addSql('CREATE INDEX IDX_765AE0C96F6814AE ON absence (covered_by_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE absence DROP FOREIGN KEY FK_765AE0C96F6814AE');
        $this->addSql('DROP INDEX IDX_765AE0C96F6814AE ON absence');
        $this->addSql('ALTER TABLE absence DROP covered_by_id');
    }
}
