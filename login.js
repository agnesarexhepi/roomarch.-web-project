const signUp = document.getElementById("signUp");
const signIn = document.getElementById("signIn");
const container = document.getElementById("container");

// Toggle Sign Up panel
signUp.addEventListener("click", () => {
    container.classList.add("right-panel-active");
});

// Toggle Sign In panel
signIn.addEventListener("click", () => {
    container.classList.remove("right-panel-active");
});
