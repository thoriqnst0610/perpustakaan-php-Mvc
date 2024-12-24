<?php

namespace perpustakaan\Model;

class UserLoginRequest
{
    public ?string $username;
    public ?string $id = null;
    public ?string $password = null;
}