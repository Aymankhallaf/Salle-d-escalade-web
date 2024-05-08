const today = new Date();
let hour = today.getHours();
console.log(typeof (hour))


function displayTime(start, end) {
    for (start; start <= end; start++) {

        console.log(`${start}:00`)
        console.log(`${start}:30`)
        // createTimeCell()
    }
}

displayTime(10,19)
// displayTime(11,20)