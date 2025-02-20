// farmer_tab.js

// Add event listener to the login form
document.getElementById("login-form").addEventListener("submit", function (e) {
    e.preventDefault(); // Prevent form submission

    // Get username and password
    const username = document.getElementById("username").value;
    const password = document.getElementById("password").value;

    // For now, just check if fields are filled (simple validation)
    if (username === "officer" && password === "1234") {
        alert("Login successful!");

        // Hide login section
        document.getElementById("login-section").style.display = "none";

        // Show farmer dashboard
        document.getElementById("farmer-dashboard").style.display = "block";
    } else {
        alert("Invalid username or password. Please try again.");
    }
});
