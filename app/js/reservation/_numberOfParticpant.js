// const participantsInput = document.getElementById("participants")

// /**
//  * 
//  * @returns number of participants.
//  */
// function handleparticipantsField(value, max) {
//     let value = parseInt(participantsInput.value);
//     if(verifyCapacity(value, max)){

//     } 

//     return value
// }

// let numberOfParticipants = handleparticipantsField();


// // listen to the input value
// participantsInput.addEventListener("keyup", handleparticipantsField);


// //listen to the input increase button
// document.getElementById("increase-participant").addEventListener("click", () => {
//     let newNumberOfParticipants = handleparticipantsField() + 1;
//     participantsInput.value = newNumberOfParticipants;
// })

// //listen to the input decrease button
// document.getElementById("decrease-participant").addEventListener("click", () => {
//     let newNumberOfParticipants = handleparticipantsField() - 1;
//     participantsInput.value = newNumberOfParticipants;
// })



// /**
//  * compared a value to max and return true or false.
//  * @param {int} max int max value.
//  * @param {int} value int max value.
//  * @returns {boolean} true if value smaller or equal to max.
//  */
// export function verifyCapacity(value, max) {
//     return value <= max;
// }

