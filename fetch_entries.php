<?php
require_once 'config.php';

$stmt = $db->query("SELECT entries.*, users.username FROM entries JOIN users ON entries.user_id = users.id ORDER BY entries.id DESC");
$entries = $stmt->fetchAll(PDO::FETCH_ASSOC);

header('Content-Type: application/json');
echo json_encode($entries);
?>
