<?php

// API endpoint
$apiUrl = 'https://api.example.com/data';

// Veritabanı bilgileri
$dbHost = 'localhost';
$dbName = 'database_name';
$dbUser = 'username';
$dbPass = 'password';

try {
    // Veritabanı bağlantısı oluşturma
    $db = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUser, $dbPass);
    
    // API'den veriyi alma
    $data = file_get_contents($apiUrl);
    
    // Veriyi JSON formatından diziye dönüştürme
    $dataArray = json_decode($data, true);
    
    // Veriyi veritabanına kaydetme
    foreach ($dataArray as $item) {
        $stmt = $db->prepare("INSERT INTO table_name (column1, column2) VALUES (:value1, :value2)");
        $stmt->bindParam(':value1', $item['value1']);
        $stmt->bindParam(':value2', $item['value2']);
        $stmt->execute();
    }
    
    echo 'Veri başarıyla alındı ve veritabanına kaydedildi.';
} catch (PDOException $e) {
    echo 'Hata: ' . $e->getMessage();
}
?>
