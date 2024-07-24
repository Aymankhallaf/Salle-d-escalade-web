import * as F from "./_functions.js";


//listen to first next button
document.getElementById("step-btn-1").addEventListener("click", function () {
    validateName("lname", document.getElementById("lname").value);
    validateName("fname", document.getElementById("fname").value);
    valideDate(document.getElementById("birthdate").value);
    valideDate(document.getElementById("birthdate").value);
    console.log("1")
    showNextStep("2");
    document.getElementById("birthdate").value
});

//listen to previous next button
document.getElementById("step-btn-prev-1").addEventListener("click", function(){
    showNextStep("1");

})

//listen to second next button
document.getElementById("step-btn-2").addEventListener("click", function () {
    ValideTel(document.getElementById("tel").value);
    validateName("city", document.getElementById("city").value);
    showNextStep("3");
});




//listen to finish button
document.getElementById("finish").addEventListener("click", function () {
    ValideMail("email", document.getElementById("email").value);
    verifyconfirmPassword(
        document.getElementById("password").value,
        document.getElementById("confirm-psw").value
)
    console.log("finsh")
});




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
    const namePattern = new RegExp( /^[a-zA-ZÀ-Ÿ-. ]*$/);

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




/**
 * valide telephone 
 * @param {string} tel input telephone number
 * @returns 
 */
function ValideTel(tel) {
    const regextel = new RegExp(/[0-9]/gi);

    if (!regextel.test(tel)) {
        displayErrorForm(`Le numéro de télephone est invalide.`);
        return;
    }

    localStorage.setItem("tel", JSON.stringify(tel));

}


/**
 *
 *verfy email adress and save it in DOM.
 * @param {string} email email adresse.
 * @return {void} return if it doesn't follow the criteria.
 */
function ValideMail(email) {
    const regxemail = new RegExp('/^[a-z0-9._%+\-]+@[a-z0-9.\-]+\.[a-z]{2,}$/');
    if (!regxemail.test(email)) {
        displayErrorForm(`Le email est invalide.`);
        return;
    }
    localStorage.setItem("email", JSON.stringify(email));

}




/**
 *
 *Valides if password has one number, one small lettre and capital lettre at leaast. 
 * @param {string} pw pasword.
 * @return {void} return if the password doesn't follow the criteria. 
 */
function validePw(pw) {
    
    const regxemail = new RegExp('(?=.*?[0-9])(?=.*[a-z])(?=.*[A-Z]).{8,}');
    if (!regxemail.test(pw)) {
        displayErrorForm(`Le mot de passe est invalide. Il doit contenir au moins une lettre minuscule, une lettre majuscule et un chiffre.`);
        return;
    }

    localStorage.setItem("pw", JSON.stringify(pw));
}


/**
 *
 * Confirm if the password and confirm password are identical.
 * @param {string} password a string of password.
 *  @param {string} confirmPassword a string of password
 * @return {void} return if they aren't equal.
 */
function verifyconfirmPassword(password,confirmPassword){
    if (password !== confirmPassword) {
        displayErrorForm("Les mots de passe ne correspondent pas.");
        return;
    }
}


/**
 *
 *hide the current step and show the next step by adding hidden css.
 * @param {string} stepNumber number of step in string formate.
 */
function showNextStep(stepNumber) {
    document.querySelectorAll("[data-step]").forEach((step) => {
        if (step.dataset.step == stepNumber || step.dataset.step == stepNumber - 1) {

            step.classList.toggle("hidden");
        }
    })
}





// function sendCreationData() {
//     callApi("POST", {
//         action: "createAcount",
//         token: F.getToken(),

        
//     })
//         .then(data = {
//         })
// }