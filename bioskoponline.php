<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];
    $film = $_POST['film'];
    $jumlah = $_POST['jumlah'];

    if ($film == "avengers") {
        $harga = 50000;
        $judul = "Avengers: Endgame";
    } elseif ($film == "spiderman") {
        $harga = 45000;
        $judul = "Spider-Man: No Way Home";
    } elseif ($film == "interstellar") {
        $harga = 55000;
        $judul = "Interstellar";
    } elseif ($film == "joker") {
        $harga = 40000;
        $judul = "Joker";
    } else {
        $harga = 0;
        $judul = "Tidak Diketahui";
    }

    $total = $harga * $jumlah;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Sistem Pembelian Tiket Bioskop</title>
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(135deg, #1b2735 0%, #090a0f 100%);
      color: #fff;
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      margin: 0;
    }

    .card {
      background: rgba(255, 255, 255, 0.1);
      padding: 30px;
      border-radius: 20px;
      box-shadow: 0 4px 20px rgba(0,0,0,0.4);
      width: 380px;
      backdrop-filter: blur(10px);
      animation: fadeIn 0.8s ease;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }

    h2 {
      text-align: center;
      margin-bottom: 20px;
      color: #00ffe0;
    }

    label {
      display: block;
      margin: 10px 0 5px;
      font-weight: bold;
    }

    select, input {
      width: 100%;
      padding: 10px;
      border: none;
      border-radius: 10px;
      background: rgba(255, 255, 255, 0.2);
      color: #fff;
      outline: none;
    }

    button {
      margin-top: 20px;
      width: 100%;
      background: #00ffe0;
      color: #000;
      border: none;
      padding: 12px;
      font-weight: bold;
      border-radius: 10px;
      cursor: pointer;
      transition: 0.3s;
    }

    button:hover {
      background: #00b8a3;
      transform: translateY(-2px);
    }

    option {
      color: #000;
    }

    .hasil {
      text-align: center;
    }

    .hasil p {
      margin: 8px 0;
      font-size: 16px;
    }

    .back-btn {
      margin-top: 20px;
      background: #00ffae;
      border: none;
      padding: 10px 20px;
      color: #000;
      border-radius: 10px;
      cursor: pointer;
      transition: 0.3s;
      text-decoration: none;
      font-weight: bold;
      display: inline-block;
    }

    .back-btn:hover {
      background: #00b387;
    }
  </style>
</head>
<body>
  <div class="card" id="form-section" style="<?= isset($total) ? 'display:none;' : '' ?>">
      <h2>Pemesanan Tiket Bioskop</h2>
      <form method="post">
        <label for="nama">Nama Pemesan:</label>
        <input type="text" name="nama" required>

        <label for="film">Pilih Film:</label>
        <select name="film" required>
          <option value="">-- Pilih Film --</option>
          <option value="avengers">Avengers: Endgame</option>
          <option value="spiderman">Spider-Man: No Way Home</option>
          <option value="interstellar">Interstellar</option>
          <option value="joker">Joker</option>
        </select>

        <label for="jumlah">Jumlah Tiket:</label>
        <input type="number" name="jumlah" min="1" required>

        <button type="submit">Pesan Sekarang</button>
      </form>
  </div>

  <?php if (isset($total)) : ?>
  <div class="card" id="result-section">
      <h2>Detail Pemesanan</h2>
      <div class="hasil">
        <p><strong>Nama:</strong> <?= htmlspecialchars($nama) ?></p>
        <p><strong>Film:</strong> <?= $judul ?></p>
        <p><strong>Harga per Tiket:</strong> Rp <?= number_format($harga, 0, ',', '.') ?></p>
        <p><strong>Jumlah Tiket:</strong> <?= $jumlah ?></p>
        <p><strong>Total Bayar:</strong> Rp <?= number_format($total, 0, ',', '.') ?></p>

        <?php
        if ($total >= 200000) {
            echo "<p style='color:#00ffae;'>🎉 Kamu dapat cashback Rp 20.000!</p>";
        } elseif ($total >= 100000) {
            echo "<p style='color:#ffd700;'>🍿 Kamu dapat snack gratis!</p>";
        } else {
            echo "<p style='color:#ff6363;'>😅 Tidak ada bonus, beli lagi ya!</p>";
        }
        ?>

        <button class="back-btn" onclick="goBack()">Kembali</button>
      </div>
  </div>
  <?php endif; ?>

  <script>
    
    function goBack() {
      document.getElementById('result-section').style.display = 'none';
      document.getElementById('form-section').style.display = 'block';
    }
  </script>
</body>
</html>
