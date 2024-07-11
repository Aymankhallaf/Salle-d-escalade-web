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



/**
 * Display error message with template
 * @param {string} errorMessage 
 */
function displayError(errorMessage) {
    const li = document.importNode(document.getElementById('templateError').content, true);
    const m = li.querySelector('[data-error-message]');
    m.innerText = errorMessage;
    document.getElementById('errorsList').appendChild(li);
    setTimeout(() => m.remove(), 2000);
}


/**
 * Display message with template
 * @param {string} message 
 */
function displayMessage(message) {
    const li = document.importNode(document.getElementById('templateMessage').content, true);
    const m = li.querySelector('[data-message]')
    m.innerText = message;
    document.getElementById('messagesList').appendChild(li);
    setTimeout(() => m.remove(), 2000);
}


export async function getVacationDates(idGym) {
    try {
        const data = await callApi("POST", {
            action: "fetch",
            idGym: idGym,
            token: getToken()
            
        });

        if (!data.isOk) {
            displayError(data['errorMessage']);
            return;
        }
        let holidaysFR = []
        data[0].forEach(day => {
            holidaysFR.push(Calendar.formateDay(new Date(day)));
        });
        displayMessage("tu as bien choisi le salle");
        document.getElementById("month-days").innerText="";
        await Calendar.updateHolidays(holidaysFR);
        await Calendar.updateCalendar();

    } catch (error) {
        displayError("Error fetching dates: " + error);
    }
}