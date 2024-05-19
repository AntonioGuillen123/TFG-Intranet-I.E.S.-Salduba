<?php

namespace App\Entity;

use App\Repository\SoulRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SoulRepository::class)]
class Soul
{
    #[ORM\Id]
    #[ORM\Column(length: 12)]
    private ?string $student_key = null;

    #[ORM\Column(length: 12, nullable: true)]
    private ?string $student_key2 = null;

    #[ORM\Column(length: 10, nullable: true)]
    private ?string $dni = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $home = null;

    #[ORM\Column(length: 30, nullable: true)]
    private ?string $postal_code = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $student_location = null;

    #[ORM\Column(length: 30, nullable: true)]
    private ?string $student_date = null;

    #[ORM\Column(length: 60, nullable: true)]
    private ?string $province_residence = null;

    #[ORM\Column(length: 30, nullable: true)]
    private ?string $phone = null;

    #[ORM\Column(length: 30, nullable: true)]
    private ?string $emergency_phone = null;

    #[ORM\Column(length: 64, nullable: true)]
    private ?string $email = null;

    #[ORM\Column(length: 60, nullable: true)]
    private ?string $expedience_number = null;

    #[ORM\Column(length: 120, nullable: true)]
    private ?string $surnames = null;

    #[ORM\Column(length: 30, nullable: true)]
    private ?string $first_tutor_dni = null;

    #[ORM\Column(length: 60, nullable: true)]
    private ?string $first_tutor_first_surname = null;

    #[ORM\Column(length: 60, nullable: true)]
    private ?string $first_tutor_second_surname = null;

    #[ORM\Column(length: 60, nullable: true)]
    private ?string $first_tutor_name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $father = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $first_tutor_sex = null;

    #[ORM\Column(length: 60, nullable: true)]
    private ?string $second_tutor_dni = null;

    #[ORM\Column(length: 30, nullable: true)]
    private ?string $first_tutor_number = null;

    #[ORM\Column(length: 60, nullable: true)]
    private ?string $second_tutor_first_surname = null;

    #[ORM\Column(length: 60, nullable: true)]
    private ?string $second_tutor_second_surname = null;

    #[ORM\Column(length: 60, nullable: true)]
    private ?string $second_tutor_name = null;

    #[ORM\Column(length: 20, nullable: true)]
    private ?string $second_tutor_sex = null;

    #[ORM\Column(length: 30, nullable: true)]
    private ?string $second_tutor_number = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $born_location = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $born_province = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $born_country = null;

    #[ORM\Column(length: 2, nullable: true)]
    private ?string $age = null;

    #[ORM\Column(length: 32, nullable: true)]
    private ?string $nationality = null;

    #[ORM\Column(length: 1, nullable: true)]
    private ?string $sex = null;

    #[ORM\Column]
    private ?int $brothers = null;

    #[ORM\Column(length: 30, nullable: true)]
    private ?string $user = null;

    #[ORM\Column(length: 30)]
    private ?string $password = null;

    #[ORM\Column(length: 10, nullable: true)]
    private ?string $library_code = null;

    #[ORM\Column(length: 12, nullable: true)]
    private ?string $social_security = null;

    #[ORM\Column(length: 200)]
    private ?string $student_repeat = null;

    #[ORM\Column(length: 12, nullable: true)]
    private ?string $user_think = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $highschool_email = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $transit = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $student_personal_email = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $student_personal_phone = null;

    #[ORM\Column(nullable: true)]
    private ?int $initial_year = null;

    #[ORM\Column(length: 2, nullable: true)]
    private ?string $disease = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $treatment = null;

    #[ORM\Column(length: 2, nullable: true)]
    private ?string $allergy = null;

    #[ORM\Column(length: 2, nullable: true)]
    private ?string $intolerance = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $custody = null;

    #[ORM\Column(length: 12, nullable: true)]
    private ?string $custody1_dni = null;

    #[ORM\Column(length: 12, nullable: true)]
    private ?string $custody2_dni = null;

    #[ORM\Column(length: 30, nullable: true)]
    private ?string $large_family = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStudentKey(): ?string
    {
        return $this->student_key;
    }

    public function setStudentKey(string $student_key): static
    {
        $this->student_key = $student_key;

        return $this;
    }

