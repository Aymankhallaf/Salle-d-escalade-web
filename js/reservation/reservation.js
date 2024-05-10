// //data
// halls = { "first": { "mai 2024": { "1": { "10:00": 10 } } } }
import * as Calendar from "./calender.js";
import * as Hours from "./hours.js";

document.getElementById("reservation-form").addEventListener("submit", handleSubmit)
function handleSubmit(e) {
    e.preventDefault();
    let formData = new FormData(e.target);
    console.log(formData)
    for (const [key, value] of formData) {
        console.log(`${key}: ${typeof(value)}\n`);
    }
    

}