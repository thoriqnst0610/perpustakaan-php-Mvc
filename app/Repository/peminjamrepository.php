<?php

namespace perpustakaan\Repository;

use Exception;
use PDO;
use perpustakaan\Config\Database;
use perpustakaan\domain\denda;
use perpustakaan\domain\peminjam;

class peminjamrepository{

    private PDO $database;

    public function __construct(PDO $database)
    {
        $this->database = $database;
    }

    public function menyimpan(peminjam $peminjam):int
    {
        try{

            $statement = $this->database->prepare("INSERT INTO peminjam(id_anggota, id_buku) VALUES (?, ?)");
            $statement->execute([
            $peminjam->id_anggota, $peminjam->id_buku
            
        ]);

        return $this->database->lastInsertId();

        }catch(Exception $ex){

            throw $ex;

        }
        
    }

    public function ambil(): peminjam
    {
      
        try{

            $statement = $this->database->prepare("select * from peminjam");
            $statement->execute();

            $peminjam = new peminjam();
            $peminjam->semua = $statement->fetchAll(PDO::FETCH_ASSOC);

            return $peminjam;

        }catch(Exception $ex){

            throw $ex;
            
        }
        
    }

    public function menghapus(string $id_peminjam)
    {

        try{

            $statement = $this->database->prepare("DELETE FROM peminjam WHERE id_peminjam = ?");
            $statement->execute([$id_peminjam]);

        }catch(Exception $ex){

            throw $ex;

        }

    }

    public function ambilbuku(string $id_buku):peminjam
    {

        try{

            $statement = $this->database->prepare("SELECT * FROM peminjam WHERE id_buku = ?");
            $statement->execute([$id_buku]);

            $buku = new peminjam();
            $request = $statement->fetchAll(PDO::FETCH_ASSOC);
            $buku->semua = $request;

            return $buku;
            

        }catch(Exception $ex){

            throw $ex;

        }

    }

    public function ambilanggota(string $id_anggota):peminjam
    {

        try{

            $statement = $this->database->prepare("SELECT * FROM peminjam WHERE id_anggota = ?");
            $statement->execute([$id_anggota]);

            $anggota = new peminjam();
            $request = $statement->fetchAll(PDO::FETCH_ASSOC);
            $anggota->semua = $request;

            return $anggota;
            

        }catch(Exception $ex){

            throw $ex;

        }

    }

    public function mengedit(peminjam $peminjam):void
    {
        

        try{

            $statement = $this->database->prepare("UPDATE peminjam SET id_anggota = ?, id_buku = ?, status = ? WHERE id_peminjam = ?");
            $statement->execute([$peminjam->id_anggota, $peminjam->id_buku, $peminjam->status, $peminjam->id_peminjam]);

        }catch(Exception $ex){

            throw $ex;

        }
        
    }

    public function mengambil(string $id_peminjam):peminjam
    {

        try{

            $statement = $this->database->prepare("SELECT * FROM peminjam WHERE id_peminjam = ?");
            $statement->execute([$id_peminjam]);
            $response = $statement->fetchAll(PDO::FETCH_ASSOC);

            $buku = new peminjam();
            $buku->semua = $response;

            return $buku;

        }catch(Exception $ex){

            throw $ex;

        }
    }
    
}