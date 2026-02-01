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

/* LOGIN */
/*
loginForm.addEventListener("submit", function (e) {
    e.preventDefault();

    loginEmailError.textContent = "";
    loginPasswordError.textContent = "";
    loginSuccess.textContent = "";

    if (loginEmail.value === "") {
        loginEmailError.textContent = "Email is required";
        return;
    }

    if (loginPassword.value === "") {
        loginPasswordError.textContent = "Password is required";
        return;
    }

    loginSuccess.textContent = "Login successful";
    loginForm.reset();
});
*/

/* SIGN UP */
signupForm.addEventListener("submit", function (e) {
    e.preventDefault();

    signupNameError.textContent = "";
    signupEmailError.textContent = "";
    signupPasswordError.textContent = "";
    signupSuccess.textContent = "";

    if (signupName.value === "") {
        signupNameError.textContent = "Name is required";
        return;
    }

    if (signupEmail.value === "") {
        signupEmailError.textContent = "Email is required";
        return;
    }

    if (signupPassword.value === "") {
        signupPasswordError.textContent = "Password is required";
        return;
    }

    if (signupPassword.value.length < 6) {
        signupPasswordError.textContent = "Password must be at least 6 characters";
        return;
    }

    signupSuccess.textContent = "Account created successfully";
    signupForm.reset();
});

