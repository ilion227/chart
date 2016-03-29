<?php
/**
 * Created by PhpStorm.
 * User: janli
 * Date: 12/27/2015
 * Time: 22:36
 */

if(isset($_POST['id'])) {

    $db = new PDO("pgsql:host=localhost;dbname=spinner", "postgres", "root");

    $query = $db->prepare("UPDATE users SET price = :value, color = :color, label = :label WHERE user_id = :id ");
    $query->execute([
        'price' => $_POST['price'],
        'color' => $_POST['color'],
        'label' => $_POST['label'],
        'id' => $_POST['id']
    ]);
}