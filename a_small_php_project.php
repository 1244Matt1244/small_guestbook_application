<?php
// Database connection
$db = new PDO('mysql:host=localhost;dbname=guestbook', 'username', 'password');

// User authentication
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['username'], $_POST['password'])) {
    // Authenticate the user...
}

// Input validation
function validate_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Add entry
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['message'])) {
    $message = validate_input($_POST['message']);
    $stmt = $db->prepare("INSERT INTO entries (user_id, message) VALUES (?, ?)");
    $stmt->execute([$_SESSION['user_id'], $message]);
}

// Get entries
$stmt = $db->query("SELECT * FROM entries ORDER BY id DESC");
$entries = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!-- HTML and form for login and adding entries -->

<?php foreach ($entries as $entry): ?>
    <div>
        <h2><?=htmlspecialchars($entry['message'], ENT_QUOTES, 'UTF-8')?></h2>
        <!-- Display other entry data... -->
    </div>
<?php endforeach; ?>
