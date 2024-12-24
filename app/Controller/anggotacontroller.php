<?php

namespace perpustakaan\Controller;

use Exception;
use perpustakaan\App\View;
use perpustakaan\Config\Database;
use perpustakaan\Repository\anggotarepository;
use perpustakaan\domain\anggota;
use perpustakaan\Exception\ValidationException;
use perpustakaan\Repository\peminjamrepository;
use perpustakaan\Service\anggotaservice;

class anggotacontroller{

    private anggotaservice $service;

    public function __construct()
    {
        $datbase = Database::getConnection();
        $repository = new anggotarepository($datbase);
        $peminjam = new peminjamrepository($datbase);
        $this->service = new anggotaservice($repository, $peminjam);
    }

    public function menampilkan()
    {
        try{

            $response = $this->service->menampilkan();
            $anggota = $response->semua;

            View::render('/anggota/tampil',[
                'anggota' => $anggota
            ]);

        }catch(Exception $ex){

            View::render('/anggota',[
                'error' => $ex->getMessage()
            ]);
            
        }
    }

    public function menambah()
    {
        View::render('/anggota/tambah',[]);
    }

    public function postmenambah()
    {

        $anggota = new anggota();
        $anggota->nama = $_POST['nama'];
        $anggota->alamat = $_POST['alamat'];
        $anggota->nik = $_POST['nik'];

        try{

            $this->service->menambah($anggota);
            View::redirect('/anggota/menampilkan');

        }catch(ValidationException $ex){

            View::render('/anggota/tambah',[
                'error' => $ex->getMessage()
            ]);
        }
    }

    public function menghapus()
    {

        try{

            $this->service->menghapus($_GET['id_anggota']);
            View::redirect('/anggota/menampilkan');

        }catch(ValidationException $ex){

            $response = $this->service->menampilkan();
            $anggota = $response->semua;

            View::render('/anggota/tampil',[
                'error' => $ex->getMessage(),
                'anggota' => $anggota
            ]);
        }

    }

    public function mengedit()
    {

        try{

            $anggota = $this->service->mengambil($_GET['id_anggota']);
            View::render('/anggota/edit', [

                'id_anggota' => $anggota->id_anggota,
                'nama' => $anggota->nama,
                'alamat' => $anggota->alamat,
                'nik' => $anggota->nik
                
            ]);

        }catch(ValidationException $ex){

            View::render('anggota/tampil',[
                'error' => $ex->getMessage()
            ]);

        }
        

    }

    public function postmengedit()
    {

        $anggota = new anggota();
        $anggota->id_anggota = $_POST['id_anggota'];
        $anggota->nama = $_POST['nama'];
        $anggota->alamat = $_POST['alamat'];
        $anggota->nik = $_POST['nik'];


        try{

            $this->service->mengedit($anggota);
            View::redirect('/anggota/menampilkan');

        }catch(ValidationException $ex){

            View::render('anggota/tampil',[
                'error' => $ex->getMessage()
            ]);
        }
        
    }

    
}