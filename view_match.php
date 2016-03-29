<?php
/**
 * Created by PhpStorm.
 * User: janli
 * Date: 12/28/2015
 * Time: 22:50
 */

if(isset($_GET['match_id'])) {
    $db = new PDO("pgsql:host=localhost;dbname=spinner", "postgres", "root");

    $query = $db->prepare("SELECT *
                           FROM matches m
                           LEFT JOIN users u
                           ON m.id = u.match_id
                           WHERE m.id = :match_id");

    $query->execute([
        'match_id' => $_GET['match_id']
    ]);

    $results = $query->fetchAll(PDO::FETCH_ASSOC);

    //echo json_encode($results, JSON_PRETTY_PRINT);
}

?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Document</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    </head>
    <body>
        <?php if(isset($_GET['match_id'])): ?>
            <?php echo "<h1>Match # " . $_GET['match_id'] . "</h1>" ?>
            <table class="table">
                <thead>
                    <th>Match ID</th>
                    <th>User ID</th>
                    <th>Price</th>
                    <th>Tickets</th>
                    <th>Percentage</th>
                    <th>Color</th>
                    <th>Label</th>
                </thead>
                <?php foreach( $results as $result): ?>
                    <tr>
                        <td><?= $result['match_id'] ?></td>
                        <td><?= $result['user_id'] ?></td>
                        <td><?= $result['price'] ?></td>
                        <td><?= $result['tickets'] ?></td>
                        <td><?= $result['percentage'] ?></td>
                        <td><?= $result['color'] ?></td>
                        <td><?= $result['label'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>

        <?php endif; ?>

    </body>
</html>
