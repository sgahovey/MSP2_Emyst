<?php

namespace App\Enum;

enum TypeObjectifEnum: string
{
    case PERTE_POIDS = 'Perte poids';
    case PRISE_MASSE = 'Prise masse';
    case SECHE = 'Sèche';
    case AMELIORATION_CARDIO = 'Amelioration cardio';
    case AUGMENTATION_FORCE = 'Augmentation force';
    case ENDURANCE = 'Endurance';
    case VITESSE = 'Vitesse';
    case FLEXIBILITE = 'Flexibilite';
    case FREQUENCE_SEANCES = 'Frequence seances';
    case COMPETITION = 'Competition';
    case RECORD_PERSONNEL = 'Record personnel';
}