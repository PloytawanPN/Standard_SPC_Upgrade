var dropdown = body.querySelector(".dropdown");
var action_menu = body.querySelector(".action_menu");

action_menu.addEventListener("click", () => {
    action_menu.classList.toggle("close");
});

dropdown.addEventListener("click", () => {
    dropdown.classList.toggle("close");
});
