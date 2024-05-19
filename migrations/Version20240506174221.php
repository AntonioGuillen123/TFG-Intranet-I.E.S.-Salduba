<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240506174221 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE soul (id INT AUTO_INCREMENT NOT NULL, student_key VARCHAR(12) NOT NULL, student_key2 VARCHAR(12) DEFAULT NULL, dni VARCHAR(10) DEFAULT NULL, home VARCHAR(255) DEFAULT NULL, postal_code VARCHAR(30) DEFAULT NULL, student_location VARCHAR(255) DEFAULT NULL, student_date VARCHAR(30) DEFAULT NULL, province_residence VARCHAR(60) DEFAULT NULL, phone VARCHAR(30) DEFAULT NULL, emergency_phone VARCHAR(30) DEFAULT NULL, email VARCHAR(64) DEFAULT NULL, expedience_number VARCHAR(60) DEFAULT NULL, surnames VARCHAR(120) DEFAULT NULL, first_tutor_dni VARCHAR(30) DEFAULT NULL, first_tutor_first_surname VARCHAR(60) DEFAULT NULL, first_tutor_second_surname VARCHAR(60) DEFAULT NULL, first_tutor_name VARCHAR(60) DEFAULT NULL, father VARCHAR(255) DEFAULT NULL, first_tutor_sex VARCHAR(255) DEFAULT NULL, second_tutor_dni VARCHAR(60) DEFAULT NULL, first_tutor_number VARCHAR(30) DEFAULT NULL, second_tutor_first_surname VARCHAR(60) DEFAULT NULL, second_tutor_second_surname VARCHAR(60) DEFAULT NULL, second_tutor_name VARCHAR(60) DEFAULT NULL, second_tutor_sex VARCHAR(20) DEFAULT NULL, second_tutor_number VARCHAR(30) DEFAULT NULL, born_location VARCHAR(255) DEFAULT NULL, born_province VARCHAR(255) DEFAULT NULL, born_country VARCHAR(255) DEFAULT NULL, age VARCHAR(2) DEFAULT NULL, nationality VARCHAR(32) DEFAULT NULL, sex VARCHAR(1) DEFAULT NULL, brothers INT NOT NULL, user VARCHAR(30) DEFAULT NULL, password VARCHAR(30) NOT NULL, library_code VARCHAR(10) DEFAULT NULL, social_security VARCHAR(12) DEFAULT NULL, student_repeat VARCHAR(200) NOT NULL, user_think VARCHAR(12) DEFAULT NULL, highschool_email VARCHAR(100) DEFAULT NULL, transit VARCHAR(50) DEFAULT NULL, student_personal_email VARCHAR(100) DEFAULT NULL, student_personal_phone VARCHAR(100) DEFAULT NULL, initial_year INT DEFAULT NULL, disease VARCHAR(2) DEFAULT NULL, treatment VARCHAR(100) DEFAULT NULL, allergy VARCHAR(2) DEFAULT NULL, intolerance VARCHAR(2) DEFAULT NULL, custody VARCHAR(255) DEFAULT NULL, custody1_dni VARCHAR(12) DEFAULT NULL, custody2_dni VARCHAR(12) DEFAULT NULL, large_family VARCHAR(30) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE soul');
    }
}
