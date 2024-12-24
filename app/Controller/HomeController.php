<?php

namespace perpustakaan\Controller;

use perpustakaan\App\View;
use perpustakaan\Config\Database;
use perpustakaan\Repository\SessionRepository;
use perpustakaan\Repository\UserRepository;
use perpustakaan\Service\SessionService;


class HomeController
{

    private SessionService $sessionService;

    public function __construct()
    {
        $connection = Database::getConnection();
        $sessionRepository = new SessionRepository($connection);
        $userRepository = new UserRepository($connection);
        $this->sessionService = new SessionService($sessionRepository, $userRepository);

    }


    function index()
    {
        $user = $this->sessionService->current();
        if ($user == null) {
            View::render('user/login', [
                "title" => "PHP Login Management"
            ]);
        } else {

            View::render('/buku/tampil', [
            ]);
        }
    }

}