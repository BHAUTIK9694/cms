<?php

include "core/clientFunctions.php";



// session_start(); // Start the session

// If 'Id' is provided in the URL, update session
// if (isset($_GET['Id'])) {
//     $_SESSION['clientId'] = $_GET['Id'];
// }

// Retrieve clientId from session
// $clientId = isset($_SESSION['clientId']) ? $_SESSION['clientId'] : '';

// Default tab
// $name = isset($_GET['tab']) ? $_GET['tab'] : 'PrimaryInfo';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Layout</title>
    <link rel="stylesheet" href="public/css/AddClient.css">
    <link rel="stylesheet" href="public/css/navbar.css">
    <link rel="stylesheet" href="public/css/input.css">
    <link rel="stylesheet" href="public/css/services.css">
    <link rel="stylesheet" href="public/css/tabs.css">
    <link rel="stylesheet" href="public/css/addClient/primaryInfo.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>

    </style>
</head>

<body>
    <?php
    include 'partials/navbar.php';
    ?>
    <div>
        <div class="tabs-container-pl09">
            <a href="Clients.php" class="back-btn">Back</a>
            <ul class="tabs">
                <li class="tab active" data-tab="tab1">Primary Info</li>
                <li class="tab" data-tab="tab2">Hours</li>
                <li class="tab" data-tab="tab3">Social</li>
                <li class="tab" data-tab="tab4">Hosting & Domain</li>
                <li class="tab" data-tab="tab5">Subscription</li>
                <li class="tab" data-tab="tab6">Images</li>
            </ul>

        </div>

        <div class="tab-content">
            <div id="tab1" class="tab-pane active">
                <?php include "primaryInfo.php"; ?>
            </div>

            <div id="tab2" class="tab-pane">
                <?php include "Hours.php"; ?>
            </div>

            <div id="tab3" class="tab-pane">
                <?php include "Social.php"; ?>
            </div>

            <div id="tab4" class="tab-pane">
                <?php include "Hosting.php"; ?>
            </div>

            <div id="tab5" class="tab-pane">
                <?php include "Subscription.php"; ?>
            </div>
            <div id="tab6" class="tab-pane">
                <?php include "Images.php"; ?>
            </div>
        </div>


        <script src="public/js/tabs.js"></script>
        <script src="public/js/tags.js"></script>
        <script src="public/js/addClient.js"></script>
        <script>
            // Business Category:


            // Business Phone:
            document.getElementById("add-phone-btn").addEventListener("click", function () {
                const additionalPhonesContainer = document.getElementById("additional-phones");
                const phoneCount = additionalPhonesContainer.children.length + 1;

                const newNumberContainer = document.createElement('div');
                newNumberContainer.classList.add("phone-container");

                const newPhoneInputDiv = document.createElement("div");
                newPhoneInputDiv.classList.add("newBusinessNumber");
                newPhoneInputDiv.classList.add("form-input");

                const newPhoneInput = document.createElement("div");
                newPhoneInput.classList.add("form-input");

                const newPhoneLabel = document.createElement('label');
                newPhoneLabel.htmlFor = `phone-${phoneCount}`;
                newPhoneLabel.textContent = "Other Business Number";

                const businessNumInput = document.createElement("input");
                businessNumInput.type = "tel";
                businessNumInput.id = `phone-${phoneCount}`;
                businessNumInput.name = "phone[]";
                businessNumInput.placeholder = "Enter Other Business number";
                businessNumInput.required = true;

                const inputRemoveBtn = document.createElement('button');
                inputRemoveBtn.type = "button";
                inputRemoveBtn.classList.add("remove-btn");
                inputRemoveBtn.textContent = "Remove";
                // Attach event listener properly
                inputRemoveBtn.addEventListener("click", function () {
                    newNumberContainer.remove(); // Removes the entire div
                });

                newPhoneInputDiv.appendChild(businessNumInput);
                newPhoneInputDiv.appendChild(newPhoneLabel);
                newNumberContainer.appendChild(newPhoneInputDiv);
                newNumberContainer.appendChild(inputRemoveBtn);
                additionalPhonesContainer.appendChild(newNumberContainer);

            });

        </script>
</body>

</html>