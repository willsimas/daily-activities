<?php
require 'includes/Activity.php';
require 'includes/ActivityHandler.php';

$activityHandler = new ActivityHandler('activities/activities.txt');
$activities = $activityHandler->getActivities();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['activity_name'] ?? '';
    $activity = new Activity($name);
    $activityHandler->addActivity($activity);
    header('Location: index.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daily activities control</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 font-sans">
    <header class="text-center text-3xl font-bold text-indigo-600 my-8">
        DAILY CONTROL</header>
    <main>
        <form action="index.php" method="POST" class="flex flex-col space-y-4 p-4 max-w-md mx-auto bg-white shadow-md rounded-lg">
            <div class="flex flex-col">
                <label for="activity_name_id" class="mb-2 text-sm font-medium text-gray-700">Activity name:</label>
                <input type="text" name="activity_name" id="activity_name_id" class="px-3 py-2 border border-gray-300 rounded-md shadow-sm" placeholder="Enter activity name">
            </div>
            <div class="flex justify-end">
                <button type="submit" class="px-4 py-2 bg-blue-500 text-white font-semibold rounded-md shadow-sm">Submit</button>
            </div>
        </form>
        <section class="activities-list">
            <?php if ($activities): ?>
                <ul>
                    <?php foreach ($activities as $index => $activity): ?>
                        <li>
                            <div><?= htmlspecialchars($activity['name']) ?></div>
                            <div>Status: <?= htmlspecialchars($activity['status']) ?></div>
                            <div>Created at: <?= htmlspecialchars($activity['created_at']) ?></div>
                            <?php if ($activity['completed_at']): ?>
                                <div>Completed at: <?= htmlspecialchars($activity['completed_at']) ?></div>
                            <?php endif; ?>
                            <button class="edit-btn" data-index="<?= $index ?>">Edit</button>
                            <button class="delete-btn" data-index="<?= $index ?>">Delete</button>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <p>No activities found.</p>
            <?php endif; ?>
        </section>
    </main>
    <script src="scripts/activityManager.js"></script>
</body>

</html>