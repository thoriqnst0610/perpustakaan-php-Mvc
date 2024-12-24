<?php

namespace perpustakaan\Service;

use Exception;
use perpustakaan\domain\anggota;
use perpustakaan\Repository\laporanrepository;

class laporanservice{

    private laporanrepository $repository;

    public function __construct(laporanrepository $repository)
    {
        $this->repository = $repository;
    }

    public function mengambil():anggota
    {

        try{

            return $this->repository->FindAll();

        }catch(Exception $ex){

            throw $ex;

        }
    }
}