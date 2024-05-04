//calender header
let display = document.querySelector(".calender__ttl");
let days = document.querySelector(".calender__month");
let previous = document.querySelector(".calender__left");
let next = document.querySelector(".calender__right");

//selected date
let selected = document.querySelector(".calender__selected-txt");
let closedDays = "";

let
  day = new Date();

let year =
  day.getFullYear();
let month =
  day.getMonth();


/**
 * displays the calender header (month and year).
 * @returns {Array} return array the first element day index 
 */
function displayCalendarHeader() {
  const firstDay = new Date(year, month, 1);
  const lastDay = new Date(year, month + 1, 0);
  // Sunday - Saturday : 0 - 6
  let firstDayIndex = firstDay.getDay();
  let numberOfDays = lastDay.getDate();
  let formattedDate =
    day.toLocaleString("fr-FR", {
      year: "numeric",
      month: "long",
    });

  display.innerHTML = `${formattedDate}`;
  return [firstDayIndex, numberOfDays]
}

function createDaycell(element, dateset) {
  const days = document.getElementById("day-template");
  const day = document.importNode(days.content, true);
  const monthDays = document.getElementById("month-day")
  day.querySelector(".js-calender__month--day").textContent = element;
  day.querySelector(".js-calender__month--day").dataset.date = dateset;
  monthDays.appendChild(day);

}

function showEmptyDay(firstDayIndex) {
  if(firstDayIndex === 0) {firstDayIndex = 7 } ;
  for (let x = 0; x < firstDayIndex - 1; x++) {
    createDaycell("")
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

    createDaycell(i, dataSet);
  }

}
displayCalendar();

function upDateDate() {
  displayCalendarHeader();
  let firstDayIndex = displayCalendarHeader()[0];
  console.log(firstDayIndex);
  let numberOfDays = displayCalendarHeader()[1];
  showEmptyDay(firstDayIndex)
  displayCalendar(numberOfDays)


}




upDateDate()


previous.addEventListener("click", () => {

  days.innerHTML = ""
  if (month < 0) {
    month = 11;
    year = year - 1;
  }

  month = month - 1;

  day.setMonth(month);
  upDateDate()
  displaySelected();
  disactiveClosedDay("lu");

});

next.addEventListener("click", () => {

  days.innerHTML = ""
  if (month > 11) {
    month = 0;
    year = year + 1;
  }

  month = month + 1;

  day.setMonth(month);

  upDateDate()
  disactiveClosedDay("lu");

});





const dayElements = document.querySelectorAll(".calender__month--day");
function handleClick(e) {
  if (e.target.classList.contains("disactive")) {
    document.removeEventListener("click", handleClick);
  }
  const selectedDate = e.target;
  activeDay(dayElements, selectedDate);
  selected.innerHTML = `Vous avez choisi: ${selectedDate.dataset.date}`;

}





function displaySelected() {
  dayElements.forEach((day) => {
    day.addEventListener("click", handleClick);
  });
}
displaySelected();


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

//disactive lu(lundi) monday (as the closed day)
disactiveClosedDay("lu");

/**
 * disactive the required day by writing the first two letters in small letters
 * @param {text} dayName object of html elements (days)
 */
function disactiveClosedDay(dayName) {
  for (const day of dayElements) {
    if (day.dataset.date.slice(0, 2) === dayName) {
      day.classList.toggle("disactive");
      document.removeEventListener("click", handleClick);
    }
  }

}

// function disactive by date to do