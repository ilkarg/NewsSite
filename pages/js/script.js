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

function logout() {
    fetch('api/v1/logout', {
        method: 'POST',
        headers: {
            "Content-Type": "application/json"
        }
    }).then(function(response) {
        return response.json().then(function(resp) {
            console.log(resp);
        });
    });
}

function addPost() {
    let title = document.querySelector("#postTitle").value;
    let body = document.querySelector("#postBody").value;
    fetch('api/v1/addPost', {
        method: 'POST',
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify({
            title: title,
            body: body
        })
    }).then(function(response) {
        return response.json().then(function(resp) {
            console.log(resp);
            createPost(title, body);
        });
    });
}

function getPosts() {
    fetch('api/v1/getPosts', {
        method: 'POST',
        headers: {
            "Content-Type": "application/json"
        }
    }).then(function(response) {
        return response.json().then(function(resp) {
            console.log(resp);
            if (!resp["response"] && Object.keys(resp).length > 0) {
                Object.keys(resp).map(function(key) {
                    createPost(resp[key].title, resp[key].body);
                });
            }
        });
    });
}

function isAdmin() {
    fetch('api/v1/isAdmin', {
        method: 'POST',
        headers: {
            "Content-Type": "application/json"
        }
    }).then(function(response) {
        return response.json().then(function(resp) {
            if (resp["response"] === "admin") {
                document.querySelector("#addPostForm").style.visibility = "visible";
            }
        });
    });
}

function createPost(title, body) {
    let post = document.createElement("div");
    let pTitle = document.createElement("p");
    pTitle.innerHTML = `Title: ${title}`;
    let pBody = document.createElement("p");
    pBody.innerHTML = `Body: ${body}`;
    post.appendChild(pTitle);
    post.appendChild(pBody);
    document.querySelector("#posts").appendChild(post);
}