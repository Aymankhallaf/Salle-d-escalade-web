// halls = { "first": { "mai 2024": { "1": { "10:00": 10 } } } }
import * as Calendar from "./_calendar.js";
import * as Hours from "./_hours.js";
import * as NParticipants from "./_numberOfParticpant.js";
import * as F from "../_functions.js";




document.getElementById("hall").addEventListener("change", (e) => {

    if (e.target.value !== "1" && e.target.value !== "2") {
        displayError("erreur lors du choix de la salle d'escalade");
        return;
    }
    //get vacation dates
    localStorage.setItem("chosenGym", JSON.stringify(e.target.value));
    Calendar.getVacationDates(e.target.value);
}
);



// document.getElementById("reservation-form").addEventListener("submit", handleSubmit)
// function handleSubmit(e) {
//     e.preventDefault();
//     let formData = new FormData(e.target);
//     console.log(formData)
//     for (const [key, value] of formData) {
//         console.log(`${key}: ${(value)}\n`);
//     }


// }