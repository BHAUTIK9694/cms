<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Layout</title>
    <link rel="stylesheet" href="public/css/AddClient.css">
    <link rel="stylesheet" href="public/css/navbar.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>

    </style>
</head>

<body>
    <?php
    include 'partials/navbar.php';
    include 'partials/AddClientNav.php';
    ?>
    <div>


        <form action="AddClientData.php" method="POST">
            <!-- <h1>Client Details</h1> -->
            <div class="container">
                <!-- Primary Information -->
                <div class="box" id="box1">
                    <h2>Primary Details</h2>
                    <div class="form-group">
                        <!-- <label for="client-id">Client ID:</label> -->
                        <input type="hidden" id="client-id" name="client_id" placeholder="Enter client ID" required>
                    </div>
                    <div class="form-group">
                        <label for="business-name">Business Name:</label>
                        <input type="text" id="business-name" name="business_name" placeholder="Enter business name"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="website">Website:</label>
                        <input type="url" id="website" name="website" placeholder="Enter website" required>
                    </div>
                    <div class="form-group">
                        <label for="business-category">Business Category:</label>
                        <div class="tag-input" id="business-category-container">
                            <input type="text" id="business-category" name="business_category[]"
                                placeholder="Add a category and press Enter">
                        </div>

                    </div>
                    <div class="form-group">
                        <label for="short-description">Short Description:</label>
                        <textarea id="short-description" name="short_description" rows="3"
                            placeholder="Enter short description" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="long-description">Long Description:</label>
                        <textarea id="long-description" name="long_description" rows="5"
                            placeholder="Enter long description" required></textarea>
                    </div>
                </div>

                <!-- Contact Information -->
                <div class="box" id="box2">
                    <h2>Contact Information</h2>

                    <div class="form-group">
                        <label for="phone">Business Number:</label>
                        <input type="tel" id="phone" name="phone[]" placeholder="Enter Business number" required>
                    </div>

                    <div id="additional-phones"></div>

                    <button type="button" id="add-phone-btn" class="add-btn">Business Number</button>

                    <div class="form-group">
                        <label for="mobile">Mobile:</label>
                        <input type="tel" id="mobile" name="mobile" placeholder="Enter mobile number" required>
                    </div>
                    <div class="form-group">
                        <label for="fax">Fax:</label>
                        <input type="text" id="fax" name="fax" placeholder="Enter fax number" required>
                    </div>
                    <div class="form-group">
                        <label for="toll-free">Toll-Free:</label>
                        <input type="text" id="toll-free" name="toll_free" placeholder="Enter toll-free number"
                            required>
                    </div>
                </div>

                <!-- Location Information -->
                <div class="box" id="box3">
                    <h2>Location Information</h2>
                    <div class="form-group">
                        <label for="country">Country:</label>
                        <input type="text" id="country" name="country" placeholder="Enter country" required>
                    </div>
                    <div class="form-group">
                        <label for="address">Address:</label>
                        <input type="text" id="address" name="address" placeholder="Enter address" required>
                    </div>
                    <div class="form-group">
                        <label for="city">City:</label>
                        <input type="text" id="city" name="city" placeholder="Enter city" required>
                    </div>
                    <div class="form-group">
                        <label for="state">State:</label>
                        <input type="text" id="state" name="state" placeholder="Enter state" required>
                    </div>
                    <div class="form-group">
                        <label for="zip">Zip Code:</label>
                        <input type="text" id="zip" name="zip" placeholder="Enter zip code" required>
                    </div>
                    <div class="form-group">
                        <label for="time-zone">Time Zone:</label>
                        <input type="text" id="time-zone" name="time_zone" placeholder="Enter time zone" required>
                    </div>
                    <div class="form-group">
                        <label for="map">Map:</label>
                        <input type="url" id="map" name="map" placeholder="Enter map link" required>
                    </div>
                </div>

                <!-- Operation Information -->
                <div class="box" id="box4">
                    <h2>Operation Information</h2>
                    <div class="form-group">
                        <label for="booking-link">Booking Link:</label>
                        <input type="url" id="booking-link" name="booking_link" placeholder="Enter booking link"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="services-offered">Services Offered:</label>
                        <div class="tag-input" id="services-container">
                            <input type="text" id="service-input" name="services_offered[]"
                                placeholder="Add a service and press Enter">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="brands-carried">Brands Carried:</label>
                        <div class="tag-input" id="brands-container">
                            <input type="text" id="brand-input" name="brands_carried[]"
                                placeholder="Add a brand and press Enter">
                        </div>
                    </div>
                </div>

                <!-- Save Button -->
                <div class="save-btn">
                    <button name="btn" type="submit">Save</button>
                </div>
            </div>
        </form>


        <script>
            // Business Category:

            document.addEventListener("DOMContentLoaded", () => {
                function handleTagInput(inputId, containerId) {
                    const input = document.getElementById(inputId);
                    const container = document.getElementById(containerId);

                    input.addEventListener("keypress", (e) => {
                        if (e.key === "Enter" && input.value.trim() !== "") {
                            e.preventDefault();
                            addTag(input.value.trim(), container);
                            input.value = "";
                        }
                    });
                }

                function addTag(value, container) {
                    const tagElement = document.createElement("span");
                    tagElement.classList.add("tag");
                    tagElement.textContent = value;


                    const removeTag = document.createElement("span");
                    removeTag.textContent = "×";
                    removeTag.classList.add("remove-tag");
                    removeTag.addEventListener("click", () => tagElement.remove());

                    tagElement.appendChild(removeTag);
                    container.appendChild(tagElement);
                }

                handleTagInput("business-category", "business-category-container");
                handleTagInput("service-input", "services-container");
                handleTagInput("brand-input", "brands-container");
            });

            // Business Phone:
            document.getElementById("add-phone-btn").addEventListener("click", function() {
                const additionalPhonesContainer = document.getElementById("additional-phones");
                const phoneCount = additionalPhonesContainer.children.length + 1;

                const newPhoneInput = document.createElement("div");
                newPhoneInput.classList.add("form-group");
                newPhoneInput.innerHTML = `
            <label for="phone-${phoneCount}">Other Business Number:</label>
            <input type="tel" id="phone-${phoneCount}" name="phone[]" placeholder="Enter Other Business number" required>
            <button type="button" class="remove-btn" onclick="this.parentElement.remove()">Remove</button>
        `;

                additionalPhonesContainer.appendChild(newPhoneInput);
            });
        </script>
</body>

</html>