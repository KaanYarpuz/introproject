var tabLinks = document.querySelectorAll(".tab-links");
var tabContents = document.querySelectorAll(".tab-contents");

function opentab(event, tabname) {
    for (let tablink of tabLinks) {
        tablink.classList.remove("active-link");
    }
    for (let tabcontent of tabContents) {
        tabcontent.classList.remove("active-tab");
    }
    event.currentTarget.classList.add("active-link");

    let content = document.getElementById(tabname);
    if (content) {
        content.classList.add("active-tab");
    }
}