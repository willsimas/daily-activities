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
    <script src="scripts/activityManager.js" defer></script>

</head>

<body class="bg-gray-100 font-sans">
    <header class="text-center text-3xl font-bold text-indigo-600 my-8">
        DAILY CONTROL</header>
    <main class="flex flex-col gap-4 w-9/12 mx-auto">
        <form action="index.php" method="POST" class="flex flex-col space-y-4 p-4 w-2/6 mx-auto bg-white shadow-md rounded-lg">
            <div class="flex flex-col w-96">
                <label for="activity_name_id" class="mb-2 text-sm font-medium text-gray-700">Activity name:</label>
                <input type="text" name="activity_name" id="activity_name_id" class="px-3 py-2 border border-gray-300 rounded-md shadow-sm" placeholder="Enter activity name">
            </div>
            <div class="flex justify-end">
                <button type="submit" class="px-4 py-2 bg-blue-500 text-white font-semibold rounded-md shadow-sm">Submit</button>
            </div>
        </form>
        <section class="activities-list p-6 w-2/6 max-w-6xl mx-auto">
            <?php if ($activities): ?>
                <ul class="space-y-8">
                    <?php foreach ($activities as $index => $activity): ?>
                        <li class="p-4 bg-white border border-gray-200 rounded-md shadow-sm flex flex-col space-y-2 relative">
                            <div class="activity-view flex flex-col gap-4">
                                <div class="font-semibold text-lg activity-name"><?= htmlspecialchars($activity['name']) ?></div>
                                <div class="text-sm text-gray-600">Status: <span class="font-medium text-blue-600 activity-status"><?= htmlspecialchars($activity['status']) ?></span></div>
                                <div class="text-sm text-gray-600">Created at: <?= htmlspecialchars($activity['created_at']) ?></div>
                                <?php if ($activity['completed_at']): ?>
                                    <div class="text-sm text-gray-600">Completed at: <?= htmlspecialchars($activity['completed_at']) ?></div>
                                <?php endif; ?>
                                <div class="flex space-x-2 mt-">
                                    <button class="edit-btn px-4 py-2 bg-blue-500 text-white font-semibold rounded-md shadow-sm hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2" data-index="<?= $index ?>">Edit</button>
                                    <button class="delete-btn px-4 py-2 bg-red-500 text-white font-semibold rounded-md shadow-sm hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2" data-index="<?= $index ?>">Delete</button>
                                </div>
                            </div>
                            <div class="activity-edit flex flex-col gap-4 hidden">
                                <input type="text" class="activity-name-edit px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" value="<?= htmlspecialchars($activity['name']) ?>">
                                <select class="activity-status-edit px-3 py-2 w-full border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                    <option value="aberto" <?= $activity['status'] === 'aberto' ? 'selected' : '' ?>>Open</option>
                                    <option value="realizando" <?= $activity['status'] === 'realizando' ? 'selected' : '' ?>>In Progress</option>
                                    <option value="finalizado" <?= $activity['status'] === 'finalizado' ? 'selected' : '' ?>>Completed</option>
                                </select>
                                <div class="flex space-x-2 mt-2">
                                    <button class="save-btn px-4 py-2 bg-green-500 text-white font-semibold rounded-md shadow-sm hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">Save</button>
                                    <button class="cancel-btn px-4 py-2 bg-red-500 text-white font-semibold rounded-md shadow-sm hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">Cancel</button>
                                </div>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <p class="text-center text-gray-500">No activities found.</p>
            <?php endif; ?>
        </section>


    </main>
</body>

</html>