<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jamu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/home.css">    
</head>
<body>
    <header>
        <h1>Daftar Bahan Jamu</h1>
        <a href="/keranjang" class="cart-btn">
            <i class="bi bi-cart-fill"></i> Keranjang
        </a>
    </header>

    <div class="container">
        <?php foreach ($bahan as $b): ?>
            <div class="bahan-card">
                <h2><?= htmlspecialchars($b['nama']); ?></h2>
                <p><?= htmlspecialchars($b['deskripsi']); ?></p>
                <p><strong>Harga:</strong> Rp <?= number_format($b['harga'], 0, ',', '.'); ?></p>
                <p><strong>Jenis:</strong> <?= htmlspecialchars($b['jenis']); ?></p>
                <form action="/keranjang/tambah" method="POST">
                    <input type="hidden" name="bahan_id" value="<?= $b['id']; ?>">
                    <label for="porsi">Porsi:</label>
                    <input type="number" name="porsi" id="porsi" value="1" min="1">
                    <button type="submit">
                        <i class="bi bi-plus-circle"></i> Tambah
                    </button>
                </form>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>
