// halls = { "first": { "mai 2024": { "1": { "10:00": 10 } } } }
import * as Calendar from "./_calender.js";
import * as Hours from "./_hours.js";
import * as NParticipants from "./_numberOfParticpant.js";
import * as f from "../_functions.js";


document.getElementById("hall").addEventListener("change", (e) => {

    console.log(e.target.value);
    if (e.target.value !== "1" && e.target.value !== "2") {
        console.log("error chosing gym");
        return;
    }
    f.getDates(e.target.value);
}
);

console.log(currentDate);
console.log("".currentDate.toLocaleString("fr-FR", {
    weekday: "long",
    year: "numeric",
    month: "long",
    day: "numeric",
  }))


// document.getElementById("reservation-form").addEventListener("submit", handleSubmit)
// function handleSubmit(e) {
//     e.preventDefault();
//     let formData = new FormData(e.target);
//     console.log(formData)
//     for (const [key, value] of formData) {
//         console.log(`${key}: ${(value)}\n`);
//     }


// }