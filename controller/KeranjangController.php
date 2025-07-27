<?php


require_once __DIR__ . '/../model/Keranjang.php';
require_once __DIR__ . '/../model/Bahan.php';

class KeranjangController {
    
    public function index() {
        $keranjang = Keranjang::get();
        $jumlahKeranjang = count($keranjang);
        include __DIR__ . '/../views/keranjang.php';
    }

    public function tambah() {
        $data = [
            'bahan_id' => $_POST['bahan_id'],
            'porsi' => $_POST['porsi']
        ];
        Keranjang::create($data);
        header("Location: /");
        exit();
    }

    public function bayar() {
        Keranjang::hapusSemua();
        header("Location: /keranjang");
        exit();
    }

    public function updatePorsi($id) {
        $action = $_POST['action'];
        $item = Keranjang::find($id);
        if (!$item) {
            header("Location: /keranjang");
            exit();
        }

        if ($action === 'plus') {
            $newPorsi = $item['porsi'] + 1;
            Keranjang::update($id, ['bahan_id' => $item['bahan_id'], 'porsi' => $newPorsi]);
        } elseif ($action === 'minus') {
            $newPorsi = $item['porsi'] - 1;
            if ($newPorsi <= 0) {
                Keranjang::delete($id);
            } else {
                Keranjang::update($id, ['bahan_id' => $item['bahan_id'], 'porsi' => $newPorsi]);
            }
        }

        header("Location: /keranjang");
        exit();
    }


}