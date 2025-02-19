// Function for Popup
function openPopup(event) {
  event.preventDefault();
  document.querySelector(".popup-overlay").style.display = "block";
  document.querySelector(".popup-form").style.display = "block";
}

function closePopup() {
  document.querySelector(".popup-overlay").style.display = "none";
  document.querySelector(".popup-form").style.display = "none";
}


// The below loadProjectTextEditor function is specificaly for project details div
function loadProjectTextEditor() {
  document.addEventListener("DOMContentLoaded", function () {
    (function (window) {
      function myLibrary() {
        let _myLibraryObject = {};
        let defaults = {
          container: null,
          html: `<div id="code-editor">
<div class="editor-block-controls">
  <div>
    <button type="button" class="command" title="Undo" data-command='undo'><i class="fas fa-undo"></i></button>
    <button type="button" class="command" title="Redo" data-command='redo'><i class="fas fa-redo"></i></button>
  </div>
  <div>
    <button type="button" class="command" title="Italic" data-command='italic'><i class="fas fa-italic"></i></button>
    <button type="button" class="command" title="Bold" data-command='bold'><i class="fas fa-bold"></i></button>
    <button type="button" class="command" title="Horizontal Rule" data-command="insertHorizontalRule">Hr</button>
    <button type="button" class='command' title="Strike-Through" data-command='strikethrough'><strike>abc</strike></button>
    <button type="button" class="command" title="H1" data-command='h1'>H1</button>
    <button type="button" class="command" title="H2" data-command='h2'>H2</button>
    <button type="button" class="command" title="Underline" data-command='underline'>U</button>
    <button type="button" class="command" title="Paragraph" data-command="p"><i class="fas fa-paragraph"></i></button>
  </div>
  <div>
    <button type="button" class="command" title="Indent" data-command="indent"><i class="fas fa-indent"></i></button>
    <button type="button" class="command" title="Outdent" data-command="outdent"><i class="fas fa-outdent"></i></button>
  </div>
  <div>
    <button type="button" class="command" title="Justify-Left" data-command='justifyleft'><i class="fas fa-align-left"></i></button>
    <button type="button" class="command" title="Justify-Center" data-command='justifycenter'><i class="fas fa-align-justify"></i></button>
    <button type="button" class="command" title="Justify-Right" data-command='justifyright'><i class="fas fa-align-right"></i></button>
  </div>
</div>
<div class="editor-block-controls">
  <div>
    <button type="button" class="command" title="Blockquote" data-command='formatBlock'><i class="fas fa-quote-right"></i></button>
    <button type="button" class="command" title="Superscript" data-command='superscript'>A<sup>abc</sup></button>
    <button type="button" class="command" title="Subscript" data-command='subscript'>A<sub>abc</sub></button>
  </div>
  <div>
    <button type="button" class="command" title="Decrease font" data-command='decreasefontsize'><sub>A</sub></button>
    <button type="button" class="command" title="Increase font" data-command='increasefontsize'><i class="fas fa-font"></i></button>
  </div>
  <div>
    <select class="wsy-command" title="Font size">
      <option value="1">small</option>
      <option value="2">normal</option>
      <option value="3">medium</option>
      <option value="4">large</option>
      <option value="5">x-large</option>
      <option value="6">xx-large</option>
      <option value="7">xxx-large</option>
    </select>
  </div>
</div>
<div id="editor-block-content" contenteditable></div>
</div>`,
        };

        _myLibraryObject.init = function (container) {
          defaults.container = document.querySelector(container);
          _myLibraryObject.setUI();
          _myLibraryObject.setListeners();
          return defaults.container;
        };

        _myLibraryObject.setUI = function () {
          if (defaults.container !== null && defaults.container)
            defaults.container.innerHTML = defaults.html;
        };

        _myLibraryObject.setListeners = function () {
          for (let el of defaults.container.querySelectorAll(
            "button.command"
          )) {
            el.addEventListener("mousedown", function (e) {
              e.preventDefault(); // Prevent form submission
              let command = e.currentTarget.getAttribute("data-command");
              switch (command) {
                case "h1":
                case "h2":
                case "p":
                  document.execCommand("formatBlock", false, command);
                  break;
                case "formatBlock":
                  document.execCommand("formatBlock", false, "blockquote");
                  break;
                case "increasefontsize":
                  document.execCommand("fontSize", false, 5);
                  break;
                case "decreasefontsize":
                  document.execCommand("fontSize", false, 2);
                  break;
                default:
                  document.execCommand(command, false, command);
                  break;
              }
              printJsonOutput(); // Print JSON output on command execution
            });
          }
          defaults.container
            .querySelector("select")
            .addEventListener("change", (e) => {
              document.execCommand("fontSize", false, e.target.value);
              printJsonOutput(); // Print JSON output on font size change
            });

          // Listen for input events to print JSON output on content change
          defaults.container
            .querySelector("#editor-block-content")
            .addEventListener("input", function () {
              printJsonOutput();
            });
        };

        // Function to print JSON output in hidden input field
        function printJsonOutput() {
          let editorContent = defaults.container.querySelector(
            "#editor-block-content"
          ).innerHTML;

          // Prepare JSON output
          let parser = new DOMParser();
          let doc = parser.parseFromString(editorContent, "text/html");
          let jsonOutput = {};
          let currentHeading = null;

          doc.body.childNodes.forEach((node) => {
            if (node.tagName === "H1" || node.tagName === "H2") {
              currentHeading = node.textContent.trim();
              jsonOutput[currentHeading] = [];
            } else if (node.tagName === "DIV" && currentHeading) {
              jsonOutput[currentHeading].push(node.textContent.trim());
            }
          });

          // Set JSON output to hidden input field
          let hiddenInput = document.getElementById("texteditor-hidden");
          hiddenInput.value = JSON.stringify(jsonOutput); // Convert to JSON string
          console.clear(); // Clear console
          console.log(jsonOutput); // Log JSON output to console
        }

        return _myLibraryObject;
      }

      if (typeof window.wsyJA === "undefined") {
        window.wsyJA = myLibrary();
      }
    })(window);

    wsyJA.init(".wsyig");
  });
}
loadProjectTextEditor();

