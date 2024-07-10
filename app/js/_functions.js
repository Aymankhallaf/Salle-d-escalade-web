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
            console.log(data);
        })
}