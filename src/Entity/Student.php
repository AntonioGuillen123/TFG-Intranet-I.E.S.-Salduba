<?php

namespace App\Entity;

use App\Repository\StudentRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StudentRepository::class)]
class Student
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $student = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $registration_status = null;

    #[ORM\Column(length: 10, nullable: true)]
    private ?string $school_id = null;

    #[ORM\Column(length: 9, nullable: true)]
    private ?string $dni_student = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $address = null;

    #[ORM\Column]
    private ?int $postal_code = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $residence_location = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $birthday = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $residence_province = null;

    #[ORM\Column(length: 9, nullable: true)]
    private ?string $phone = null;

    #[ORM\Column(length: 9, nullable: true)]
    private ?string $emergency_phone = null;

    #[ORM\Column(length: 9, nullable: true)]
    private ?string $student_personal_phone = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $student_personal_email = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $email = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $course = null;

    #[ORM\Column(length: 9, nullable: true)]
    private ?string $center_file_number = null;

    #[ORM\Column(length: 30, nullable: true)]
    private ?string $unit = null;

    #[ORM\Column(length: 30, nullable: true)]
    private ?string $first_surname = null;

    #[ORM\Column(length: 30, nullable: true)]
    private ?string $second_surname = null;

    #[ORM\Column(length: 30, nullable: true)]
    private ?string $name = null;

    #[ORM\Column(length: 9, nullable: true)]
    private ?string $first_tutor_dni = null;

    #[ORM\Column(length: 30, nullable: true)]
    private ?string $first_tutor_first_surname = null;

    #[ORM\Column(length: 30, nullable: true)]
    private ?string $first_tutor_second_surname = null;

    #[ORM\Column(length: 30, nullable: true)]
    private ?string $first_tutor_name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $first_tutor_email = null;

    #[ORM\Column(length: 9, nullable: true)]
    private ?string $first_tutor_phone = null;

    #[ORM\Column(length: 1, nullable: true)]
    private ?string $first_tutor_sex = null;

    #[ORM\Column(length: 9, nullable: true)]
    private ?string $second_tutor_dni = null;

    #[ORM\Column(length: 30, nullable: true)]
    private ?string $second_tutor_first_surname = null;

    #[ORM\Column(length: 30, nullable: true)]
    private ?string $second_tutor_second_surname = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $second_tutor_email = null;

    #[ORM\Column(length: 30, nullable: true)]
    private ?string $second_tutor_name = null;

    #[ORM\Column(length: 1, nullable: true)]
    private ?string $second_tutor_sex = null;

    #[ORM\Column(length: 9, nullable: true)]
    private ?string $second_tutor_phone = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $born_location = null;

    #[ORM\Column]
    private ?int $tuition_year = null;

    #[ORM\Column]
    private ?int $tuitions_number_this_course = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $tuition_observations = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $born_province = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $born_country = null;

    #[ORM\Column]
    private ?int $age_last_day_tuition_year = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $nationality = null;

    #[ORM\Column(length: 1, nullable: true)]
    private ?string $student_sex = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $tuition_date = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $social_security_number = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $have_disease = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $follow_treatment = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $medicines_allergy = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $food_intolerances = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $custody = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $large_family = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $image = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStudent(): ?string
    {
        return $this->student;
    }

    public function setStudent(string $student): static
    {
        $this->student = $student;

        return $this;
    }

    public function getRegistrationStatus(): ?string
    {
        return $this->registration_status;
    }

    public function setRegistrationStatus(?string $registration_status): static
    {
        $this->registration_status = $registration_status;

        return $this;
    }

    public function getSchoolId(): ?string
    {
        return $this->school_id;
    }

    public function setSchoolId(string $school_id): static
    {
        $this->school_id = $school_id;

        return $this;
    }

    public function getDniStudent(): ?string
    {
        return $this->dni_student;
    }

    public function setDniStudent(string $dni_student): static
    {
        $this->dni_student = $dni_student;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): static
    {
        $this->address = $address;

        return $this;
    }

    public function getPostalCode(): ?int
    {
        return $this->postal_code;
    }

    public function setPostalCode(int $postal_code): static
    {
        $this->postal_code = $postal_code;

        return $this;
    }

    public function getResidenceLocation(): ?string
    {
        return $this->residence_location;
    }

    public function setResidenceLocation(string $residence_location): static
    {
        $this->residence_location = $residence_location;

        return $this;
    }

    public function getBirthday(): ?\DateTimeInterface
    {
        return $this->birthday;
    }

    public function setBirthday(\DateTimeInterface $birthday): static
    {
        $this->birthday = $birthday;

        return $this;
    }

    public function getResidenceProvince(): ?string
    {
        return $this->residence_province;
    }

    public function setResidenceProvince(string $residence_province): static
    {
        $this->residence_province = $residence_province;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): static
    {
        $this->phone = $phone;

        return $this;
    }

    public function getEmergencyPhone(): ?string
    {
        return $this->emergency_phone;
    }

    public function setEmergencyPhone(string $emergency_phone): static
    {
        $this->emergency_phone = $emergency_phone;

        return $this;
    }

    public function getStudentPersonalPhone(): ?string
    {
        return $this->student_personal_phone;
    }

    public function setStudentPersonalPhone(string $student_personal_phone): static
    {
        $this->student_personal_phone = $student_personal_phone;

        return $this;
    }

    public function getStudentPersonalEmail(): ?string
    {
        return $this->student_personal_email;
    }

    public function setStudentPersonalEmail(string $student_personal_email): static
    {
        $this->student_personal_email = $student_personal_email;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getCourse(): ?string
    {
        return $this->course;
    }

    public function setCourse(string $course): static
    {
        $this->course = $course;

        return $this;
    }

    public function getCenterFileNumber(): ?string
    {
        return $this->center_file_number;
    }

    public function setCenterFileNumber(string $center_file_number): static
    {
        $this->center_file_number = $center_file_number;

        return $this;
    }

    public function getUnit(): ?string
    {
        return $this->unit;
    }

    public function setUnit(string $unit): static
    {
        $this->unit = $unit;

        return $this;
    }

    public function getFirstSurname(): ?string
    {
        return $this->first_surname;
    }

    public function setFirstSurname(string $first_surname): static
    {
        $this->first_surname = $first_surname;

        return $this;
    }

    public function getSecondSurname(): ?string
    {
        return $this->second_surname;
    }

    public function setSecondSurname(string $second_surname): static
    {
        $this->second_surname = $second_surname;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getFirstTutorDni(): ?string
    {
        return $this->first_tutor_dni;
    }

    public function setFirstTutorDni(string $first_tutor_dni): static
    {
        $this->first_tutor_dni = $first_tutor_dni;

        return $this;
    }

    public function getFirstTutorFirstSurname(): ?string
    {
        return $this->first_tutor_first_surname;
    }

    public function setFirstTutorFirstSurname(string $first_tutor_first_surname): static
    {
        $this->first_tutor_first_surname = $first_tutor_first_surname;

        return $this;
    }

    public function getFirstTutorSecondSurname(): ?string
    {
        return $this->first_tutor_second_surname;
    }

    public function setFirstTutorSecondSurname(string $first_tutor_second_surname): static
    {
        $this->first_tutor_second_surname = $first_tutor_second_surname;

        return $this;
    }

    public function getFirstTutorName(): ?string
    {
        return $this->first_tutor_name;
    }

    public function setFirstTutorName(string $first_tutor_name): static
    {
        $this->first_tutor_name = $first_tutor_name;

        return $this;
    }

    public function getFirstTutorEmail(): ?string
    {
        return $this->first_tutor_email;
    }

    public function setFirstTutorEmail(string $first_tutor_email): static
    {
        $this->first_tutor_email = $first_tutor_email;

        return $this;
    }

    public function getFirstTutorPhone(): ?string
    {
        return $this->first_tutor_phone;
    }

    public function setFirstTutorPhone(string $first_tutor_phone): static
    {
        $this->first_tutor_phone = $first_tutor_phone;

        return $this;
    }

    public function getFirstTutorSex(): ?string
    {
        return $this->first_tutor_sex;
    }

    public function setFirstTutorSex(string $first_tutor_sex): static
    {
        $this->first_tutor_sex = $first_tutor_sex;

        return $this;
    }

    public function getSecondTutorDni(): ?string
    {
        return $this->second_tutor_dni;
    }

    public function setSecondTutorDni(?string $second_tutor_dni): static
    {
        $this->second_tutor_dni = $second_tutor_dni;

        return $this;
    }

    public function getSecondTutorFirstSurname(): ?string
    {
        return $this->second_tutor_first_surname;
    }

    public function setSecondTutorFirstSurname(?string $second_tutor_first_surname): static
    {
        $this->second_tutor_first_surname = $second_tutor_first_surname;

        return $this;
    }

    public function getSecondTutorSecondSurname(): ?string
    {
        return $this->second_tutor_second_surname;
    }

    public function setSecondTutorSecondSurname(?string $second_tutor_second_surname): static
    {
        $this->second_tutor_second_surname = $second_tutor_second_surname;

        return $this;
    }

    public function getSecondTutorEmail(): ?string
    {
        return $this->second_tutor_email;
    }

    public function setSecondTutorEmail(?string $second_tutor_email): static
    {
        $this->second_tutor_email = $second_tutor_email;

        return $this;
    }

    public function getSecondTutorName(): ?string
    {
        return $this->second_tutor_name;
    }

    public function setSecondTutorName(?string $second_tutor_name): static
    {
        $this->second_tutor_name = $second_tutor_name;

        return $this;
    }

    public function getSecondTutorSex(): ?string
    {
        return $this->second_tutor_sex;
    }

    public function setSecondTutorSex(?string $second_tutor_sex): static
    {
        $this->second_tutor_sex = $second_tutor_sex;

        return $this;
    }

    public function getSecondTutorPhone(): ?string
    {
        return $this->second_tutor_phone;
    }

    public function setSecondTutorPhone(?string $second_tutor_phone): static
    {
        $this->second_tutor_phone = $second_tutor_phone;

        return $this;
    }

    public function getBornLocation(): ?string
    {
        return $this->born_location;
    }

    public function setBornLocation(string $born_location): static
    {
        $this->born_location = $born_location;

        return $this;
    }

    public function getTuitionYear(): ?int
    {
        return $this->tuition_year;
    }

    public function setTuitionYear(int $tuition_year): static
    {
        $this->tuition_year = $tuition_year;

        return $this;
    }

    public function getTuitionsNumberThisCourse(): ?int
    {
        return $this->tuitions_number_this_course;
    }

    public function setTuitionsNumberThisCourse(int $tuitions_number_this_course): static
    {
        $this->tuitions_number_this_course = $tuitions_number_this_course;

        return $this;
    }

    public function getTuitionObservations(): ?string
    {
        return $this->tuition_observations;
    }

    public function setTuitionObservations(?string $tuition_observations): static
    {
        $this->tuition_observations = $tuition_observations;

        return $this;
    }

    public function getBornProvince(): ?string
    {
        return $this->born_province;
    }

    public function setBornProvince(string $born_province): static
    {
        $this->born_province = $born_province;

        return $this;
    }

    public function getBornCountry(): ?string
    {
        return $this->born_country;
    }

    public function setBornCountry(string $born_country): static
    {
        $this->born_country = $born_country;

        return $this;
    }

    public function getAgeLastDayTuitionYear(): ?int
    {
        return $this->age_last_day_tuition_year;
    }

    public function setAgeLastDayTuitionYear(int $age_last_day_tuition_year): static
    {
        $this->age_last_day_tuition_year = $age_last_day_tuition_year;

        return $this;
    }

    public function getNationality(): ?string
    {
        return $this->nationality;
    }

    public function setNationality(string $nationality): static
    {
        $this->nationality = $nationality;

        return $this;
    }

    public function getStudentSex(): ?string
    {
        return $this->student_sex;
    }

    public function setStudentSex(string $student_sex): static
    {
        $this->student_sex = $student_sex;

        return $this;
    }

    public function getTuitionDate(): ?\DateTimeInterface
    {
        return $this->tuition_date;
    }

    public function setTuitionDate(\DateTimeInterface $tuition_date): static
    {
        $this->tuition_date = $tuition_date;

        return $this;
    }

    public function getSocialSecurityNumber(): ?string
    {
        return $this->social_security_number;
    }

    public function setSocialSecurityNumber(string $social_security_number): static
    {
        $this->social_security_number = $social_security_number;

        return $this;
    }

    public function getHaveDisease(): ?string
    {
        return $this->have_disease;
    }

    public function setHaveDisease(?string $have_disease): static
    {
        $this->have_disease = $have_disease;

        return $this;
    }

    public function getFollowTreatment(): ?string
    {
        return $this->follow_treatment;
    }

    public function setFollowTreatment(?string $follow_treatment): static
    {
        $this->follow_treatment = $follow_treatment;

        return $this;
    }

    public function getMedicinesAllergy(): ?string
    {
        return $this->medicines_allergy;
    }

    public function setMedicinesAllergy(?string $medicines_allergy): static
    {
        $this->medicines_allergy = $medicines_allergy;

        return $this;
    }

    public function getFoodIntolerances(): ?string
    {
        return $this->food_intolerances;
    }

    public function setFoodIntolerances(?string $food_intolerances): static
    {
        $this->food_intolerances = $food_intolerances;

        return $this;
    }

    public function getCustody(): ?string
    {
        return $this->custody;
    }

    public function setCustody(?string $custody): static
    {
        $this->custody = $custody;

        return $this;
    }

    public function getLargeFamily(): ?string
    {
        return $this->large_family;
    }

    public function setLargeFamily(?string $large_family): static
    {
        $this->large_family = $large_family;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): static
    {
        $this->image = $image;

        return $this;
    }
}