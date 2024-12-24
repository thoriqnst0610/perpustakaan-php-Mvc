<?php

namespace perpustakaan\Repository;

use PDO;
use perpustakaan\domain\anggota;

class laporanrepository{

    private PDO $database;

    public function __construct(PDO $database)
    {
        $this->database = $database;
    }

    public function FindAll() : array|anggota
    {
        $statement = $this->database->prepare("SELECT
        a.nama AS nama_anggota,
        a.alamat AS alamat_anggota,
        a.nik,
        b.nama_buku,
        p.status AS status_peminjaman,
        d.denda
        FROM
        peminjam p
        JOIN
        anggota a ON p.id_anggota = a.id_anggota
        JOIN
        buku b ON p.id_buku = b.id_buku
        LEFT JOIN
        denda d ON p.id_peminjam = d.id_peminjam;
    ");

        $statement->execute([]);

        try{

            if($row = $statement->fetchAll(PDO::FETCH_ASSOC)){

                $response = new anggota();
                $response->semua = $row;

                return $response;

            }
            else{

                $row = $statement->fetchAll(PDO::FETCH_ASSOC);

                $response = new anggota();
                $response->semua = $row;

                return $response;

            }

        }finally{

            $statement->closeCursor();

        }
        
    }
    
}