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
        <div>
            <form action="" class="flex flex-col space-y-4 p-4 max-w-md mx-auto bg-white shadow-md rounded-lg">
                <div class="flex flex-col">
                    <label for="activity_name_id" class="mb-2 text-sm font-medium text-gray-700">Activity name:</label>
                    <input
                        type="text"
                        name="activity_name"
                        id="activity_name_id"
                        class="px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        placeholder="Enter activity name">
                </div>

                <div class="flex justify-end">
                    <button
                        type="submit"
                        class="px-4 py-2 bg-blue-500 text-white font-semibold rounded-md shadow-sm hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                        Submit
                    </button>
                </div>
            </form>

        </div>
    </main>
</body>

</html>