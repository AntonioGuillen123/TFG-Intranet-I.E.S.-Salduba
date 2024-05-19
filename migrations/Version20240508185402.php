<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240508185402 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cteachers MODIFY id INT NOT NULL');
        $this->addSql('DROP INDEX `primary` ON cteachers');
        $this->addSql('ALTER TABLE cteachers DROP id');
        $this->addSql('ALTER TABLE cteachers ADD PRIMARY KEY (id_teacher)');
        $this->addSql('ALTER TABLE soul MODIFY id INT NOT NULL');
        $this->addSql('DROP INDEX `primary` ON soul');
        $this->addSql('ALTER TABLE soul DROP id');
        $this->addSql('ALTER TABLE soul ADD PRIMARY KEY (student_key)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE soul ADD id INT AUTO_INCREMENT NOT NULL, DROP PRIMARY KEY, ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE cteachers ADD id INT AUTO_INCREMENT NOT NULL, DROP PRIMARY KEY, ADD PRIMARY KEY (id)');
    }
}
