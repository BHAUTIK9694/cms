document.addEventListener("DOMContentLoaded", function () {
  let addAnotherTaskBtn = document.getElementById("add-another-task-btn");
  let taskFormDiv = document.getElementById("task-form-container");

  let tasks_list = [];

  let templ_btn = document.getElementById("save-template-btn");
  if (templ_btn) {
    console.log(templ_btn);
    templ_btn.addEventListener("click", function () {
      getAllInputData(tasks_list);
    });
  }

  const expandAllBtn = document.querySelector(
    ".task-form-header button:nth-child(2)"
  );
  const collapseAllBtn = document.querySelector(
    ".task-form-header button:nth-child(1)"
  );
  const taskList = document.getElementById("task-list");

  // Expand All Functionality
  expandAllBtn.addEventListener("click", function () {
    document.querySelectorAll(".detailed-task-info").forEach((detail) => {
      detail.style.display = "flex"; // Show all task details
    });
  });

  // Collapse All Functionality
  collapseAllBtn.addEventListener("click", function () {
    document.querySelectorAll(".detailed-task-info").forEach((detail) => {
      detail.style.display = "none"; // Hide all task details
    });
  });

  // Ensure that new tasks support click-to-toggle functionality
  taskList.addEventListener("click", function (event) {
    if (event.target.closest(".initial-task-info")) {
      const taskItem = event.target.closest(".task-item");
      const details = taskItem.querySelector(".detailed-task-info");
      details.style.display =
        details.style.display === "none" ? "flex" : "none";
    }
  });

  if (addAnotherTaskBtn) {
    addAnotherTaskBtn.addEventListener("click", function () {
      console.log("clicked");
      if (taskFormDiv) {
        taskFormDiv.style.display = "block";
      }
    });
  }

  const saveTaskBtn = document.getElementById("taskSaveBtn");
  // const taskList = document.getElementById("task-list");

  saveTaskBtn.addEventListener("click", function () {
    if (taskFormDiv) {
      const taskInputData = getInputDetails(); // Fetch user input
      tasks_list.push(taskInputData);
      updateTaskList(tasks_list);
      taskFormDiv.style.display = "none"; // Hide form

      // Create task item container
      const taskItem = document.createElement("div");
      taskItem.classList.add("task-item");

      // Create initial task info
      const initialTaskInfo = document.createElement("div");
      initialTaskInfo.classList.add("initial-task-info");
      initialTaskInfo.innerHTML = `
      <h4 class="task-title-h none-mb">${taskInputData.taskName}</h4>
      <h4 class="task-due-h none-mb">${taskInputData.taskDue} days from creation</h4>
    `;

      // Create detailed task info
      const detailedTaskInfo = document.createElement("div");
      detailedTaskInfo.classList.add("detailed-task-info");

      const taskDetailsList = document.createElement("ul");
      taskDetailsList.innerHTML = `
      <li><strong>Task Name:</strong> ${taskInputData.taskName}</li>
      <li><strong>Task Assignee:</strong> ${taskInputData.taskAssignee}</li>
      <li><strong>Due:</strong> ${taskInputData.taskDue}</li>
      <li><strong>Tags:</strong> ${taskInputData.taskTags.join(", ")}</li>
      <li><strong>Details:</strong> ${taskInputData.taskDetails}</li>
    `;

      detailedTaskInfo.appendChild(taskDetailsList);
      taskItem.appendChild(initialTaskInfo);
      taskItem.appendChild(detailedTaskInfo);
      taskList.appendChild(taskItem);
    }
  });
});

function getInputDetails() {
  let taskName = document.getElementById("task_name").value;
  let taskAssignee = document.getElementById("task_assignee").value;
  let taskDue = document.getElementById("task_due").value;
  let taskTags = Array.from(
    document.querySelectorAll("#task-tag-list .tag span")
  ).map((tag) => tag.textContent);
  let taskDetails = document
    .getElementById("wsyigTask")
    .querySelector("#editor-block-content").innerHTML;

  resetTaskForm();
  const taskInputDetails = {
    taskName,
    taskAssignee,
    taskDue,
    taskTags,
    taskDetails,
  };

  return taskInputDetails;
  console.log(taskInputDetails);
}

function getAllInputData(taskl) {
  // project
  const projectName = document.getElementById("project_name").value.trim();
  const projectAssignee = document
    .getElementById("project_assignee")
    .value.trim();
  const projectDue = document.getElementById("project_due").value.trim();
  const projectRecurrence = document.querySelector(
    "select[name='project_recurrence']"
  ).value;

  let projectTags = Array.from(
    document.querySelectorAll("#tag-list .tag span")
  ).map((tag) => tag.textContent);

  let projectDetails = document
    .getElementById("wsyig")
    .querySelector("#editor-block-content").innerHTML;

  const data = {
    projectName,
    projectAssignee,
    projectDue,
    projectRecurrence,
    projectTags,
    projectDetails,
    tasks: taskl,
  };

  fetch("saveTemplate.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify(data),
  })
    .then((response) => response.text()) // Get the response as text
    .then((result) => {
      console.log("Response from PHP:", result);
    })
    .catch((error) => console.error("Error:", error));

  console.log(data);
}

function resetTaskForm() {
  document.getElementById("task_name").value = ""; // Reset task name
  document.getElementById("task_assignee").value = ""; // Reset assignee
  document.getElementById("task_due").value = ""; // Reset due date

  // Clear tags
  document.getElementById("task-tag-list").innerHTML = "";

  // Reset task details editor
  document
    .getElementById("wsyigTask")
    .querySelector("#editor-block-content").innerHTML = "";
}

function updateTaskList(tasks) {
  let tasksHidden = document.getElementById("project-tasks-list");
  if (tasksHidden) {
    tasksHidden.value = JSON.stringify(tasks);
  }
}
