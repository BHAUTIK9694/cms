const tabs = document.querySelectorAll(".tab");
const tabPanes = document.querySelectorAll(".tab-pane");

tabs.forEach((tab) => {
  tab.addEventListener("click", () => {
    // 1. Remove active class from all tabs and panes
    tabs.forEach((t) => t.classList.remove("active"));
    tabPanes.forEach((pane) => pane.classList.remove("active"));

    // 2. Add active class to the clicked tab and corresponding pane
    const targetPaneId = tab.dataset.tab;
    const targetPane = document.getElementById(targetPaneId);

    tab.classList.add("active");
    targetPane.classList.add("active");
  });
});
