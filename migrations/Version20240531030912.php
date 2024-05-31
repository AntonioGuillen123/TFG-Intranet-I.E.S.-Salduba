<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240531030912 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE session ADD FOREIGN KEY (type_id) REFERENCES user_rol (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE session DROP FOREIGN KEY FK_D044D5D4C54C8C93');
        $this->addSql('DROP TABLE user_rol');
        $this->addSql('DROP INDEX IDX_D044D5D4C54C8C93 ON session');
        $this->addSql('ALTER TABLE session ADD type VARCHAR(255) NOT NULL, DROP type_id');
    }
}
