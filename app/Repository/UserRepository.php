<?php

namespace perpustakaan\Repository;

use perpustakaan\domain\User;

class UserRepository
{
    private \PDO $connection;

    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    public function save(User $user): User
    {
        $statement = $this->connection->prepare("INSERT INTO users(name, password, username) VALUES (?, ?, ?)");
        $statement->execute([
            $user->name, $user->password, $user->username
        ]);
        return $user;
    }

    public function update(User $user): User
    {
        $statement = $this->connection->prepare("UPDATE users SET name = ?, password = ? WHERE id = ?");
        $statement->execute([
            $user->name, $user->password, $user->id
        ]);
        return $user;
    }

    public function findById(string $username): ?User
    {

        $statement = $this->connection->prepare("SELECT id, name, password, username FROM users WHERE username = ?");
        $statement->execute([$username]);

        try {
            if ($row = $statement->fetch()) {
                $user = new User();
                $user->name = $row['name'];
                $user->password = $row['password'];
                $user->username = $row['username'];
                $user->id = $row['id'];
                return $user;
            } else {
                return null;
            }
        } finally {
            $statement->closeCursor();
        }
    }

    public function deleteAll(): void
    {
        $this->connection->exec("DELETE from users");
    }
}