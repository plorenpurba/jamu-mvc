<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jamu</title>
</head>
<body>
    <?php foreach ($bahan as $b): ?>
        <div class="bahan-b">
            <h2><?php echo htmlspecialchars($b['nama']); ?></h2>
            <p><?php echo htmlspecialchars($b['deskripsi']); ?></p>
            <p>Harga: Rp <?php echo number_format($b['harga'], 0, ',', '.'); ?></p>
            <p>Jenis: <?php echo htmlspecialchars($b['jenis']); ?></p>
            <form action="/keranjang/tambah" method="POST">
                <input type="hidden" name="bahan_id" value="<?php echo $b['id']; ?>">
                <label for="porsi">Porsi:</label>
                <input type="number" name="porsi" id="porsi" value="1" min="1">
                <button type="submit">Tambah ke Keranjang</button>
            </form>
        </div>
    <?php endforeach; ?>
</body>
</html>