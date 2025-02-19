<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Template</title>
    <link rel="stylesheet" href="public/css/navbar.css">
    <link rel="stylesheet" href="public/css/services.css">
    <link rel="stylesheet" href="public/css/input.css">
    <link rel="stylesheet" href="public/css/popup.css">
    <link rel="stylesheet" href="public/css/projecttemplate/tasks.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
</head>

<body>
    <?php include 'partials/navbar.php' ?>
    <div class='template-header-container'>
        <div class="btnBox">
            <button class="createTemplateBtn" id="create-template-btn" onclick="openPopup(event)">Create
                Template</button>
        </div>
    </div>

    <div class="project-template-container">
        <div>
            <h3>Templates</h3>
        </div>
        <div class="project-template-list">
            <?php include 'fetch_project_template.php' ?>
        </div>
    </div>

    <!-- Popup Form -->
    <div class="popup-overlay" onclick="closePopup()"></div>
    <div class="popup-form">
        <h2>Create Project Template</h2>
        <div class="project-details-container">
            <?php include "project_template_form.php" ?>

        </div>
    </div>



    <script src="public/js/services.js"></script>
    <script src="public/js/tags.js"></script>
    <script src="public/js/tasks.js"></script>
    <script>
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

            // Add a search input to the dropdown
            var searchInput = document.createElement("INPUT");
            searchInput.setAttribute("type", "text");
            searchInput.setAttribute("placeholder", "Search...");
            searchInput.setAttribute("class", "search-input");
            b.appendChild(searchInput);

            // Event listener for filtering options
            searchInput.addEventListener("input", function (e) {
                var filter = e.target.value.toUpperCase();
                var divs = this.parentNode.getElementsByTagName("DIV");
                for (var k = 1; k < divs.length; k++) { // Skip the search input
                    txtValue = divs[k].textContent || divs[k].innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        divs[k].style.display = "";
                    } else {
                        divs[k].style.display = "none";
                    }
                }
            });

            // Prevent dropdown from closing when interacting with the search input
            searchInput.addEventListener("click", function (e) {
                e.stopPropagation(); // Prevent the dropdown from closing
            });

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
            var x, y, i, xl, yl, arrNo = [];
            x = document.getElementsByClassName("select-items");
            y = document.getElementsByClassName("select-selected");
            xl = x.length;
            yl = y.length;
            for (i = 0; i < yl; i++) {
                if (elmnt == y[i]) {
                    arrNo.push(i)
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
    </script>
</body>

</html>