<?php

include "partials/sql-connction.php";
?>


<div class="cms-task-sub-header">
    <div class="cms-proj-filter-div">

    </div>
    <div class="cms-proj-add-btn-div">
        <button class="cms-proj-filter-btn" onclick="openteamPopup()">Add Team</button>
    </div>
</div>

<div class="table-container">
    <table class="Team-table" id="Team-table">
        <thead>
            <tr>
                <th>Task Name </th>
                <th>Action</th>
            </tr>
        </thead>

    </table>
</div>


<!-- The Popup Form -->
<div class=" popup-overlay popupteam-overlay" onclick="closeteamPopup()">
</div>
<div class="popup-form Teamform">
    <form action="Team.php" method="POST">


        <div class="custom-select-category">
            <label for="category" class="form-label">Category</label>
            <select name="category" id="category" class="form-control" required>

                <option value="Development">Development</option>
                <option value="Design">Design</option>
                <option value="Research">Research</option>
                <option value="Marketing">Marketing</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Submit</button>
        <button type="button" class="btn btn-success" onclick="closeteamPopup()">Cancel</button>
    </form>
</div>
<script>
    // Function to open the popup form
    function openteamPopup() {
        // Get the popup overlay and form elements
        var overlay = document.querySelector(".popupteam-overlay");
        var form = document.querySelector(".Teamform");

        // Show the overlay and the form
        overlay.style.display = "block";
        form.style.display = "block";
    }

    // Function to close the popup form
    function closeteamPopup() {
        // Get the popup overlay and form elements
        var overlay = document.querySelector(".popupteam-overlay");
        var form = document.querySelector(".Teamform");
        console.log(form);

        // Hide the overlay and the form
        overlay.style.display = "none";
        form.style.display = "none";
    }
</script>