import * as F from './_functions.js';


console.log("ok");



if (window.location.hash.startsWith('#reservation-details')) {
    console.log(F.getQueryParams()['idReservation']);
    F.callApi("POST", {
        action: "reserve",
        token: getToken(),
        idReservation: F.getQueryParams()['idReservation']

    }).then(data => {
        if (!data.isOk) {
            displayError(data['errorMessage']);
            return;
        }


        console.log("ok")

    })

}