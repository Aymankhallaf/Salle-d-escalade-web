// halls = { "first": { "mai 2024": { "1": { "10:00": 10 } } } }
import * as Calendar from "./_calendar.js";
// import * as Hours from "./_hours.js";
import * as F from "../_functions.js";

//get url parameters 
let urlParam = F.getQueryParams();
localStorage.setItem("param", JSON.stringify(urlParam));


F.getGym();

document.getElementById("hall").addEventListener("change", (e) => {
    F.verifyIdGym(e.target.value);
    //get vacation dates
    localStorage.setItem("chosenGym", JSON.stringify(e.target.value));
    Calendar.GetSetGymDetails(e.target.value);
}
);

document.getElementById("duration").addEventListener("change", (e) => {

    F.verifyDuration(e.target.value);
    localStorage.setItem("duration", JSON.stringify(e.target.value));
    //to do verify avaliable time

});



document.getElementById("abonnement-form").addEventListener("submit",

    handReservationSubmit)


function handReservationSubmit(e) {

    e.preventDefault();
    let reservationElem = { ...localStorage };

    if (!reservationElem.hasOwnProperty("chosenGym")) {
        F.displayError(data["Vous n'avez pas choisi la salle."]);
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

    if (Object.keys(urlParam).length === 3) {
        editReservation("PUT", "editReservation");
        // manuplateReservation("PUT", editReservation, urlParam["idReservation"]);
    } else {
        manuplateReservation("POST", "reserve");
    }


}




function manuplateReservation(method, action, idReservation = null) {
    let apiParam = {
        action: action,
        token: F.getToken(),
        duration: JSON.parse(localStorage.getItem("duration")),
        chosenDate: JSON.parse(localStorage.getItem("chosenDate")),
        //default one abonnement for account
        participants: JSON.parse(1),
        chosenHour: JSON.parse(localStorage.getItem("chosenHour")),
        chosenGym: JSON.parse(localStorage.getItem("chosenGym"))
    }
    if (idReservation) { apiParam["idReservation"] = idReservation; }
    F.callApi(method, apiParam).then(data => {
        if (!data.isOk) {
            F.displayError(data['errorMessage']);
            return;
        }

        F.validateReturnDataReservation(data);
        //redirect to shown reservation page.(to do do you needs another params to pass?)
        document.location.href = `/panier.php#reservation-details?idReservation=${data["idReservation"]}&token=${data["token"]}`

    })
}

function editReservation(method, action) {
    let apiParam = {
        action: action,
        token: F.getToken(),
        duration: JSON.parse(localStorage.getItem("duration")),
        chosenDate: JSON.parse(localStorage.getItem("chosenDate")),
        participants: JSON.parse(localStorage.getItem("participants")),
        chosenHour: JSON.parse(localStorage.getItem("chosenHour")),
        chosenGym: JSON.parse(localStorage.getItem("chosenGym")),
        idReservation: urlParam["idReservation"]
    }
    F.callApi(method, apiParam).then(data => {
        if (!data.isOk) {
            F.displayError(data['errorMessage']);
            return;
        }

        F.validateReturnDataReservation(data);
        //redirect to shown reservation page.(to do do you needs another params to pass?)
        document.location.href = `/panier.php?idReservation=${urlParam["idReservation"]}&token=${F.getToken()}`

    })
}

