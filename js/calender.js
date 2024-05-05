//closed dayes
const ClosedDay = ["lu"]


//calender header
let display = document.querySelector(".calender__ttl");
let daysContainer = document.querySelector(".calender__month");
let previous = document.querySelector(".calender__left");
let next = document.querySelector(".calender__right");

//selected date
let selected = document.querySelector(".calender__selected-txt");

let day = new Date();
let year = day.getFullYear();
let month = day.getMonth();


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

function createDayCell(day, dataSet) {
  const template = document.getElementById("day-template");
  const dayElement = document.importNode(template.content, true);
  const dayCell = dayElement.querySelector(".js-calender__month--day");
  dayCell.textContent = day;
  dayCell.dataset.date = dataSet;
  if (ClosedDay.includes(dataSet.slice(0, 2))) {
    dayCell.classList.add("disactive");
  }
  daysContainer.appendChild(dayElement);
}


// function disactiveClosedDay(day, dataSet, ClosedDay) {
//   for (const dayName of ClosedDay) {
//     console.log(dayName)
//     if (dataSet.slice(0, 2) === dayName) {
//       day.querySelector(".js-calender__month--day").classList.toggle("disactive");

//       // document.removeEventListener("click", handleClick);
//     }
//     else { return }
//   }
// }




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

}

displayCalendar();

function upDateDate() {
  displayCalendarHeader();
  let firstDayIndex = displayCalendarHeader()[0];
  let numberOfDays = displayCalendarHeader()[1];
  showEmptyDay(firstDayIndex)
  displayCalendar(numberOfDays)
  getDaysElement()
}


upDateDate()


previous.addEventListener("click", () => {

  daysContainer.innerHTML = ""
  if (month < 0) {
    month = 11;
    year--;
  }

  month--;

  day.setMonth(month);
  upDateDate()

});

next.addEventListener("click", () => {

  daysContainer.innerHTML = ""
  if (month > 11) {
    month = 0;
    year++;
  }

  month++;

  day.setMonth(month);

  upDateDate()

});





let dayElements = document.querySelectorAll(".calender__month--day");

let monthDays = document.getElementById("month-days").children;
for (const day of monthDays) {
}
function getDaysElement() {
  return document.querySelectorAll(".calender__month--day");
}

getDaysElement();


function handleClick(e) {

  if (e.target.classList.contains("disactive")) {
    document.removeEventListener("click", handleClick);
  }
  const selectedDate = e.target;
  activeDay(dayElements, selectedDate);
  selected.innerHTML = `Vous avez choisi: ${selectedDate.dataset.date}`;

}





// function displaySelected() {
//   dayElements.forEach((day) => {
//     day.addEventListener("click", handleClick);
//   });
// }

// displaySelected();


// /**
//  * actives the selected day and desactives the others
//  * @param {object} dayElements object of html elements (days)
//  * @param {object} selectedDate object of  html elements (day)
//  */
// function activeDay(dayElements, selectedDate) {
//   selectedDate.classList.toggle("active");
//   for (const day of dayElements) {
//     if (selectedDate !== day)
//       day.classList.remove("active");
//   }

// }

// //disactive lu(lundi) monday (as the closed day)
// disactiveClosedDay("lu");

// /**
//  * disactive the required day by writing the first two letters in small letters
//  * @param {text} dayName object of html elements (days)
//  */
// function disactiveClosedDay(dayName) {
//   for (const day of dayElements) {
//     if (day.dataset.date.slice(0, 2) === dayName) {
//       day.classList.toggle("disactive");
//       document.removeEventListener("click", handleClick);
//     }
//   }

// }

// function disactive by date to do

