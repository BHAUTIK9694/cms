<?php


$clientId = $_GET['Id'] ?? null;

// Initialize $clientData as an empty array in case no client ID is provided or data is not found
$clientData = [];

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
        $clientData = $clientDetails;
    } else {
        echo "Error retrieving client details: " . $conn->error;
        $stmt->close();
    }

} catch (Exception $e) {
    echo "Error retrieving client details: " . $e->getMessage();
}


if ($clientId) {
    // $clientData = getClientsPrimaryInfo($clientId);
    if ($clientData === false) { // Handle database error
        $clientData = []; // Treat as no data if there's an error
        echo "Error retrieving client data. Displaying empty form.";
    } elseif ($clientData === null) {  //if client id is not found in database.
        echo "No client data found. Displaying empty form.";
        $clientData = [];
    }
} else {
    echo "Client ID not provided. Displaying empty form.";
}

// echo "<pre>";
// print_r($clientData);
// echo "</pre>";
?>


<div class="client-container-outer-674pl">
    <form style="width: 95%;" id="client_primary_info_form">
        <!-- <h1>Client Details</h1> -->
        <div class="primary-container-0989kl">

            <div class="outer-box-1">
                <!-- Primary Information -->
                <div class="box" id="box1">
                    <h2>Primary Details</h2>
                    <div class="form-input">
                        <!-- <label for="client-id">Client ID:</label> -->
                        <input type="hidden" id="client-id" name="client_id" value="<?php echo $clientId; ?>">
                    </div>
                    <div class="form-input">
                        <input type="text" id="business-name" name="business_name" placeholder="Enter business name"
                            value="<?php echo $clientData['business_name'] ?? ''; ?>">
                        <label for="business-name">Business Name:</label>
                    </div>
                    <div class="form-input">
                        <input type="url" id="website" name="website" placeholder="Enter website"
                            value="<?php echo $clientData['website'] ?? ''; ?>">
                        <label for="website">Website:</label>
                    </div>
                    <div class="tag-container form-input-skill" name="business-category">
                        <div class="form-input">
                            <input type="text" class="tag-input" id="business-cat-tag-input" placeholder="Add tags"
                                onkeydown="addBusinessCatTag(event)">
                            <label for="business-category">Business Category</label>
                        </div>
                        <div class="tags" id="business-cat-tag-list">
                            <?php

                            // Example: Let's assume the business category string is stored in $businessCategoryString
                            $businessCategoryString = $clientData['business_category'] ?? ''; // Get from database or use empty string
                            
                            // Convert the comma-separated string to an array
                            $businessCategories = explode(",", $businessCategoryString);

                            // Remove any empty entries or extra whitespace from the array
                            $businessCategories = array_filter(array_map('trim', $businessCategories));
                            ?>
                            <?php if (!empty($businessCategories)): // Check if the array is not empty ?>
                                <?php foreach ($businessCategories as $category): ?>
                                    <div class="tag" style="background-color: rgb(0, 116, 116); color: rgb(255, 255, 255);">
                                        <span><?php echo htmlspecialchars($category); // Escape for safety ?></span>
                                        <button type="button" class="tag-close" onclick="removeBusinessCatTag(this)">×</button>
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>

                        <!-- <input type="hidden" name="business-cat-tags" id="hidden-business-cat-tags"> -->
                    </div>
                    <div class="form-input">
                        <textarea id="short-description" name="short_description" rows="3"
                            placeholder="Enter short description"><?php
                            $shortDescription = $clientData['short_description'] ?? '';
                            echo htmlspecialchars(trim($shortDescription)); // Trim and escape
                            ?></textarea>
                        <label for="short-description">Short Description:</label>
                    </div>
                    <div class="form-input">
                        <textarea id="long-description" name="long_description" rows="10"
                            placeholder="Enter long description"><?php
                            $longDescription = $clientData['long_description'] ?? '';
                            echo htmlspecialchars(trim($longDescription)); // Trim and escape
                            ?></textarea>
                        <label for="long-description">Long Description:</label>
                    </div>
                </div>

                <!-- Location Information -->
                <div class="box" id="box3">
                    <h2 style="margin-bottom: 20px;">Location Information</h2>
                    <div class="form-input">
                        <input type="text" id="country" name="country" placeholder="Enter country"
                            value="<?php echo $clientData['country'] ?? ''; ?>">
                        <label for="country">Country:</label>
                    </div>
                    <div class="form-input">
                        <input type="text" id="address" name="address" placeholder="Enter address"
                            value="<?php echo $clientData['address'] ?? ''; ?>">
                        <label for="address">Address:</label>
                    </div>
                    <div class="form-input">
                        <input type="text" id="city" name="city" placeholder="Enter city"
                            value="<?php echo $clientData['city'] ?? ''; ?>">
                        <label for="city">City:</label>
                    </div>
                    <div class="form-input">
                        <input type="text" id="state" name="state" placeholder="Enter state"
                            value="<?php echo $clientData['state'] ?? ''; ?>">
                        <label for="state">State:</label>
                    </div>
                    <div class="form-input">
                        <input type="text" id="zip" name="zip" placeholder="Enter zip code"
                            value="<?php echo $clientData['zip_code'] ?? ''; ?>">
                        <label for="zip">Zip Code:</label>
                    </div>
                    <div class="form-input">
                        <input type="text" id="time-zone" name="time_zone" placeholder="Enter time zone"
                            value="<?php echo $clientData['time_zone'] ?? ''; ?>">
                        <label for="time-zone">Time Zone:</label>
                    </div>
                    <div class="form-input">
                        <input type="url" id="map" name="map" placeholder="Enter map link"
                            value="<?php echo $clientData['map_link'] ?? ''; ?>">
                        <label for="map">Map:</label>
                    </div>
                </div>

            </div>


            <div class="outer-box-1">
                <!-- Contact Information -->
                <div class="box" id="box2">
                    <h2 style="margin-bottom: 20px;">Contact Information</h2>

                    <div class="form-input">
                        <input type="tel" id="phone" name="business_number" placeholder="Enter Business number"
                            value="<?php echo $clientData['business_number'] ?? ''; ?>">
                        <label for="phone">Business Number:</label>
                    </div>

                    <div id="additional-phones">
                        <?php

                        // Get the other business numbers string from the database
                        $otherBusinessNumbersString = $clientData['other_business_number'] ?? '';

                        // Check if it's a string (single number or comma-separated numbers)
                        if (is_string($otherBusinessNumbersString) && !empty($otherBusinessNumbersString)) {
                            // Split into an array if there are commas (multiple numbers)
                            if (strpos($otherBusinessNumbersString, ",") !== false) {
                                $otherBusinessNumbers = explode(",", $otherBusinessNumbersString);
                            } else {
                                $otherBusinessNumbers = [$otherBusinessNumbersString]; // Single number, create a one-element array
                            }

                            // Clean up: Remove empty entries and whitespace
                            $otherBusinessNumbers = array_filter(array_map('trim', $otherBusinessNumbers));
                        } else {
                            $otherBusinessNumbers = []; // No numbers provided, initialize as empty array
                        }
                        ?>

                        <?php if (!empty($otherBusinessNumbers)): ?>
                            <?php foreach ($otherBusinessNumbers as $index => $number): ?>
                                <div class="phone-container">
                                    <div class="newBusinessNumber form-input">
                                        <input type="tel" id="phone-<?php echo $index + 1; ?>" name="phone[]"
                                            placeholder="Enter Other Business number"
                                            value="<?php echo htmlspecialchars($number); ?>" required>
                                        <label for="phone-<?php echo $index + 1; ?>">Other Business Number</label>
                                    </div>
                                    <button type="button" class="remove-btn"
                                        onclick="removePhoneContainer(this)">Remove</button>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>

                    </div>

                    <button type="button" id="add-phone-btn" class="add-btn">Business Number</button>

                    <div class="form-input">
                        <input type="tel" id="mobile" name="mobile" placeholder="Enter mobile number"
                            value="<?php echo $clientData['mobile'] ?? ''; ?>">
                        <label for="mobile">Mobile:</label>
                    </div>
                    <div class="form-input">
                        <input type="text" id="fax" name="fax" placeholder="Enter fax number"
                            value="<?php echo $clientData['fax'] ?? ''; ?>">
                        <label for="fax">Fax:</label>
                    </div>
                    <div class="form-input">
                        <input type="text" id="toll-free" name="toll_free" placeholder="Enter toll-free number"
                            value="<?php echo $clientData['toll_free'] ?? ''; ?>">
                        <label for="toll-free">Toll-Free:</label>
                    </div>
                </div>
                <!-- Operation Information -->
                <div class="box" id="box4">
                    <h2 style="margin-bottom: 20px;">Operation Information</h2>
                    <div class="form-input">
                        <input type="url" id="booking-link" name="booking_link" placeholder="Enter booking link"
                            value="<?php echo $clientData['booking_link'] ?? ''; ?>">
                        <label for="booking-link">Booking Link:</label>
                    </div>


                    <div class="tag-container form-input-skill" name="services-offered">
                        <div class="form-input">
                            <input type="text" class="tag-input" id="services-offered-tag-input" placeholder="Add tags"
                                onkeydown="addServiceOfferedTag(event)">
                            <label for="services-offered">Services Offered</label>
                        </div>
                        <div class="tags" id="services-offered-tag-list">

                            <?php
                            $servicesOfferedString = $clientData['services_offered'] ?? ''; // Get from database
                            $servicesOffered = explode(",", $servicesOfferedString);
                            $servicesOffered = array_filter(array_map('trim', $servicesOffered));
                            ?>

                            <?php if (!empty($servicesOffered)): ?>
                                <?php foreach ($servicesOffered as $service): ?>
                                    <div class="tag" style="background-color: rgb(0, 116, 116); color: rgb(255, 255, 255);">
                                        <span><?php echo htmlspecialchars($service); ?></span>
                                        <button type="button" class="tag-close"
                                            onclick="removeServiceOfferedTag(this)">×</button>
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>

                        <!-- <input type="hidden" name="services-offered-tags" id="hidden-business-cat-tags"> -->
                    </div>

                    <!-- <div class="form-input">
                        <div class="tag-input" id="services-container">
                            <input type="text" id="service-input" name="services_offered[]"
                                placeholder="Add a service and press Enter">
                            <label for="services-offered">Services Offered:</label>
                        </div>
                    </div> -->
                    <div class="tag-container form-input-skill" name="brands-carried">
                        <div class="form-input">
                            <input type="text" class="tag-input" id="brands-carried-tag-input" placeholder="Add tags"
                                onkeydown="addBrandCarriedTag(event)">
                            <label for="brands-carried">Brands Carried</label>
                        </div>
                        <div class="tags" id="brands-carried-tag-list">

                            <?php
                            $brandsCarriedString = $clientData['brands_carried'] ?? ''; // Get from database
                            $brandsCarried = explode(",", $brandsCarriedString);
                            $brandsCarried = array_filter(array_map('trim', $brandsCarried));
                            ?>

                            <?php if (!empty($brandsCarried)): ?>
                                <?php foreach ($brandsCarried as $brand): ?>
                                    <div class="tag" style="background-color: rgb(0, 116, 116); color: rgb(255, 255, 255);">
                                        <span><?php echo htmlspecialchars($brand); ?></span>
                                        <button type="button" class="tag-close" onclick="removeBrandCarriedTag(this)">×</button>
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>

                        <!-- <input type="hidden" name="brands-carried-tags" id="hidden-business-cat-tags"> -->
                    </div>
                </div>

            </div>





        </div>
        <!-- Save Button -->
        <div class="save-btn">
            <div class="save-btn-container-6475i">
                <button name="btn" type="button" id="save-client-primaryInfo-btn">Save</button>
            </div>
        </div>
    </form>
</div>