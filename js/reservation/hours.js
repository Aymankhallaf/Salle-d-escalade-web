
const hoursContainer = document.getElementById("hours__container")
const today = new Date();
let hour = today.getHours();
console.log(typeof (hour))


function createTimeCell(hour) {
    const template = document.getElementById("hours-template");
    const hourElement = document.importNode(template.content, true);
    const hourCell = hourElement.querySelector(".js-hours__element");
    hourCell.textContent = hour;
    hourCell.dataset.hour = hour;
    hourCell.textContent = hour;

    hoursContainer.appendChild(hourElement)

}


function displayTime(start, end) {
    for (start; start <= end; start++) {
        for (let minute = 0; minute < 60; minute += 30) {
            console.log(`${start}:${minute}`)
            createTimeCell(`${start}:${minute === 0 ? '00' : minute}`)
        }
        // createTimeCell()
    }
}

displayTime(10, 19)
// displayTime(11,20)