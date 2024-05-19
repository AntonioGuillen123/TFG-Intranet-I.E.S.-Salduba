<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240507194111 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE cteachers (id INT AUTO_INCREMENT NOT NULL, id_teacher INT NOT NULL, pass VARCHAR(48) DEFAULT NULL, name_teacher VARCHAR(64) DEFAULT NULL, dni VARCHAR(10) NOT NULL, idea VARCHAR(12) NOT NULL, id_department INT NOT NULL, email VARCHAR(64) DEFAULT NULL, state TINYINT(1) NOT NULL, phone VARCHAR(9) DEFAULT NULL, alias_teacher VARCHAR(64) DEFAULT NULL, id_language TINYINT(1) NOT NULL, top_secret VARCHAR(16) DEFAULT NULL, consent TINYINT(1) NOT NULL, email_warning TINYINT(1) DEFAULT NULL, tmp TINYINT(1) DEFAULT NULL, personal_warning TINYINT(1) DEFAULT NULL, shortcut_menu TINYINT(1) NOT NULL, side_shortcut_menu TINYINT(1) NOT NULL, asistence_number INT DEFAULT NULL, highschool_email VARCHAR(64) DEFAULT NULL, caped INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE cteachers');
    }
}
