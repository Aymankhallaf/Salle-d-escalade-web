//main menu
export function toggleMenu() {
    document.getElementById("header-nav__btn").addEventListener("click", () => {
        document.getElementById("main-menu").classList.toggle("header-nav__menu--side");
    });
}
