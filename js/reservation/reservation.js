// //data
// halls = { "first": { "mai 2024": { "1": { "10:00": 10 } } } }
import * as Calendar from "./calender.js";
import * as Hours from "./hours.js"

// Update the calendar and event listeners


// Define a function to handle the click event
function handleCalendarClick(e) {
    const selectedDate = e.target.dataset.date; // Get the selected date from the clicked element
    console.log("Selected date:", selectedDate);
}

// Set the click handler in the calendar module
Calendar.setClickHandler(handleCalendarClick);