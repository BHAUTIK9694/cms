class TagsInput {
  constructor(elementId, hiddenInputField) {
    this.element = document.getElementById(elementId);
    this.hiddenInputField = document.getElementById(hiddenInputField);
    this.ul = this.element.querySelector("ul");
    this.input = this.element.querySelector("ul input");
    this.tags = [];

    this.showTags();
    this.setupEventListeners();
  }

  showTags() {
    this.element.querySelectorAll("li").forEach((li) => li.remove());
    this.tags.forEach((value, key) => {
      if (value !== undefined) {
        // Check if the element is not undefined
        let newEl = document.createElement("li");
        newEl.innerText = value;
        let elRemove = document.createElement("img");
        elRemove.src = "./public/assets/cancelwhite.svg";
        elRemove.alt = "cancle";
        elRemove.setAttribute("data-key", key); // Use data attribute instead of onclick
        elRemove.classList.add("remove");
        newEl.appendChild(elRemove);
        this.ul.appendChild(newEl);
        this.hiddenInputField.value = JSON.stringify(this.tags);
      }
    });
    this.setupRemoveListeners(); // Setup remove listeners after tags are shown
  }

  setupRemoveListeners() {
    this.element.querySelectorAll(".remove").forEach((removeBtn) => {
      removeBtn.addEventListener("click", (event) => {
        const key = event.target.dataset.key;
        this.removeItem(key);
      });
    });
  }

  removeItem(key) {
    delete this.tags[key];
    this.showTags();
  }

  setupEventListeners() {
    this.input.addEventListener("keyup", (event) => {
      console.log(event.key);

      if (event.key === " ") {
        if (
          !this.tags.includes(this.input.value) &&
          this.input.value.trim() !== ""
        ) {
          this.tags.push(this.input.value.trim());
          this.showTags();
        }
        this.input.value = "";
      }
    });
  }
}

document.addEventListener("DOMContentLoaded", function () {
  // new TagsInput("projectTagsDiv");
});
