<?php

namespace perpustakaan\Service;

use Exception;
use perpustakaan\Exception\ValidationException;
use perpustakaan\domain\anggota;
use perpustakaan\Repository\anggotarepository;
use perpustakaan\Repository\peminjamrepository;

class anggotaservice{
    
    private anggotarepository $repository;
    private peminjamrepository $peminjam;

    public function __construct(anggotarepository $repository, peminjamrepository $peminjam)
    {

        $this->repository = $repository;
        $this->peminjam = $peminjam;
        
    }

    public function menampilkan():anggota
    {


        return $this->repository->menampilkan();

    }

    public function menambah(anggota $anggota):void
    {

        try{

            $this->repository->menambah($anggota);

        }catch(Exception $ex){

            throw $ex;

        }
    }

    private function validatemenambah(anggota $anggota):void
    {

        $nik = $this->repository->ambilnik($anggota->nik)->semua;

        if(

            $anggota->nama == "" ||
            $anggota->alamat == "" ||
            $anggota->nik == "" ||
            !is_null($nik)

        ){

            throw new ValidationException("Data ada yang kosong / nik duplikat");

        }
    }

    public function menghapus(string $id_anggota):void
    {

        $this->validatemenghapus($id_anggota);

        try{

            $this->repository->menghapus($id_anggota);

        }catch(Exception $ex){

            throw $ex;

        }
        
    }

    private function validatemenghapus(string $id_anggota):void
    {
        $anggota = $this->peminjam->ambilanggota($id_anggota);
        $anggota = $anggota->semua;

        if(!empty($anggota)){

            throw new ValidationException("maaf, anggota ini lagi meminjam buku");
        }

        if($id_anggota == ""){

            throw new ValidationException("id buku tidak boleh kosong");

        }
    }

    public function mengedit(anggota $anggota):void
    {
       
        $this->validamengedit($anggota);

        try{


            $this->repository->mengedit($anggota);

        }catch(Exception $ex){

            throw $ex;
            
        }

    }

    private function validamengedit(anggota $anggota):void
    {

        if(

            $anggota->id_anggota == "" ||
            $anggota->nama == "" ||
            $anggota->alamat == "" ||
            $anggota->nik == ""

        ){

            throw new ValidationException("tidak ada yang boleh kosong");

        }

    }

    public function mengambil(string $id_anggota):anggota
    {

        $this->validatemengambil($id_anggota);

        try{

            $anggota = $this->repository->ambil($id_anggota);
            $semua = $anggota->semua;

            foreach($semua as $bagi){

                $anggota->id_anggota = $bagi['id_anggota'];
                $anggota->nama = $bagi['nama'];
                $anggota->alamat = $bagi['alamat'];
                $anggota->nik = $bagi['nik'];

            }

            return $anggota;

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