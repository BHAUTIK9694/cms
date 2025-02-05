<?php
session_start(); // Start the session

// If 'Id' is provided in the URL, update session
if (isset($_GET['Id'])) {
    $_SESSION['clientId'] = $_GET['Id'];
}

// Retrieve clientId from session
$clientId = isset($_SESSION['clientId']) ? $_SESSION['clientId'] : '';

// Default tab
$name = isset($_GET['tab']) ? $_GET['tab'] : 'PrimaryInfo';
?>

<!DOCTYPE html>
<html lang="en">
<?php
// Start the session before anything else
session_start();
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Social</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        h2 {
            text-decoration: underline;
        }

        .social-links-form {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .social-links-form h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .social-links-form label {
            display: block;
            font-size: 16px;
            margin-bottom: 5px;
        }

        .social-links-form input {
            width: 96%;
            padding: 10px;
            margin: 10px 0 20px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .social-links-form button {
            background-color: #0077ff;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
        }

        .social-links-form button:hover {
            background-color: #005bb5;
        }

        .error-message {
            color: red;
            font-size: 14px;
            margin-top: -15px;
            margin-bottom: 20px;
        }

        /* Platform-specific background color */
        .facebook {
            background-color: #3b5998;
            color: white;
        }

        .twitter {
            background-color: #00acee;
            color: white;
        }

        .instagram {
            background-color: #e1306c;
            color: white;
        }

        .linkedin {
            background-color: #0e76a8;
            color: white;
        }

        .youtube {
            background-color: #ff0000;
            color: white;
        }

        .save-btn button {
            background-color: #007474;
            color: white;
            padding: 15px 30px;
            font-size: 18px;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            transition: background 0.3s;
        }

        .save-btn {
            grid-column: span 2;
            text-align: center;
        }

        .save-btn button:hover {
            background-color: #007474c3;
        }

        .session {
            background-color: #E5E5E5;
            color: #007474;
            padding: 5px;
            border-radius: 7px;
            margin-bottom: 20px;
            text-align: center;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <?php
    include 'partials/navbar.php';
    include 'partials/AddClientNav.php';
    ?>
    <h1><?php echo $clientId ?></h1>
    <input type="hidden" id="client-id" name="client_id" value="<?php echo $clientId; ?>" required>
    <div class="container">
        <?php
        //    session_start();
        if (isset($_SESSION['success'])) {
            echo  "
                <h1 class='session'>" . $_SESSION['success'] . "</h1>
            ";
            unset($_SESSION['success']);
        }
        ?>
        <!-- Social Media Links Form -->
        <div class="social-links-form">
            <h2>Enter Your Social Media Links</h2>

            <form action="SocialData.php" method="post">
                <!-- Facebook Input -->

                <label for="facebook">Facebook:</label>
                <input type="url" id="facebook" name="facebook" placeholder="Enter Facebook Link" required />
                <div class="error-message" id="facebookError"></div>

                <!-- Twitter Input -->
                <label for="twitter">Twitter:</label>
                <input type="url" id="twitter" name="twitter" placeholder="Enter Twitter Link" required />
                <div class="error-message" id="twitterError"></div>

                <!-- Instagram Input -->
                <label for="instagram">Instagram:</label>
                <input type="url" id="instagram" name="instagram" placeholder="Enter Instagram Link" required />
                <div class="error-message" id="instagramError"></div>

                <!-- LinkedIn Input -->
                <label for="linkedin">LinkedIn:</label>
                <input type="url" id="linkedin" name="linkedin" placeholder="Enter LinkedIn Link" required />
                <div class="error-message" id="linkedinError"></div>

                <!-- YouTube Input -->
                <label for="youtube">YouTube:</label>
                <input type="url" id="youtube" name="youtube" placeholder="Enter YouTube Link" required />
                <div class="error-message" id="youtubeError"></div>

                <!-- Custom Link -->
                <label for="custom_name">Custom Link Name:</label>
                <input type="text" id="custom_name" name="custom_name" placeholder="Enter Link Name (Optional)" />

                <label for="custom_link">Custom Link URL:</label>
                <input type="url" id="custom_link" name="custom_link" placeholder="Enter Custom Link (Optional)" />
                <div class="error-message" id="customLinkError"></div>

                <!-- Submit Button -->
                <div class="save-btn">
                    <button type="submit">Submit Links</button>
                </div>
            </form>
        </div>
    </div>

</body>

</html>