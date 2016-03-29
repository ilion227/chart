<?php
/**
 * Created by PhpStorm.
 * User: janli
 * Date: 12/27/2015
 * Time: 21:39
 */

if(isset($_POST['price'])) {

    $db = new PDO("pgsql:host=localhost;dbname=spinner", "postgres", "root");

    $query = $db->prepare("INSERT INTO users (match_id, price, color, label, created_at) VALUES (:match_id, :price, :color, :label, NOW())");
    $query->execute([
        'match_id' => 1,
        'price' => $_POST['price'],
        'color' => $_POST['color'],
        'label' => $_POST['label']
    ]);
}
