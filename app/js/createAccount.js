/**
 * Display error message with template under li element.
 * @param {string} errorMessage
 *@param {string} idElement id of html tag to show the error
 */
 export function displayErrorForm(errorMessage) {
    document.getElementById('errorsList').innerHTML="";
    const li = document.importNode(document.getElementById('templateError').content, true);
    const m = li.querySelector('[data-error-message]');
    m.innerText = errorMessage;
    document.getElementById('errorsList').appendChild(li);
}



/**
 * Valides name input field.
 * @param {string} name 
 * @param {string} idToShowError 
 * @returns 
 */
export function validateName(name) {
    const namePattern = /^[a-zA-Z\s-]+$/;

    if (!name) {
        displayErrorForm(`Le ${name} est obligatoire.`);
        return;
    }

    if (!namePattern.test(name)) {
        displayErrorForm(`Le ${name} invalide.`);
        return;
        
    }

    return "Valid name.";
}


let lname = document.getElementById("lname");
displayErrorForm(`Le name invalide.`, "lname");

let nextBtnFirst = document.getElementById("step-btn-1");
nextBtnFirst.addEventListener("click", function () {
   validateName(lname.value, "lname");
})

