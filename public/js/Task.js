// Function to open the popup form
function openPopup() {
  // Get the popup overlay and form elements
  var overlay = document.querySelector(".popup-overlay");
  var form = document.querySelector(".popup-form");

  // Show the overlay and the form
  overlay.style.display = "block";
  form.style.display = "block";
}

// Function to close the popup form
function closePopup() {
  // Get the popup overlay and form elements
  var overlay = document.querySelector(".popup-overlay");
  var form = document.querySelector(".popup-form");

  // Hide the overlay and the form
  overlay.style.display = "none";
  form.style.display = "none";
}

// Wait for the DOM to be fully loaded before running the script
document.addEventListener("DOMContentLoaded", function () {
  // Cache the filter buttons and table rows for efficiency
  const filterButtons = document.querySelectorAll(".filter-btn");
  const tableRows = document.querySelectorAll(".task-row");
  const filterInputs = document.querySelectorAll(".filter-input");
  const filterDropdowns = document.querySelectorAll(".filter-dropdown");

  // Function to reset the filters and show all rows
  function resetFilters() {
    tableRows.forEach((row) => {
      row.style.display = ""; // Show all rows
    });
    filterInputs.forEach((input) => {
      input.value = ""; // Clear search inputs
    });
    filterDropdowns.forEach((dropdown) => {
      dropdown.selectedIndex = 0; // Reset dropdowns
    });
  }

  // Event listener for filter buttons
  filterButtons.forEach((button) => {
    button.addEventListener("click", function () {
      const filterType = button.getAttribute("data-filter");

      // Reset all filters before applying a new one
      resetFilters();

      switch (filterType) {
        case "all":
          // Show all tasks
          break;

        case "grouped-by-status":
          // Group tasks by their category or status
          const groupedByCategory = {};
          tableRows.forEach((row) => {
            const category = row.getAttribute("data-category");
            if (!groupedByCategory[category]) {
              groupedByCategory[category] = [];
            }
            groupedByCategory[category].push(row);
          });

          // Hide all rows initially
          tableRows.forEach((row) => (row.style.display = "none"));

          // Show rows for each category
          Object.values(groupedByCategory).forEach((group) => {
            group.forEach((row) => {
              row.style.display = "";
            });
          });
          break;

        case "not-completed":
          // Filter rows where status is NOT completed
          tableRows.forEach((row) => {
            const status = row.getAttribute("data-status");
            if (status !== "Completed") {
              row.style.display = "";
            } else {
              row.style.display = "none";
            }
          });
          break;

        case "in-progress":
          // Filter rows where status is "In Progress"
          tableRows.forEach((row) => {
            const status = row.getAttribute("data-status");
            if (status === "In Progress") {
              row.style.display = "";
            } else {
              row.style.display = "none";
            }
          });
          break;

        case "progress-items":
          // Filter items where "Start Date" is within the current date or earlier
          const currentDate = new Date();
          tableRows.forEach((row) => {
            const startDate = new Date(row.cells[6].textContent); // Start Date column
            if (startDate <= currentDate) {
              row.style.display = "";
            } else {
              row.style.display = "none";
            }
          });
          break;
      }
    });
  });

  // Event listener for input-based search functionality
  filterInputs.forEach((input) => {
    input.addEventListener("input", function () {
      const filterValue = input.value.toLowerCase();
      const columnIndex = Array.from(
        input.closest("th").parentNode.children
      ).indexOf(input.closest("th"));

      tableRows.forEach((row) => {
        const cellValue = row.cells[columnIndex].textContent.toLowerCase();
        if (cellValue.includes(filterValue)) {
          row.style.display = "";
        } else {
          row.style.display = "none";
        }
      });
    });
  });

  // Event listener for dropdown-based filtering
  filterDropdowns.forEach((dropdown) => {
    dropdown.addEventListener("change", function () {
      const filterValue = dropdown.value.toLowerCase();
      const columnIndex = Array.from(
        dropdown.closest("th").parentNode.children
      ).indexOf(dropdown.closest("th"));

      tableRows.forEach((row) => {
        const cellValue = row.cells[columnIndex].textContent.toLowerCase();
        if (filterValue === "" || cellValue.includes(filterValue)) {
          row.style.display = "";
        } else {
          row.style.display = "none";
        }
      });
    });
  });
});

