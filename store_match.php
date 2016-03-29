<?php
/**
 * Created by PhpStorm.
 * User: janli
 * Date: 12/28/2015
 * Time: 22:12
 */

if(isset($_POST['price'])) {

    $db = new PDO("pgsql:host=localhost;dbname=spinner", "postgres", "root");

    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, TRUE);
    $query = $db->prepare("INSERT INTO matches (price, winner, created) VALUES ( :price, :winner, NOW())");
    $query->execute([
        'price' => $_POST['price'],
        'winner' => $_POST['winner'],
    ]);

    $last_id = $db->lastInsertId();

    echo json_encode($last_id);
}
