// const base_url = "http://localhost/Full-Stack-Mini-Project_Backend/";

document.getElementById('login').addEventListener('submit', async (event) => {
    event.preventDefault();
  
    const formData = new FormData(event.target);
    const loginData = {
      username: formData.get('username'),
      password: formData.get('password'),
    };
  
    try {
        const response = await fetch(`http://localhost/Full-Stack-Mini-Project_Backend/signin.php`, {
            method: "POST",
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(),
        })
            
        console.log(response);
    
        if (response.ok) {
            window.location.href = './src/html/dashboard.html';
            alert('Congrats');
        } else {
            alert('Invalid credentials. Please try again.');
        }
    } catch (error) {
        console.error('Error occurred during login:', error);
        alert('An error occurred during login. Please try again later.');
    }
});