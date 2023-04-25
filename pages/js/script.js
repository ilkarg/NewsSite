function registration() {
    fetch('api/v1/registration', {
        method: 'POST',
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify({
            login: document.querySelector("#login").value,
            password: document.querySelector("#password").value,
            repeatPassword: document.querySelector("#repeatPassword").value
        })
    }).then(function(response) {
        return response.json().then(function(resp) {
            console.log(resp);
        });
    });
}

function login() {
    fetch('api/v1/login', {
        method: 'POST',
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify({
            login: document.querySelector("#login").value,
            password: document.querySelector("#password").value
        })
    }).then(function(response) {
        return response.json().then(function(resp) {
            console.log(resp);
        });
    });
}