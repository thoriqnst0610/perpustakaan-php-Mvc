<?php

namespace perpustakaan\Controller;

use perpustakaan\App\View;
use perpustakaan\Config\Database;
use perpustakaan\Service\bukuservice;
use perpustakaan\domain\buku;
use perpustakaan\Exception\ValidationException;
use perpustakaan\Repository\bukurepository;
use perpustakaan\Repository\peminjamrepository;

class bukucontroller{

    private bukuservice $service;

    public function __construct()
    {
        
        $database = Database::getConnection();
        $repository = new bukurepository($database);
        $peminjam = new peminjamrepository($database);
        $this->service = new bukuservice($repository, $peminjam);

    }

    public function menampilkan()
    {

        $response = $this->service->menampilkan();
        $buku = $response->semua;

        View::render('buku/tampil',[
            'buku' => $buku
        ]);

    }

    public function menambah()
    {

        View::render('buku/tambah',[]);

    }

    public function postmenambah()
    {

        $buku = new buku;
        $buku->nama_buku = $_POST['nama_buku'];
        $buku->pengarang = $_POST['pengarang'];
        $buku->penerbit = $_POST['penerbit'];
        $buku->tahun_terbit = $_POST['tahun_terbit'];

        try{

            $this->service->menambah($buku);
            View::redirect('/buku/menampilkan');

        }catch(ValidationException $ex){

            View::render('/buku/tambah',[
                'error' => $ex->getMessage()
            ]);

        }

    }

    public function menghapus()
    {

        try{

            $this->service->menghapus($_GET['id_buku']);
            View::redirect('/buku/menampilkan');

        }catch(ValidationException $ex){

            $response = $this->service->menampilkan();
            $buku = $response->semua;

            View::render('/buku/tampil',[
                'error' => $ex->getMessage(),
                'buku' => $buku
            ]);
        }

    }

    public function mengedit()
    {

        try{

            $buku = $this->service->mengambil($_GET['id_buku']);
            View::render('/buku/edit', [

                'id_buku' => $buku->id_buku,
                'nama_buku' => $buku->nama_buku,
                'pengarang' => $buku->pengarang,
                'penerbit' => $buku->penerbit,
                'tahun_terbit' => $buku->tahun_terbit
                
            ]);

        }catch(ValidationException $ex){

            View::render('buku/tampil',[
                'error' => $ex->getMessage()
            ]);

        }
        

    }

    public function postmengedit()
    {

        $buku = new buku();
        $buku->id_buku = $_POST['id_buku'];
        $buku->nama_buku = $_POST['nama_buku'];
        $buku->pengarang = $_POST['pengarang'];
        $buku->penerbit = $_POST['penerbit'];
        $buku->tahun_terbit = $_POST['tahun_terbit'];

        try{

            $this->service->mengedit($buku);
            View::redirect('/buku/menampilkan');

        }catch(ValidationException $ex){

            View::render('buku/tampil',[
                'error' => $ex->getMessage()
            ]);
        }
        
    }

}