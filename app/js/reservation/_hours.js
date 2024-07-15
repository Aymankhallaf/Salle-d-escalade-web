const closedHours = [];
const hoursContainer = document.getElementById("hours__container");
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
    // hourCell.addEventListener("change", (e)=>{
    //     console.log(e.target);
    // })
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
    createHourCell(end, '00');
    updateEventHourListeners();
}


/** to do rewrite this function.
 * check if an hour is earier than the time now and return false. 
 * @param {number} hour a certain hour in format number.
 * @returns {boolean} return "true" if time now i or true 
 */
function isHoursDisactive(hour) {
    // return timeNow > hour
return false;

}

/**
 * listen to the click of active hours celles and applicate handleHourCellClick() function.
 */
function updateEventHourListeners() {
    const HourElements = hoursContainer.querySelectorAll("[data-hour]");
    HourElements.forEach(hourElement => {
      if (hourElement.classList.contains("disactive")) {
        hourElement.removeEventListener("click", handleHourCellClick);
      } else {
        hourElement.addEventListener("click",  handleHourCellClick);
      }
    });
  }

/**
* handles a hours Cell click and shown the selected hour and disactive the other clicked hour cell. 
* @param {Event} a clicked event.
*/
function handleHourCellClick(e) {
    const selectedHour = e.target;
    console.log(selectedHour);
    activeHour(selectedHour);
    if (selectedHour.classList.contains("active")) {
      chosenHour = selectedHour.datatime;
      //save chosen date in local Storage.
      localStorage.setItem("chosenHour", JSON.stringify(chosenHour));
      selected.classList.remove("error");
      getOpenHoures(JSON.parse(localStorage.getItem("chosenGym")), chosenDateShort);
      //to be reviewed
      return chosenDate;
  
    } else {
      selected.innerHTML = `Vous n'avez pas choisi`;
      selected.classList.toggle("error");
    }
  
  }

// displayHour(10, 20)

/**
 * Activates the selected hour and deactivates the others
 * @param {object} selectedHour The selected hour element
 */
function activeHour(selectedHour) {
    const hourElements = hoursContainer.querySelectorAll("[data-hour]");
    hourElements.forEach(hour => {
      if (selectedHour !== hour) {
        hour.classList.remove("active");
      }
    });
    selectedHour.classList.toggle("active");
  };
  