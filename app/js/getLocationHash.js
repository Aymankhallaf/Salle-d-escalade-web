import * as F from './_functions.js';



let param = F.getQueryParams()

document.addEventListener("DOMContentLoaded", function () {
    if(F.getToken()!==param.token ){
        return;
    }
    F.callApi("POST", {
        action: "getAReservation",
        token: F.getToken(),
        idReservation: param.idReservation

    }).then(data => {
        if (!data.isOk) {
            displayError(data['errorMessage']);

        }

        F.displayReservation(data[0][0]);
    });
});

document.getElementById("reservation-cancel").addEventListener("click", function () {
    
    console.log(param);
    F.callApi("POST", {
        action: "cancelReservation",
        token: F.getToken(),
        idReservation: param.idReservation

    }).then(data => {
        if (!data.isOk) {
            displayError(data['errorMessage']);

        }

    });
})


