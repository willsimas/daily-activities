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
        <section class="activities-list p-6 max-w-4xl mx-auto bg-gray-50 rounded-lg shadow-md">
            <?php if ($activities): ?>
                <ul class="space-y-4">
                    <?php foreach ($activities as $index => $activity): ?>
                        <li class="p-4 bg-white border border-gray-200 rounded-md shadow-sm flex flex-col space-y-2 relative">
                            <div class="font-semibold text-lg"><?= htmlspecialchars($activity['name']) ?></div>
                            <div class="text-sm text-gray-600">Status: <span class="font-medium text-blue-600"><?= htmlspecialchars($activity['status']) ?></span></div>
                            <div class="text-sm text-gray-600">Created at: <?= htmlspecialchars($activity['created_at']) ?></div>
                            <?php if ($activity['completed_at']): ?>
                                <div class="text-sm text-gray-600">Completed at: <?= htmlspecialchars($activity['completed_at']) ?></div>
                            <?php endif; ?>
                            <div class="flex space-x-2">
                                <button class="edit-btn px-4 py-2 bg-blue-500 text-white font-semibold rounded-md shadow-sm hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2" data-index="<?= $index ?>">Edit</button>
                                <button class="delete-btn px-4 py-2 bg-red-500 text-white font-semibold rounded-md shadow-sm hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2" data-index="<?= $index ?>">Delete</button>
                            </div>
                            <div class="status-dropdown hidden absolute top-12 left-0 bg-white border border-gray-300 rounded-md shadow-lg p-2">
                                <select class="status-select px-3 py-2 w-full border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                    <option value="aberto">Open</option>
                                    <option value="realizando">In Progress</option>
                                    <option value="finalizado">Completed</option>
                                </select>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <p class="text-center text-gray-500">No activities found.</p>
            <?php endif; ?>
        </section>


    </main>
    <script src="scripts/activityManager.js"></script>
</body>

</html>