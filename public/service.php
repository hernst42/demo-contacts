<?php
/**
 * definition of
 *
 * @version    $Id$
 */

require_once __DIR__ . '/../bootstrap.php';

$respository = new hernst42\orm\ContactRepository(new \PDO('mysql:host=localhost;dbname=hernst_demo', 'hernst', 'hernst'));
$conditions  = [];
if (!empty($_REQUEST['disable'])) {
    $respository->disable($_REQUEST['disable']);
}
if (!empty($_REQUEST['enable'])) {
    $respository->enable($_REQUEST['enable']);
}
if (!empty($_REQUEST['search'])) {
    $conditions = $_REQUEST['search'];
}

$result = $respository->findByConditions($conditions);
header('Content-Type: text/json');
echo json_encode($result);
