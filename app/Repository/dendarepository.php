<?php

namespace perpustakaan\Repository;

use Exception;
use PDO;
use perpustakaan\domain\denda;
use perpustakaan\domain\peminjam;

class dendarepository{
    
    private PDO $database;

    public function __construct(PDO $database)
    {
        $this->database = $database;
    }

    public function menyimpan(denda $denda):void
    {
        try{

            $statement = $this->database->prepare("INSERT INTO denda(id_peminjam, denda, waktu_pengembalian) VALUES (?, ?, ?)");
            $statement->execute([
            $denda->id_peminjam, $denda->denda, $denda->waktu_pengembalian
        ]);

        }catch(Exception $ex){

            throw $ex;

        }
    }

    public function mengedit(denda $denda):void
    {
        

        try{

            $statement = $this->database->prepare("UPDATE denda SET denda = ? WHERE id_denda = ?");
            $statement->execute([$denda->denda, $denda->id_denda]);

        }catch(Exception $ex){

            throw $ex;

        }
        
    }

    public function ambil(): denda
    {
      
        try{

            $statement = $this->database->prepare("select * from denda");
            $statement->execute();

            $denda = new denda();
            $denda->semua = $statement->fetchAll(PDO::FETCH_ASSOC);

            return $denda;

        }catch(Exception $ex){

            throw $ex;
            
        }
        
    }

    public function menghapus(string $id_denda)
    {

        try{

            $statement = $this->database->prepare("DELETE FROM denda WHERE id_denda = ?");
            $statement->execute([$id_denda]);

        }catch(Exception $ex){

            throw $ex;

        }

    }

    public function ambilpeminjam(string $id_peminjam):peminjam
    {

        try{

            $statement = $this->database->prepare("SELECT * FROM denda WHERE id_peminjam = ?");
            $statement->execute([$id_peminjam]);

            $peminjam = new peminjam();
            $request = $statement->fetchAll(PDO::FETCH_ASSOC);
            $peminjam->semua = $request;

            return $peminjam;
            

        }catch(Exception $ex){

            throw $ex;

        }

    }
    
}