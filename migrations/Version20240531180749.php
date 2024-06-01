<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240531180749 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE news (id INT AUTO_INCREMENT NOT NULL, user_from_id INT NOT NULL, title VARCHAR(75) NOT NULL, content LONGTEXT NOT NULL, image LONGTEXT NOT NULL, views INT NOT NULL, INDEX IDX_1DD3995020C3C701 (user_from_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE news ADD CONSTRAINT FK_1DD3995020C3C701 FOREIGN KEY (user_from_id) REFERENCES session (id)');
        $this->addSql('ALTER TABLE session ADD CONSTRAINT FK_D044D5D4C54C8C93 FOREIGN KEY (type_id) REFERENCES user_rol (id)');
        $this->addSql('CREATE INDEX IDX_D044D5D4C54C8C93 ON session (type_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE news DROP FOREIGN KEY FK_1DD3995020C3C701');
        $this->addSql('DROP TABLE news');
        $this->addSql('ALTER TABLE session DROP FOREIGN KEY FK_D044D5D4C54C8C93');
        $this->addSql('DROP INDEX IDX_D044D5D4C54C8C93 ON session');
    }
}
