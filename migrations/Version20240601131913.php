<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240601131913 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE news_session (news_id INT NOT NULL, session_id INT NOT NULL, INDEX IDX_87A0C932B5A459A0 (news_id), INDEX IDX_87A0C932613FECDF (session_id), PRIMARY KEY(news_id, session_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE news_session ADD CONSTRAINT FK_87A0C932B5A459A0 FOREIGN KEY (news_id) REFERENCES news (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE news_session ADD CONSTRAINT FK_87A0C932613FECDF FOREIGN KEY (session_id) REFERENCES session (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE news_session DROP FOREIGN KEY FK_87A0C932B5A459A0');
        $this->addSql('ALTER TABLE news_session DROP FOREIGN KEY FK_87A0C932613FECDF');
        $this->addSql('DROP TABLE news_session');
    }
}
