

//listen to first next button
document.getElementById("step-btn-1").addEventListener("click", function () {
    if (!isValidateName("lname", document.getElementById("lname").value)) return;
    if (!isValidateName("fname", document.getElementById("fname").value)) return;
    console.log
    if (!isValideDate(document.getElementById("birthdate").value)) return;
    showNextStep("2");
});

//listen to previous next button
document.getElementById("step-btn-prev-1").addEventListener("click", function(){
    showNextStep("2");

})

//listen to second next button
document.getElementById("step-btn-2").addEventListener("click", function () {
    if (!isValideTel(document.getElementById("tel").value))return;
    if (!isValidateName("city", document.getElementById("city").value))return;
    showNextStep("3");
});

//listen to second next button

document.getElementById("step-btn-prev-2").addEventListener("click", function(){
    showNextStep("3");

})


//listen to finish button
document.getElementById("finish").addEventListener("click", function () {
    if (!isValideMail("email", document.getElementById("email").value))return;
    if (!isValidePw(document.getElementById("password").value))return;
    if (!isVerifyconfirmPassword(
        document.getElementById("password").value,
        document.getElementById("confirm-psw").value
                                 )) return;
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
 * is a valide name input field? shows an error message.
 * @param {string} name The name of the field being validated.
 * @param {string} value The input value.
 * @returns {boolean} false if not and true if it is valide.
 */
function isValidateName(name, value) {
    const namePattern = new RegExp( /^[a-zA-ZÀ-Ÿ-. ]*$/);

    if (!value) {
        displayErrorForm(`Le ${name} est obligatoire.`);
        return false;
    }

    if (!namePattern.test(value)) {
        displayErrorForm(`Le ${name} invalide.`);
        return false;
    }
    return true;

}


/**
 *
 * is a Valide birthdate? and show the error if not.
 * @param {string} dateInput date input(birthdate).
 * @return {boolean} false if not and true if it is valide.
 */
function isValideDate(dateInput) {

    let birthDay = new Date(dateInput);
    if (isNaN(birthDay)) {
        displayErrorForm(`Le birthDate invalide.`);
        return false;
    };
    return true;
}




/**
 * is valide telephone ?  show the error if not.
 * @param {string} tel input telephone number
 * @returns {boolean} false if not and true if it is valide.
 */
function isValideTel(tel) {
    const regextel = new RegExp(/[0-9]/gi);

    if (!regextel.test(tel)) {
        displayErrorForm(`Le numéro de télephone est invalide.`);
        return false;
    }
    return true;

}


/**
 *
 * is valide email adresse? show the error if not.
 * @param {string} email email adresse.
 * @return {boolean} return if it doesn't follow the criteria.
 */
function isValideMail(email) {
    const regxemail = new RegExp('/^[^\s@]+@[^\s@]+\.[^\s@]+$/');
    if (!regxemail.test(email)) {
        displayErrorForm(`Le ${emailField} est invalide.`);
        return false;
    }
    return true;
}




/**
 *
 * is Valide password has one number, one small lettre and capital lettre at leaast. 
 * @param {string} pw pasword.
 * @return {boolean} return false if the password doesn't follow the criteria otherwise true. 
 */
function isValidePw(pw) {
    
    const regxemail = new RegExp('(?=.*?[0-9])(?=.*[a-z])(?=.*[A-Z]).{8,}');
    if (!regxemail.test(pw)) {
        displayErrorForm(`Le mot de passe est invalide. Il doit contenir au moins une lettre minuscule, une lettre majuscule et un chiffre.`);
        return;
    }

}


/**
 *
 * Is the password and confirm password are identical?.
 * @param {string} password a string of password.
 *  @param {string} confirmPassword a string of password.
 * @return {boolean} return fasle if they aren't equal, true if they are equal.
 */
function isVerifyconfirmPassword(password,confirmPassword){
    if (password !== confirmPassword) {
        displayErrorForm("Les mots de passe ne correspondent pas.");
        return false;
    }
    return true;
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