<?php

namespace perpustakaan\domain;

class peminjam{
    
    public ?string $id_peminjam = null;
    public ?array $semua = [];
    public ?string $id_anggota = null;
    public ?string $id_buku = null;
    public ?string $waktu_pengembalian = null;
    public ?string $status = null;

}