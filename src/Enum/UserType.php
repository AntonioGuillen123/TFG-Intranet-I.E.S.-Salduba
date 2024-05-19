<?php

namespace App\Enum;

enum UserType: string {
    case Student = 'alumno';
    case Father = 'padre';
    case Teacher = 'profesor';
    case Directive = 'directiva';
    case Administrator = 'administrador';
}