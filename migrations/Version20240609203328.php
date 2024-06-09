<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240609203328 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE absence ADD author_id INT NOT NULL');
        $this->addSql('ALTER TABLE absence ADD CONSTRAINT FK_765AE0C9F675F31B FOREIGN KEY (author_id) REFERENCES teacher (id)');
        $this->addSql('CREATE INDEX IDX_765AE0C9F675F31B ON absence (author_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE absence DROP FOREIGN KEY FK_765AE0C9F675F31B');
        $this->addSql('DROP INDEX IDX_765AE0C9F675F31B ON absence');
        $this->addSql('ALTER TABLE absence ADD author VARCHAR(75) NOT NULL, DROP author_id');
    }
}
