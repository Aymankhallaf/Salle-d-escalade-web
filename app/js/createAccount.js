import * as F from "./_functions.js";

// Listen to first next button
document.getElementById("step-btn-1").addEventListener("click", function () {
    if (!validateName("lname", document.getElementById("lname").value)) return;
    if (!validateName("fname", document.getElementById("fname").value)) return;
    if (!validateDate(document.getElementById("birthdate").value)) return;
    showNextStep("2");

    //update ui (stepper img, progress, attributes)
    updatePrevStepperUI("stepper-profile",
        "stepper-profile-img", "./img/name-finished-icon.svg",
        "stepper-profile--progress"
    )
    updateNextStepperUI("stepper-coordinate", "stepper-coordinate-img",
        "./img/adresse--current.svg"

    )


});

// Listen to first previous button
document.getElementById("step-btn-prev-1").addEventListener("click", function () {
    showNextStep("2");

    // updatePrevStepperUI("stepper-coordinate", "stepper-profile",
    //     "stepper-profile-img", "./img/name-current-icon.svg",
    //     "stepper-profile--progress"
    // )


});

// Listen to second next button
document.getElementById("step-btn-2").addEventListener("click", function () {
    if (!validateTel(document.getElementById("tel").value)) return;
    if (!validateName("city", document.getElementById("city").value)) return;
    showNextStep("3");
    // updateStepperUI("stepper-coordinate", "stepper-account",
    //     "stepper-coordinate-img", "./img/adresse--progress.svg",
    //     "r-coordinate--progress"
    // )

});


// Listen to previous button of step 2
document.getElementById("step-btn-prev-2").addEventListener("click", function () {
    showNextStep("3");
});

// Listen to finish button
document.getElementById("finish").addEventListener("click", async function (e) {
    if (!validateEmail(document.getElementById("email").value)) return;
    if (!validatePw(document.getElementById("password").value)) return;
    if (!verifyConfirmPassword(
        document.getElementById("password").value,
        document.getElementById("confirm-psw").value
    )) return;

    const formData = new FormData(document.getElementById("signup-form"));
    const data = Object.fromEntries(formData.entries());

    try {
        const response = await F.callApi("POST", {
            action: "createAccount",
            token: F.getToken(),
            ...data
        });

        if (!response.isOk) {
            displayErrorForm(response.errorMessage);
            return;
        }
        console.log(response);
    } catch (error) {
        console.error("Unable to load data from server: " + error);
    }
});

/**
 * Display error message with template under li element.
 * @param {string} errorMessage
 */
function displayErrorForm(errorMessage) {
    const li = document.importNode(document.getElementById('templateError').content, true);
    const m
        = li.querySelector('[data-error-message]');
    m.innerText = errorMessage;
    document.getElementById('errorsList').innerText = '';
    document.getElementById('errorsList').appendChild(li);
}

/**
 * Validate name input field and show an error message if invalid.
 * @param {string} name The name of the field being validated.
 * @param {string} value The input value.
 * @returns {boolean} True if valid, false otherwise.
 */
function validateName(name, value) {
    const namePattern = /^[a-zA-ZÀ-Ÿ-. ]*$/;

    if (!value) {
        displayErrorForm(`Le ${name} est obligatoire.`);
        return false;
    }

    if (!namePattern.test(value)) {
        displayErrorForm(`Le ${name} est invalide.`);
        return false;
    }
    return true;
}

/**
 * Validate birthdate and show the error if invalid.
 * @param {string} dateInput Date input (birthdate).
 * @return {boolean} True if valid, false otherwise.
 */
function validateDate(dateInput) {
    let birthDay = new Date(dateInput);
    if (isNaN(birthDay)) {
        displayErrorForm(`La date de naissance est invalide.`);
        return false;
    }
    return true;
}

/**
 * Validate telephone and show the error if invalid.
 * @param {string} tel Telephone number input.
 * @returns {boolean} True if valid, false otherwise.
 */
function validateTel(tel) {
    const telPattern = /^[0-9]+$/;

    if (!telPattern.test(tel)) {
        displayErrorForm(`Le numéro de téléphone est invalide.`);
        return false;
    }
    return true;
}

/**
 * Validate email address and show the error if invalid.
 * @param {string} email Email address.
 * @return {boolean} True if valid, false otherwise.
 */
function validateEmail(email) {
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailPattern.test(email)) {
        displayErrorForm(`L'email est invalide.`);
        return false;
    }
    return true;
}

/**
 *… Validate password. Must contain at least one number, one lowercase and one uppercase letter.
 * @param {string} pw Password.
 * @return {boolean} True if valid, false otherwise.
 */
function validatePw(pw) {
    const pwPattern = /^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z]).{8,}$/;
    if (!pwPattern.test(pw)) {
        displayErrorForm(`Le mot de passe est invalide. Il doit contenir au moins une lettre minuscule, une lettre majuscule et un chiffre.`);
        return false;
    }
    return true;
}

/**
 * Check if password and confirm password are identical.
 * @param {string} password Password.
 * @param {string} confirmPassword Confirm password.
 * @return {boolean} True if they are identical, false otherwise.
 */
function verifyConfirmPassword(password, confirmPassword) {
    if (password !== confirmPassword) {
        displayErrorForm("Les mots de passe ne correspondent pas.");
        return false;
    }
    return true;
}

/**
 * Hide the current step and show the next step by toggling the 'hidden' CSS class.
 * @param {string} stepNumber Number of the step to show.
 */
function showNextStep(stepNumber) {
    document.getElementById('errorsList').innerText = '';
    document.querySelectorAll("[data-step]").forEach((step) => {
        if (step.dataset.step == stepNumber || step.dataset.step == stepNumber - 1) {
            step.classList.toggle("hidden");
        }
    });
}



// 
function updatePrevStepperUI(stepId, imgId, imgSr, progressClass = "") {

    let stepper = document.getElementById(stepId);
    let stepperImg = document.getElementById(imgId);


    stepperImg.src = imgSr;
    stepper.classList.toggle(progressClass);


    stepper.setAttribute("aria-selected", "false");
    stepper.setAttribute("aria-current", "false");
}

function updateNextStepperUI(stepId, imgId, imgSr, progressClass = "") {

    let stepper = document.getElementById(stepId);
    let stepperImg = document.getElementById(imgId);


    stepperImg.src = imgSr;
    stepper.classList.toggle(progressClass);


    stepper.setAttribute("aria-selected", "true");
    stepper.setAttribute("aria-current", "step");
}

// function updateStepperUI(prevStepId, prevImgId, prevImgSrc,
//     nextStepId, nextImgId, nextImgSrc,
//     progressClass) {
//     let stepperPrev = document.getElementById(prevStepId);
//     let stepperNext = document.getElementById(nextStepId);
//     let stepperPrevImg = document.getElementById(prevImgId);
//     let stepperNextImg = document.getElementById(nextImgId);


//     stepperPrevImg.src = prevImgSrc;
//     stepperNextImg.src = nextImgSrc
//     stepperPrev.classList.toggle(progressClass);
//     stepperNext.classList.toggle(progressClass);


//     stepperPrev.setAttribute("aria-selected", "false");
//     stepperPrev.setAttribute("aria-current", "false");
//     stepperNext.setAttribute("aria-selected", "true");
//     stepperNext.setAttribute("aria-current", "step");
// }