    public function getStudentKey2(): ?string
    {
        return $this->student_key2;
    }

    public function setStudentKey2(?string $student_key2): static
    {
        $this->student_key2 = $student_key2;

        return $this;
    }

    public function getDni(): ?string
    {
        return $this->dni;
    }

    public function setDni(?string $dni): static
    {
        $this->dni = $dni;

        return $this;
    }

    public function getHome(): ?string
    {
        return $this->home;
    }

    public function setHome(?string $home): static
    {
        $this->home = $home;

        return $this;
    }

    public function getPostalCode(): ?string
    {
        return $this->postal_code;
    }

    public function setPostalCode(?string $postal_code): static
    {
        $this->postal_code = $postal_code;

        return $this;
    }

    public function getStudentLocation(): ?string
    {
        return $this->student_location;
    }

    public function setStudentLocation(?string $student_location): static
    {
        $this->student_location = $student_location;

        return $this;
    }

    public function getStudentDate(): ?string
    {
        return $this->student_date;
    }

    public function setStudentDate(?string $student_date): static
    {
        $this->student_date = $student_date;

        return $this;
    }

    public function getProvinceResidence(): ?string
    {
        return $this->province_residence;
    }

    public function setProvinceResidence(?string $province_residence): static
    {
        $this->province_residence = $province_residence;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(?string $phone): static
    {
        $this->phone = $phone;

        return $this;
    }

    public function getEmergencyPhone(): ?string
    {
        return $this->emergency_phone;
    }

    public function setEmergencyPhone(?string $emergency_phone): static
    {
        $this->emergency_phone = $emergency_phone;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getExpedienceNumber(): ?string
    {
        return $this->expedience_number;
    }

    public function setExpedienceNumber(?string $expedience_number): static
    {
        $this->expedience_number = $expedience_number;

        return $this;
    }

    public function getSurnames(): ?string
    {
        return $this->surnames;
    }

    public function setSurnames(?string $surnames): static
    {
        $this->surnames = $surnames;

        return $this;
    }

    public function getFirstTutorDni(): ?string
    {
        return $this->first_tutor_dni;
    }

    public function setFirstTutorDni(?string $first_tutor_dni): static
    {
        $this->first_tutor_dni = $first_tutor_dni;

        return $this;
    }

    public function getFirstTutorFirstSurname(): ?string
    {
        return $this->first_tutor_first_surname;
    }

    public function setFirstTutorFirstSurname(?string $first_tutor_first_surname): static
    {
        $this->first_tutor_first_surname = $first_tutor_first_surname;

        return $this;
    }

    public function getFirstTutorSecondSurname(): ?string
    {
        return $this->first_tutor_second_surname;
    }

    public function setFirstTutorSecondSurname(?string $first_tutor_second_surname): static
    {
        $this->first_tutor_second_surname = $first_tutor_second_surname;

        return $this;
    }

    public function getFirstTutorName(): ?string
    {
        return $this->first_tutor_name;
    }

    public function setFirstTutorName(?string $first_tutor_name): static
    {
        $this->first_tutor_name = $first_tutor_name;

        return $this;
    }

    public function getFather(): ?string
    {
        return $this->father;
    }

    public function setFather(?string $father): static
    {
        $this->father = $father;

        return $this;
    }

    public function getFirstTutorSex(): ?string
    {
        return $this->first_tutor_sex;
    }

    public function setFirstTutorSex(?string $first_tutor_sex): static
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

    public function getFirstTutorNumber(): ?string
    {
        return $this->first_tutor_number;
    }

    public function setFirstTutorNumber(?string $first_tutor_number): static
    {
        $this->first_tutor_number = $first_tutor_number;

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

    public function getSecondTutorNumber(): ?string
    {
        return $this->second_tutor_number;
    }

    public function setSecondTutorNumber(?string $second_tutor_number): static
    {
        $this->second_tutor_number = $second_tutor_number;

        return $this;
    }

    public function getBornLocation(): ?string
    {
        return $this->born_location;
    }

    public function setBornLocation(?string $born_location): static
    {
        $this->born_location = $born_location;

        return $this;
    }

    public function getBornProvince(): ?string
    {
        return $this->born_province;
    }

    public function setBornProvince(?string $born_province): static
    {
        $this->born_province = $born_province;

        return $this;
    }

    public function getBornCountry(): ?string
    {
        return $this->born_country;
    }

    public function setBornCountry(?string $born_country): static
    {
        $this->born_country = $born_country;

        return $this;
    }

    public function getAge(): ?string
    {
        return $this->age;
    }

    public function setAge(?string $age): static
    {
        $this->age = $age;

        return $this;
    }

    public function getNationality(): ?string
    {
        return $this->nationality;
    }

    public function setNationality(?string $nationality): static
    {
        $this->nationality = $nationality;

        return $this;
    }

    public function getSex(): ?string
    {
        return $this->sex;
    }

    public function setSex(?string $sex): static
    {
        $this->sex = $sex;

        return $this;
    }

    public function getBrothers(): ?int
    {
        return $this->brothers;
    }

    public function setBrothers(int $brothers): static
    {
        $this->brothers = $brothers;

        return $this;
    }

    public function getUser(): ?string
    {
        return $this->user;
    }

    public function setUser(?string $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    public function getLibraryCode(): ?string
    {
        return $this->library_code;
    }

    public function setLibraryCode(?string $library_code): static
    {
        $this->library_code = $library_code;

        return $this;
    }

    public function getSocialSecurity(): ?string
    {
        return $this->social_security;
    }

    public function setSocialSecurity(?string $social_security): static
    {
        $this->social_security = $social_security;

        return $this;
    }

    public function getStudentRepeat(): ?string
    {
        return $this->student_repeat;
    }

    public function setStudentRepeat(string $student_repeat): static
    {
        $this->student_repeat = $student_repeat;

        return $this;
    }

    public function getUserThink(): ?string
    {
        return $this->user_think;
    }

    public function setUserThink(?string $user_think): static
    {
        $this->user_think = $user_think;

        return $this;
    }

    public function getHighschoolEmail(): ?string
    {
        return $this->highschool_email;
    }

    public function setHighschoolEmail(?string $highschool_email): static
    {
        $this->highschool_email = $highschool_email;

        return $this;
    }

    public function getTransit(): ?string
    {
        return $this->transit;
    }

    public function setTransit(?string $transit): static
    {
        $this->transit = $transit;

        return $this;
    }

    public function getStudentPersonalEmail(): ?string
    {
        return $this->student_personal_email;
    }

    public function setStudentPersonalEmail(?string $student_personal_email): static
    {
        $this->student_personal_email = $student_personal_email;

        return $this;
    }

    public function getStudentPersonalPhone(): ?string
    {
        return $this->student_personal_phone;
    }

    public function setStudentPersonalPhone(?string $student_personal_phone): static
    {
        $this->student_personal_phone = $student_personal_phone;

        return $this;
    }

    public function getInitialYear(): ?int
    {
        return $this->initial_year;
    }

    public function setInitialYear(?int $initial_year): static
    {
        $this->initial_year = $initial_year;

        return $this;
    }

    public function getDisease(): ?string
    {
        return $this->disease;
    }

    public function setDisease(?string $disease): static
    {
        $this->disease = $disease;

        return $this;
    }

    public function getTreatment(): ?string
    {
        return $this->treatment;
    }

    public function setTreatment(?string $treatment): static
    {
        $this->treatment = $treatment;

        return $this;
    }

    public function getAllergy(): ?string
    {
        return $this->allergy;
    }

    public function setAllergy(?string $allergy): static
    {
        $this->allergy = $allergy;

        return $this;
    }

    public function getIntolerance(): ?string
    {
        return $this->intolerance;
    }

    public function setIntolerance(?string $intolerance): static
    {
        $this->intolerance = $intolerance;

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

    public function getCustody1Dni(): ?string
    {
        return $this->custody1_dni;
    }

    public function setCustody1Dni(?string $custody1_dni): static
    {
        $this->custody1_dni = $custody1_dni;

        return $this;
    }

    public function getCustody2Dni(): ?string
    {
        return $this->custody2_dni;
    }

    public function setCustody2Dni(?string $custody2_dni): static
    {
        $this->custody2_dni = $custody2_dni;

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
}