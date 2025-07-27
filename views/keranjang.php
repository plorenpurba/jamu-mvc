<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/keranjang.css">
</head>
<body>
    <header>
        <h1>Keranjang Belanja</h1>
        <a href="/" class="cart-btn">
            <i class="bi bi-arrow-left"></i> Pilih Bahan
        </a>
    </header>

    <div class="container">
        <?php if (empty($keranjang)): ?>
            <div class="empty-cart">
                <p><i class="bi bi-cart-x" style="font-size: 40px;"></i></p>
                <h2>Keranjang Kosong</h2>
            </div>
        <?php else: ?>
            <table>
                <thead>
                    <tr>
                        <th>Nama Bahan</th>
                        <th>Harga</th>
                        <th>Porsi</th>
                        <th>Total Harga</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($keranjang as $item): ?>
                        <tr>
                            <td><?= htmlspecialchars($item['nama']); ?></td>
                            <td>Rp <?= number_format($item['harga'], 0, ',', '.'); ?></td>
                            <td><?= htmlspecialchars($item['porsi']); ?></td>
                            <td>Rp <?= number_format($item['total_harga'], 0, ',', '.'); ?></td>
                            <td>
                                <form action="/keranjang/update/<?= $item['keranjang_id']; ?>" method="POST" style="display:inline;">
                                    <input type="hidden" name="action" value="minus">
                                    <button type="submit" class="btn-action" 
                                    <?php echo ($item['porsi'] <= 1) ? 'onclick="return confirm(\'Hapus dari keranjang?\');"' : ''; ?>>
                                        <i class="bi bi-dash"></i>
                                    </button>
                                </form>
                                <?= htmlspecialchars($item['porsi']) ?>
                                <form action="/keranjang/update/<?= $item['keranjang_id']; ?>" method="POST" style="display:inline;">
                                    <input type="hidden" name="action" value="plus">
                                    <button type="submit" class="btn-action">
                                        <i class="bi bi-plus"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <h3 style="text-align:right; margin-top:15px;">
                Total: Rp <?php 
                    $total = array_sum(array_column($keranjang, 'total_harga'));
                    echo number_format($total, 0, ',', '.'); 
                ?>
            </h3>
            
            <?php if ($jumlahKeranjang > 0): ?>
                <form action="/keranjang/bayar" method="POST">
                    <button type="submit" class="btn-bayar" onclick="return confirm('Bayar?');">
                        <i class="bi bi-cash-coin"></i> Bayar Sekarang
                    </button>
                </form>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</body>
</html>
