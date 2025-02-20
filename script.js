document.addEventListener('DOMContentLoaded', () => {
    const loginForm = document.querySelector('.login-section form');
    
    loginForm.addEventListener('submit', (e) => {
        e.preventDefault();
        
        const username = document.getElementById('username').value;
        const password = document.getElementById('password').value;
        
        // For now, just console log the values. Later, you'll handle the login logic.
        console.log('Username:', username);
        console.log('Password:', password);
        
        // Example of how you might validate the fields
        if (username === '' || password === '') {
            alert('Please enter both username and password.');
        } else {
            alert('Login successful!');
            // Redirect or show the farmer dashboard page.
        }
    });
});