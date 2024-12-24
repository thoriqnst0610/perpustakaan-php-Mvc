<?php

namespace perpustakaan\Service;

use Exception;
use perpustakaan\domain\peminjam;
use perpustakaan\Exception\ValidationException;
use perpustakaan\Repository\dendarepository;
use perpustakaan\Repository\peminjamrepository;

class peminjamservice{

    private peminjamrepository $repository;
    private dendarepository $denda;

    public function __construct(peminjamrepository $repository, dendarepository $denda)
    {
        $this->repository = $repository;
        $this->denda = $denda;
    }

    public function menyimpan(peminjam $peminjam):int
    {

        $this->validatemenyimpan($peminjam);

        try{

            return $this->repository->menyimpan($peminjam);

        }catch(Exception $ex){

            throw $ex;

        }

    }

    private function validatemenyimpan(peminjam $peminjam)
    {


            if(

                $peminjam->id_anggota == null ||
                $peminjam->id_buku == null

                ){

                    throw new ValidationException("tidak ada yang boleh kosong guys");

                }
                
    }

    public function ambil():peminjam
    {
        try{

            return $this->repository->ambil();

        }catch(Exception $ex){

            throw $ex;

        }
    }
    
    public function menghapus(string $id_peminjam):void
    {

        $this->validatemenghapus($id_peminjam);

        try{

            $this->repository->menghapus($id_peminjam);

        }catch(Exception $ex){

            throw $ex;

        }
        
    }

    private function validatemenghapus(string $id_peminjam):void
    {

        $peminjam = $this->denda->ambilpeminjam($id_peminjam);
        $peminjam = $peminjam->semua;

        if(!empty($peminjam)){

            throw new ValidationException("maaf, Peminjam ini lagi mempunyai denda");
        }

        if($id_peminjam == ""){

            throw new ValidationException("id buku tidak boleh kosong");

        }
    }

    public function mengedit(peminjam $peminjam):void
    {
       
        $this->validamengedit($peminjam);

        try{


            $this->repository->mengedit($peminjam);

        }catch(Exception $ex){

            throw $ex;
            
        }

    }

    private function validamengedit(peminjam $peminjam):void
    {

        if(

            $peminjam->id_anggota == "" ||
            $peminjam->id_buku == "" ||
            $peminjam->status == "" ||
            $peminjam->id_peminjam == ""

        ){

            throw new ValidationException("tidak ada yang boleh kosong");

        }

    }

    public function mengambil(string $id_peminjam):peminjam
    {

        $this->validatemengambil($id_peminjam);

        try{

            $peminjam = $this->repository->mengambil($id_peminjam);
            $semua = $peminjam->semua;

            foreach($semua as $bagi){

                $peminjam->id_anggota = $bagi['id_anggota'];
                $peminjam->id_buku = $bagi['id_buku'];
                $peminjam->status = $bagi['status'];
                $peminjam->id_peminjam = $bagi['id_peminjam'];

            }

            return $peminjam;

        }catch(Exception $ex){

            throw $ex;

        }

    }

    public function validatemengambil(string $id_anggota)
    {

        if($id_anggota == ""){

            throw new ValidationException("id buku tidak boleh kosong");

        }

    }
}