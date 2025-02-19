document.addEventListener("DOMContentLoaded", function () {
  const savePrimaryInfoBtn = document.getElementById(
    "save-client-primaryInfo-btn"
  );

  const saveSocialLinks = document.getElementById("subscribe-btn-456yrt"); // for social link handling
  const saveHostingandDomain = document.getElementById(
    "save-hosting-and-domain-btn"
  ); // for client domain and hosting handling

  if (savePrimaryInfoBtn) {
    savePrimaryInfoBtn.addEventListener("click", function () {
      let form = document.querySelector(".client-container-outer-674pl form"); // Select the form
      let formData = new FormData(form); // Create FormData object

      let formValues = extractFormData(form);

      let businessCategoryTags = Array.from(
        document.querySelectorAll("#business-cat-tag-list .tag span")
      ).map((tag) => tag.textContent);
      let business_category = businessCategoryTags.join(",");

      let BrandCarriedTags = Array.from(
        document.querySelectorAll("#brands-carried-tag-list .tag span")
      ).map((tag) => tag.textContent);
      let brand_carried = BrandCarriedTags.join(",");

      let ServiceOfferedTags = Array.from(
        document.querySelectorAll("#services-offered-tag-list .tag span")
      ).map((tag) => tag.textContent);
      let service_offered = ServiceOfferedTags.join(",");

      formValues["business_category"] = business_category;
      formValues["brand_carried"] = brand_carried;
      formValues["services_offered"] = service_offered;
      formValues["formId"] = "client_primary_info_form";
      console.log(formValues);

      fetch("updateClientInfo.php", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify(formValues),
      })
        .then((response) => response.text()) // Get the response as text
        .then((result) => {
          alert("Client Details updated successfully");
          console.log("Response from PHP:", result);
        })
        .catch((error) => console.error("Error:", error));

      // console.log(data);
    });
  }

  if (saveSocialLinks) {
    saveSocialLinks.addEventListener("click", function () {
      let form = document.querySelector(".social-links-form form");
      let formValues = extractFormData(form);
      formValues["formId"] = "client_social_links";
      console.log(formValues);

      fetch("updateClientInfo.php", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify(formValues),
      })
        .then((response) => response.text()) // Get the response as text
        .then((result) => {
          alert("Client social links updated successfully");
          console.log("Response from PHP:", result);
        })
        .catch((error) => console.error("Error:", error));
    });
  }

  if (saveHostingandDomain) {
    saveHostingandDomain.addEventListener("click", function () {
      let form = document.querySelector("#client_hosting_and_domain");
      let formValues = extractFormData(form);
      formValues["formId"] = "client_hosting_and_domain";
      console.log(formValues);
      fetch("updateClientInfo.php", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify(formValues),
      })
        .then((response) => response.text()) // Get the response as text
        .then((result) => {
          console.log("Response from PHP:", result);
        })
        .catch((error) => console.error("Error:", error));
    });
  }
});

function extractFormData(form) {
  let formData = new FormData(form);
  let formValues = {};
  formData.forEach((value, key) => {
    if (formValues[key]) {
      if (Array.isArray(formValues[key])) {
        formValues[key].push(value);
      } else {
        formValues[key] = [formValues[key], value];
      }
    } else {
      formValues[key] = value;
    }
  });

  return formValues;
}
