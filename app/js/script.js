import * as Menu from "./menu.js"
//menu drop dow
Menu.dropDownMainMenu();

if (window.location.href.includes("reservation.html")) {
    (async () => {
        const reservation = await import("./reservation/reservation.js");
    })();
}