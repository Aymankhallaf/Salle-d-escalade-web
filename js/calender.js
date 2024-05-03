
let display = document.querySelector(".calender__ttl");
let days = document.querySelector(".calender__month");
let previous = document.querySelector(".calender__left");
let next = document.querySelector(".calender__right");
let selected = document.querySelector(".calender__selected-txt");

let date = new Date();

let year = date.getFullYear();
let month = date.getMonth();


/**
 * displays the calender header (month and year).
 * @returns {Array} return array the first element day index
 */
function displayCalendarHeader(){
  const firstDay = new Date(year, month, 1);
  const lastDay = new Date(year, month + 1, 0);
  // Sunday - Saturday : 0 - 6
  const firstDayIndex = firstDay.getDay();
  const numberOfDays = lastDay.getDate();
  let formattedDate = date.toLocaleString("fr-FR", {
    year: "numeric",
    month: "long",
  });

  display.innerHTML = `${formattedDate}`;
  return [firstDayIndex,numberOfDays]
}


/**
 * function to display calender
 */
function displayCalendar() {
  let firstDayIndex = displayCalendarHeader()[0];
  let numberOfDays = displayCalendarHeader()[1];
  for (let x = 1; x <= firstDayIndex; x++) {
    const li = document.createElement("li");
    li.innerHTML += "";

    days.appendChild(li);
  }

  for (let i = 1; i <= numberOfDays; i++) {
    let li = document.createElement("li");
    let currentDate = new Date(year, month, i);
    li.dataset.date = currentDate.toLocaleString("fr-FR", {
      weekday: "long",
      year: "numeric",
      month: "long",
      day: "numeric",

    });

    li.classList = "calender__month--day";

    li.innerHTML += i;
    days.appendChild(li);
    if (
      currentDate.getFullYear() === new Date().getFullYear() &&
      currentDate.getMonth() === new Date().getMonth() &&
      currentDate.getDate() === new Date().getDate()
    ) {
      li.classList.add("current-date");
    }
  }
}

// Call the function to display the calendar
displayCalendar();



previous.addEventListener("click", () => {
  days.innerHTML = "";
  selected.innerHTML = "";

  if (month < 0) {
    month = 11;
    year = year - 1;
  }

  month = month - 1;

  date.setMonth(month);

  displayCalendar();
  displaySelected();
  disactiveClosedDay("lu");
});

next.addEventListener("click", () => {
  days.innerHTML = "";
  selected.innerHTML = "";

  if (month > 11) {
    month = 0;
    year = year + 1;
  }

  month = month + 1;
  date.setMonth(month);

  displayCalendar();
  displaySelected();
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