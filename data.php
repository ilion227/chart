<?php
/**
 * Created by PhpStorm.
 * User: janli
 * Date: 12/27/2015
 * Time: 18:16
 */

$db = new PDO("pgsql:host=localhost;dbname=spinner", "postgres", "root");

$query = $db->prepare("SELECT * FROM users WHERE match_id = '2' ORDER BY created_at DESC");

$query->execute();

$results = $query->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($results);