document.addEventListener("DOMContentLoaded", function () {
    // Form Validation for Login
    const loginForm = document.getElementById("login-form");
    
    if (loginForm) {
        loginForm.addEventListener("submit", function (event) {
            const username = document.querySelector("input[name='txtUName']").value.trim();
            const password = document.querySelector("input[name='txtPsw']").value.trim();

            if (username === "" || password === "") {
                event.preventDefault(); // Prevent form submission
                alert("Username and Password cannot be empty!");
            }
        });
    }

    // Smooth fade-in effect for login section
    const loginSection = document.getElementById("login-section");
    if (loginSection) {
        loginSection.style.opacity = 0;
        setTimeout(() => {
            loginSection.style.transition = "opacity 1s ease-in-out";
            loginSection.style.opacity = 1;
        }, 200);
    }

    // Dashboard Interactivity: Toggle Request Status Visibility
    const statusCard = document.querySelector(".card:nth-child(2)"); // Selects the "Request Status" card
    if (statusCard) {
        statusCard.addEventListener("click", function () {
            alert("Request Status: Approved \nExpected Delivery: 5-7 days");
        });
    }
});
