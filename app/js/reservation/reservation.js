// halls = { "first": { "mai 2024": { "1": { "10:00": 10 } } } }
import * as Calendar from "./_calendar.js";
import * as Hours from "./_hours.js";
import * as NParticipants from "./_nbParticpant.js";
import * as F from "../_functions.js";



F.getGym();
document.getElementById("hall").addEventListener("change", (e) => {
    F.verifyIdGym(e.target.value);
    //get vacation dates
    localStorage.setItem("chosenGym", JSON.stringify(e.target.value));
    Calendar.GetSetGymDetails(e.target.value);
}
);



document.getElementById("duration").addEventListener("change", (e) => {

    //to do -write function to verify id !!!
    //get vacation dates
    localStorage.setItem("duration", JSON.stringify(e.target.value));
    //to do verify avaliable time

}
);



document.getElementById("reservation-form").addEventListener("submit", handleSubmit)
function handleSubmit(e) {

    e.preventDefault();
    let reservationElem = { ...localStorage };
    //to do a review
    if (!reservationElem.hasOwnProperty("chosenGym")) {
        F.displayError(data["Vous n'avez pas choisi la salle."]);
        return
    }
    if (!reservationElem.hasOwnProperty("participants")) {
        F.displayError(data["Vous n'avez pas choisi le numéro de participants."]);
        return
    }
    if (!reservationElem.hasOwnProperty("chosenDate")) {
        F.displayError(data["Vous n'avez pas choisi le date."]);
        return
    }
    if (!reservationElem.hasOwnProperty("duration")) {
        F.displayError(data["Vous n'avez pas choisi l'heure."]);
        return
    }
    if (!reservationElem.hasOwnProperty("chosenHour")) {
        F.displayError(data["Vous n'avez pas choisi l'heure."]);
        return
    }

    F.callApi("POST", {
        action: "reserve",
        token: F.getToken(),
        duration: JSON.parse(localStorage.getItem("duration")),
        chosenDate: JSON.parse(localStorage.getItem("chosenDate")),
        participants: JSON.parse(localStorage.getItem("participants")),
        chosenHour: JSON.parse(localStorage.getItem("chosenHour")),
        chosenGym: JSON.parse(localStorage.getItem("chosenGym"))
    }).then(data => {
        if (!data.isOk) {
            F.displayError(data['errorMessage']);
            return;
        }
        // console.log(data["idGym"]);
        // console.log(localStorage.getItem("chosenGym"));
        // F.verifyReturnData(data["idGym"], JSON.parse(localStorage.getItem("chosenGym")));
        // F.verifyReturnData(data["chosenDate"], JSON.parse(localStorage.getItem("chosenDate")));
        // let hours = data["openClosehoures"][0];
        // let openHour = hours["open_hour"].slice(0, 2);
        // let closeHour = hours["close_hour"].slice(0, 2);
        // document.getElementById("hours__container").innerHTML = "";
        // H.displayHour(openHour, closeHour);
        
        //redirect to shown reservation page.
        // document.location.href = `/dashboard.php#reservation-details?idReservation=${data["idReservation"]}`

   


    })

    // let formData = new FormData(e.target);
    // console.log(formData)
    // for (const [key, value] of formData) {
    //     console.log(`${key}: ${(value)}\n`);
    // // }


}