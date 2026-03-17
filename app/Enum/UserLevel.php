<?php

namespace App\UserLevel;

enum UserLevel: int
{
    case Member = 0;
    case Contributor = 1;
    case Administrator = 2;
}
