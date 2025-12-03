<?php

namespace App\Enum;

enum TypeSeanceEnum: string {
    case FULL_BODY = 'Full body';
    case HAUT_DU_CORPS = 'Haut du corps';
    case BAS_DU_CORPS = 'Bas du corps';
    case CARDIO = 'Cardio';
    case RENFORCEMENT = 'Renforcement';
    case STRETCHING = 'Étirements';
    case HIIT = 'HIIT';
    case ABDOS = 'Abdos';
    case POMPE = 'Pompe';
    case PLIOMETRIE = 'Pliométrie';
}