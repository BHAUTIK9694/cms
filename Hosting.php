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
<?php
if (isset($_SESSION['success'])) {
    echo "<div class='success-message'>" . $_SESSION['success'] . "</div>";
    unset($_SESSION['success']);
}

if (isset($_SESSION['error'])) {
    echo "<div class='error-message'>" . $_SESSION['error'] . "</div>";
    unset($_SESSION['error']);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="public/css/AddClient.css">
    <link rel="stylesheet" href="public/css/navbar.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <?php
    include 'partials/navbar.php';
    include 'partials/AddClientNav.php';
    ?>
    <div>
        <h1><?php echo $clientId ?></h1>
        <form action="DomainDB.php" method="POST">
            <!-- Hosting Information -->
            <div class="container">
                <!-- Primary Information -->
                <div class="box" id="box1">
                    <h2>Hosting Registrar</h2>
                    <div class="form-group">
                        <!-- <label for="client-id">Client ID:</label> -->
                        <input type="hidden" id="client-id" name="client_id" value="<?php echo $clientId; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="hosting-provider">Hosting Provider:</label>
                        <input type="text" id="hosting_provider" name="hosting_provider" placeholder="Enter Hosting Provider">

                    </div>
                    <div class="form-group">
                        <label for="hosting-plan">Hosting Plan:</label>
                        <input type="text" id="hosting_plan" name="hosting_plan" placeholder="Enter Hosting Plan" required>
                    </div>
                    <div class="form-group">
                        <label for="hosting-start-date">Hosting Start Date:</label>
                        <input type="date" id="hosting_start_date" name="hosting_start_date" placeholder="Enter Hosting Start Date" required>
                    </div>
                    <div class="form-group">
                        <label for="hosting-renewal-date">Hosting Renewal Date:</label>
                        <input type="date" id="hosting_renewal_date" name="hosting_renewal_date" placeholder="Enter Hosting Renewal Date" required>
                    </div>
                    <div class="form-group">
                        <label for="hosting-cost">Hosting Cost:</label>
                        <input type="text" id="hosting_cost" name="hosting_cost" placeholder="Enter Hosting Cost" required>
                    </div>
                    <div class="form-group">
                        <label for="IP-address">IP Address:</label>
                        <input type="text" id="ip_address" name="ip_address" placeholder="Enter IP Address" required>
                    </div>
                </div>



                <!-- Domain Registration form -->
                <div class="box" id="box3">
                    <h2>Domain Registrar</h2>
                    <div class="form-group">
                        <!-- <label for="client-id">Client ID:</label> -->
                        <input type="hidden" id="client" name="client" placeholder="Enter client ID" required>
                    </div>
                    <div class="form-group">
                        <label for="domain-name">Domain Name:</label>
                        <input type="text" id="domain_name" name="domain_name" placeholder="Enter Domain Name" required>
                    </div>
                    <div class="form-group">
                        <label for="domain-registration-date">Domain Registration Date:</label>
                        <input type="date" id="domain_registration_date" name="domain_registration_date" placeholder="Enter Domain Registration Date" required>
                    </div>
                    <div class="form-group">
                        <label for="domain-expiry-date">Domain Expiry Date:</label>
                        <input type="date" id="domain_expiry_date" name="domain_expiry_date" placeholder="Enter Domain Expiry Date" required>
                    </div>
                    <div class="form-group">
                        <label for="domain-cost">Domain Cost:</label>
                        <input type="number" id="domain_cost" name="doman_cost" placeholder="Enter Domain Cost" required>
                    </div>
                </div>
                <!-- SSL Registration form -->
                <div class="box" id="box3">
                    <h2>SSL Registrar</h2>
                    <div class="form-group">
                        <!-- <label for="client-id">Client ID:</label> -->
                        <input type="hidden" id="client" name="client" placeholder="Enter Client ID" required>
                    </div>
                    <div class="form-group">
                        <label for="ssl-provider">SSL Provider:</label>
                        <input type="text" id="ssl_provider" name="ssl_provider" placeholder="Enter SSL Provider" required>
                    </div>
                    <div class="form-group">
                        <label for="ssl-expiry-date">SSL Expiry Date:</label>
                        <input type="date" id="ssl_expiry_date" name="ssl_expiry_date" placeholder="Enter SSL Expiry Date" required>
                    </div>
                    <div class="form-group">
                        <label for="ssl-installation-date">SSL Installation Date:</label>
                        <input type="date" id="ssl_installation_date" name="ssl_installation_date" placeholder="Enter SSL Installation Date" required>
                    </div>
                    <div class="form-group">
                        <label for="billing_frequency">Billing Frequency:</label>
                        <input type="text" id="billing_frequency" name="billing_frequency" placeholder="Enter Billing Frequency" required>
                    </div>
                    <div class="form-group">
                        <label for="last-payment-date">Last Payment Date:</label>
                        <input type="date" id="last_payment_date" name="last_payment_date" placeholder="Enter Last Payment Date" required>
                    </div>
                    <div class="form-group">
                        <label for="next-billing-date">Next Billing Date:</label>
                        <input type="date" id="next_billing_date" name="next_billing_date" placeholder="Enter Next Billing Date" required>
                    </div>
                    <div class="form-group">
                        <label for="total-amount-due">Total Amount Due:</label>
                        <input type="number" id="total_amount_due" name="total_amount_due" placeholder="Enter Total Amount Due" required>
                    </div>
                    <div class="form-group">
                        <label for="payment-method">Payment Method:</label>
                        <input type="text" id="payment_method" name="payment_method" placeholder="Enter Payment Method" required>
                    </div>
                </div>
                <div class="box" id="box3">
                    <h2>Billing</h2>
                    <div class="form-group">
                        <!-- <label for="client-id">Client ID:</label> -->
                        <input type="hidden" id="client" name="client" placeholder="Enter Client ID" required>
                    </div>
                    <div class="form-group">
                        <label for="billing_frequency">Billing Frequency:</label>
                        <input type="text" id="billing_frequency" name="billing_frequency" placeholder="Enter Billing Frequency" required>
                    </div>
                    <div class="form-group">
                        <label for="last-payment-date">Last Payment Date:</label>
                        <input type="date" id="last_payment_date" name="last_payment_date" placeholder="Enter Last Payment Date" required>
                    </div>
                    <div class="form-group">
                        <label for="next-billing-date">Next Billing Date:</label>
                        <input type="date" id="next_billing_date" name="next_billing_date" placeholder="Enter Next Billing Date" required>
                    </div>
                    <div class="form-group">
                        <label for="total-amount-due">Total Amount Due:</label>
                        <input type="number" id="total_amount_due" name="total_amount_due" placeholder="Enter Total Amount Due" required>
                    </div>
                    <div class="form-group">
                        <label for="payment-method">Payment Method:</label>
                        <input type="text" id="payment_method" name="payment_method" placeholder="Enter Payment Method" required>
                    </div>
                </div>
                <!-- Save Button -->
                <div class="save-btn">
                    <button name="btn" type="submit">Save</button>
                </div>
            </div>
        </form>
</body>

</html>