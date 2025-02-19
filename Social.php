<?php
// session_start(); // Start the session

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
// session_start();
?>

<head>
    <style>
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

        .subscribe-btn-456yrt {
            width: 7rem !important;
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

        .social-container-989ojk {
            width: 50%;
        }

        /* .subscribe-btn-div {
            width: 100% !important;
        } */
    </style>
</head>

<body>

    <?php
    // echo "<pre>";
    // print_r($clientData);
    // echo "</pre>";

    ?>
    <div class="client-container-outer-674pl">
        <div class="social-container-989ojk">
            <!-- Social Media Links Form -->
            <div class="social-links-form">
                <h2>Enter Your Social Media Links</h2>

                <form action="updateClientInfo.php" method="post" id="client_social_links">
                    <!-- Facebook Input -->
                    <input type="hidden" name="client_id" value="<?php echo $_GET['Id']; ?>">

                    <div class="form-input">

                        <input type="url" id="facebook" name="facebook" placeholder="Enter Facebook Link" value="<?php echo $clientData['facebook']?>"  />
                        <label for="facebook">Facebook:</label>
                    </div>
                    <!-- <div class="error-message" id="facebookError"></div> -->

                    <!-- Twitter Input -->
                    <div class="form-input">

                        <input type="url" id="twitter" name="twitter" placeholder="Enter Twitter Link" value="<?php echo $clientData['twitter']?>"  />
                        <label for="twitter">Twitter:</label>
                    </div>
                    <!-- <div class="error-message" id="twitterError"></div> -->

                    <!-- Instagram Input -->
                    <div class="form-input">

                        <input type="url" id="instagram" name="instagram" placeholder="Enter Instagram Link" value="<?php echo $clientData['instagram']?>"  />
                        <label for="instagram">Instagram:</label>
                    </div>
                    <!-- <div class="error-message" id="instagramError"></div> -->

                    <!-- LinkedIn Input -->
                    <div class="form-input">

                        <input type="url" id="linkedin" name="linkedin" placeholder="Enter LinkedIn Link" value="<?php echo $clientData['linkedin']?>" />
                        <label for="linkedin">LinkedIn:</label>
                    </div>
                    <!-- <div class="error-message" id="linkedinError"></div> -->

                    <!-- YouTube Input -->
                    <div class="form-input">

                        <input type="url" id="youtube" name="youtube" placeholder="Enter YouTube Link" value="<?php echo $clientData['youtube']?>" />
                        <label for="youtube">YouTube:</label>
                    </div>

                    <div class="form-input">

                        <input type="url" id="custom_link" name="custom_link"
                            placeholder="Enter Custom Link (Optional)" value="<?php echo $clientData['custom_link']?>" />
                        <label for="custom_link">Custom Link URL:</label>
                    </div>
                    <!-- <div class="error-message" id="customLinkError"></div> -->

                    <!-- Submit Button -->
                    <div class="save-btn subscribe-btn-div">
                        <button type="button" class="subscribe-btn-456yrt" id="subscribe-btn-456yrt">Submit
                            Links</button>
                    </div>
                </form>
            </div>
        </div>

    </div>

</body>

</html>