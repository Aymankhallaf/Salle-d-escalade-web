//main menu

/**
 * drop down for main menu
 */
export function dropDownMainMenu() {
    document.getElementById("header-nav__btn").addEventListener("click", () => {
        document.getElementById("main-menu").classList.toggle("header-nav__menu--side");
    });
}
