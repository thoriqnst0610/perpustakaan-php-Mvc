<?php

namespace perpustakaan\Service;

use Exception;
use perpustakaan\Repository\bukurepository;
use perpustakaan\domain\buku;
use perpustakaan\Exception\ValidationException;
use perpustakaan\Repository\peminjamrepository;

class bukuservice{

    private bukurepository $repository;
    private peminjamrepository $peminjam;

    public function __construct(bukurepository $repository, peminjamrepository $peminjam)
    {

        $this->repository = $repository;
        $this->peminjam = $peminjam;
        
    }

    public function menampilkan():buku
    {


        return $this->repository->menampilkan();

    }

    public function menambah(buku $buku):void
    {

        $this->validatemenambah($buku);

        try{

            $this->repository->menambah($buku);

        }catch(Exception $ex){

            throw $ex;

        }
    }

    private function validatemenambah(buku $buku):void
    {

        if(

            $buku->nama_buku == "" ||
            $buku->pengarang == "" ||
            $buku->penerbit == "" ||
            $buku->tahun_terbit == ""

        ){

            throw new ValidationException("tidak ada yang boleh kosong");

        }
    }

    public function menghapus(string $id_buku):void
    {

        $this->validatemenghapus($id_buku);

        try{

            $this->repository->menghapus($id_buku);

        }catch(Exception $ex){

            throw $ex;

        }
        
    }

    private function validatemenghapus(string $id_buku):void
    {

        $buku = $this->peminjam->ambilbuku($id_buku);
        $buku = $buku->semua;

        if(!empty($buku)){

            throw new ValidationException("maaf, buku ini lagi ada yang pinjam");
        }

        if($id_buku == ""){

            throw new ValidationException("id buku tidak boleh kosong");

        }
    }

    public function mengedit(buku $buku):void
    {
       
        $this->validamengedit($buku);

        try{


            $this->repository->mengedit($buku);

        }catch(Exception $ex){

            throw $ex;
            
        }

    }

    private function validamengedit(buku $buku):void
    {

        if(

            $buku->id_buku == "" ||
            $buku->nama_buku == "" ||
            $buku->pengarang == "" ||
            $buku->penerbit == "" ||
            $buku->tahun_terbit == ""

        ){

            throw new ValidationException("tidak ada yang boleh kosong");

        }

    }

    public function mengambil(string $id_buku):buku
    {

        $this->validatemengambil($id_buku);

        try{

            $buku = $this->repository->ambil($id_buku);
            $semua = $buku->semua;

            foreach($semua as $bagi){

                $buku->id_buku = $bagi['id_buku'];
                $buku->nama_buku = $bagi['nama_buku'];
                $buku->pengarang = $bagi['pengarang'];
                $buku->penerbit = $bagi['penerbit'];
                $buku->tahun_terbit = $bagi['tahun_terbit'];

            }

            return $buku;

        }catch(Exception $ex){

            throw $ex;

        }

    }

    public function validatemengambil(string $id_buku)
    {

        if($id_buku == ""){

            throw new ValidationException("id buku tidak boleh kosong");

        }

    }

}