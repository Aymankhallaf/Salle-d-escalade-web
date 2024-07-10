// halls = { "first": { "mai 2024": { "1": { "10:00": 10 } } } }
import * as Calendar from "./_calender.js";
import * as Hours from "./_hours.js";
import * as NParticipants from "./_numberOfParticpant.js"

document.getElementById("hall").addEventListener("change", function () {

    console.log(this.value)
    callApi()
}
);



document.getElementById("reservation-form").addEventListener("submit", handleSubmit)
function handleSubmit(e) {
    e.preventDefault();
    let formData = new FormData(e.target);
    console.log(formData)
    for (const [key, value] of formData) {
        console.log(`${key}: ${(value)}\n`);
    }


}