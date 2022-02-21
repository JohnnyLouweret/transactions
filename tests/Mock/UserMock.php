<?php

namespace App\Tests\Mock;

use App\Entity\User;

class UserMock extends User
{
    /**
     * @return UserMock
     */
    public static function create(): UserMock
    {
        return new self();
    }
}
