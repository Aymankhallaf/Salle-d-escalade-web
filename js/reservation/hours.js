const closedHours = []
const hoursContainer = document.getElementById("hours__container")
const today = new Date();
let timeNow = today.getHours();


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


function displayHour(start, end) {
    for (start; start < end; start++) {
        for (let minute = 0; minute < 60; minute += 30) {
            createHourCell(start, minute)
        }
    }
    createHourCell(end, '00')

}


function isHoursDisactive(hour) {
    return timeNow > hour

}

displayHour(10, 20)