// The below loadTaskTextEditor function is specificaly for task details div
function loadTaskTextEditor() {
  document.addEventListener("DOMContentLoaded", function () {
    (function (window) {
      function myLibrary() {
        let _myLibraryObject = {};
        let defaults = {
          container: null,
          hiddenInput: null,
          html: `<div id="code-editor">
              <div class="editor-block-controls">
                <div>
                  <button type="button" class="command" title="Undo" data-command='undo'><i class="fas fa-undo"></i></button>
                  <button type="button" class="command" title="Redo" data-command='redo'><i class="fas fa-redo"></i></button>
                </div>
                <div>
                  <button type="button" class="command" title="Italic" data-command='italic'><i class="fas fa-italic"></i></button>
                  <button type="button" class="command" title="Bold" data-command='bold'><i class="fas fa-bold"></i></button>
                  <button type="button" class="command" title="Horizontal Rule" data-command="insertHorizontalRule">Hr</button>
                  <button type="button" class='command' title="Strike-Through" data-command='strikethrough'><strike>abc</strike></button>
                  <button type="button" class="command" title="H1" data-command='h1'>H1</button>
                  <button type="button" class="command" title="H2" data-command='h2'>H2</button>
                  <button type="button" class="command" title="Underline" data-command='underline'>U</button>
                  <button type="button" class="command" title="Paragraph" data-command="p"><i class="fas fa-paragraph"></i></button>
                </div>
                <div>
                  <button type="button" class="command" title="Indent" data-command="indent"><i class="fas fa-indent"></i></button>
                  <button type="button" class="command" title="Outdent" data-command="outdent"><i class="fas fa-outdent"></i></button>
                </div>
                <div>
                  <button type="button" class="command" title="Justify-Left" data-command='justifyleft'><i class="fas fa-align-left"></i></button>
                  <button type="button" class="command" title="Justify-Center" data-command='justifycenter'><i class="fas fa-align-justify"></i></button>
                  <button type="button" class="command" title="Justify-Right" data-command='justifyright'><i class="fas fa-align-right"></i></button>
                </div>
              </div>
              <div class="editor-block-controls">
                <div>
                  <button type="button" class="command" title="Blockquote" data-command='formatBlock'><i class="fas fa-quote-right"></i></button>
                  <button type="button" class="command" title="Superscript" data-command='superscript'>A<sup>abc</sup></button>
                  <button type="button" class="command" title="Subscript" data-command='subscript'>A<sub>abc</sub></button>
                </div>
                <div>
                  <button type="button" class="command" title="Decrease font" data-command='decreasefontsize'><sub>A</sub></button>
                  <button type="button" class="command" title="Increase font" data-command='increasefontsize'><i class="fas fa-font"></i></button>
                </div>
                <div>
                  <select class="wsy-command" title="Font size">
                    <option value="1">small</option>
                    <option value="2">normal</option>
                    <option value="3">medium</option>
                    <option value="4">large</option>
                    <option value="5">x-large</option>
                    <option value="6">xx-large</option>
                    <option value="7">xxx-large</option>
                  </select>
                </div>
              </div>
              <div id="editor-block-content" contenteditable></div>
            </div>`,
        };

        _myLibraryObject.init = function (container, hiddenInput) {
          defaults.container = document.querySelector(container);
          defaults.hiddenInput = document.querySelector(hiddenInput);
          _myLibraryObject.setUI();
          _myLibraryObject.setListeners();
          return defaults.container;
        };

        _myLibraryObject.setUI = function () {
          if (defaults.container !== null)
            defaults.container.innerHTML = defaults.html;
        };

        _myLibraryObject.setListeners = function () {
          for (let el of defaults.container.querySelectorAll(
            "button.command"
          )) {
            el.addEventListener("mousedown", function (e) {
              e.preventDefault();
              let command = e.currentTarget.getAttribute("data-command");
              switch (command) {
                case "h1":
                case "h2":
                case "p":
                  document.execCommand("formatBlock", false, command);
                  break;
                case "formatBlock":
                  document.execCommand("formatBlock", false, "blockquote");
                  break;
                case "increasefontsize":
                  document.execCommand("fontSize", false, 5);
                  break;
                case "decreasefontsize":
                  document.execCommand("fontSize", false, 2);
                  break;
                default:
                  document.execCommand(command, false, command);
                  break;
              }
              printJsonOutput();
            });
          }
          defaults.container
            .querySelector("select")
            .addEventListener("change", (e) => {
              document.execCommand("fontSize", false, e.target.value);
              printJsonOutput();
            });

          defaults.container
            .querySelector("#editor-block-content")
            .addEventListener("input", function () {
              printJsonOutput();
            });
        };

        function printJsonOutput() {
          let editorContent = defaults.container.querySelector(
            "#editor-block-content"
          ).innerHTML;

          let parser = new DOMParser();
          let doc = parser.parseFromString(editorContent, "text/html");
          let jsonOutput = {};
          let currentHeading = null;

          doc.body.childNodes.forEach((node) => {
            if (node.tagName === "H1" || node.tagName === "H2") {
              currentHeading = node.textContent.trim();
              jsonOutput[currentHeading] = [];
            } else if (node.tagName === "DIV" && currentHeading) {
              jsonOutput[currentHeading].push(node.textContent.trim());
            }
          });

          if (defaults.hiddenInput) {
            defaults.hiddenInput.value = JSON.stringify(jsonOutput);
          }

          console.clear();
          console.log(jsonOutput);
        }

        return _myLibraryObject;
      }

      if (typeof window.wsyJA === "undefined") {
        window.wsyJA = myLibrary();
      }
    })(window);

    // Initialize the editor for the given div and hidden input
    wsyJA.init(".wsyigTask", "#texteditor-hidden-Task");
  });
}

loadTaskTextEditor();
