/**
 * Display error message with template under li element.
 * @param {string} errorMessage
 *@param {string} idElement id of html tag to show the error
 */
export function displayErrorForm(errorMessage) {
    // document.getElementById('errorsList').innerText="";
    const li = document.importNode(document.getElementById('templateError').content, true);
    const m = li.querySelector('[data-error-message]');
    m.innerText = errorMessage;
    document.getElementById('errorsList').appendChild(li);
}



/**
 * Validates name input field and saves it in local storage or shows an error message.
 * @param {string} name The name of the field being validated.
 * @param {string} value The input value.
 * @returns {string|void}
 */
function validateName(name, value) {
    const namePattern = /^[a-zA-ZÀ-ÖØ-öø-ÿ\s-]+$/;

    if (!value) {
        displayErrorForm(`Le ${name} est obligatoire.`);
        return;
    }

    if (!namePattern.test(value)) {
        displayErrorForm(`Le ${name} invalide.`);
        return;
    }

    localStorage.setItem(name, value);
    return "Valid name.";
}


let nextBtnFirst = document.getElementById("step-btn-1");
nextBtnFirst.addEventListener("click", function () {


    const lnameValidationResult = validateName("lname", document.getElementById("lname").value);
    const fnameValidationResult = validateName("fname", document.getElementById("fname").value);

    // if (lnameValidationResult === "Valid name." && fnameValidationResult === "Valid name.") {
    //     // Proceed to the next step
    //     showStep(1); // Assuming showStep is a function that handles the step transition
    // }
});
