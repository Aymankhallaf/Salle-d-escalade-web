let display = document.querySelector(".calender__ttl");
let days = document.querySelector(".calender__month");
let previous = document.querySelector(".calender__left");
let next = document.querySelector(".calender__right");
let selected = document.querySelector(".selected");

let date = new Date();

let year = date.getFullYear();
let month = date.getMonth();

function displayCalendar() {
  const firstDay = new Date(year, month, 1);

  const lastDay = new Date(year, month + 1, 0);

  const firstDayIndex = firstDay.getDay(); //4

  const numberOfDays = lastDay.getDate(); //31

  let formattedDate = date.toLocaleString("fr-FR", {
    year: "numeric",
    month: "long",
  });

  display.innerHTML = `${formattedDate}`;

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
});

const dayElements = document.querySelectorAll(".calender__month--day");
function displaySelected() {
  dayElements.forEach((day) => {
    day.addEventListener("click", (e) => {
      const selectedDate = e.target;
      activeDay(dayElements, selectedDate);
      selected.innerHTML = `Vous avez choisi: ${selectedDate.dataset.date}`;
    });
  });
}
displaySelected();



function activeDay(dayElements, selectedDate) {
  selectedDate.classList.toggle("active");
  for (const day of dayElements) {
    if (selectedDate !== day)
      day.classList.remove("active");
  }

}