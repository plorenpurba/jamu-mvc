<?php

class Keranjang{
    private static function connect()
    {
        $db = new PDO("sqlite:" . __DIR__ . "/../database/database.db");
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $db;
    }

    public static function get()
    {
        $db = self::connect();
        $stmt = $db->query("
            SELECT 
                k.id AS keranjang_id,
                k.porsi,
                k.bahan_id,
                b.nama,
                b.harga,
                b.jenis,
                b.deskripsi,
                (b.harga * k.porsi) AS total_harga
            FROM keranjang k
            JOIN bahan b ON b.id = k.bahan_id
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function find($id)
    {
        $db = self::connect();
        $stmt = $db->prepare("SELECT * FROM keranjang WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function create($data)
    {
        $db = self::connect();
        $stmt = $db->prepare("INSERT INTO keranjang (bahan_id, porsi) VALUES (:bahan_id, :porsi)");
        $stmt->execute($data);
        $data['id'] = $db->lastInsertId();
        return $data;
    }

    public static function update($id, $data)
    {
        $db = self::connect();
        $data['id'] = $id;
        $stmt = $db->prepare("UPDATE keranjang SET bahan_id = :bahan_id, porsi = :porsi WHERE id = :id");
        $stmt->execute($data);
        return self::find($id);
    }

    public static function delete($id)
    {
        $db = self::connect();
        $stmt = $db->prepare("DELETE FROM keranjang WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->rowCount() > 0;
    }
    
    public static function hapusSemua()
    {
        $db = self::connect();
        $db->exec("DELETE FROM keranjang");
        return true;
    }
}