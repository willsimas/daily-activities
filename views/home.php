<?php
if (!Auth::isLoggedIn()) {
    header('Location: /login');
    exit;
}
?>

<?php
    require "./header.php";
?>
    <div class="container mx-auto p-4">
        <h1 class="text-3xl font-semibold mb-4">Welcome</h1>
        <a href="/activity" class="text-blue-500">Manage Activities</a>
        <form method="POST" action="/logout" class="mt-4">
            <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-md">Logout</button>
        </form>
    </div>

    <?php
    require "./footer.php";
    ?>
