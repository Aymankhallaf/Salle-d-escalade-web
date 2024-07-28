
//api functions
/**
 * Get current global token value.
 * @returns 
 */
export function getToken() {
    return document.getElementById('token').dataset.token;
}


/**
 * Generate asynchronous call to api.php with parameters
 * @param {string} method GET, POST, PUT or DELETE
 * @param {object} params An object with data to send.
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
 * Generate asynchronous call to "url.php" with parameters
 * @param {string} url the target url
 * @param {string} method GET, POST, PUT or DELETE
 * @param {object} params An object with data to send.
 * @returns 
 */
export async function callUrlApi(url, method, param) {
    try {
        const response = await fetch("url",
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




//error

/**
 * Display error message with template under li element.
 * @param {string} errorMessage
 *@param {string} idElement id of html tag to show the error
 */
export function displayErrorForm(errorMessage, idElement) {
    const li = document.importNode(document.getElementById('templateError').content, true);
    const m = li.querySelector('[data-error-message]');
    m.innerText = errorMessage;
    document.getElementById(idElement).appendChild(li);
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


// reservation function

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
 * to be review
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
 * to be reviewed.
 *verify if the response data the same as the requested
 * @param {string} request string for request data. 
 * @param {string} response string for response data. 
 * @return {void} if not the same and display message error.
 */
export function verifyReturnData(request, response) {
    if (request !== response) {
        displayError("erreur lors de l'envoi et de la réception des données");
        return false
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


///

/**
 *Get parameters from url
 *
 * @return {object} object of params
 */
function getQueryParams() {
    const queryString = window.location.hash.split('?')[1];
    const params = {};
    if (queryString) {
        const pairs = queryString.split('&');
        pairs.forEach(pair => {
            const [key, value] = pair.split('=');
            params[decodeURIComponent(key)] = decodeURIComponent(value);
        });
    }
    return params;
}


/**
 * Display gym(hall) with template
 * @param {object} gym 
 */
export function displayReservation(reservation) {
    const template = document.importNode(document.getElementById('hallTemplate').content, true);
    const option = template.querySelector('.js-hall-option')
    option.innerText = gym['name_gym'];
    option.value = gym['id_gym'];
    document.getElementById('hall').appendChild(option);

}


