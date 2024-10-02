<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guestbook Application</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Guestbook</h1>

    <?php if (!empty($error)): ?>
        <p class="error-message"><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></p>
    <?php endif; ?>

    <?php if (!isset($_SESSION['username'])): ?>
        <form id="loginForm" method="post" action="">
            <input type="hidden" name="csrf_token" value="<?php echo getCsrfToken(); ?>">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <button type="submit">Login</button>
        </form>
    <?php else: ?>
        <form id="entryForm" method="post" action="">
            <input type="hidden" name="csrf_token" value="<?php echo getCsrfToken(); ?>">
            <label for="message">Message:</label>
            <textarea id="message" name="message" required></textarea>
            <button type="submit">Add Entry</button>
        </form>

        <h2>Entries</h2>
        <div id="entries">
            <?php foreach ($entries as $entry): ?>
                <div>
                    <h3><?php echo htmlspecialchars($entry['message'], ENT_QUOTES, 'UTF-8'); ?></h3>
                    <p>By: <?php echo htmlspecialchars($entry['username'], ENT_QUOTES, 'UTF-8'); ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <script src="scripts.js"></script>
</body>
</html>
