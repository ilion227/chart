<?php
/**
 * Created by PhpStorm.
 * User: janli
 * Date: 12/27/2015
 * Time: 22:04
 */

if(isset($_GET['id'])) {

    $db = new PDO("pgsql:host=localhost;dbname=spinner", "postgres", "root");

    $query = $db->prepare("DELETE FROM users WHERE user_id = :id");
    $query->execute([
        'id' => $_GET['id']
    ]);
}