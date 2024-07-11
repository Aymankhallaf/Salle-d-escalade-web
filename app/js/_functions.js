import * as Calendar from "./reservation/_calendar.js";

/**
 * Generate asynchronous call to api.php with parameters
 * @param {*} method GET, POST, PUT or DELETE
 * @param {*} params An object with data to send.
 * @returns 
 */
async function callApi(method, param) {
    try {
        const response = await fetch("api.php",
            {
                method: method,
                body: JSON.stringify(param),
                headers: {
                    'Content-type': 'application/json'
                }
            });
        return await response.json();



    }
    catch (error) {
        console.error("Unable to load data from server : " + error);

    }

}


export function getDates(idGym) {

    callApi("POST", {
        action: "fetch",
        idGym: idGym
    })
        .then(data => {
            if (!data.isOk) {
                console.log("error");
                return;
            }
            data[0].forEach(date => {
                const vacationDate = new Date(date);
                console.log( Calendar.formateDay(vacationDate));
          
                //                 let dateElement= new Date(element);
                // console.log(dateElement);
                // console.log(Calendar.formateDay(element))
            })
        })
}