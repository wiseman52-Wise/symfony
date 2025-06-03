<?php

namespace App\Enum;

enum TypeUtilisateur: string
{
    case ADMIN = 'admin';
    case ENSEIGNANT = 'enseignant';
    case ETUDIANT = 'etudiant';
}

