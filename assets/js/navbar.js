const menuToggle = document.getElementById("menuToggle");
const mainMenu = document.getElementById("mainMenu");

if (menuToggle && mainMenu) {

    menuToggle.addEventListener("click", () => {

        mainMenu.classList.toggle("active");

    });

}