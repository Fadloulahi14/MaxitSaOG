<?php 

namespace App\Entity;

enum TypeEnum: string {
    case CLIENT = 'client';
    case VENDEUR = 'vendeur';
}
