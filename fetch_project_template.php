<?php
include "partials/sql-connction.php"; // Include database connection

// Fetch all project templates
$query = "SELECT id, name, assignee, due, recurrence, details, created_at FROM project_template ORDER BY created_at DESC";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
    echo '<div class="template-container">';
    echo '<div class="disp-flx">';

    while ($row = mysqli_fetch_assoc($result)) {
        echo '<div class="tem-row">';
        echo '  <div class="card shadow-sm">';
        echo '      <div class="card-body">';
        echo '          <h5 class="card-title">' . htmlspecialchars($row['name']) . '</h5>';
        echo '          <p class="card-text"><strong>Assignee:</strong> ' . htmlspecialchars($row['assignee']) . '</p>';
        echo '          <p class="card-text"><strong>Due Days:</strong> ' . ($row['due'] ? $row['due'] . ' days from creation' : 'N/A') . '</p>';
        echo '          <p class="card-text"><strong>Recurrence:</strong> ' . htmlspecialchars($row['recurrence']) . '</p>';
        echo '          <p class="card-text"><strong>Details:</strong> ' . nl2br(htmlspecialchars($row['details'])) . '</p>';
        echo '          <p class="card-text text-muted"><small>Created: ' . date('F j, Y', strtotime($row['created_at'])) . '</small></p>';
        echo '      </div>';
        echo '  </div>';
        echo '</div>';
    }

    echo '</div>';
    echo '</div>';
} else {
    echo "<p class='text-center mt-3'>No project templates found.</p>";
}

mysqli_close($conn);
?>