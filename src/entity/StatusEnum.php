<?php
  namespace App\Entity;

  enum StatusEnum: string {
      case PAYE = 'paye';
      case IMPAYE = 'impaye';

  }
