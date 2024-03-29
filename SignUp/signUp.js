document.getElementById('signUpForm').addEventListener('submit', function(event) {
    event.preventDefault();
    
    var formData = new FormData(this);
    
    axios.post('http://localhost/urban_green_space_map/signUp/signUpAction.php', formData)
    .then(function(response) {
        alert(response.data.message);
        if (response.status === 201) {
            window.location.href = "../Login/login.html";
        }
    })
    .catch(function(error) {
        console.error(error);
        alert("An error occurred: " + error.response.data.message);
    });
});


