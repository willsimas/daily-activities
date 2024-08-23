<?php
// if (Auth::isLoggedIn()) {
//     header('Location: /home');
//     exit;
// }

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    if ($username === 'admin' && $password === 'password') {
        Auth::login(1); // Simular login com ID 1
        header('Location: /home');
        exit;
    } else {
        $error = 'Credenciais inválidas';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="/style/style.css" rel="stylesheet">
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="w-full max-w-sm bg-white p-8 rounded-lg shadow-md">
        <h1 class="text-2xl font-semibold mb-4">Login</h1>
        <?php
        // if (isset($error)):
        ?>
            <p class="text-red-500 mb-4">
                <?php
                // htmlspecialchars($error)
                ?>
                </p>
        <?php
        // endif;
        ?>
        <form method="POST">
            <label class="block mb-2">
                <span class="text-gray-700">Username</span>
                <input type="text" name="username" class="form-input mt-1 block w-full" required>
            </label>
            <label class="block mb-4">
                <span class="text-gray-700">Password</span>
                <input type="password" name="password" class="form-input mt-1 block w-full" required>
            </label>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md">Login</button>
        </form>
    </div>
</body>

</html>