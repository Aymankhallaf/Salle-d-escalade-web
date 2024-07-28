import * as F from './_functions.js';


console.log("ok");



document.addEventListener("DOMContentLoaded", function () {
    let param = F.getQueryParams()
    console.log(param);
    F.callApi("POST", {
        action: "getAReservation",
        token: F.getToken(),
        idReservation: param.idReservation

    }).then(data => {
        if (!data.isOk) {
            displayError(data['errorMessage']);

        }
    });
});
