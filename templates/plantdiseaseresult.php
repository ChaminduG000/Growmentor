<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <title>Plant Disease Detection</title>
    <link rel="stylesheet" href="static/css/style.css">
    <link rel="stylesheet" href="static/css/result.css">
    <style>
        /* Circle Styles */
        .circle {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            margin: 0 auto;
            opacity: 0; /* Initially hidden */
        }

        .green {
            background-color: green;
            animation: blinkGreen 2s infinite;
        }

        .red {
            background-color: red;
            animation: blinkRed 2s infinite;
        }

        @keyframes blinkGreen {
            0%, 100% {
                opacity: 0;
            }
            50% {
                opacity: 1;
            }
        }

        @keyframes blinkRed {
            0%, 100% {
                opacity: 0;
            }
            50% {
                opacity: 1;
            }
        }
    </style>
</head>
<body>
    <!-- Result Section -->
    <section style="background-color: #023802; padding: 2%;">
        <div class="reultDisplay m-4 mb-5 p-5 overflow-auto" style="width: 90%; height: 30rem; background-color: rgba(41, 39, 39, 0.4); border-radius: 36px;" id="resltDsply">
            <p class="showReslt dsiplay-block" id="shwReslt"> </p>
            <div class="row-sm p-sm-5">
                <div class="col-sm-12 p-sm-5">
                    <h1 class="text-center">
                        <div class="circle green"></div>
                        <div class="circle red"></div>

                        <b><big><big><font color="white">Plant Disease Detection</b></font>
                    </h1>
                    <h2 class="text-center"><font color="white">
                        The detected disease is - {{corrected_result}}
                    </h2></font>
<!-- ... (other HTML code) ... -->
<?php
// Database connection parameters
$host = "localhost";
$username = "root"; // Replace with your database username
$password = ""; // Replace with your database password
$database = "growmentor";

// Create a database connection
$conn = new mysqli($host, $username, $password, $database);

// Check for connection errors
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the corrected_result value
$corrected_result = "{{corrected_result}}"; // Replace with your actual corrected result

// Query to select Treatment and Link1 based on the detected disease
$sql = "SELECT Treatment, Link1 FROM plant_disease WHERE Plant_Disease = '$corrected_result'";

// Execute the query
$result = $conn->query($sql);

// Check if there is a row in the result
if ($result->num_rows > 0) {
    // Output the treatment and Link1
    $row = $result->fetch_assoc();
    echo "<h4 class='text-center'><font color='white'><b>Treatment:</b></h4></font>";
    echo "<ul class='text-center'>";
    echo "<li><font color='white'>" . $row["Treatment"] . "</li>";
    echo "<li><font color='white'>" . $row["Link1"] . "</li>";
    echo "</ul>";

    // Display Link1 if it exists
    if (!empty($row["Link1"])) {
        // Display the Link1
    }
} else {
    echo "No treatment information found for the detected disease.";
}

// Close the database connection
$conn->close();
?>

                </div>
            </div>
        </div>
    </section>

    <script>
        function goBack() {
            window.history.back();
        }
    
        // Get the corrected_result value
        var corrected_result = "{{corrected_result}}"; // Replace with your actual value
    
        // Get the circle elements
        var greenCircle = document.querySelector('.circle.green');
        var redCircle = document.querySelector('.circle.red');
        var diseaseDetails = document.getElementById('diseaseDetails');
    
        // Check if the corrected_result includes "healthy"
        if (corrected_result.toLowerCase().includes("healthy")) {
            greenCircle.style.display = "block";
            redCircle.style.display = "none";
        } else {
            redCircle.style.display = "block";
            greenCircle.style.display = "none";
        }
    
        // Check if corrected_result is "grapeblackrot" to display diseaseDetails
        if (corrected_result.toLowerCase() === "grapeblackrot") {
            diseaseDetails.style.display = "block"; // Show disease details
        }
    </script>
    
</body>
</html>
