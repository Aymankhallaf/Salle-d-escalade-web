let numberOfAvaliablePlace = 10;
const participantsInput = document.getElementById("participants")

function handleInputField() {
    console.log(parseInt(participantsInput.value));

    return parseInt(participantsInput.value);
}

let numberOfParticipants = handleInputField();

    function controlNumberOfParticpants(numberOfAvaliablePlace, numberOfParticipants) {
        if (numberOfParticipants>numberOfAvaliablePlace){
            
            console.log(`th`)
         }

}



participantsInput.addEventListener("keyup", handleInputField)