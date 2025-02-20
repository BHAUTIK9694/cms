<?php
// Initialize $clientHostingData as an empty array in case no client ID is provided or data is not found
$clientHostingData = [];
include "partials/sql-connction.php";

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

    $clientHostingData = $data; // Return the fetched data (or null if not found)

} catch (Exception $e) {
    echo "Error getting domain/hosting info: " . $e->getMessage();
    
}

// $clientHostingData = getClientHostingAndDomain($clientId);
if ($clientHostingData === false) { // Handle database error
    $clientHostingData = []; // Treat as no data if there's an error
    echo "Error retrieving client data. Displaying empty form.";
} elseif ($clientHostingData === null) {  //if client id is not found in database.
    echo "No client data found. Displaying empty form.";
    $clientHostingData = [];
}


?>

<div class="client-container-outer-674pl">
    <form action="DomainDB.php" method="POST" id="client_hosting_and_domain" style="width: 95%;">
        <!-- Hosting Information -->
        <div class="primary-container-0989kl">
            <div class="outer-box-1">

                <!-- Primary Information -->
                <div class="box" id="box1">
                    <h2>Hosting Registrar</h2>
                    <div class="form-input">
                        <!-- <label for="client-id">Client ID:</label> -->
                        <input type="hidden" id="client-id" name="client_id" value="<?php echo $clientId; ?>">
                    </div>
                    <div class="form-input">
                        <input type="text" id="hosting_provider" name="hosting_provider"
                            placeholder="Enter Hosting Provider"
                            value="<?php echo $clientHostingData['hosting_provider'] ?>">
                        <label for="hosting-provider">Hosting Provider:</label>

                    </div>
                    <div class="form-input">
                        <input type="text" id="hosting_plan" name="hosting_plan" placeholder="Enter Hosting Plan"
                            value="<?php echo $clientHostingData['hosting_plan'] ?>">
                        <label for="hosting-plan">Hosting Plan:</label>
                    </div>
                    <div class="form-input">
                        <input type="date" id="hosting_start_date" name="hosting_start_date"
                            placeholder="Enter Hosting Start Date"
                            value="<?php echo $clientHostingData['hosting_start_date'] ?>">
                        <label for="hosting-start-date">Hosting Start Date:</label>
                    </div>
                    <div class="form-input">
                        <input type="date" id="hosting_renewal_date" name="hosting_renewal_date"
                            placeholder="Enter Hosting Renewal Date"
                            value="<?php echo $clientHostingData['hosting_renewal_date'] ?>">
                        <label for="hosting-renewal-date">Hosting Renewal Date:</label>
                    </div>
                    <div class="form-input">
                        <input type="number" id="hosting_cost" name="hosting_cost" placeholder="Enter Hosting Cost"
                            value="<?php echo $clientHostingData['hosting_cost'] ?>">
                        <label for="hosting-cost">Hosting Cost:</label>
                    </div>
                    <div class="form-input">
                        <input type="text" id="ip_address" name="ip_address" placeholder="Enter IP Address"
                            value="<?php echo $clientHostingData['ip_address'] ?>">
                        <label for="IP-address">IP Address:</label>
                    </div>
                </div>

                <!-- SSL Registration form -->
                <div class="box" id="box3">
                    <h2>SSL Registrar</h2>
                    <div class="form-input">
                        <!-- <label for="client-id">Client ID:</label> -->
                        <!-- <input type="hidden" id="client" name="client" placeholder="Enter Client ID"> -->
                    </div>
                    <div class="form-input">
                        <input type="text" id="ssl_provider" name="ssl_provider" placeholder="Enter SSL Provider"
                            value="<?php echo $clientHostingData['ssl_provider'] ?>">
                        <label for="ssl-provider">SSL Provider:</label>
                    </div>
                    <div class="form-input">
                        <input type="date" id="ssl_expiry_date" name="ssl_expiry_date"
                            placeholder="Enter SSL Expiry Date"
                            value="<?php echo $clientHostingData['ssl_expiry_date'] ?>">
                        <label for="ssl-expiry-date">SSL Expiry Date:</label>
                    </div>
                    <div class="form-input">
                        <input type="date" id="ssl_installation_date" name="ssl_installation_date"
                            placeholder="Enter SSL Installation Date"
                            value="<?php echo $clientHostingData['ssl_installation_date'] ?>">
                        <label for="ssl-installation-date">SSL Installation Date:</label>
                    </div>
                    <div class="form-input">
                        <input type="text" id="billing_frequency" name="ssl_billing_frequency"
                            placeholder="Enter Billing Frequency"
                            value="<?php echo $clientHostingData['ssl_billing_frequency'] ?>">
                        <label for="billing_frequency">Billing Frequency:</label>
                    </div>
                    <div class="form-input">
                        <input type="date" id="last_payment_date" name="ssl_last_payment_date"
                            placeholder="Enter Last Payment Date"
                            value="<?php echo $clientHostingData['ssl_last_payment_date'] ?>">
                        <label for="last-payment-date">Last Payment Date:</label>
                    </div>
                    <div class="form-input">
                        <input type="date" id="next_billing_date" name="ssl_next_billing_date"
                            placeholder="Enter Next Billing Date"
                            value="<?php echo $clientHostingData['ssl_next_billing_date'] ?>">
                        <label for="next-billing-date">Next Billing Date:</label>
                    </div>
                    <div class="form-input">
                        <input type="number" id="total_amount_due" name="ssl_total_amount_due"
                            placeholder="Enter Total Amount Due"
                            value="<?php echo $clientHostingData['ssl_total_amount_due'] ?>">
                        <label for="total-amount-due">Total Amount Due:</label>
                    </div>
                    <div class="form-input">
                        <input type="text" id="payment_method" name="ssl_payment_method"
                            placeholder="Enter Payment Method" value="<?php echo $clientHostingData['ssl_payment_method'] ?>">
                        <label for="payment-method">Payment Method:</label>
                    </div>
                </div>
            </div>
            <div class="outer-box-2">


                <!-- Domain Registration form -->
                <div class="box" id="box3">
                    <h2>Domain Registrar</h2>
                    <div class="form-input">
                        <!-- <label for="client-id">Client ID:</label> -->
                        <!-- <input type="hidden" id="client" name="client" placeholder="Enter client ID"> -->
                    </div>
                    <div class="form-input">
                        <input type="text" id="domain_name" name="domain_name" placeholder="Enter Domain Name" value="<?php echo $clientHostingData['domain_name'] ?>">
                        <label for="domain-name">Domain Name:</label>
                    </div>
                    <div class="form-input">
                        <input type="date" id="domain_registration_date" name="domain_registration_date"
                            placeholder="Enter Domain Registration Date" value="<?php echo $clientHostingData['domain_registration_date'] ?>">
                        <label for="domain-registration-date">Domain Registration Date:</label>
                    </div>
                    <div class="form-input">
                        <input type="date" id="domain_expiry_date" name="domain_expiry_date"
                            placeholder="Enter Domain Expiry Date" value="<?php echo $clientHostingData['domain_expiry_date'] ?>">
                        <label for="domain-expiry-date">Domain Expiry Date:</label>
                    </div>
                    <div class="form-input">
                        <input type="number" id="domain_cost" name="doman_cost" placeholder="Enter Domain Cost" value="<?php echo $clientHostingData['domain_cost'] ?>">
                        <label for="domain-cost">Domain Cost:</label>
                    </div>
                </div>

                <div class="box" id="box3">
                    <h2>Hosting Billing</h2>
                    <div class="form-input">
                        <!-- <label for="client-id">Client ID:</label> -->
                        <!-- <input type="hidden" id="client" name="client" placeholder="Enter Client ID"> -->
                    </div>
                    <div class="form-input">
                        <input type="text" id="billing_frequency" name="hosting_billing_frequency"
                            placeholder="Enter Billing Frequency" value="<?php echo $clientHostingData['hosting_billing_frequency'] ?>">
                        <label for="billing_frequency">Billing Frequency:</label>
                    </div>
                    <div class="form-input">
                        <input type="date" id="last_payment_date" name="hosting_last_payment_date"
                            placeholder="Enter Last Payment Date" value="<?php echo $clientHostingData['hosting_last_payment_date'] ?>">
                        <label for="last-payment-date">Last Payment Date:</label>
                    </div>
                    <div class="form-input">
                        <input type="date" id="next_billing_date" name="hosting_next_billing_date"
                            placeholder="Enter Next Billing Date" value="<?php echo $clientHostingData['hosting_next_billing_date'] ?>">
                        <label for="next-billing-date">Next Billing Date:</label>
                    </div>
                    <div class="form-input">
                        <input type="number" id="total_amount_due" name="hosting_total_amount_due"
                            placeholder="Enter Total Amount Due" value="<?php echo $clientHostingData['hosting_total_amount_due'] ?>">
                        <label for="total-amount-due">Total Amount Due:</label>
                    </div>
                    <div class="form-input">
                        <input type="text" id="payment_method" name="hosting_payment_method"
                            placeholder="Enter Payment Method" value="<?php echo $clientHostingData['hosting_payment_method'] ?>">
                        <label for="payment-method">Payment Method:</label>
                    </div>
                </div>
                <div class="box" id="box3">
                    <h2>Domain Billing</h2>
                    <div class="form-input">
                        <!-- <label for="client-id">Client ID:</label> -->
                        <!-- <input type="hidden" id="client" name="client" placeholder="Enter Client ID"> -->
                    </div>
                    <div class="form-input">
                        <input type="text" id="billing_frequency" name="domain_billing_frequency"
                            placeholder="Enter Billing Frequency" value="<?php echo $clientHostingData['domain_billing_frequency'] ?>">
                        <label for="billing_frequency">Billing Frequency:</label>
                    </div>
                    <div class="form-input">
                        <input type="date" id="last_payment_date" name="domain_last_payment_date"
                            placeholder="Enter Last Payment Date" value="<?php echo $clientHostingData['domain_last_payment_date'] ?>">
                        <label for="last-payment-date">Last Payment Date:</label>
                    </div>
                    <div class="form-input">
                        <input type="date" id="next_billing_date" name="domain_next_billing_date"
                            placeholder="Enter Next Billing Date" value="<?php echo $clientHostingData['domain_next_billing_date'] ?>">
                        <label for="next-billing-date">Next Billing Date:</label>
                    </div>
                    <div class="form-input">
                        <input type="number" id="total_amount_due" name="domain_total_amount_due"
                            placeholder="Enter Total Amount Due" value="<?php echo $clientHostingData['domain_total_amount_due'] ?>">
                        <label for="total-amount-due">Total Amount Due:</label>
                    </div>
                    <div class="form-input">
                        <input type="text" id="payment_method" name="domain_payment_method"
                            placeholder="Enter Payment Method" value="<?php echo $clientHostingData['domain_payment_method'] ?>">
                        <label for="payment-method">Payment Method:</label>
                    </div>
                </div>


            </div>



        </div>
        <!-- Save Button -->
        <div class="save-btn">
            <div>
                <button name="btn" type="button" id="save-hosting-and-domain-btn">Save</button>
            </div>
        </div>
    </form>

</div>