var x, i, j, l, ll, selElmnt, a, b, c;
x = document.getElementsByClassName("custom-select");
l = x.length;
for (i = 0; i < l; i++) {
  selElmnt = x[i].getElementsByTagName("select")[0];
  ll = selElmnt.length;

  // Create the selected item DIV
  a = document.createElement("DIV");
  a.setAttribute("class", "select-selected");
  a.innerHTML = selElmnt.options[selElmnt.selectedIndex].innerHTML;
  x[i].appendChild(a);

  // Create the options container DIV
  b = document.createElement("DIV");
  b.setAttribute("class", "select-items select-hide");

  // Loop through all options in the original select element
  for (j = 0; j < ll; j++) {
    c = document.createElement("DIV");
    c.innerHTML = selElmnt.options[j].innerHTML;

    if (selElmnt.options[j].disabled) {
      c.classList.add("disabled-option");
      c.style.color = "#aaa";
      c.style.pointerEvents = "none";
    }

    // Add click event to each option
    c.addEventListener("click", function (e) {
      var y, i, k, s, h, sl, yl;
      s = this.parentNode.parentNode.getElementsByTagName("select")[0];
      sl = s.length;
      h = this.parentNode.previousSibling;
      for (i = 0; i < sl; i++) {
        if (s.options[i].innerHTML == this.innerHTML) {
          s.selectedIndex = i;
          h.innerHTML = this.innerHTML;
          y = this.parentNode.getElementsByClassName("same-as-selected");
          yl = y.length;
          for (k = 0; k < yl; k++) {
            y[k].removeAttribute("class");
          }
          this.setAttribute("class", "same-as-selected");
          break;
        }
      }
      h.click();
    });
    b.appendChild(c);
  }
  x[i].appendChild(b);

  // Add event listener to toggle dropdown
  a.addEventListener("click", function (e) {
    e.stopPropagation();
    closeAllSelect(this);
    this.nextSibling.classList.toggle("select-hide");
    this.classList.toggle("select-arrow-active");
  });
}

// Function to close all dropdowns
function closeAllSelect(elmnt) {
  var x,
    y,
    i,
    xl,
    yl,
    arrNo = [];
  x = document.getElementsByClassName("select-items");
  y = document.getElementsByClassName("select-selected");
  xl = x.length;
  yl = y.length;
  for (i = 0; i < yl; i++) {
    if (elmnt == y[i]) {
      arrNo.push(i);
    } else {
      y[i].classList.remove("select-arrow-active");
    }
  }
  for (i = 0; i < xl; i++) {
    if (arrNo.indexOf(i)) {
      x[i].classList.add("select-hide");
    }
  }
}

document.addEventListener("click", closeAllSelect);

// document
//   .getElementById("uploadForm")
//   .addEventListener("submit", function (event) {
//     event.preventDefault();

//     var formData = new FormData();
//     formData.append("file", document.getElementById("fileInput").files[0]);

//     fetch("Task.php", {
//       method: "POST",
//       body: formData,
//     })
//       .then((response) => response.text())
//       .then((data) => {
//         location.reload(); // Refresh to update table after upload
//       })
//       .catch((error) => console.error("Error:", error));
//   });

document.addEventListener("DOMContentLoaded", function () {
  const filterHeaders = document.querySelectorAll(".filter-header");
  const table = document.querySelector("table");
  const rows = table.querySelectorAll("tbody tr");

  // Populate status filter dropdown dynamically
  const statusDropdown = document.querySelector(
    "th[data-filter='status'] .filter-dropdown"
  );
  if (statusDropdown) {
    let uniqueStatuses = new Set();
    rows.forEach((row) => {
      const statusCell = row.querySelector("td:nth-child(5)"); // Adjust index if needed
      if (statusCell) {
        uniqueStatuses.add(statusCell.textContent.trim());
      }
    });
    uniqueStatuses.forEach((status) => {
      let option = document.createElement("option");
      option.value = status;
      option.textContent = status;
      statusDropdown.appendChild(option);
    });
  }

  filterHeaders.forEach((header) => {
    const filterType = header.getAttribute("data-filter");
    const input = header.querySelector(".filter-input");
    const dropdown = header.querySelector(".filter-dropdown");
    const icon = header.querySelector(".filter-icon");

    if (input) {
      icon.addEventListener("click", () => {
        input.classList.toggle("hidden");
        input.focus();
      });

      input.addEventListener("keyup", () => {
        filterTable();
      });
    }

    if (dropdown) {
      icon.addEventListener("click", () => {
        dropdown.classList.toggle("hidden");
      });

      dropdown.addEventListener("change", () => {
        filterTable();
      });
    }
  });

  function filterTable() {
    rows.forEach((row) => {
      let showRow = true;

      filterHeaders.forEach((header) => {
        const filterType = header.getAttribute("data-filter");
        const input = header.querySelector(".filter-input");
        const dropdown = header.querySelector(".filter-dropdown");
        const cell = row.querySelector(
          `td:nth-child(${getColumnIndex(filterType)})`
        );

        if (input && !input.classList.contains("hidden")) {
          const filterValue = input.value.trim().toLowerCase();
          if (
            filterValue &&
            (!cell || !cell.textContent.toLowerCase().includes(filterValue))
          ) {
            showRow = false;
          }
        }

        if (dropdown && !dropdown.classList.contains("hidden")) {
          const selectedValue = dropdown.value;
          if (
            selectedValue &&
            (!cell || cell.textContent.trim() !== selectedValue)
          ) {
            showRow = false;
          }
        }
      });

      row.style.display = showRow ? "" : "none";
    });
  }

  function getColumnIndex(filterType) {
    const headers = document.querySelectorAll("th");
    let index = 1;
    headers.forEach((header, i) => {
      if (header.getAttribute("data-filter") === filterType) {
        index = i + 1;
      }
    });
    return index;
  }
});

