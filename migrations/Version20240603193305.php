<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240603193305 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE students (id INT AUTO_INCREMENT NOT NULL, student VARCHAR(255) NOT NULL, registration_status VARCHAR(255) DEFAULT NULL, school_id VARCHAR(10) NOT NULL, dni_student VARCHAR(9) NOT NULL, address VARCHAR(255) NOT NULL, postal_code INT NOT NULL, residence_location VARCHAR(255) NOT NULL, birthday DATE NOT NULL, residence_province VARCHAR(255) NOT NULL, phone VARCHAR(9) NOT NULL, emergency_phone VARCHAR(9) NOT NULL, student_personal_phone VARCHAR(9) NOT NULL, student_personal_email VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, course VARCHAR(255) NOT NULL, center_file_number VARCHAR(9) NOT NULL, unit VARCHAR(30) NOT NULL, first_surname VARCHAR(30) NOT NULL, second_surname VARCHAR(30) NOT NULL, name VARCHAR(30) NOT NULL, first_tutor_dni VARCHAR(9) NOT NULL, first_tutor_first_surname VARCHAR(30) NOT NULL, first_tutor_second_surname VARCHAR(30) NOT NULL, first_tutor_name VARCHAR(30) NOT NULL, first_tutor_email VARCHAR(255) NOT NULL, first_tutor_phone VARCHAR(9) NOT NULL, first_tutor_sex VARCHAR(1) NOT NULL, second_tutor_dni VARCHAR(9) DEFAULT NULL, second_tutor_first_surname VARCHAR(30) DEFAULT NULL, second_tutor_second_surname VARCHAR(30) DEFAULT NULL, second_tutor_email VARCHAR(255) DEFAULT NULL, second_tutor_name VARCHAR(30) DEFAULT NULL, second_tutor_sex VARCHAR(1) DEFAULT NULL, second_tutor_phone VARCHAR(9) DEFAULT NULL, born_location VARCHAR(255) NOT NULL, tuition_year INT NOT NULL, tuitions_number_this_course INT NOT NULL, tuition_observations VARCHAR(255) DEFAULT NULL, born_province VARCHAR(255) NOT NULL, born_country VARCHAR(255) NOT NULL, age_last_day_tuition_year INT NOT NULL, nationality VARCHAR(255) NOT NULL, student_sex VARCHAR(1) NOT NULL, tuition_date DATE NOT NULL, social_security_number VARCHAR(255) NOT NULL, have_disease VARCHAR(255) DEFAULT NULL, follow_treatment VARCHAR(255) DEFAULT NULL, medicines_allergy VARCHAR(255) DEFAULT NULL, food_intolerances VARCHAR(255) DEFAULT NULL, custody VARCHAR(255) DEFAULT NULL, large_family VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE teacher (id INT AUTO_INCREMENT NOT NULL, employe VARCHAR(100) NOT NULL, dni VARCHAR(9) NOT NULL, job VARCHAR(50) NOT NULL, start_job_date DATE NOT NULL, end_job_date DATE DEFAULT NULL, phone VARCHAR(9) NOT NULL, google_or_microsoft_account VARCHAR(255) NOT NULL, coordinator TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE teacher_schedule (id INT AUTO_INCREMENT NOT NULL, day_number INT NOT NULL, hour_number INT NOT NULL, subject_abbreviation VARCHAR(10) DEFAULT NULL, subject VARCHAR(30) NOT NULL, teacher_name VARCHAR(50) NOT NULL, classroom_name VARCHAR(50) NOT NULL, group_name VARCHAR(50) NOT NULL, start_hour VARCHAR(5) NOT NULL, end_hour VARCHAR(5) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tuition (id INT AUTO_INCREMENT NOT NULL, student VARCHAR(100) NOT NULL, course VARCHAR(20) NOT NULL, status_and_validity_of_tuition VARCHAR(30) NOT NULL, school_expedient_number VARCHAR(20) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE students');
        $this->addSql('DROP TABLE teacher');
        $this->addSql('DROP TABLE teacher_schedule');
        $this->addSql('DROP TABLE tuition');
    }
}
