<?php

namespace perpustakaan\domain;

class denda{

    public ?array $semua = [];

    public ?string $id_denda = null;
    public ?string $id_peminjam = null;
    public ?int $denda = 0;
    public ?string $waktu_pengembalian = null;

}