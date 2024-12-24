<?php

namespace perpustakaan\Repository;

use Exception;
use PDO;
use perpustakaan\Config\Database;
use perpustakaan\Domain\buku;

class bukurepository{

    private PDO $database;

    public function __construct(PDO $database)
    {
        $this->database = $database;
    }

    public function menampilkan():buku
    {
        $statement = $this->database->prepare("select * from buku");
        $statement->execute();
        $response = $statement->fetchAll(PDO::FETCH_ASSOC);
        
        $buku = new buku();
        $buku->semua = $response;
        return $buku;
        
    }

    public function menambah(buku $buku):void
    {

        $statement = $this->database->prepare("INSERT INTO buku(nama_buku, pengarang, penerbit, tahun_terbit) VALUES (?, ?, ?,?)");
        $statement->execute([
            $buku->nama_buku, $buku->pengarang, $buku->penerbit, $buku->tahun_terbit
        ]);
        
    }

    public function menghapus(string $id_buku)
    {

        try{

            $statement = $this->database->prepare("DELETE FROM buku WHERE id_buku = ?");
            $statement->execute([$id_buku]);

        }catch(Exception $ex){

            throw $ex;

        }

    }

    public function mengedit(buku $buku):void
    {
        

        try{

            $statement = $this->database->prepare("UPDATE buku SET nama_buku = ?, pengarang = ?, penerbit = ?, tahun_terbit = ? WHERE id_buku = ?");
            $statement->execute([$buku->nama_buku, $buku->pengarang, $buku->penerbit, $buku->tahun_terbit, $buku->id_buku]);

        }catch(Exception $ex){

            throw $ex;

        }
        
    }

    public function ambil(string $id_buku):buku
    {

        try{

            $statement = $this->database->prepare("SELECT * FROM buku WHERE id_buku = ?");
            $statement->execute([$id_buku]);
            $response = $statement->fetchAll(PDO::FETCH_ASSOC);

            $buku = new buku();
            $buku->semua = $response;

            return $buku;

        }catch(Exception $ex){

            throw $ex;

        }
    }


}