/**
 * The below two function are responsible for adding and removing the tags
 */

function removeTag(button) {
  const tag = button.parentElement;
  tag.remove();
}

function addTag(event) {
  const input = event.target;
  const tagList = document.getElementById("tag-list");
  const inputValue = input.value.trim();

  if (event.key === "Enter" && inputValue !== "") {
    event.preventDefault();

    const existingTags = Array.from(tagList.getElementsByTagName("span"));
    const tagExists = existingTags.some(
      (tag) => tag.textContent.toLowerCase() === inputValue.toLowerCase()
    );

    if (!tagExists) {
      const newTag = document.createElement("div");
      newTag.classList.add("tag");
      newTag.style.backgroundColor = "#007474";
      newTag.style.color = "#fff";
      newTag.innerHTML = `
      <span>${inputValue}</span>
      <button type="button" class="tag-close" onclick="removeTag(this)">&times;</button>
  `;
      tagList.appendChild(newTag);
      input.value = "";
    } else {
      alert("Tag already exists!");
    }
  }
}

// for task tags
function removeTaskTag(button) {
  const tag = button.parentElement;
  tag.remove();
}

function addTaskTag(event) {
  const input = event.target;
  const tagList = document.getElementById("task-tag-list");
  const inputValue = input.value.trim();

  if (event.key === "Enter" && inputValue !== "") {
    event.preventDefault();

    const existingTags = Array.from(tagList.getElementsByTagName("span"));
    const tagExists = existingTags.some(
      (tag) => tag.textContent.toLowerCase() === inputValue.toLowerCase()
    );

    if (!tagExists) {
      const newTag = document.createElement("div");
      newTag.classList.add("tag");
      newTag.style.backgroundColor = "#007474";
      newTag.style.color = "#fff";
      newTag.innerHTML = `
      <span>${inputValue}</span>
      <button type="button" class="tag-close" onclick="removeTaskTag(this)">&times;</button>
  `;
      tagList.appendChild(newTag);
      input.value = "";
    } else {
      alert("Tag already exists!");
    }
  }
}

// for business category
function addBusinessCatTag(event) {
  
  const input = event.target;
  const tagList = document.getElementById("business-cat-tag-list");
  const inputValue = input.value.trim();

  if (event.key === "Enter" && inputValue !== "") {
    event.preventDefault();

    const existingTags = Array.from(tagList.getElementsByTagName("span"));
    const tagExists = existingTags.some(
      (tag) => tag.textContent.toLowerCase() === inputValue.toLowerCase()
    );

    if (!tagExists) {
      const newTag = document.createElement("div");
      newTag.classList.add("tag");
      newTag.style.backgroundColor = "#007474";
      newTag.style.color = "#fff";
      newTag.innerHTML = `
      <span>${inputValue}</span>
      <button type="button" class="tag-close" onclick="removeBusinessCatTag(this)">&times;</button>
  `;
      tagList.appendChild(newTag);
      input.value = "";
    } else {
      alert("Tag already exists!");
    }
  }
}

function removeBusinessCatTag(button) {
  
  const tag = button.parentElement;
  tag.remove();
}


// for Brands Carried
function addBrandCarriedTag(event) {
  
  const input = event.target;
  const tagList = document.getElementById("brands-carried-tag-list");
  const inputValue = input.value.trim();

  if (event.key === "Enter" && inputValue !== "") {
    event.preventDefault();

    const existingTags = Array.from(tagList.getElementsByTagName("span"));
    const tagExists = existingTags.some(
      (tag) => tag.textContent.toLowerCase() === inputValue.toLowerCase()
    );

    if (!tagExists) {
      const newTag = document.createElement("div");
      newTag.classList.add("tag");
      newTag.style.backgroundColor = "#007474";
      newTag.style.color = "#fff";
      newTag.innerHTML = `
      <span>${inputValue}</span>
      <button type="button" class="tag-close" onclick="removeBrandCarriedTag(this)">&times;</button>
  `;
      tagList.appendChild(newTag);
      input.value = "";
    } else {
      alert("Tag already exists!");
    }
  }
}

function removeBrandCarriedTag(button) {
  
  const tag = button.parentElement;
  tag.remove();
}


// for Brands Carried
function addServiceOfferedTag(event) {
  const input = event.target;
  const tagList = document.getElementById("services-offered-tag-list");
  const inputValue = input.value.trim();

  if (event.key === "Enter" && inputValue !== "") {
    event.preventDefault();

    const existingTags = Array.from(tagList.getElementsByTagName("span"));
    const tagExists = existingTags.some(
      (tag) => tag.textContent.toLowerCase() === inputValue.toLowerCase()
    );

    if (!tagExists) {
      const newTag = document.createElement("div");
      newTag.classList.add("tag");
      newTag.style.backgroundColor = "#007474";
      newTag.style.color = "#fff";
      newTag.innerHTML = `
      <span>${inputValue}</span>
      <button type="button" class="tag-close" onclick="removeServiceOfferedTag(this)">&times;</button>
  `;
      tagList.appendChild(newTag);
      input.value = "";
    } else {
      alert("Tag already exists!");
    }
  }
}

function removeServiceOfferedTag(button) {
  const tag = button.parentElement;
  tag.remove();
}