function openTaskDetails(taskId, taskName) {
  const panel = document.getElementById("taskDetailsPanel");
  const content = document.getElementById("taskDetailsContent");
  const taskTitle = document.getElementById("taskTitle"); // If you want to show the task name in the panel

  // Set the task name in the panel (optional)
  if (taskTitle) {
    taskTitle.textContent = taskName;
  }

  // Fetch the task details via AJAX or another method, here we just simulate it
  content.innerHTML = "Loading..."; // Show loading message while fetching

  // Example: Using fetch to load task details dynamically (replace with your actual data fetching method)
  fetch("getTaskDetails.php?task_id=" + taskId)
    .then((response) => response.text())
    .then((data) => {
      content.innerHTML = data; // Populate content with task details
      panel.classList.add("open"); // Slide in the panel
    })
    .catch((error) => {
      content.innerHTML = "Error loading task details."; // Error handling
    });
}

function closeTaskDetails() {
  const panel = document.getElementById("taskDetailsPanel");
  panel.classList.remove("open"); // Close the panel by removing 'open' class
}

document.addEventListener("DOMContentLoaded", function () {
  document.querySelectorAll(".task-link").forEach(function (link) {
    link.addEventListener("click", function (e) {
      e.preventDefault(); // Prevent default anchor action

      const taskId = this.getAttribute("data-task-id");

      fetch(`TaskOverview.php?task_id=${taskId}`)
        .then((response) => response.text()) // or response.json() if you expect JSON
        .then((data) => {
          // Handle the response data (e.g., show it in a modal, div, etc.)
          document.getElementById("task-details-container").innerHTML = data;
        })
        .catch((error) => console.error("Error fetching task data:", error));
    });
  });
});

document.addEventListener("DOMContentLoaded", function () {
  document.querySelectorAll(".task-link").forEach(function (link) {
    link.addEventListener("click", function (e) {
      e.preventDefault();

      const taskId = this.getAttribute("data-task-id");
      const popupContainer = document.getElementById("task-popup");
      const taskDetailsContainer = document.getElementById(
        "task-details-container"
      );

      fetch(`TaskOverview.php?task_id=${taskId}`)
        .then((response) => response.text())
        .then((data) => {
          taskDetailsContainer.innerHTML = data;
          popupContainer.style.display = "flex"; // Show popup
        })
        .catch((error) => console.error("Error fetching task data:", error));
    });
  });

  // Close popup
  document.querySelector(".close-popup").addEventListener("click", function () {
    document.getElementById("task-popup").style.display = "none";
  });

  // Close popup if user clicks outside the content
  window.addEventListener("click", function (e) {
    const popupContainer = document.getElementById("task-popup");
    if (e.target === popupContainer) {
      popupContainer.style.display = "none";
    }
  });
});

document.querySelectorAll(".tab-button").forEach((button) => {
  button.addEventListener("click", () => {
    const tab = button.getAttribute("data-tab");

    document
      .querySelectorAll(".tab-button")
      .forEach((btn) => btn.classList.remove("active"));
    document
      .querySelectorAll(".tab-content")
      .forEach((content) => content.classList.remove("active"));

    button.classList.add("active");
    document.getElementById(`${tab}-content`).classList.add("active");
  });
});
