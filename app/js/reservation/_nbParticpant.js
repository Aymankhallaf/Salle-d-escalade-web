import * as F from "../_functions.js";

const participantsInput = document.getElementById("participants");
const maxDefaultCapacity = JSON.parse(localStorage.getItem("capacity"));

/**
 * Handle the participants input field.
 * @param {number} value - The current number of participants.
 * @param {number} maxDefaultCapacity - The maximum allowed capacity.
 * @returns {number} The number of participants.
 */
function handleInputField(value, maxDefaultCapacity) {
    value === null ? 0 : value;
    if (!verifyCapacity(value, maxDefaultCapacity)) {
        F.displayError(`La valeur doit être inférieure à ${maxDefaultCapacity}`);
        return participantsInput.value; // Return the current value to prevent changes
    }
    if (value < 1) {
        F.displayError(`La valeur doit être supérieure à 0`);
        return participantsInput.value; // Return the current value to prevent changes
    }
    localStorage.setItem("participants", JSON.stringify(value));
    return value;
}


/**
 * Compares a value to max and returns true or false.
 * @param {number} value - The value to compare.
 * @param {number} max - The maximum allowed value.
 * @returns {boolean} True if value is smaller or equal to max.
 */
export function verifyCapacity(value, max) {
    return value <= max;
}


// Listen to the input value changes
participantsInput.addEventListener("keyup", () => {
    let value = parseInt(participantsInput.value);
    let validatedValue = handleInputField(value, maxDefaultCapacity);
    participantsInput.value = validatedValue;
});

// Listen to the increase button click
document.getElementById("increase-participant").addEventListener("click", () => {
    let currentValue = parseInt(participantsInput.value);
    let newValue = handleInputField(currentValue + 1, maxDefaultCapacity);
    participantsInput.value = newValue;
});

// Listen to the decrease button click
document.getElementById("decrease-participant").addEventListener("click", () => {
    let currentValue = parseInt(participantsInput.value);
    let newValue = handleInputField(currentValue - 1, maxDefaultCapacity);
    participantsInput.value = newValue;
});
