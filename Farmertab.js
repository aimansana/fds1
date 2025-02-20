document.getElementById("login-form").addEventListener("submit", function (e) 
{
    e.preventDefault(); // Prevent form submission

    // Get username and password
    const username = document.getElementById("username").value;
    const password = document.getElementById("password").value;

    // Send AJAX request to login.php
    fetch("login.php", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: `username=${encodeURIComponent(username)}&password=${encodeURIComponent(password)}`
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert("Login successful!");
            document.getElementById("login-section").style.display = "none";
            document.getElementById("farmer-dashboard").style.display = "block";
        } else {
            alert("Invalid username or password. Please try again.");
        }
    })
    .catch(error => console.error("Error:", error));
});
