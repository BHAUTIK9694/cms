<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hours</title>
    <link rel="stylesheet" href="public/css/navbar.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        /* General Styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #F1F1EC;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        h2 {
            color: #007474;
        }

        .working-hour-section {
            width: 90%;
            margin: 20px auto;
            background: #fff;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #007474;
            color: white;
        }

        input[type="time"],
        input[type="checkbox"] {
            padding: 5px;
            margin-right: 10px;
        }

        .app-all {
            background-color: #007474;
            color: white;
            padding: 5px 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .app-all:hover {
            background-color: #007474c3;
        }
    </style>
</head>

<body>
    <?php
    include 'partials/navbar.php';
    include 'partials/AddClientNav.php';
    ?>
    <section class="working-hour-section">

        <table>
            <tr>
                <th>Day</th>
                <th>Enable</th>
                <th>Start Time</th>
                <th>End Time</th>
                <th>Actions</th>
            </tr>
            <tr>
                <td>Monday</td>
                <td>
                    <input type="checkbox" id="monday_active" name="monday_active" onclick="toggleDay('monday')">
                </td>
                <td>
                    <input type="time" id="monday_start" name="monday_start" value="09:00" disabled>
                </td>
                <td>
                    <input type="time" id="monday_end" name="monday_end" value="18:00" disabled>
                </td>
                <td>
                    <button type="button" class="app-all" onclick="applyTimesToAll('monday')">Apply to All</button>
                </td>
            </tr>
            <tr>
                <td>Tuesday</td>
                <td>
                    <input type="checkbox" id="tuesday_active" name="tuesday_active" onclick="toggleDay('tuesday')">
                </td>
                <td>
                    <input type="time" id="tuesday_start" name="tuesday_start" value="09:00" disabled>
                </td>
                <td>
                    <input type="time" id="tuesday_end" name="tuesday_end" value="18:00" disabled>
                </td>
                <td>
                    <button class="app-all" type="button" onclick="applyTimesToAll('tuesday')">Apply to All</button>
                </td>
            </tr>
            <tr>
                <td>Wednesday</td>
                <td>
                    <input type="checkbox" id="wednesday_active" name="wednesday_active" onclick="toggleDay('wednesday')">
                </td>
                <td>
                    <input type="time" id="wednesday_start" name="wednesday_start" value="09:00" disabled>
                </td>
                <td>
                    <input type="time" id="wednesday_end" name="wednesday_end" value="18:00" disabled>
                </td>
                <td>
                    <button class="app-all" type="button" onclick="applyTimesToAll('wednesday')">Apply to All</button>
                </td>
            </tr>
            <tr>
                <td>Thursday</td>
                <td>
                    <input type="checkbox" id="thursday_active" name="thursday_active" onclick="toggleDay('thursday')">
                </td>
                <td>
                    <input type="time" id="thursday_start" name="thursday_start" value="09:00" disabled>
                </td>
                <td>
                    <input type="time" id="thursday_end" name="thursday_end" value="18:00" disabled>
                </td>
                <td>
                    <button class="app-all" type="button" onclick="applyTimesToAll('thursday')">Apply to All</button>
                </td>
            </tr>
            <tr>
                <td>Friday</td>
                <td>
                    <input type="checkbox" id="friday_active" name="friday_active" onclick="toggleDay('friday')">
                </td>
                <td>
                    <input type="time" id="friday_start" name="friday_start" value="09:00" disabled>
                </td>
                <td>
                    <input type="time" id="friday_end" name="friday_end" value="18:00" disabled>
                </td>
                <td>
                    <button class="app-all" type="button" onclick="applyTimesToAll('friday')">Apply to All</button>
                </td>
            </tr>
            <tr>
                <td>Saturday</td>
                <td>
                    <input type="checkbox" id="saturday_active" name="saturday_active" onclick="toggleDay('saturday')">
                </td>
                <td>
                    <input type="time" id="saturday_start" name="saturday_start" value="09:00" disabled>
                </td>
                <td>
                    <input type="time" id="saturday_end" name="saturday_end" value="18:00" disabled>
                </td>
                <td>
                    <button class="app-all" type="button" onclick="applyTimesToAll('saturday')">Apply to All</button>
                </td>
            </tr>
            <tr>
                <td>Sunday</td>
                <td>
                    <input type="checkbox" id="sunday_active" name="sunday_active" onclick="toggleDay('sunday')">
                </td>
                <td>
                    <input type="time" id="sunday_start" name="sunday_start" value="09:00" disabled>
                </td>
                <td>
                    <input type="time" id="sunday_end" name="sunday_end" value="18:00" disabled>
                </td>
                <td>
                    <button class="app-all" type="button" onclick="applyTimesToAll('sunday')">Apply to All</button>
                </td>
            </tr>
        </table>
    </section>
</body>
<script>
    // Function to toggle day inputs based on checkbox state
    function toggleDay(day) {
        const checkbox = document.getElementById(day + '_active');
        const startInput = document.getElementById(day + '_start');
        const endInput = document.getElementById(day + '_end');

        if (checkbox.checked) {
            startInput.disabled = false;
            endInput.disabled = false;
        } else {
            startInput.disabled = true;
            endInput.disabled = true;
        }
    }

    // Function to apply the selected day's times and availability to all other days
    function applyTimesToAll(day) {
        const startTime = document.getElementById(day + '_start').value;
        const endTime = document.getElementById(day + '_end').value;
        const isChecked = document.getElementById(day + '_active').checked;

        const days = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];

        days.forEach(function(currentDay) {
            if (currentDay !== day) {
                document.getElementById(currentDay + '_start').value = startTime;
                document.getElementById(currentDay + '_end').value = endTime;

                const checkbox = document.getElementById(currentDay + '_active');
                checkbox.checked = isChecked;
                toggleDay(currentDay);
            }
        });
    }

    // Tooltip on hover to display start and end times
    document.querySelectorAll('input[type="time"]').forEach((input) => {
        input.addEventListener('mouseover', function() {
            const day = this.id.split('_')[0];
            const startInput = document.getElementById(day + '_start').value;
            const endInput = document.getElementById(day + '_end').value;
            this.title = `Start: ${startInput} - End: ${endInput}`;
        });
    });
</script>

</html>