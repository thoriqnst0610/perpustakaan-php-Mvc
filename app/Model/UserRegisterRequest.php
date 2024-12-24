<?php

namespace perpustakaan\Model;

class UserRegisterRequest
{
    public ?string $username;
    public ?string $id = null;
    public ?string $name = null;
    public ?string $password = null;
}