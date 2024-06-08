
function toggle(element, closedClassName) {
    element.addEventListener("click", function (event) {
        element.classList.toggle(closedClassName);
    });
}


function toggleClassName(className, closedClassName) {
    document.querySelectorAll(className).forEach(element => {
        toggle(element, closedClassName);
    });

}

toggleClassName(".js-select", "open-simple-arrow");


