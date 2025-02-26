document.addEventListener("DOMContentLoaded", function () {
  const projectDetailForm = document.getElementById("projectDetailForm");
  const projectSaveBtn = document.getElementById("projectSaveBtn-11pr44");

  if (projectDetailForm && projectSaveBtn) {
    projectSaveBtn.addEventListener("click", function () {
      const formData = new FormData(projectDetailForm);
      let projectData = {};

      formData.forEach((value, key) => {
        projectData[key] = value;
      });

      if (projectData["project_name"] === "") {
        alert("Project name is required");
      } else if (projectData["client_id"] === "") {
        alert("Client name is required");
      } else if (projectData["manager"] === "") {
        alert("Manager name is required");
      } else {
        const project_tags = Array.from(
          document.querySelectorAll("#projectTagsDiv ul li")
        )
          .map((tag) => tag.textContent)
          .join(",");
        const project_description = document
          .getElementById("wsyigProject-0o123")
          .querySelector("#editor-block-content").innerHTML;

        projectData["project_description"] = project_description;
        projectData["project_tags"] = project_tags;

        // console.log(projectData);
        sendDataToServer(projectData);
      }
    });
  }
});

function sendDataToServer(projectData) {
  fetch("ProjectData.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify(projectData),
  })
    .then((response) => response.json())
    .then((data) => {
      if (data["status"] === "success") {
        alert(data["message"]);
        closePopup();
      }
      console.log("Success:", data);
    })
    .catch((error) => {
      console.error("Error:", error);
    });
}

function openPopup(event) {
  event.preventDefault();
  document.querySelector(".popup-overlay").style.display = "block";
  document.querySelector(".popup-form").style.display = "block";
}

function closePopup() {
  document.querySelector(".popup-overlay").style.display = "none";
  document.querySelector(".popup-form").style.display = "none";
}
function openProjectTemplatePopup(event) {
  event.preventDefault();
  document.querySelector(".popup-overlay").style.display = "block";
  document.querySelector(".popup-form-project-template-12pl0").style.display =
    "block";
}

function closeProjectTemplatePopup() {
  document.querySelector(".popup-overlay").style.display = "none";
  document.querySelector(".popup-form-project-template-12pl0").style.display =
    "none";
}
