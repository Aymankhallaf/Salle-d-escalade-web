

//menu toggle

document.getElementById("header-nav__btn").addEventListener("click", () => {
    console.log("clicked")
    document.getElementById("main-menu").classList.toggle("header-nav__menu--side");
    document.querySelectorAll("header-nav__menu-link--side")
});
