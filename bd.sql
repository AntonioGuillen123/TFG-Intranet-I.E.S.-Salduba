USE tfgdb;

CREATE TABLE soul (
    student_key varchar(12) PRIMARY KEY,
    student_key2 varchar(12),
    dni varchar(10),
    home varchar(255),
    postal_code varchar(30),
    student_location varchar(255),
    student_date varchar(30),
    province_residence varchar(60),
    phone varchar(30),
    emergency_phone varchar(30),
    email varchar(64),
    expedience_number varchar(60),
    surnames varchar(120),
    student_name varchar(60),
    first_tutor_dni varchar(30),
    first_tutor_first_surname varchar(60),
    first_tutor_second_surname varchar(60),
    first_tutor_name varchar(60),
    father varchar(255),
    first_tutor_sex varchar(255),
    second_tutor_dni varchar(60),
    first_tutor_number varchar(30),
    second_tutor_first_surname varchar(60),
    second_tutor_second_surname varchar(60),
    second_tutor_name varchar(60),
    second_tutor_sex varchar(20),
    second_tutor_number varchar(30),
    born_location varchar(255),
    born_province varchar(255),
    born_country varchar(255),
    age varchar(2),
    nationality varchar(32),
    sex varchar(1),
    brothers int NOT NULL,
    user varchar(30),
    password varchar(30) NOT NULL,
    library_code varchar(10),
    social_security varchar(12),
    student_repeat varchar(200) NOT NULL,
    user_think varchar(12),
    highschool_email varchar(100),
    transit varchar(50),
    student_personal_email varchar(100),
    student_personal_phone varchar(100),
    initial_year int,
    disease varchar(2),
    treatment varchar(100),
    allergy varchar(2),
    intolerance varchar(2),
    custody varchar(255),
    custody1_dni varchar(12),
    custody2_dni varchar(12),
    large_family varchar(30)
);