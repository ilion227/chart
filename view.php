<?php
/**
 * Created by PhpStorm.
 * User: janli
 * Date: 12/27/2015
 * Time: 22:54
 */

if(isset($_GET['id'])) {
    $db = new PDO("pgsql:host=localhost;dbname=spinner", "postgres", "root");

    $query = $db->prepare("SELECT * FROM users WHERE user_id = :id");

    $query->execute([
        'id' => $_GET['id']
    ]);

    $results = $query->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($results);
}
