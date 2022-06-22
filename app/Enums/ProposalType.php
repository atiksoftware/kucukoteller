<?php

namespace App\Enums;

enum ProposalType:int
{
	case DIRECTION = 1;
	case EAT = 2;
	case GUIDE = 3;
	case PLACES = 4;
	case TODO = 5;
	case TAKE = 6;
	case BOUTIQUE = 7;
	case PRICE = 8;
}
