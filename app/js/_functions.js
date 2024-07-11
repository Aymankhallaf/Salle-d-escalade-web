import * as Calendar from "./reservation/_calendar.js";


/**
 * Get current global token value.
 * @returns 
 */
function getToken() {
    return document.getElementById('token').dataset.token;
}


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

console.log(getToken());

export async function getVacationDates(idGym) {
    try {
        const data = await callApi("POST", {
            action: "fetch",
            idGym: idGym,
            token: getToken()
            
        });

        if (!data.isOk) {
            console.log("error");
            return;
        }
        let holidaysFR = []
        data[0].forEach(day => {
            holidaysFR.push(Calendar.formateDay(new Date(day)));
        });
        console.log(holidaysFR);
        document.getElementById("month-days").innerText="";
        await Calendar.updateHolidays(holidaysFR);
        await Calendar.updateCalendar();

    } catch (error) {
        console.error("Error fetching dates: " + error);
    }
}