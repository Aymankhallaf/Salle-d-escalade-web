const closedHours = []
const hoursContainer = document.getElementById("hours__container")
const today = new Date();
let timeNow = today.getHours();


/**
 * create an hour cell in html tag with attributes content, datasethour, datatset.minute and data time and disactive the cell acording to disactive function;
 * @param {number} hour an hour in number formate.
 * @param {number} minute minutes in number formate. 
 */
 function createHourCell(hour, minute) {
    const template = document.getElementById("hours-template");
    const hourElement = document.importNode(template.content, true);
    const hourCell = hourElement.querySelector(".js-hours__element");
    hourCell.textContent = `${hour}:${minute === 0 ? '00' : minute}`;
    hourCell.dataset.hour = hour;
    hourCell.dataset.minute = minute;
    hourCell.setAttribute("datetime", hourCell.textContent);
    if (isHoursDisactive(hour)) {
        hourCell.classList.add("disactive");
    }
    hoursContainer.appendChild(hourElement)

}

/**
 * display hours in html tag from start hour to end hour avery 30 min.
 * @param {number} start the Starting hour in number format.
 * @param {number} end the Starting hour in number format.
 */
export function displayHour(start, end) {
    for (start; start < end; start++) {
        for (let minute = 0; minute < 60; minute += 30) {
            createHourCell(start, minute)
        }
    }
    createHourCell(end, '00')
}


/**
 * check if an hour is earier than the time now and return false. 
 * @param {number} hour a certain hour in format number.
 * @returns {boolean} return "true" if time now i or true 
 */
function isHoursDisactive(hour) {
    // return timeNow > hour
return false;

}

// displayHour(10, 20)