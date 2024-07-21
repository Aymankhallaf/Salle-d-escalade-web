

//listen to first next button
document.getElementById("step-btn-1").addEventListener("click", function () {
    validateName("lname", document.getElementById("lname").value);
    validateName("fname", document.getElementById("fname").value);
    valideDate(document.getElementById("birthdate").value);
    valideDate(document.getElementById("birthdate").value);
    showNextStep("2");
    document.getElementById("birthdate").value
});

//listen to previous next button

//listen to second next button





/**
 * Display error message with template under li element.
 * @param {string} errorMessage
 *@param {string} idElement id of html tag to show the error
 */
function displayErrorForm(errorMessage) {

    const li = document.importNode(document.getElementById('templateError').content, true);
    const m = li.querySelector('[data-error-message]');
    m.innerText = errorMessage;
    document.getElementById('errorsList').appendChild(li);


}



/**
 * Validates name input field and saves it in local storage or shows an error message.
 * @param {string} name The name of the field being validated.
 * @param {string} value The input value.
 * @returns {void}
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

    localStorage.setItem(name, JSON.stringify(value));
}


/**
 *
 *Valides birthdate and save it in local storge.
 * @param {string} dateInput date input(birthdate).
 * @return {void} 
 */
function valideDate(dateInput) {

    let birthDay = new Date(dateInput);
    if (isNaN(birthDay)) {
        displayErrorForm(`Le birthDate invalide.`);
        return;
    };
    localStorage.setItem("birthDate", JSON.stringify(dateInput));
}





function Portable_Valide(nbTel)
{
  let regexTelephone = new RegExp(/^(06|07)[0-9]{8}/gi);
    
    if (!regexTelephone.test (nbTel))
    {
        return(true);
    }

    localStorage.setItem("tel", JSON.stringify(nbTel));
    
}



/**
 *
 *hide the current step and show the next step by adding hidden css.
 * @param {string} stepNumber number of step in string formate.
 */
function showNextStep(stepNumber) {
    document.querySelectorAll("[data-step]").forEach((step) => {
        if (step.dataset.step <= stepNumber) {

            step.classList.toggle("hidden");
        }
    })
}