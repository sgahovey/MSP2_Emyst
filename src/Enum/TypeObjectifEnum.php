<?php

namespace App\Enum;

enum TypeObjectifEnum: string
{
    case PERTE_POIDS = 'Perte de poids';
    case PRISE_MASSE = 'Prise de masse';
    case SECHE = 'Sèche musculaire';
    case AMELIORATION_CARDIO = 'Amélioration cardio-vasculaire';
    case AUGMENTATION_FORCE = 'Augmentation de la force';
    case ENDURANCE = 'Amélioration de l\'endurance';
    case VITESSE = 'Amélioration de la vitesse';
    case FLEXIBILITE = 'Amélioration de la flexibilité';
    case FREQUENCE_SEANCES = 'Augmentation de la fréquence des séances';
    case COMPETITION = 'Préparation à une compétition';
    case RECORD_PERSONNEL = 'Battre un record personnel';
}