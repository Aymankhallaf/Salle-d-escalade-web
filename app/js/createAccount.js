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
 * Valides name input field and save it in local storge or show an error message .
 * @param {string} name (the name that we want to check) input value.
 * @param {string} savedName id of the input value
 * @returns {string?void}
 */
export function validateName(name,savedName) {
    const namePattern = /^[a-zA-Z\s-]+$/;

    if (!name) {
        displayErrorForm(`Le ${name} est obligatoire.`);
        return;
    }

    if (!namePattern.test(name)) {
        displayErrorForm(`Le ${name} invalide.`);
        return;
        
    }
    localStorage.setItem(savedName, JSON.stringify(name)); 
    return "Valid name.";
}




let nextBtnFirst = document.getElementById("step-btn-1");
nextBtnFirst.addEventListener("click", function () {
    validateName("lname", document.getElementById("lname").value);
    validateName("fname", document.getElementById("fname").value); 
 
})

