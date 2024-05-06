

function toggle(element) {
    element.addEventListener("click", function (event) {
        element.classList.toggle("closed");
    });
}


function getAllSelect() {
    document.querySelectorAll(".js-select").forEach(element => {
        toggle(element);
    });
    console.log(document.querySelectorAll(".js-select")
    );

}

getAllSelect()

console.log("ok")
console.log(document.querySelectorAll(".js-select")
);

