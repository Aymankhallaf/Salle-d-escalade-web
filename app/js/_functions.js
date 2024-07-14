import * as Calendar from "./reservation/_calendar.js";


/**
 * Get current global token value.
 * @returns 
 */
export function getToken() {
    return document.getElementById('token').dataset.token;
}


/**
 * Generate asynchronous call to api.php with parameters
 * @param {*} method GET, POST, PUT or DELETE
 * @param {*} params An object with data to send.
 * @returns 
 */
export async function callApi(method, param) {
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
export function displayError(errorMessage) {
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
export function displayMessage(message) {
    const li = document.importNode(document.getElementById('templateMessage').content, true);
    const m = li.querySelector('[data-message]')
    m.innerText = message;
    document.getElementById('messagesList').appendChild(li);
    setTimeout(() => m.remove(), 2000);
}

/**
 * Display gym(hall) with template
 * @param {object} gym 
 */
export function displayGym(gym) {
    const template = document.importNode(document.getElementById('hallTemplate').content, true);
    const option = template.querySelector('.js-hall-option')
    option.innerText = gym['name_gym'];
    option.value = gym['id_gym'];
    document.getElementById('hall').appendChild(option);

}



/**
 * verify the id gym.
 * return void(stop script) if the id gym not "1" or "2"
 * @returns {void}
 */
export function verifyIdGym(idGym) {
    if (idGym !== "1" && idGym !== "2") {
        displayError("erreur lors du choix de la salle d'escalade");
        return;
    }
}


/**
 *
 *verify if the response data the same as the requested
 * @param {string} request string for request data. 
 * @param {string} response string for response data. 
 * @return {void} if not the same and display message error.
 */
export function verifyReturnData(request, response) {
    if (request !== response) {
        displayError("erreur lors de l'envoi et de la réception des données");
        return
    }
}


/**
 * get list of gym then call displayGym().
 */
export function getGym() {
    callApi("POST", {
        action: "fetchGym",
        token: getToken()

    }).then(data => {
        if (!data.isOk) {
            displayError(data['errorMessage']);
            return;
        }
        data[0].forEach(gym => {
            displayGym(gym);

        });


    })

}


/**
 * compared a value to max and return true or false.
 * @param {int} max int max value.
 * @param {int} value int max value.
 * @returns {boolean} true if value smaller or equal to max.
 */
function verifyCapacity(value,max){
return value <= max;
}

/*** */
function maxCapacityControl(capicty){
    document.getElementsByName("participants").addEventListener('change', capacityControl );
}

