let numberOfAvaliablePlace = 10;
const participantsInput = document.getElementById("participants")

function handleInputField() {

    return parseInt(participantsInput.value);
}

let numberOfParticipants = handleInputField();

function controlNumberOfParticpants(numberOfAvaliablePlace, numberOfParticipants) {
    if (numberOfParticipants > numberOfAvaliablePlace) {
//move this function to reservation.js
    }

}



participantsInput.addEventListener("keyup", handleInputField)