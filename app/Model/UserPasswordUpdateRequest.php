<?php

namespace perpustakaan\Model;

class UserPasswordUpdateRequest
{
    public ?string $username;
    public ?string $id = null;
    public ?string $oldPassword = null;
    public ?string $newPassword = null;
}