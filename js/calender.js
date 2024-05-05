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

function createDayCell(day, dataSet) {
  const template = document.getElementById("day-template");
  const dayElement = document.importNode(template.content, true);
  const dayCell = dayElement.querySelector(".js-calender__month--day");
  dayCell.textContent = day;
  dayCell.dataset.date = dataSet;

  if (isDayDisabled(dataSet)) {
    dayCell.classList.add("disactive");
  }

 
  daysContainer.appendChild(dayElement);
}

function isDayDisabled(dataSet){
 return ClosedDay.includes(dataSet.slice(0, 2)
    || holydays.includes(dataSet))
  
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
    let dataSet = currentDate.toLocaleString("fr-FR", {
      weekday: "long",
      year: "numeric",
      month: "long",
      day: "numeric",
    });

    createDayCell(i, dataSet);
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
  upDateDate()

});

next.addEventListener("click", () => {
  daysContainer.innerHTML = ""
  if (month > 11) {
    month = 0;
    year++;
  }
  month++;
  console.log(month)
  currentDate.setFullYear(year, month);
  upDateDate()

});


function updateEventListeners() {
  for (const dayElement of daysContainer.querySelectorAll(".js-calender__month--day")) {
    if (dayElement.classList.contains("disactive")) {
      dayElement.removeEventListener("click", handleClick);
    } else {
      dayElement.addEventListener("click", handleClick);
    }
  }
}

function handleClick(e) {
  const selectedDate = e.target;
  selected.innerHTML = `Vous avez choisi: ${selectedDate.dataset.date}`;
}

/**
 * actives the selected day and desactives the others
 * @param {object} dayElements object of html elements (days)
 * @param {object} selectedDate object of  html elements (day)
 */
function activeDay(dayElements, selectedDate) {
  selectedDate.classList.toggle("active");
  for (const day of dayElements) {
    if (selectedDate !== day)
      day.classList.remove("active");
  }

}