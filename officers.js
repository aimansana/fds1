document.addEventListener("DOMContentLoaded", function () {
    // Hide all dashboards at first
    const dashboards = document.querySelectorAll(".dashboard");
    dashboards.forEach(dashboard => dashboard.style.display = "none");

    // Handle login form submission
    document.getElementById("login-form").addEventListener("submit", function (event) {
        event.preventDefault();

        const username = document.getElementById("username").value;
        const password = document.getElementById("password").value;

        // Simulated login (Replace this with an actual API call)
        const officers = {
            "field_officer": "Field Officer",
            "junior_officer": "Junior Officer",
            "senior_officer": "Senior Officer",
            "quality_control": "Quality Control Officer",
            "subsidy_officer": "Subsidy Payment Officer"
        };

        if (officers[username]) {
            alert(`Welcome, ${officers[username]}!`);
            document.getElementById("login").style.display = "none"; // Hide login section
            document.getElementById(`${username}-dashboard`).style.display = "block"; // Show respective dashboard
        } else {
            alert("Invalid credentials! Please try again.");
        }
    });
});
