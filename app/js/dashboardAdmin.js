const today = new Date();
let tomorrow = new Date(today);
tomorrow.setDate(today.getDate() + 1);
// const tomorow = setDate(today.getDate() + 1)
const formattedDate = today.toISOString().split('T')[0];
document.getElementById('start-date').value = formattedDate;
document.getElementById('end-date').value = tomorrow.toISOString().split('T')[0];
