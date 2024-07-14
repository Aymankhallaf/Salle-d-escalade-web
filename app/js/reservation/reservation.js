// halls = { "first": { "mai 2024": { "1": { "10:00": 10 } } } }
import * as Calendar from "./_calendar.js";
import * as Hours from "./_hours.js";
import * as NParticipants from "./_numberOfParticpant.js";
import * as F from "../_functions.js";



 F.getGym();
 document.getElementById("hall").addEventListener("change", (e) => {

    F.verifyIdGym(e.target.value);
    //get vacation dates
    localStorage.setItem("chosenGym", JSON.stringify(e.target.value));
    Calendar.getVacationDates(e.target.value);
    F.setMaxGymCapacity(capicty);

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