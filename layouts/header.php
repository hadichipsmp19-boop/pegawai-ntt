<?php
    session_start();
    include 'config/db.php';

    if(!isset($_SESSION['logged_in'])){
        header("Location: login.php");
        exit();
    }

    if(isset($_GET['logout'])){
        session_destroy();
        header("Location: login.php");
        exit();
    }
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="Gambar/TVRINTTicon.png">
    <title>Kepegawaian TVRI NTT</title>
    <style>
        /* Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f5f6fa;
        }

        /* Navbar */
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: #01356d;
            padding: 10px 50px;
            position: sticky;
            top: 0;
            z-index: 999;
        }

        .navbar a img {
            height: 40px;
        }

        .navbar ul {
            list-style: none;
            display: flex;
            gap: 0px;
        }

        .navbar ul li {
            position: relative;
        }

        .navbar ul li a {
            color: #fff;
            text-decoration: none;
            font-weight: bold;
            transition: color 0.3s;
            padding: 10px;
            display: block;
        }

        .navbar ul li a:hover {
            color: orange;
        }

        /* Dropdown umum */
        .dropdown {
            position: relative;
        }

        .dropdown ul {
            display: none;
        }

        .isi-dropdown {
            position: absolute;
            top: 100%;
            left: 0;
            background: #01356de2;
            border-radius: 6px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            display: none;
            flex-direction: column;
            min-width: 200px;
            z-index: 1000;
        }

        .isi-dropdown li a {
            color: #333;
            padding: 10px 15px;
            text-decoration: none;
            transition: background 0.3s;
        }

        .isi-dropdown li a:hover {
            background: white;
            border-radius: 2px;
        }

        /* Desktop: dropdown hanya tampil saat hover */
        @media (min-width: 769px) {
            .dropdown:hover .isi-dropdown {
                display: flex;
            }
        }

        /* Hamburger */
        .hamburger {
            display: none;
            flex-direction: column;
            cursor: pointer;
            gap: 5px;
        }

        .hamburger span {
            width: 25px;
            height: 3px;
            background: #fff;
            border-radius: 2px;
        }

        /* Tablet & Smartphone */
        @media (max-width: 768px) {
            .navbar {
                padding: 10px 20px;
            }

            .navbar ul {
                position: absolute;
                top: 60px;
                left: 0;
                width: 100%;
                flex-direction: column;
                background: #0b3d91;
                display: none;
                gap : 20px;
            }

            .navbar ul.show {
                display: flex;
            }

            .navbar ul li {
                width: 100%;
            }

            .navbar ul li a {
                padding: 12px 20px;
                border-bottom: 1px solid rgba(255,255,255,0.2);
            }

            /* Hilangkan efek hover di mobile */
            .dropdown:hover .isi-dropdown {
                display: none !important;
            }


            .isi-dropdown li a {
                color: #fff;
                padding: 10px 20px;
                border-bottom: 1px solid rgba(255,255,255,0.1);
            }

            /* Dropdown aktif hanya saat diklik */
            .dropdown.active .isi-dropdown {
                display: flex;
            }

            .hamburger {
                display: flex;
            }
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <a href="index.php">
            <img src="Gambar/TVRILogoInv.png" alt="Logo Perusahaan">
        </a>

        <div class="hamburger" onclick="toggleMenu()">
            <span></span>
            <span></span>
            <span></span>
        </div>

        <ul id="menu">
            <li><a href="index.php">Beranda</a></li>
            <li class="dropdown">
                <a style="margin : -2px;" href="javascript:void(0)" onclick="toggleDropdown(this)">Profil Pegawai ▾</a>
                <ul class="isi-dropdown">
                    <li><a href="informasi-pegawai.php">▸ Informasi Pegawai</a></li>
                    <li><a href="profil-pegawai.php">▸ Dokumen Pegawai</a></li>
                </ul>
            </li>
            <?php if($_SESSION['urole'] == 'admin'): ?>
                <li><a href="data-pegawai.php">Data Pegawai</a></li>
                <li><a href="users.php">Data Admin/User</a></li>
            <?php endif ?>
            <li><a href="?logout">Logout</a></li>
        </ul>
    </nav>

    <script>
        function toggleMenu() {
            document.getElementById("menu").classList.toggle("show");
        }

        function toggleDropdown(el) {
            if (window.innerWidth <= 768) { // hanya untuk tablet & smartphone
                const parent = el.parentElement;
                parent.classList.toggle("active");

                // tutup dropdown lain kalau ada
                document.querySelectorAll(".dropdown").forEach(function(drop) {
                    if (drop !== parent) {
                        drop.classList.remove("active");
                    }
                });
            }
        }
    </script>
</body>
</html>
