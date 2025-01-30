<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client Overview</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;

        }

        .container {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .header {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .client-name {
            font-size: 18px;
            padding: 5px;
            border: none;
            background: transparent;
            font-weight: bold;
        }

        .tabs {
            display: flex;
            gap: 15px;
            margin: 20px 0;
        }

        .tabs a {
            text-decoration: none;
            color: #333;
            font-weight: bold;
        }

        .business-details {
            border: 1px solid #ddd;
            padding: 10px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .details-box {
            display: flex;
            flex-direction: column;
        }

        .details-row {
            display: flex;
            justify-content: space-between;
            padding: 5px 0;
            border-bottom: 1px solid #ddd;
        }

        .projects-tasks {
            display: flex;
            gap: 20px;
        }

        .projects,
        .tasks {
            width: 50%;
        }

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

        .placeholder {
            text-align: center;
            color: #888;
        }
    </style>
</head>

<body>

    <div class="container">
        <header class="header">
            <button class="back-button">&larr;</button>
            <input type="text" class="client-name" value="Client Name" readonly>
        </header>

        <nav class="tabs">
            <a href="#">Overview</a>
            <a href="#">Hosting & Domain</a>
            <a href="#">Hours</a>
            <a href="#">Images</a>
            <a href="#">Social</a>
        </nav>

        <section class="business-details">
            <h2>Business Details</h2>
            <div class="details-box">
                <div class="details-row">
                    <span>Address</span>
                    <span>Website</span>
                    <span>Short Description</span>
                    <span>Tags</span>
                </div>
                <div class="details-row">
                    <span>Phone Number</span>
                    <span>Time Zone</span>
                    <span>Long Description</span>
                    <span>Client ID</span>
                </div>
            </div>
        </section>

        <section class="projects-tasks">
            <div class="projects">
                <h2>Projects</h2>
                <table>
                    <tr>
                        <th>Project Name</th>
                        <th>Team Member</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Status</th>
                    </tr>
                    <tr>
                        <td class="placeholder">if end date passes show OVERDUE tag along with end date</td>
                        <td>--</td>
                        <td>--</td>
                        <td>--</td>
                        <td>--</td>
                    </tr>
                    <tr>
                        <td class="placeholder">if end date passes show OVERDUE tag along with end date</td>
                        <td>--</td>
                        <td>--</td>
                        <td>--</td>
                        <td>--</td>
                    </tr>
                    <tr>
                        <td class="placeholder">if end date passes show OVERDUE tag along with end date</td>
                        <td>--</td>
                        <td>--</td>
                        <td>--</td>
                        <td>--</td>
                    </tr>
                    <tr>
                        <td class="placeholder">if end date passes show OVERDUE tag along with end date</td>
                        <td>--</td>
                        <td>--</td>
                        <td>--</td>
                        <td>--</td>
                    </tr>
                </table>
            </div>
            <div class="tasks">
                <h2>Tasks</h2>
                <table>
                    <tr>
                        <th>Task Name</th>
                        <th>Assignee</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Status</th>
                    </tr>
                    <tr>
                        <td>--</td>
                        <td>--</td>
                        <td>--</td>
                        <td>--</td>
                        <td class="placeholder">if end date passes show OVERDUE tag along with end date</td>
                    </tr>
                    <tr>
                        <td>--</td>
                        <td>--</td>
                        <td>--</td>
                        <td>--</td>
                        <td class="placeholder">if end date passes show OVERDUE tag along with end date</td>
                    </tr>
                    <tr>
                        <td>--</td>
                        <td>--</td>
                        <td>--</td>
                        <td>--</td>
                        <td class="placeholder">if end date passes show OVERDUE tag along with end date</td>
                    </tr>
                    <tr>
                        <td>--</td>
                        <td>--</td>
                        <td>--</td>
                        <td>--</td>
                        <td class="placeholder">if end date passes show OVERDUE tag along with end date</td>
                    </tr>
                </table>
            </div>
        </section>
    </div>
</body>

</html>