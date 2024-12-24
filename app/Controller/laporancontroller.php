<?php

namespace perpustakaan\Controller;

use Exception;
use perpustakaan\App\View;
use perpustakaan\Config\Database;
use perpustakaan\Repository\dendarepository;
use perpustakaan\Repository\laporanrepository;
use perpustakaan\Service\dendaservice;
use perpustakaan\Service\laporanservice;

class laporancontroller{

    private laporanservice $laporan;
    private dendaservice $service;

    public function __construct()
    {
        $database = Database::getConnection();
        $repository = new laporanrepository($database);
        $this->laporan = new laporanservice($repository);

        $repository = new dendarepository($database);
        $this->service = new dendaservice($repository);
    }

    public function mengambil()
    {

        try{

            $denda = $this->service->menghitung();
            $semua = $denda->semua;

            $response = $this->laporan->mengambil();
            $laporan = $response->semua;

            View::render('/laporan/tampil',[
                'laporan' => $laporan
            ]);

        }catch(Exception $ex){

            View::render('/laporan/tampil',[
                'error' => $ex->getMessage()
            ]);

        }
        
    }

    public function cetak()
    {

        try{

            $response = $this->laporan->mengambil();
            $laporan = $response->semua;

            View::render('/laporan/laporan',[
                'laporan' => $laporan
            ]);

        }catch(Exception $ex){

            View::render('/laporan/laporan',[
                'error' => $ex->getMessage()
            ]);

        }
        
    }
}