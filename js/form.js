
/**
 * toggel function 
 * @param {string} toggleId an id text ex(#features)
 * @param {string} hiddenMenuClass a class text ex(.menu)
 */
function toggle(toggleId, hiddenMenuClass) {
    document.querySelector(toggleId).addEventListener("click", function (event) {
        btn.classList.toggle("closed");
        document.querySelector(hiddenMenuClass).classList.toggle("text-hidden");
    });
}



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

toggleClassName(".js-select", "simple-arrow");

