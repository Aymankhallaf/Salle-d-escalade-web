//closed dayes
const ClosedDay = ["lu"]
const holydays = ["jeudi 9 mai 2024", "Lundi 20 mai 2024", "dimanche 14 juillet 2024", "jeudi 15 août 2024"]

//calender header
let display = document.querySelector(".calender__ttl");
let daysContainer = document.querySelector(".calender__month");
let previous = document.querySelector(".calender__left");
let next = document.querySelector(".calender__right");

//selected date
let selected = document.querySelector(".calender__selected-txt");
const today = new Date();
let currentDate = new Date();
let year = currentDate.getFullYear();
let month = currentDate.getMonth();



function getFirstAndLastDay() {
  const firstDay = new Date(year, month, 1);
  let firstDayIndex = firstDay.getDay();
  const lastDay = new Date(year, month + 1, 0);
  let numberOfDays = lastDay.getDate();
  return [firstDayIndex, numberOfDays]
}





/**
 * displays the calender header (month and year).
 * @returns {Array} return array the first element day index 
 */
function displayCalendarHeader() {
  display.innerHTML = currentDate.toLocaleString("fr-FR", {
    year: "numeric",
    month: "long",
  });;
}

function createDayCell(day, currentDate) {
  let dataSet = currentDate.toLocaleString("fr-FR", {
    weekday: "long",
    year: "numeric",
    month: "long",
    day: "numeric",
  });
  const template = document.getElementById("day-template");
  const dayElement = document.importNode(template.content, true);
  const dayCell = dayElement.querySelector(".js-calender__month--day");
  dayCell.textContent = day;
  dayCell.dataset.date = dataSet;
  dayCell.setAttribute("datetime", currentDate);
  if (isDayDisactive(dataSet, currentDate)) {
    dayCell.classList.add("disactive");
  }


  daysContainer.appendChild(dayElement);
}

function isDayDisactive(dataSet, currentDate) {
  return (ClosedDay.includes(dataSet.slice(0, 2))
    || holydays.includes(dataSet) || (currentDate < today))

}

function showEmptyDay(firstDayIndex) {

  if (firstDayIndex === 0) { firstDayIndex = 7 };
  for (let x = 0; x < firstDayIndex - 1; x++) {
    createDayCell("", "")
  }
}

//create days in the month
function displayCalendar(numberOfDays) {
  for (let i = 1; i <= numberOfDays; i++) {
    let currentDate = new Date(year, month, i);

    createDayCell(i, currentDate);
  }
  updateEventListeners();
}


function upDateDate() {
  displayCalendarHeader();
  let firstDayIndex = getFirstAndLastDay()[0];
  let numberOfDays = getFirstAndLastDay()[1];
  showEmptyDay(firstDayIndex)
  displayCalendar(numberOfDays)
}


upDateDate()


previous.addEventListener("click", () => {
  daysContainer.innerHTML = ""
  if (month < 0) {
    month = 11;
    year--;
  }
  month--;
  currentDate.setFullYear(year, month);
  upDateDate();
});



next.addEventListener("click", () => {
  daysContainer.innerHTML = ""
  if (month > 11) {
    month = 0;
    year++;
  }
  month++;
  currentDate.setFullYear(year, month);
  upDateDate();

});



function updateEventListeners() {
  const dayElements = daysContainer.querySelectorAll(".js-calender__month--day");
  dayElements.forEach(dayElement => {
    if (dayElement.classList.contains("disactive")) {
      dayElement.removeEventListener("click", handleClick);
    } else {
      dayElement.addEventListener("click", handleClick);
    }
  });
}

function handleClick(e) {
  const selectedDate = e.target;
  activeDay(selectedDate);
  if (selectedDate.classList.contains("active")) {

    selected.innerHTML = `Vous avez choisi: ${selectedDate.dataset.date}`;
    selected.classList.remove("error");

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
  
}