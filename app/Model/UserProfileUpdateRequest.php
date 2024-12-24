<?php

namespace perpustakaan\Model;

class UserProfileUpdateRequest
{
    public ?string $username;
    public ?string $id = null;
    public ?string $name = null;
}