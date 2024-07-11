import * as F from "../_functions.js";

//closed days
const closedDay = ["lu"];
// let holidays = ["jeudi 9 mai 2024", "Lundi 20 mai 2024", "dimanche 14 juillet 2024", "jeudi 15 août 2024"]
let holidays = []
function updateHolidays(newHolidays) {
  holidays = newHolidays;
}

let headerTtl = document.getElementById("calender__ttl")
let previous = document.getElementById("calender__left");
let next = document.getElementById("calender__right");

// all the days apears here
let daysContainer = document.getElementById("month-days");



// selected date apears here
let selected = document.querySelector(".calender__selected-txt");
// constant of today
const today = new Date();
// avariable of day changes every time we change the month to calculate the calender the initial start is today.
let currentDate = new Date();
let year = currentDate.getFullYear();
let month = currentDate.getMonth();

//selected date to be reviewed
let chosenDate = null;






/**
 * get the index of the first day the current month and the number of days in this month.
 * @returns{array} array, the first day index [ex. sunday-satrday 0-6] and the number of days in the month
 */
function getFirstAndLastDay() {
  const firstDay = new Date(year, month, 1);
  let firstDayIndex = firstDay.getDay();
  const lastDay = new Date(year, month + 1, 0);
  let numberOfDays = lastDay.getDate();
  return [firstDayIndex, numberOfDays]
}



/**
 * Displays the calender header (month and year) ex. mai 2024.
 */
function displayCalendarHeader() {
  headerTtl.innerHTML = currentDate.toLocaleString("fr-FR", {
    year: "numeric",
    month: "long",
  });
}

/**
 * convert string date to date in french formate.
 * @param {string} date in string
 * @returns a date in french format "jeudi 9 mai 2024"
 */
export function formateDay(date) {
  return date.toLocaleString("fr-FR", {
    weekday: "long",
    year: "numeric",
    month: "long",
    day: "numeric",
  });
}

/**
 * creates a day cell with its attributes and disactive it according to isDayDisactive function.
 * @param {number} day a number of day.
 * @param {*} currentDate a variable of day change   
 */
function createDayCell(day, currentDate) {
  let dataSet = formateDay(currentDate);
  const template = document.getElementById("day-template");
  const dayElement = document.importNode(template.content, true);
  const dayCell = dayElement.querySelector(".js-calender__month--day");
  dayCell.textContent = day;
  dayCell.dataset.day = day;
  dayCell.dataset.date = dataSet;
  dayCell.setAttribute("datetime", currentDate);
  if (isDayDisactive(dataSet, currentDate)) {
    dayCell.classList.add("disactive");
  }

  daysContainer.appendChild(dayElement);
}

/**
 * disactive the day according to holidays, closed days and previous days.     
 * @param {text} dataSet text of the date
 * @param {date} currentDate the curent date
 * @returns 
 */
function isDayDisactive(dataSet, currentDate) {
  return (
    closedDay.includes(dataSet.slice(0, 2))
    || holidays.includes(dataSet)
    || (currentDate < today))

}



/**
 * create empty cells in the clender where there is no date in the begining of the month.
 * @param {number} firstDayIndex 
 */
function showEmptyDay(firstDayIndex) {
  if (firstDayIndex === 0) { firstDayIndex = 7 };
  for (let x = 0; x < firstDayIndex - 1; x++) {
    createDayCell("", "");
  }
}

/**
 * create cells and display them and listen to the events in this cells check createDayCell() and updateEventListeners() functions.
 * @param {number} numberOfDays number of days in the month.
 */
function displayCalendar(numberOfDays) {
  for (let i = 1; i <= numberOfDays; i++) {
    let currentDate = new Date(year, month, i);
    createDayCell(i, currentDate);
  }
  updateEventListeners();
}


/**
 * updates calender display with all functions. See more showEmptyDay() and displaydisplayCalendar()
 */
function updateCalendar() {
  displayCalendarHeader();
  let firstDayIndex = getFirstAndLastDay()[0];
  let numberOfDays = getFirstAndLastDay()[1];
  showEmptyDay(firstDayIndex);
  displayCalendar(numberOfDays);
}


//listens to pervious button to display calender
previous.addEventListener("click", () => {
  daysContainer.innerHTML = ""
  if (month < 0) {
    month = 11;
    year--;
  }
  month--;
  currentDate.setFullYear(year, month);
  updateCalendar();
});


//listens to next button to display calender
next.addEventListener("click", () => {
  daysContainer.innerHTML = ""
  if (month > 11) {
    month = 0;
    year++;
  }
  month++;
  currentDate.setFullYear(year, month);
  updateCalendar();

});


/**
 * listen to the click of active days celles and applicate handleCalendarCellClick() function.
 */
function updateEventListeners() {
  const dayElements = daysContainer.querySelectorAll(".js-calender__month--day");
  dayElements.forEach(dayElement => {
    if (dayElement.classList.contains("disactive")) {
      dayElement.removeEventListener("click", handleCalendarCellClick);
    } else {
      dayElement.addEventListener("click", handleCalendarCellClick);
    }
  });
}


/**
* handles a Calendar Cell click and shown the selected day and disactive the other clicke day. 
* @param {Event} a clicked event.
*/
function handleCalendarCellClick(e) {
  const selectedDate = e.target;
  activeDay(selectedDate);
  if (selectedDate.classList.contains("active")) {
    chosenDate = selectedDate.dataset.date;
    //save chosen date in local Storage.
    localStorage.setItem("chosenDate", JSON.stringify(chosenDate));
    selected.innerHTML = `Vous avez choisi: ${chosenDate}`;
    selected.classList.remove("error");
    selected.dataset.selectedDay = chosenDate;
    //to be reviewed
    return chosenDate;

  } else {
    selected.innerHTML = `Vous n'avez pas choisi`;
    selected.classList.toggle("error");
  }

}

/**
 * Activates the selected day and deactivates the others
 * @param {object} selectedDate The selected date element
 */
function activeDay(selectedDate) {
  const dayElements = daysContainer.querySelectorAll(".js-calender__month--day");
  dayElements.forEach(day => {
    if (selectedDate !== day) {
      day.classList.remove("active");
    }
  });
  selectedDate.classList.toggle("active");
};




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

/**
* get the vacation date and update calender.
* @param {string} idGym gym id
* @returns 
*/
export function getVacationDates(idGym) {
  F.callApi("POST", {
    action: "fetch",
    idGym: idGym,
    token: F.getToken()

  }).then(data => {
    if (!data.isOk) {
      F.displayError(data['errorMessage']);
      return;
    }
    let holidaysFR = []
    data[0].forEach(day => {
      holidaysFR.push(formateDay(new Date(day)));
    });
    F.displayMessage("tu as bien choisi le salle");
    document.getElementById("month-days").innerText = "";
    updateHolidays(holidaysFR);
    updateCalendar();

  })
}
