<div class="project-container">
    <div class="project-header">
        <h2><span>PROJECT :</span> <?= strtoupper($rowdata['project_name'] ?? 'Unknown Project') ?></h2>
        <a href="project.php" class="back-btn">Back To Project List</a>
    </div>

    <div class="project-details-grid">
        <?php
        $fields = [
            "Code" => $rowdata['id'],
            "Project Name" => $rowdata['project_name'] ?? "-",
            "Project Tag" => $rowdata['tags'] ?? "-",
            "Project Status" => "<span class='project-status'>" . ($rowdata['status'] ?? "N/A") . "</span>",
            "Sales Person" => $rowdata['sales_person'] ?? "-",
            "Project Manager" => "<span class='project-manager'>👤 " . ($rowdata['manager'] ?? "-") . "</span>",
            "Client Name" => "<span class='project-client'>🏢 " . ($rowdata['client_name'] ?? "-") . "</span>",
            "Start Date" => "<span class='project-date'>📅 " . ($rowdata['date_created'] ?? "-") . "</span>",
            "End Date" => "<span class='project-date'>📅 " . ($rowdata['due_date'] ?? "-") . "</span>",
            "Project Price" => "<span class='project-price'> " . ($rowdata['project_price'] ?? "-") . "</span>",
            "Billable Type" => "<span class='billable-type'> " . ($rowdata['billable_type'] ?? "-") . "</span>",
            "Billable_rate" => "<span class='billable-rate'> " . ($rowdata['billable_rate'] ?? "-") . "</span>",
            "Budget Type" => "<span class='budget-type'> " . ($rowdata['budget_type'] ?? "-") . "</span>",
            "Budget" => "<span class='budget'>" . ($rowdata['budget'] ?? "-") . "</span>"
        ];

        foreach ($fields as $title => $value) {
            echo "<div>";
            echo "<label>$title</label><br>";
            echo "<span>$value</span>";
            echo "</div>";
        }
        ?>
    </div>
</div>