<?php

namespace perpustakaan\Repository;

use Exception;
use PDO;
use perpustakaan\domain\anggota;
use perpustakaan\Config\Database;
use perpustakaan\Exception\ValidationException;

class anggotarepository{

    private PDO $database;

    public function __construct(PDO $database)
    {
        $this->database = $database;
    }

    public function menampilkan():anggota
    {
        $statement = $this->database->prepare("select * from anggota");
        $statement->execute();
        $response = $statement->fetchAll(PDO::FETCH_ASSOC);
        
        $anggota = new anggota();
        $anggota->semua = $response;
        return $anggota;
        
    }

    public function menambah(anggota $anggota):void
    {

        try{

            $statement = $this->database->prepare("INSERT INTO anggota(nama, alamat, nik) VALUES (?, ?, ?)");
            $statement->execute([
            $anggota->nama, $anggota->alamat, $anggota->nik
            ]);

        }catch(Exception $ex){

            throw $ex;
            
        }

        
        
    }

    public function menghapus(string $id_anggota)
    {

        try{

            $statement = $this->database->prepare("DELETE FROM anggota WHERE id_anggota = ?");
            $statement->execute([$id_anggota]);

        }catch(Exception $ex){

            throw $ex;

        }

    }

    public function mengedit(anggota $anggota):void
    {
        

        try{

            $statement = $this->database->prepare("UPDATE anggota SET nama = ?, alamat = ?, nik = ? WHERE id_anggota = ?");
            $statement->execute([$anggota->nama, $anggota->alamat, $anggota->nik, $anggota->id_anggota]);

        }catch(Exception $ex){

            throw $ex;

        }
        
    }

    public function ambil(string $id_anggota):anggota
    {

        try{

            $statement = $this->database->prepare("SELECT * FROM anggota WHERE id_anggota = ?");
            $statement->execute([$id_anggota]);
            $response = $statement->fetchAll(PDO::FETCH_ASSOC);

            $buku = new anggota();
            $buku->semua = $response;

            return $buku;

        }catch(Exception $ex){

            throw $ex;

        }
    }

    public function ambilnik(string $nik):anggota
    {

        try{

            $statement = $this->database->prepare("SELECT * FROM anggota WHERE nik = ?");
            $statement->execute([$nik]);
            $response = $statement->fetchAll(PDO::FETCH_ASSOC);

            $buku = new anggota();
            $buku->semua = $response;

            return $buku;

        }catch(Exception $ex){

            throw $ex;

        }
    }
    

}