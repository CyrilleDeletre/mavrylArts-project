let btnBurger = document.querySelector("#btn-burger");

let nav = document.querySelector(".main-nav-burger");


btnBurger.addEventListener("click", () => {
    // Code à effectuer si l'utilisateur clique sur btnBurger
    nav.classList.toggle("visible");
}
)