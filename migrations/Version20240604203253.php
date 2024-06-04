<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240604203253 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE student CHANGE school_id school_id VARCHAR(10) DEFAULT NULL, CHANGE dni_student dni_student VARCHAR(9) DEFAULT NULL, CHANGE address address VARCHAR(255) DEFAULT NULL, CHANGE residence_location residence_location VARCHAR(255) DEFAULT NULL, CHANGE residence_province residence_province VARCHAR(255) DEFAULT NULL, CHANGE phone phone VARCHAR(9) DEFAULT NULL, CHANGE emergency_phone emergency_phone VARCHAR(9) DEFAULT NULL, CHANGE student_personal_phone student_personal_phone VARCHAR(9) DEFAULT NULL, CHANGE student_personal_email student_personal_email VARCHAR(255) DEFAULT NULL, CHANGE course course VARCHAR(255) DEFAULT NULL, CHANGE center_file_number center_file_number VARCHAR(9) DEFAULT NULL, CHANGE unit unit VARCHAR(30) DEFAULT NULL, CHANGE first_surname first_surname VARCHAR(30) DEFAULT NULL, CHANGE second_surname second_surname VARCHAR(30) DEFAULT NULL, CHANGE name name VARCHAR(30) DEFAULT NULL, CHANGE first_tutor_dni first_tutor_dni VARCHAR(9) DEFAULT NULL, CHANGE first_tutor_first_surname first_tutor_first_surname VARCHAR(30) DEFAULT NULL, CHANGE first_tutor_second_surname first_tutor_second_surname VARCHAR(30) DEFAULT NULL, CHANGE first_tutor_name first_tutor_name VARCHAR(30) DEFAULT NULL, CHANGE first_tutor_email first_tutor_email VARCHAR(255) DEFAULT NULL, CHANGE first_tutor_phone first_tutor_phone VARCHAR(9) DEFAULT NULL, CHANGE first_tutor_sex first_tutor_sex VARCHAR(1) DEFAULT NULL, CHANGE born_location born_location VARCHAR(255) DEFAULT NULL, CHANGE born_province born_province VARCHAR(255) DEFAULT NULL, CHANGE born_country born_country VARCHAR(255) DEFAULT NULL, CHANGE nationality nationality VARCHAR(255) DEFAULT NULL, CHANGE student_sex student_sex VARCHAR(1) DEFAULT NULL, CHANGE social_security_number social_security_number VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE student CHANGE school_id school_id VARCHAR(10) NOT NULL, CHANGE dni_student dni_student VARCHAR(9) NOT NULL, CHANGE address address VARCHAR(255) NOT NULL, CHANGE residence_location residence_location VARCHAR(255) NOT NULL, CHANGE residence_province residence_province VARCHAR(255) NOT NULL, CHANGE phone phone VARCHAR(9) NOT NULL, CHANGE emergency_phone emergency_phone VARCHAR(9) NOT NULL, CHANGE student_personal_phone student_personal_phone VARCHAR(9) NOT NULL, CHANGE student_personal_email student_personal_email VARCHAR(255) NOT NULL, CHANGE course course VARCHAR(255) NOT NULL, CHANGE center_file_number center_file_number VARCHAR(9) NOT NULL, CHANGE unit unit VARCHAR(30) NOT NULL, CHANGE first_surname first_surname VARCHAR(30) NOT NULL, CHANGE second_surname second_surname VARCHAR(30) NOT NULL, CHANGE name name VARCHAR(30) NOT NULL, CHANGE first_tutor_dni first_tutor_dni VARCHAR(9) NOT NULL, CHANGE first_tutor_first_surname first_tutor_first_surname VARCHAR(30) NOT NULL, CHANGE first_tutor_second_surname first_tutor_second_surname VARCHAR(30) NOT NULL, CHANGE first_tutor_name first_tutor_name VARCHAR(30) NOT NULL, CHANGE first_tutor_email first_tutor_email VARCHAR(255) NOT NULL, CHANGE first_tutor_phone first_tutor_phone VARCHAR(9) NOT NULL, CHANGE first_tutor_sex first_tutor_sex VARCHAR(1) NOT NULL, CHANGE born_location born_location VARCHAR(255) NOT NULL, CHANGE born_province born_province VARCHAR(255) NOT NULL, CHANGE born_country born_country VARCHAR(255) NOT NULL, CHANGE nationality nationality VARCHAR(255) NOT NULL, CHANGE student_sex student_sex VARCHAR(1) NOT NULL, CHANGE social_security_number social_security_number VARCHAR(255) NOT NULL');
    }
}
