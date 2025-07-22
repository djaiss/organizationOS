<?php

declare(strict_types=1);

namespace App\Enums;

enum EmailType: string
{
    case LOGIN_FAILED = 'login_failed';
    case MAGIC_LINK_CREATED = 'magic_link_created';
}
