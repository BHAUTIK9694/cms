class TextEditor {
  constructor(containerId, hiddenInputId) {
    this.container = document.getElementById(containerId);
    this.hiddenInput = document.getElementById(hiddenInputId);
    this.defaults = {
      html: `<div id="code-editor">
                <div class="editor-block-controls">
                    <div>
                        <button type="button" class="command" title="Undo" data-command='undo'><i class="fas fa-undo"></i></button>
                        <button type="button" class="command" title="Redo" data-command='redo'><i class="fas fa-redo"></i></button>
                    </div>
                    <div>
                        <button type="button" class="command" title="Bold" data-command='bold'><i class="fas fa-bold"></i></button>
                        <button type="button" class="command" title="Italic" data-command='italic'><i class="fas fa-italic"></i></button>
                        <button type="button" class="command" title="Horizontal Rule" data-command="insertHorizontalRule">Hr</button>
                        <button type="button" class='command' title="Strike-Through" data-command='strikethrough'><strike>abc</strike></button>
                        <button type="button" class="command" title="H1" data-command='h1'>H1</button>
                        <button type="button" class="command" title="H2" data-command='h2'>H2</button>
                        <button type="button" class="command" title="Underline" data-command='underline'>U</button>
                        <button type="button" class="command" title="Paragraph" data-command="p"><i class="fas fa-paragraph"></i></button>
                    </div>
                    <div>
                        <button type="button" class="command" title="Justify-Left" data-command='justifyleft'><i class="fas fa-align-left"></i></button>
                        <button type="button" class="command" title="Justify-Center" data-command='justifycenter'><i class="fas fa-align-justify"></i></button>
                        <button type="button" class="command" title="Justify-Right" data-command='justifyright'><i class="fas fa-align-right"></i></button>
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

    this.init();
  }

  init() {
    this.setUI();
    this.setListeners();
  }

  setUI() {
    if (this.container) {
      this.container.innerHTML = this.defaults.html;
    }
  }

  setListeners() {
    const commands = this.container.querySelectorAll("button.command");
    commands.forEach((el) => {
      el.addEventListener("mousedown", (e) => {
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
          default:
            document.execCommand(command, false, command);
            break;
        }
        this.printJsonOutput();
      });
    });

    const select = this.container.querySelector("select");
    select.addEventListener("change", (e) => {
      document.execCommand("fontSize", false, e.target.value);
      this.printJsonOutput();
    });

    const content = this.container.querySelector("#editor-block-content");
    content.addEventListener("input", () => {
      this.printJsonOutput();
    });
  }

  printJsonOutput() {
    let editorContent = this.container.querySelector(
      "#editor-block-content"
    ).innerHTML;
    let parser = new DOMParser();
    let doc = parser.parseFromString(editorContent, "text/html");

    let jsonOutput = editorContent;
    let currentHeading = null;

    // console.log("Editor Content:", editorContent); // Log the raw HTML

    this.hiddenInput.value = JSON.stringify(jsonOutput);
    console.clear();
    // console.log(jsonOutput);
  }
}

document.addEventListener("DOMContentLoaded", function () {

});
