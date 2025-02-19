<?php

include "core/clientFunctions.php";

// Get JSON data from the request body
$clientData = json_decode(file_get_contents("php://input"), true);

// Check if JSON decoding was successful
if ($clientData === null) {
    echo "Error decoding JSON data.";
    exit; // Stop further execution
}

// Check if $clientData is empty or if 'client_id' is missing
if (empty($clientData) || !isset($clientData['client_id'])) {
    echo "Client data or client_id is missing.";
    exit;
}


if ($clientData['formId'] === "client_social_links") {
    if (updateClientSocialLinks($clientData)) {
        echo "Client Social Links Updated Successfully";
    } else {
        echo "Error occurred";
    }
} else if ($clientData['formId'] === "client_hosting_and_domain") {
    if (updateClientDomainHosting($clientData)) {
        echo "Client domainand hosting Updated Successfully";
    } else {
        echo "Error occurred";
    }

} else if($clientData['formId'] === "client_primary_info_form") {
    if (updateClientDetails($clientData)) {
        echo "Updated Successfully";
    } else {
        echo "Error occurred";
    }
}

