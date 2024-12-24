<?php

namespace perpustakaan\Middleware;

use perpustakaan\App\View;
use perpustakaan\Config\Database;
use perpustakaan\Repository\SessionRepository;
use perpustakaan\Repository\UserRepository;
use perpustakaan\Service\SessionService;

class MustLoginMiddleware implements Middleware
{
    private SessionService $sessionService;

    public function __construct()
    {
        $sessionRepository = new SessionRepository(Database::getConnection());
        $userRepository = new UserRepository(Database::getConnection());
        $this->sessionService = new SessionService($sessionRepository, $userRepository);
    }

    function before(): void
    {
        $user = $this->sessionService->current();
        if ($user == null) {
            View::redirect('/users/login');
        }
    }
}