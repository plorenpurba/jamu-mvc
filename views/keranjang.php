<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang</title>
</head>
<body>
    <h1>Keranjangmu</h1>
    <?php if (empty($keranjang)): ?>
        <h2>Keranjang Kosong</h2>
    <?php else: ?>
        <h2>Keranjang Belanja</h2>
        <table border="1">
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
                        <td><?php echo htmlspecialchars($item['nama']); ?></td>
                        <td>Rp <?php echo number_format($item['harga'], 0, ',', '.'); ?></td>
                        <td><?php echo htmlspecialchars($item['porsi']); ?></td>
                        <td>Rp <?php echo number_format($item['total_harga'], 0, ',', '.'); ?></td>
                        <td>
                            <form action="/keranjang/update/<?php echo $item['keranjang_id']; ?>" method="POST" style="display:inline;">
                                <input type="hidden" name="action" value="minus">
                                <button type="submit">-</button>
                            </form>
                            <?php echo htmlspecialchars($item['porsi']); ?>
                            <form action="/keranjang/update/<?php echo $item['keranjang_id']; ?>" method="POST" style="display:inline;">
                                <input type="hidden" name="action" value="plus">
                                <button type="submit">+</button>
                            </form>
                        </td>

                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <h3>Total Keseluruhan: 
            Rp <?php 
                $total = array_sum(array_column($keranjang, 'total_harga'));
                echo number_format($total, 0, ',', '.'); 
            ?>
        </h3>   
        <?php endif; ?>

        <form action="/keranjang/bayar" method="POST">
            <button type="submit">Bayar</button>
        </form>

</body>
</html>