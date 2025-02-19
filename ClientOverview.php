<?php
include 'partials/navbar.php';
include "partials/sql-connction.php";
include "core/clientFunctions.php";

// Get Client ID from URL
$client_id = isset($_GET['Id']) ? intval($_GET['Id']) : 0;
// echo $client_id;

$clientData = getAllClientDetails($client_id);
$clientHostingData = getClientHostingAndDomain($client_id);
// echo $client_id;
// echo "<pre>";
// print_r($clientData);
// echo "</pre>";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client Overview</title>
    <link rel="stylesheet" href="public/css/navbar.css">
    <link rel="stylesheet" href="public/css/tabs.css">
    <!-- <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 95%;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .header {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .back-btn {
            text-decoration: none;
            font-size: 18px;
            color: black;
            font-weight: bold;
        }


        /* Business Details */
        .details-section {
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-top: 20px;
            background: #f9f9f9;
        }

        .details-section h3 {
            margin: 0 0 10px;
        }

        .details-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 15px;
        }

        .details-grid p {
            margin: 0;
            padding: 5px;
            font-weight: bold;
        }

        .details-grid span {
            font-weight: normal;
            color: #555;
        }

        /* Projects & Tasks */

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f0f0f0;
        }

        .overdue {
            color: red;
            font-weight: bold;
        }

    </style> -->

    <style>
        .client-details-09po {
            position: relative;
            background-color: #f1f1ec;
            border: 2px solid #007474;
            padding: 24px;
            display: flex;
            justify-content: start;
            align-items: center;
            gap: 4rem;
        }

        .client-details-label-890 {
            position: absolute;
            top: -12;
            left: 20;
            background-color: white;
            color: #007474;
            font-weight: 700;
            padding: 2px 6px;

        }

        .client-09plio {}

        .flex-center {
            display: flex;
            gap: 1rem;
        }

        .flex-center h4 {
            color: #007474;
            font-weight: bold;
        }

        /* project_details.css */

        .client-details-container {
            max-width: 1200px;
            background: #ffffff;
            margin: 30px auto;
            padding: 20px;
            border: 2px solid #0a4c60;
            border-radius: 8px;
            font-family: Arial, sans-serif;
        }

        .client-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-bottom: 10px;
            border-bottom: 2px solid #0a4c60;
            margin-bottom: 20px;
        }

        .client-title {
            margin: 0;
            font-size: 22px;
            color: #0a4c60;
            font-weight: bold;
        }

        .client-title-prefix {
            color: #008080;
        }

        .client-details-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
        }

        .client-detail-item {
            padding: 10px;
            border-bottom: 1px solid #ccc;
        }

        .client-detail-label {
            font-weight: bold;
            color: #0a4c60;
        }

        .client-detail-value {
            color: #333;
            font-size: 16px;
        }

        .client-status {
            color: red;
            /* Or whatever color you want for the status */
        }
    </style>

</head>

