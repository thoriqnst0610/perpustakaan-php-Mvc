<?php

namespace perpustakaan\Controller;

use Exception;
use perpustakaan\App\View;
use perpustakaan\Config\Database;
use perpustakaan\Exception\ValidationException;
use perpustakaan\Repository\dendarepository;
use perpustakaan\Service\dendaservice;

class dendacontroller{

    private dendaservice $service;

    public function __construct()
    {
        $database = Database::getConnection();
        $repository = new dendarepository($database);
        $this->service = new dendaservice($repository);
    }

    public function menampilkan()
    {
        try{

            $denda = $this->service->menghitung();
            $semua = $denda->semua;

            View::render('denda/tampil',[
                'denda' => $semua
            ]);

        }catch(Exception $ex){

            View::render('denda/tampil',[

                'error' => $ex->getMessage()

            ]);
        }
    }

    public function menghapus()
    {

        try{

            $this->service->menghapus($_GET['id_denda']);
            View::redirect('/denda/menampilkan');

        }catch(ValidationException $ex){

            View::render('/denda/tampil',[
                'error' => $ex->getMessage()
            ]);
        }

    }
    
}