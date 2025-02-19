<?php

$servername = "localhost"; // or "127.0.0.1"
$username = "root";        // your MySQL username
$password = "";            // your MySQL password
$dbname = "client_manager"; // your database name
$port = "3306"; // your MySQL server port

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname, $port);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


function getClientDataForTable()
{
    global $conn;

    try {
        $sql = "
            SELECT 
                client_id,
                client_name,  
                business_name,
                website, 
                state,
                country,
                time_zone,  
                business_category 
            FROM client_primaryinfo; 
        ";

        $result = $conn->query($sql);

        if ($result) {
            $results = [];
            while ($row = $result->fetch_assoc()) {
                $results[] = $row;
            }
            $result->free_result();
            return $results;
        } else {
            echo "Error retrieving client data: " . $conn->error;
            return false;
        }

    } catch (Exception $e) {
        echo "Error retrieving client data: " . $e->getMessage();
        return false;
    }
}

function getAllClientDetails($clientId)
{
    global $conn; // Assuming $conn is your MySQLi connection object

    try {
        $stmt = $conn->prepare("
            SELECT *
            FROM client_primaryinfo
            WHERE client_id = ?;
        ");

        if (!$stmt) {
            throw new Exception($conn->error); // Handle prepare errors
        }

        $stmt->bind_param("i", $clientId); // "i" indicates integer
        $stmt->execute();

        $result = $stmt->get_result(); // Get the result set
        $clientDetails = $result->fetch_assoc(); // Fetch a single row as an associative array

        $stmt->close();
        return $clientDetails;

    } catch (Exception $e) {
        echo "Error retrieving client details: " . $e->getMessage();
        return false;
    }
}

function getClientsPrimaryInfo($clientId)
{
    global $conn;

    try {
        $stmt = $conn->prepare("
            SELECT *
            FROM client_primaryinfo
            WHERE client_id = ?; 
        ");

        if (!$stmt) {
            throw new Exception($conn->error); // Handle prepare error
        }

        $stmt->bind_param("i", $clientId); // "i" for integer client_id
        $stmt->execute();

        $result = $stmt->get_result(); // Get the result set

        if ($result) {
            $clientDetails = $result->fetch_assoc(); // Fetch a single row
            $result->free_result(); // Free result set
            $stmt->close();
            return $clientDetails;
        } else {
            echo "Error retrieving client details: " . $conn->error;
            $stmt->close();
            return false;
        }

    } catch (Exception $e) {
        echo "Error retrieving client details: " . $e->getMessage();
        return false;
    }
}

function getClientHostingAndDomain($clientId)
{
    $servername = "localhost"; // or "127.0.0.1"
    $username = "root";        // your MySQL username
    $password = "";            // your MySQL password
    $dbname = "client_manager"; // your database name
    $port = "3306"; // your MySQL server port

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname, $port);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    try {
        $stmt = $conn->prepare("SELECT * FROM client_domain_hosting WHERE client_id = ?");
        if (!$stmt) {
            throw new Exception($conn->error);
        }

        $stmt->bind_param("i", $clientId);
        $stmt->execute();

        $result = $stmt->get_result();
        $data = $result->fetch_assoc(); // Fetch the first row as an associative array

        $stmt->close();

        return $data; // Return the fetched data (or null if not found)

    } catch (Exception $e) {
        echo "Error getting domain/hosting info: " . $e->getMessage();
        return null;
    }
}


function addClient($client_name, $business_name, $website_url)
{
    global $conn;

    try {
        $conn->begin_transaction();

        $stmt = $conn->prepare("INSERT INTO client_primaryinfo (client_name, business_name, website) VALUES (?, ?, ?)");
        if (!$stmt) {
            throw new Exception($conn->error);
        }

        $stmt->bind_param("sss", $client_name, $business_name, $website_url); // "sss" for three strings

        $stmt->execute();

        if ($stmt->affected_rows > 0) { // Check if any rows were inserted
            $client_id = $stmt->insert_id; // Get the last inserted ID
            $stmt->close();

            // Insert into client_domain_hosting
            $stmt = $conn->prepare("INSERT INTO client_domain_hosting (client_id) VALUES (?)");
            if (!$stmt) {
                throw new Exception($conn->error);
            }
            $stmt->bind_param("i", $client_id);
            $stmt->execute();
            $stmt->close();

            // Insert into client_upload
            $stmt = $conn->prepare("INSERT INTO client_uploads (client_id) VALUES (?)");
            if (!$stmt) {
                throw new Exception($conn->error);
            }
            $stmt->bind_param("i", $client_id);
            $stmt->execute();
            $stmt->close();

            // Commit the transaction if all inserts are successful
            $conn->commit();
            return true;
        } else {
            $conn->rollback();
            $stmt->close();
            return false; // No rows inserted (could be a duplicate key issue)
        }


    } catch (Exception $e) {
        $conn->rollback();
        echo "Error adding client: " . $e->getMessage();
        return false;
    }

}

function updateClientDetails($clientData)
{
    global $conn;
    // 1. Get the array of phone numbers from $_POST:
    $phoneNumbers = $clientData['phone[]'] ?? [];  // Use the null coalescing operator in case 'phone' is not set.

    if (is_array($phoneNumbers)) {
        // 2. Convert the array to a comma-separated string:
        $otherBusinessNumbersString = implode(",", $phoneNumbers);
    } else {
        $otherBusinessNumbersString = $phoneNumbers;
    }

    try {
        $conn->begin_transaction();

        $stmt = $conn->prepare("
            UPDATE client_primaryinfo 
            SET 
                business_name = ?,
                website = ?,
                business_category = ?,
                short_description = ?,
                long_description = ?,
                business_number = ?,
                other_business_number = ?,
                mobile = ?,
                fax = ?,
                toll_free = ?,
                country = ?,
                address = ?,
                city = ?,
                state = ?,
                zip_code = ?,
                time_zone = ?,
                map_link = ?,
                booking_link = ?,
                services_offered = ?,
                brands_carried = ?
            WHERE client_id = ?;
        ");

        if (!$stmt) {
            throw new Exception($conn->error);
        }

        $stmt->bind_param(
            "ssssssssssssssssssssi",
            $clientData['business_name'],
            $clientData['website'],
            $clientData['business_category'],
            $clientData['short_description'],
            $clientData['long_description'],
            $clientData['business_number'],
            $otherBusinessNumbersString,
            $clientData['mobile'],
            $clientData['fax'],
            $clientData['toll_free'],
            $clientData['country'],
            $clientData['address'],
            $clientData['city'],
            $clientData['state'],
            $clientData['zip'],
            $clientData['time_zone'],
            $clientData['map'],
            $clientData['booking_link'],
            $clientData['services_offered'],
            $clientData['brand_carried'],
            $clientData['client_id']
        );

        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            $conn->commit();
            $stmt->close();
            return true;
        } else {
            $conn->rollback();
            $stmt->close();
            return false; // No rows were updated
        }

    } catch (Exception $e) {
        $conn->rollback();
        echo "Error updating client info: " . $e->getMessage();
        return false;
    }
}


function updateClientSocialLinks($clientData)
{
    global $conn;

    try {
        $conn->begin_transaction();

        $stmt = $conn->prepare("
            UPDATE client_primaryinfo 
            SET 
                facebook = ?,
                twitter = ?,
                instagram = ?,
                linkedin = ?,
                youtube = ?,
                custom_link = ?
            WHERE client_id = ?;
        ");

        if (!$stmt) {
            throw new Exception($conn->error);
        }

        $stmt->bind_param(
            "ssssssi",
            $clientData['facebook'],
            $clientData['twitter'],
            $clientData['instagram'],
            $clientData['linkedin'],
            $clientData['youtube'],
            $clientData['custom_link'],
            $clientData['client_id']
        );

        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            $conn->commit();
            $stmt->close();
            return true;
        } else {
            $conn->rollback();
            $stmt->close();
            return false; // No rows were updated (client_id might not exist)
        }

    } catch (Exception $e) {
        $conn->rollback();
        echo "Error updating social links: " . $e->getMessage();
        return false;
    }
}


function updateClientDomainHosting($clientData)
{
    global $conn;

    try {
        $conn->begin_transaction();

        $stmt = $conn->prepare("
            UPDATE client_domain_hosting 
            SET 
                hosting_provider = ?,
                hosting_plan = ?,
                hosting_start_date = ?,
                hosting_renewal_date = ?,
                hosting_cost = ?,
                ip_address = ?,
                ssl_provider = ?,
                ssl_expiry_date = ?,
                ssl_installation_date = ?,
                ssl_billing_frequency = ?,
                ssl_last_payment_date = ?,
                ssl_next_billing_date = ?,
                ssl_total_amount_due = ?,
                ssl_payment_method = ?,
                domain_name = ?,
                domain_registration_date = ?,
                domain_expiry_date = ?,
                domain_cost = ?,
                hosting_billing_frequency = ?,
                hosting_last_payment_date = ?,
                hosting_next_billing_date = ?,
                hosting_total_amount_due = ?,
                hosting_payment_method = ?,
                domain_billing_frequency = ?,
                domain_last_payment_date = ?,
                domain_next_billing_date = ?,
                domain_total_amount_due = ?,
                domain_payment_method = ?
            WHERE client_id = ?;
        ");

        if (!$stmt) {
            throw new Exception($conn->error);
        }

        $stmt->bind_param(
            "ssssssssssssssssssssssssssssi",
            $clientData['hosting_provider'],
            $clientData['hosting_plan'],
            $clientData['hosting_start_date'],
            $clientData['hosting_renewal_date'],
            $clientData['hosting_cost'],
            $clientData['ip_address'],
            $clientData['ssl_provider'],
            $clientData['ssl_expiry_date'],
            $clientData['ssl_installation_date'],
            $clientData['ssl_billing_frequency'],
            $clientData['ssl_last_payment_date'],
            $clientData['ssl_next_billing_date'],
            $clientData['ssl_total_amount_due'],
            $clientData['ssl_payment_method'],
            $clientData['domain_name'],
            $clientData['domain_registration_date'],
            $clientData['domain_expiry_date'],
            $clientData['doman_cost'], // Corrected typo here
            $clientData['hosting_billing_frequency'],
            $clientData['hosting_last_payment_date'],
            $clientData['hosting_next_billing_date'],
            $clientData['hosting_total_amount_due'],
            $clientData['hosting_payment_method'],
            $clientData['domain_billing_frequency'],
            $clientData['domain_last_payment_date'],
            $clientData['domain_next_billing_date'],
            $clientData['domain_total_amount_due'],
            $clientData['domain_payment_method'],
            $clientData['client_id']
        );

        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            $conn->commit();
            $stmt->close();
            return true;
        } else {
            $conn->rollback();
            $stmt->close();
            return false; // No rows were updated (client_id might not exist or data is the same)
        }

    } catch (Exception $e) {
        $conn->rollback();
        echo "Error updating domain/hosting info: " . $e->getMessage();
        return false;
    }
}
