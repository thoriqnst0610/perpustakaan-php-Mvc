<?php

namespace perpustakaan\Service;

use DateTime;
use Exception;
use perpustakaan\domain\denda;
use perpustakaan\Exception\ValidationException;
use perpustakaan\Repository\dendarepository;

class dendaservice{

    private dendarepository $repository;

    public function __construct(dendarepository $repository)
    {
        $this->repository = $repository;
    }

    public function menyimpan(denda $denda):void
    {

        $this->validatemenyimpan($denda);

        try{

            $this->repository->menyimpan($denda);

        }catch(Exception $ex){

            throw $ex;

        }

    }

    private function validatemenyimpan(denda $denda)
    {


            if(

                $denda->id_peminjam == null ||
                $denda->waktu_pengembalian == null 

                ){

                    throw new ValidationException("tidak ada yang boleh kosong guys");

                }
                
    }

    public function ambil():denda
    {
        try{

            return $this->repository->ambil();

        }catch(Exception $ex){

            throw $ex;

        }
    }

    public function menghitung():denda
    {

        $denda = $this->ambil();
        $semua = $denda->semua;

        try{

            foreach($semua as $denda){

                $id_denda = $denda['id_denda'];
                $waktu_pengembalian = $denda['waktu_pengembalian'];

                $hari_ini = new DateTime();
    
                $ambil = DateTime::createFromFormat('Y-m-d H:i:s', $waktu_pengembalian);

                if ($ambil === false) {
                    $errors = DateTime::getLastErrors();
                    throw new Exception("Format tanggal tidak valid: $waktu_pengembalian. Kesalahan: " . implode(', ', $errors['errors']));
                }
                
                $hari_ini->setTime(0, 0, 0);
    
                $cek_hari = $ambil->diff($hari_ini);
                $selisih_hari =$cek_hari->days;

                if($ambil < $hari_ini){

                    if($selisih_hari > 1){
    
                        $hari = 5000;
        
                        $denda = $selisih_hari * $hari;
        
                        $request = new denda();
                        $request->id_denda = $id_denda;
                        $request->denda = $denda;
        
                        $this->mengedit($request);
        
                    }

                }
    
               
            }
    
            return $this->ambil();

        }catch(Exception $ex){

            throw $ex;
            
        }
        

    }

    public function mengedit(denda $denda):void
    {

        try{


            $this->repository->mengedit($denda);

        }catch(Exception $ex){

            throw $ex;
            
        }

    }

    function formatToRupiah($amount) {

        return 'Rp ' . number_format($amount, 0, ',', '.');
        
    }

    public function menghapus(string $id_denda):void
    {

        $this->validatemenghapus($id_denda);

        try{

            $this->repository->menghapus($id_denda);

        }catch(Exception $ex){

            throw $ex;

        }
        
    }

    private function validatemenghapus(string $id_denda):void
    {

        if($id_denda == ""){

            throw new ValidationException("id buku tidak boleh kosong");

        }
    }
    
}