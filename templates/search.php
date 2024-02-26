<?php
include('config.php'); // Include database connection file

// Initialize an empty array to store search results
$searched_posts = [];

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Get the search query from the URL
    $search_query = isset($_GET['search_query']) ? trim($_GET['search_query']) : '';

    // Validate and sanitize the search query to prevent SQL injection
    $search_query = mysqli_real_escape_string($conn, $search_query);

    // Check if the search query is not empty
    if (!empty($search_query)) {
        // Fetch posts that match the sanitized search query
        $query = "SELECT * FROM posts 
                  JOIN users ON posts.post_by = users.user_id
                  WHERE (posts.post_public = 'Y' OR users.user_id = {$_SESSION['user_id']})
                  AND posts.post_caption LIKE '%$search_query%'
                  ORDER BY post_time DESC";

        $result = mysqli_query($conn, $query);

        if ($result) {
            // Fetch all rows as an associative array
            $searched_posts = mysqli_fetch_all($result, MYSQLI_ASSOC);
        } else {
            // Handle the case when the query fails
            die("Error: " . mysqli_error($conn));
        }

        // Close the database connection
        mysqli_close($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Include your head content here -->
</head>

<body>
    <!-- Include your navigation bar and other content here -->

    <!-- Display search results -->
    <?php if (!empty($searched_posts)) : ?>
        <h2 style="text-align:center;">Search Results</h2>
        <?php foreach ($searched_posts as $post) : ?>
            <!-- Display search results as you did for regular posts -->
            <div>
                <!-- Display post information -->
                <p>Posted by: <?php echo $post['first_name'] . ' ' . $post['last_name']; ?></p>
                <p>News: <?php echo $post['post_caption']; ?></p>
                <p>Posted on: <?php echo $post['post_time']; ?></p>

                <!-- Display the uploaded photo if available -->
                <?php if (!empty($post['post_photo'])) : ?>
                    <img src="uploads<?php echo $post['post_photo']; ?>" alt="Post Photo" style="max-width: 300px; max-height: 300px;">
                <?php endif; ?>

                <hr>
            </div>
        <?php endforeach; ?>
    <?php else : ?>
        <p>No results found.</p>
    <?php endif; ?>
</body>

<footer class="footer">
    <!-- Include your footer content here -->
</footer>

</html>
