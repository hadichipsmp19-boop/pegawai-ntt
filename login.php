<?php
session_start();
include 'config/db.php';

if (isset($_POST['login'])) {
    $username = $_POST['nip'];
    $password = $_POST['password'];

    $query_check = "SELECT * FROM users WHERE nip = '$username' AND password = '$password'";
    $run_query_check = mysqli_query($conn, $query_check);
    $hasil = mysqli_fetch_object($run_query_check);

    if ($hasil) {
        $_SESSION['logged_in'] = true;
        $_SESSION['uid'] = $hasil->id;
        $_SESSION['uname'] = $hasil->name;
        $_SESSION['urole'] = $hasil->role;
        header("Location: index.php");
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <link rel="icon" href="Gambar/TVRINTTicon.png">
  <title>Kepegawaian TVRI NTT</title>

  <style>
    /* Reset dan Box-sizing */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      background: url("Gambar/KantorTVRINTT.jpg") no-repeat center center/cover;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      font-family: Tahoma, sans-serif;
      color: #333;
    }

    .container {
      width: 90%;
      max-width: 400px;
    }

    .box {
      background: rgba(255, 255, 255, 0.8);
      border-radius: 12px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.2);
      overflow: hidden;
      width: 100%;
    }

    .box-header {
      padding: 20px;
      text-align: center;
      font-size: 1.5rem;
      font-weight: bold;
      color: #01356d;
    }

    .box-content {
      padding: 20px;
    }

    .form-group {
      margin-bottom: 15px;
    }

    .form-group input {
      width: 100%;
      padding: 12px;
      border: 1px solid #ccc;
      border-radius: 6px;
      font-size: 1rem;
      outline: none;
      display: block;
    }

    .form-group input:focus {
      border-color: #01356d;
      box-shadow: 0 0 5px rgba(1, 53, 109, 0.3);
    }

    .btn {
      font-weight: 600;
      padding: 12px;
      width: 100%;
      background: #01356d;
      border: none;
      border-radius: 6px;
      color: white;
      cursor: pointer;
      transition: 0.3s;
      font-size: 1rem;
    }

    .btn:hover {
      background: orange;
      color: black;
    }

    p {
      margin-top: 15px;
      text-align: center;
      font-size: 0.9rem;
      color: white;
      text-shadow: 0 1px 3px rgba(0,0,0,0.6);
    }

    /* Responsif */
    @media (max-width: 768px) {
      .box-header { font-size: 1.3rem; }
      .btn { font-size: 0.95rem; }
    }

    @media (max-width: 480px) {
      .container { max-width: 95%; }
      .box-header { font-size: 1.2rem; }
      .form-group input { font-size: 0.95rem; padding: 10px; }
      .btn { font-size: 0.9rem; padding: 10px; }
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="box">
      <div class="box-header">Login</div>
      <div class="box-content">
        <form action="" method="post">
          <div class="form-group">
            <input type="text" name="nip" placeholder="Masukkan ID" required>
          </div>
          <div class="form-group">
            <input type="password" name="password" placeholder="Kata Sandi" required>
          </div>
          <button type="submit" name="login" class="btn">MASUK</button>
        </form>
      </div>
    </div>
    <p>Kepegawaian TVRI NTT<br>&copy; 2025 by Hary Aldi Prakoso</p>
  </div>
</body>
</html>
