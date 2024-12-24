<?php

namespace perpustakaan\Controller;

use Exception;
use perpustakaan\App\View;
use perpustakaan\Config\Database;
use perpustakaan\domain\anggota;
use perpustakaan\domain\denda;
use perpustakaan\domain\peminjam;
use perpustakaan\Exception\ValidationException;
use perpustakaan\Repository\anggotarepository;
use perpustakaan\Repository\bukurepository;
use perpustakaan\Repository\dendarepository;
use perpustakaan\Repository\peminjamrepository;
use perpustakaan\Service\anggotaservice;
use perpustakaan\Service\bukuservice;
use perpustakaan\Service\dendaservice;
use perpustakaan\Service\peminjamservice;

class peminjamcontroller{

    private peminjamservice $service;
    private anggotaservice $anggota;
    private bukuservice $buku;
    private dendaservice $denda;

    public function __construct()
    {
        $database = Database::getConnection();
        $repository = new peminjamrepository($database);
        $repositorys = new peminjamrepository($database);
        $repositorysdenda = new dendarepository($database);
        $this->service = new peminjamservice($repository, $repositorysdenda);

        $repository = new bukurepository($database);
        $this->buku = new bukuservice($repository, $repositorys);

        $repository = new anggotarepository($database);
        $this->anggota = new anggotaservice($repository, $repositorys);

        $repository = new dendarepository($database);
        $this->denda = new dendaservice($repository, $repositorys);


    }
    
    public function postmenambah()
    {
        
        try{

            $peminjam = new peminjam();
            $peminjam->id_anggota = $_POST['id_anggota'];
            $peminjam->id_buku = $_POST['id_buku'];
            $peminjam->waktu_pengembalian = $_POST['waktu_pengembalian'];
            
            $id_peminjam = $this->service->menyimpan($peminjam);

            $peminjam = $this->service->ambil();
            $peminjam = $peminjam->semua;

            $denda = new denda();
            $denda->waktu_pengembalian = $_POST['waktu_pengembalian'];
            $denda->id_peminjam = $id_peminjam;

            $this->denda->menyimpan($denda);

            View::render('/peminjam/tampil',[
                'peminjam' => $peminjam
            ]);

        }catch(Exception $ex){

            View::render('/peminjam/tampil',[
                'error' => $ex->getMessage()    
            ]);

        }

    }

    public function menambah()
    {
        try{

            $anggota = $this->anggota->menampilkan();
            $anggota = $anggota->semua;
            $buku = $this->buku->menampilkan();
            $buku = $buku->semua;

            View::render('/peminjam/tambah',[
                'buku' => $buku,
                'anggota' => $anggota
                ]);

        }catch(ValidationException $ex){

            View::render('/peminjam/menampilkan',[

                'error' => $ex->getMessage()

            ]);

        }

    }

    public function ambil()
    {

        try{

            $peminjam = $this->service->ambil();
            $peminjam = $peminjam->semua;

            View::render('/peminjam/tampil', [
                'peminjam' => $peminjam
            ]);

        }catch(Exception $ex){

            View::render('/peminjam/tampil',[
                'errror' => $ex->getMessage()
            ]);
        }

    }

    public function menghapus()
    {

        try{

            $this->service->menghapus($_GET['id_peminjam']);
            View::redirect('/peminjam/menampilkan');

        }catch(ValidationException $ex){

            $peminjam = $this->service->ambil();
            $peminjam = $peminjam->semua;

            View::render('/peminjam/tampil',[
                'error' => $ex->getMessage(),
                'peminjam' => $peminjam
            ]);
        }

    }

    public function mengedit()
    {

        try{

            $peminjam = $this->service->mengambil($_GET['id_peminjam']);
            View::render('/peminjam/edit', [

                'id_anggota' => $peminjam->id_anggota,
                'id_buku' => $peminjam->id_buku,
                'status' => $peminjam->status,
                'id_peminjam' => $peminjam->id_peminjam
                
            ]);

        }catch(ValidationException $ex){

            View::render('peminjam/tampil',[
                'error' => $ex->getMessage()
            ]);

        }
        

    }

    public function postmengedit()
    {

        $peminjam = new peminjam();
        $peminjam->id_peminjam = $_POST['id_peminjam'];
        $peminjam->id_anggota = $_POST['id_anggota'];
        $peminjam->id_buku = $_POST['id_buku'];
        $peminjam->status = $_POST['status'];

        try{

            $this->service->mengedit($peminjam);
            View::redirect('/peminjam/menampilkan');

        }catch(ValidationException $ex){

            View::render('peminjam/tampil',[
                'error' => $ex->getMessage()
            ]);
        }
        
    }
}