<body>

    <div class="container">

        <div class="tabs-container-pl09">
            <a href="Clients.php" class="back-btn">Back</a>
            <ul class="tabs">
                <li class="tab active" data-tab="tab1">Overview</li>
                <li class="tab" data-tab="tab2">Hosting & Domain</li>
                <li class="tab" data-tab="tab3">Hours</li>
                <li class="tab" data-tab="tab4">Images</li>
                <li class="tab" data-tab="tab5">Social</li>
            </ul>

        </div>

        <div class="tab-content">
            <div id="tab1" class="tab-pane active">
                <!-- Client Details -->
                <div class="client-details-container">
                    <div class="client-header">
                        <h2 class="client-title">
                            <span class="client-title-prefix">CLIENT DETAILS</span>
                        </h2>
                    </div>

                    <div class="client-details-grid">
                        <div class='client-detail-item'>
                            <label class='client-detail-label'>Client Id : </label>
                            <span class="class='client-detail-value'"><?php echo $client_id; ?></span>
                        </div>
                        <div class='client-detail-item'>
                            <label class='client-detail-label'>Client Name : </label>
                            <span class="class='client-detail-value'"><?php echo $clientData["client_name"]; ?></span>
                        </div>
                        <div class='client-detail-item'>
                            <label class='client-detail-label'>Business Name : </label>
                            <span class="class='client-detail-value'"><?php echo $clientData["business_name"]; ?></span>
                        </div>
                        <div class='client-detail-item'>
                            <label class='client-detail-label'>Website : </label>
                            <span class="class='client-detail-value'"><?php echo $clientData["website"]; ?></span>
                        </div>
                        <div class='client-detail-item'>
                            <label class='client-detail-label'>Business Category : </label>
                            <span
                                class="class='client-detail-value'"><?php echo $clientData["business_category"]; ?></span>
                        </div>
                        <div class='client-detail-item'>
                            <label class='client-detail-label'>Short Description : </label>
                            <span
                                class="class='client-detail-value'"><?php echo $clientData["short_description"]; ?></span>
                        </div>
                        <div class='client-detail-item'>
                            <label class='client-detail-label'>Long Description : </label>
                            <span
                                class="class='client-detail-value'"><?php echo $clientData["long_description"]; ?></span>
                        </div>

                        <div class='client-detail-item'>
                            <label class='client-detail-label'>Business Number : </label>
                            <span
                                class="class='client-detail-value'"><?php echo $clientData["business_number"]; ?></span>
                        </div>
                        <div class='client-detail-item'>
                            <label class='client-detail-label'>Other Business Number : </label>
                            <span
                                class="class='client-detail-value'"><?php echo $clientData["other_business_number"]; ?></span>
                        </div>
                        <div class='client-detail-item'>
                            <label class='client-detail-label'>Mobile : </label>
                            <span class="class='client-detail-value'"><?php echo $clientData["mobile"]; ?></span>
                        </div>
                        <div class='client-detail-item'>
                            <label class='client-detail-label'>Fax : </label>
                            <span class="class='client-detail-value'"><?php echo $clientData["fax"]; ?></span>
                        </div>
                        <div class='client-detail-item'>
                            <label class='client-detail-label'>Toll Free : </label>
                            <span class="class='client-detail-value'"><?php echo $clientData["toll_free"]; ?></span>
                        </div>
                        <div class='client-detail-item'>
                            <label class='client-detail-label'>Country:</label>
                            <span class='client-detail-value'><?php echo $clientData["country"]; ?></span>
                        </div>
                        <div class='client-detail-item'>
                            <label class='client-detail-label'>Address:</label>
                            <span class='client-detail-value'><?php echo $clientData["address"]; ?></span>
                        </div>
                        <div class='client-detail-item'>
                            <label class='client-detail-label'>City:</label>
                            <span class='client-detail-value'><?php echo $clientData["city"]; ?></span>
                        </div>
                        <div class='client-detail-item'>
                            <label class='client-detail-label'>State:</label>
                            <span class='client-detail-value'><?php echo $clientData["state"]; ?></span>
                        </div>
                        <div class='client-detail-item'>
                            <label class='client-detail-label'>Zip Code:</label>
                            <span class='client-detail-value'><?php echo $clientData["zip_code"]; ?></span>
                        </div>
                        <div class='client-detail-item'>
                            <label class='client-detail-label'>Time Zone:</label>
                            <span class='client-detail-value'><?php echo $clientData["time_zone"]; ?></span>
                        </div>
                        <div class='client-detail-item'>
                            <label class='client-detail-label'>Map Link:</label>
                            <span class='client-detail-value'><?php echo $clientData["map_link"]; ?></span>
                        </div>
                    </div>
                </div>

            </div>
            <div id="tab2" class="tab-pane">

                <div class="client-details-container">

                    <div class="client-header">
                        <h2 class="client-title">
                            <span class="client-title-prefix">HOSTING & DOMAIN :</span>
                        </h2>
                    </div>

                    <div class="client-details-grid">
                        <!-- Hosting Details -->
                        <div class='client-detail-item'>
                            <label class='client-detail-label'>Hosting Provider: </label>
                            <span
                                class="client-detail-value"><?php echo $clientHostingData['hosting_provider']; ?></span>
                        </div>
                        <div class='client-detail-item'>
                            <label class='client-detail-label'>Hosting Plan: </label>
                            <span
                                class="client-detail-value"><?php echo $clientHostingData['hosting_plan'] ?: 'N/A'; ?></span>
                        </div>
                        <div class='client-detail-item'>
                            <label class='client-detail-label'>Hosting Start Date: </label>
                            <span
                                class="client-detail-value"><?php echo $clientHostingData['hosting_start_date']; ?></span>
                        </div>
                        <div class='client-detail-item'>
                            <label class='client-detail-label'>Hosting Renewal Date: </label>
                            <span
                                class="client-detail-value"><?php echo $clientHostingData['hosting_renewal_date']; ?></span>
                        </div>
                        <div class='client-detail-item'>
                            <label class='client-detail-label'>Hosting Cost: </label>
                            <span class="client-detail-value"><?php echo $clientHostingData['hosting_cost']; ?></span>
                        </div>
                        <div class='client-detail-item'>
                            <label class='client-detail-label'>IP Address: </label>
                            <span class="client-detail-value"><?php echo $clientHostingData['ip_address']; ?></span>
                        </div>

                        <!-- SSL Details -->
                        <div class='client-detail-item'>
                            <label class='client-detail-label'>SSL Provider: </label>
                            <span
                                class="client-detail-value"><?php echo $clientHostingData['ssl_provider'] ?: 'N/A'; ?></span>
                        </div>
                        <div class='client-detail-item'>
                            <label class='client-detail-label'>SSL Expiry Date: </label>
                            <span
                                class="client-detail-value"><?php echo $clientHostingData['ssl_expiry_date']; ?></span>
                        </div>
                        <div class='client-detail-item'>
                            <label class='client-detail-label'>SSL Total Amount Due: </label>
                            <span
                                class="client-detail-value"><?php echo $clientHostingData['ssl_total_amount_due']; ?></span>
                        </div>
                        <div class='client-detail-item'>
                            <label class='client-detail-label'>SSL Payment Method: </label>
                            <span
                                class="client-detail-value"><?php echo $clientHostingData['ssl_payment_method']; ?></span>
                        </div>

                        <!-- Domain Details -->
                        <div class='client-detail-item'>
                            <label class='client-detail-label'>Domain Name: </label>
                            <span class="client-detail-value"><?php echo $clientHostingData['domain_name']; ?></span>
                        </div>
                        <div class='client-detail-item'>
                            <label class='client-detail-label'>Domain Registration Date: </label>
                            <span
                                class="client-detail-value"><?php echo $clientHostingData['domain_registration_date']; ?></span>
                        </div>
                        <div class='client-detail-item'>
                            <label class='client-detail-label'>Domain Expiry Date: </label>
                            <span
                                class="client-detail-value"><?php echo $clientHostingData['domain_expiry_date']; ?></span>
                        </div>
                        <div class='client-detail-item'>
                            <label class='client-detail-label'>Domain Cost: </label>
                            <span class="client-detail-value"><?php echo $clientHostingData['domain_cost']; ?></span>
                        </div>
                        <div class='client-detail-item'>
                            <label class='client-detail-label'>Domain Payment Method: </label>
                            <span
                                class="client-detail-value"><?php echo $clientHostingData['domain_payment_method'] ?: 'N/A'; ?></span>
                        </div>
                    </div>
                </div>

                <!-- <h2>Tab 2 Content</h2>
                <p>This is the content for Tab 2.</p> -->
            </div>
            <div id="tab3" class="tab-pane">
                <h2>Tab 3 Content</h2>
                <p>This is the content for Tab 3.</p>
            </div>
            <div id="tab4" class="tab-pane">
                <h2>Tab 4 Content</h2>
                <p>This is the content for Tab 3.</p>
            </div>
            <div id="tab5" class="tab-pane">
                <div class="client-details-container">

                    <div class="client-header">
                        <h2 class="client-title">
                            <span class="client-title-prefix">SOCIAL LINKS</span>
                        </h2>
                    </div>

                    <div class="client-details-grid">
                        <!-- Hosting Details -->
                        <div class='client-detail-item'>
                            <label class='client-detail-label'>Facebook: </label>
                            <span
                                class="client-detail-value"><?php echo $clientData['facebook']; ?></span>
                        </div>
                        <div class='client-detail-item'>
                            <label class='client-detail-label'>Twitter: </label>
                            <span
                                class="client-detail-value"><?php echo $clientData['twitter'] ?: 'N/A'; ?></span>
                        </div>
                        <div class='client-detail-item'>
                            <label class='client-detail-label'>Instagram: </label>
                            <span
                                class="client-detail-value"><?php echo $clientData['instagram']; ?></span>
                        </div>
                        <div class='client-detail-item'>
                            <label class='client-detail-label'>Linked In: </label>
                            <span
                                class="client-detail-value"><?php echo $clientData['linkedin']; ?></span>
                        </div>
                        <div class='client-detail-item'>
                            <label class='client-detail-label'>Youtube: </label>
                            <span
                                class="client-detail-value"><?php echo $clientData['youtube']; ?></span>
                        </div>
                        <div class='client-detail-item'>
                            <label class='client-detail-label'>Custom Link: </label>
                            <span
                                class="client-detail-value"><?php echo $clientData['custom_link']; ?></span>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>

        <!-- Projects & Tasks Section -->


    </div>


    <script src="public/js/tabs.js"></script>

</body>

</html>