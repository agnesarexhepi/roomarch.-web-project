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

// LOGIN FORM VALIDATION
const loginForm = document.getElementById("loginForm");
loginForm.addEventListener("submit", function (e) {
    e.preventDefault();
    const email = document.getElementById("loginEmail").value;
    const password = document.getElementById("loginPassword").value;

    if(email === "" || password === "") {
        alert("Please fill in all fields");
        return;
    }
    if(password.length < 6) {
        alert("Password must be at least 6 characters");
        return;
    }
    alert("Login successful (demo)"); 
    loginForm.reset();
});

// SIGNUP FORM VALIDATION
const signupForm = document.getElementById("signupForm");
signupForm.addEventListener("submit", function(e) {
    e.preventDefault();
    const name = document.getElementById("signupName").value;
    const email = document.getElementById("signupEmail").value;
    const password = document.getElementById("signupPassword").value;

    if(name === "" || email === "" || password === "") {
        alert("Please fill in all fields");
        return;
    }
    if(password.length < 6) {
        alert("Password must be at least 6 characters");
        return;
    }
    alert("Account created successfully (demo)");
    signupForm.reset();
});

