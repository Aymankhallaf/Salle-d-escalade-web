let numberOfAvaliablePlace = 10;
const participantsInput = document.getElementById("participants")


/**
 * 
 * @returns number of participants.
 */
function handleInputField() {

    return parseInt(participantsInput.value);
}

let numberOfParticipants = handleInputField();

/**
 * this function under construction.
 * @param {number} numberOfAvaliablePlace 
 * @param {number} numberOfParticipants 
 */
function controlNumberOfParticpants(numberOfAvaliablePlace, numberOfParticipants) {
    if (numberOfParticipants > numberOfAvaliablePlace) {
        //move this function to reservation.js ?!!
    }

}


// listen to the input value
participantsInput.addEventListener("keyup", handleInputField);


//listen to the input increase button
document.getElementById("increase-participant").addEventListener("click", () => {
    let newNumberOfParticipants = handleInputField() + 1;
    participantsInput.value = newNumberOfParticipants;
})

//listen to the input decrease button
document.getElementById("decrease-participant").addEventListener("click", () => {
    let newNumberOfParticipants = handleInputField() - 1;
    participantsInput.value = newNumberOfParticipants;
})