$(document).ready(function () {
    function updateData() {
        $.ajax({
            url: 'update_data.php', // PHP script to fetch updated data
            success: function (data) {
                // Update the dashboard with the new data
                var jsonData = JSON.parse(data);
                $('#totalPlants').text(jsonData.total_plants);
                $('#totalUsers').text(jsonData.total_users);
            },
        });
    }

    // Refresh data every 60 seconds (adjust the interval as needed)
    setInterval(updateData, 60000);

    // Initial data update on page load
    updateData();
});
