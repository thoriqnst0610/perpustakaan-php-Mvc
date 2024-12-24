<?php

require_once __DIR__ . '/../vendor/autoload.php';

use perpustakaan\App\Router;
use perpustakaan\Config\Database;
use perpustakaan\Controller\admincontroller;
use perpustakaan\Controller\bukucontroller;
use perpustakaan\Controller\anggotacontroller;
use perpustakaan\Controller\peminjamcontroller;
use perpustakaan\Controller\dendacontroller;
use perpustakaan\Controller\HomeController;
use perpustakaan\Controller\laporancontroller;
use perpustakaan\Controller\UserController;
use perpustakaan\domain\anggota;
use perpustakaan\domain\denda;
use perpustakaan\domain\peminjam;
use perpustakaan\Middleware\MustLoginMiddleware;
use perpustakaan\Middleware\MustNotLoginMiddleware;

Database::getConnection('prod');

Router::add('GET', '/', HomeController::class, 'index', [MustNotLoginMiddleware::class]);

// User Controller
Router::add('GET', '/users/register', UserController::class, 'register', [MustNotLoginMiddleware::class]);
Router::add('POST', '/users/register', UserController::class, 'postRegister', [MustNotLoginMiddleware::class]);
Router::add('GET', '/users/login', UserController::class, 'login', [MustNotLoginMiddleware::class]);
Router::add('POST', '/users/login', UserController::class, 'postLogin', [MustNotLoginMiddleware::class]);
Router::add('GET', '/users/logout', UserController::class, 'logout', [MustLoginMiddleware::class]);

// Buku Controller
Router::add('GET', '/buku/menampilkan', bukucontroller::class, 'menampilkan', [MustLoginMiddleware::class]);
Router::add('GET', '/buku/menambah', bukucontroller::class, 'menambah', [MustLoginMiddleware::class]);
Router::add('POST', '/buku/menambah', bukucontroller::class, 'postmenambah', [MustLoginMiddleware::class]);
Router::add('GET', '/buku/menghapus', bukucontroller::class, 'menghapus', [MustLoginMiddleware::class]);
Router::add('GET', '/buku/mengedit', bukucontroller::class, 'mengedit', [MustLoginMiddleware::class]);
Router::add('POST', '/buku/mengedit', bukucontroller::class, 'postmengedit', [MustLoginMiddleware::class]);

//Anggota Controller
Router::add('GET', '/anggota/menampilkan', anggotacontroller::class, 'menampilkan', [MustLoginMiddleware::class]);
Router::add('GET', '/anggota/menambah', anggotacontroller::class, 'menambah', [MustLoginMiddleware::class]);
Router::add('POST', '/anggota/menambah', anggotacontroller::class, 'postmenambah', [MustLoginMiddleware::class]);
Router::add('GET', '/anggota/menghapus', anggotacontroller::class, 'menghapus', [MustLoginMiddleware::class]);
Router::add('GET', '/anggota/mengedit', anggotacontroller::class, 'mengedit', [MustLoginMiddleware::class]);
Router::add('POST', '/anggota/mengedit', anggotacontroller::class, 'postmengedit', [MustLoginMiddleware::class]);

//Peminjam Controller
Router::add('GET', '/peminjam/menambah', peminjamcontroller::class, 'menambah', [MustLoginMiddleware::class]);
Router::add('POST', '/peminjam/menambah', peminjamcontroller::class, 'postmenambah', [MustLoginMiddleware::class]);
Router::add('GET', '/peminjam/menampilkan', peminjamcontroller::class, 'ambil', [MustLoginMiddleware::class]);
Router::add('GET', '/peminjam/menghapus', peminjamcontroller::class, 'menghapus', [MustLoginMiddleware::class]);
Router::add('GET', '/peminjam/mengedit', peminjamcontroller::class, 'mengedit', [MustLoginMiddleware::class]);
Router::add('POST', '/peminjam/mengedit', peminjamcontroller::class, 'postmengedit', [MustLoginMiddleware::class]);
Router::add('GET', '/denda/menampilkan', dendacontroller::class, 'menampilkan', [MustLoginMiddleware::class]);
Router::add('GET', '/denda/menghapus', dendacontroller::class, 'menghapus', [MustLoginMiddleware::class]);

//laporan
Router::add('GET', '/laporan/mengambil', laporancontroller::class, 'mengambil', [MustLoginMiddleware::class]);
Router::add('GET', '/laporan/mencetak', laporancontroller::class, 'cetak', [MustLoginMiddleware::class]);


Router::run();