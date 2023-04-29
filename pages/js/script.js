function registration() {
    fetch(`${window.location.origin}/api/v1/registration`, {
        method: 'POST',
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify({
            login: document.querySelector("#login").value,
            password: document.querySelector("#password").value,
            repeatPassword: document.querySelector("#repeatPassword").value
        })
    }).then(function (response) {
        return response.json().then(function (resp) {
            console.log(resp);
        });
    });
}

function login() {
    fetch(`${window.location.origin}/api/v1/login`, {
        method: 'POST',
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify({
            login: document.querySelector("#login").value,
            password: document.querySelector("#password").value
        })
    }).then(function (response) {
        return response.json().then(function (resp) {
            console.log(resp);
        });
    });
}

function logout() {
    fetch(`${window.location.origin}/api/v1/logout`, {
        method: 'POST',
        headers: {
            "Content-Type": "application/json"
        }
    }).then(function (response) {
        return response.json().then(function (resp) {
            console.log(resp);
        });
    });
}

function addPost() {
    let title = document.querySelector("#postTitle").value;
    let body = document.querySelector("#postBody").value;
    let tag = document.querySelector("#postTag").value;
    let date = new Date();
    let publicationTime = `${date.getHours()}:${date.getMinutes()}`;
    fetch(`${window.location.origin}/api/v1/addPost`, {
        method: 'POST',
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify({
            title: title,
            body: body,
            tag: tag,
            publicationTime: publicationTime
        })
    }).then(function (response) {
        return response.json().then(function (resp) {
            console.log(resp);
            body = body.replaceAll("\n", "<br>");
            createPostCard(title, body, tag, publicationTime);
        });
    });
}

function getPosts() {
    let args = window.location.search;
    if (args.length === 0) {
        redirectToSecurityNews();
    }
    args = args.split("&");
    if (args.length > 1) {
        redirectToSecurityNews();
    }
    args[0] = args[0].substring(1, args[0].length);
    args.map(function (arg) {
        if (!(arg.startsWith("id=") || arg.startsWith("tag="))) {
            redirectToSecurityNews();
        }

        if (arg.startsWith("tag=")) {
            let tag = arg.substring(arg.indexOf("=") + 1, arg.length);
            if (["security", "administration", "health", "studying"].indexOf(tag) === -1) {
                redirectToSecurityNews();
            }
            getPostsByTag(tag);
        } else if (arg.startsWith("id=")) {
            let id = arg.substring(arg.indexOf("=") + 1, arg.length);
            getPostById(id);
        }
    })
}

function isAdmin() {
    fetch(`${window.location.origin}/api/v1/isAdmin`, {
        method: 'POST',
        headers: {
            "Content-Type": "application/json"
        }
    }).then(function (response) {
        return response.json().then(function (resp) {
            if (resp["response"] === "admin") {
                document.querySelector("#addPostForm").style.visibility = "visible";
            }
        });
    });
}

function getPostById(id) {
    fetch(`${window.location.origin}/api/v1/getPostById`, {
        method: 'POST',
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify({
            id: id
        })
    }).then(function (response) {
        return response.json().then(function (resp) {
            console.log(resp);
            if (!resp["response"] && Object.keys(resp).length > 0) {
                let key = Object.keys(resp)[0];
                let body = resp[key].body.replaceAll("\n", "<br>");
                createFullPost(resp[key].title, body, resp[key].tag, resp[key].publication_time, key);
            }
        });
    });
}

function getPostsByTag(tag) {
    fetch(`${window.location.origin}/api/v1/getPostsByTag`, {
        method: 'POST',
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify({
            tag: tag
        })
    }).then(function (response) {
        return response.json().then(function (resp) {
            console.log(resp);
            if (!resp["response"] && Object.keys(resp).length > 0) {
                Object.keys(resp).map(function (key) {
                    let body = resp[key].body.replaceAll("\n", "<br>");
                    createPostCard(resp[key].title, resp[key].tag, resp[key].publication_time, key);
                });
            }
        });
    });
}

function redirectToSecurityNews() {
    window.location = "/posts/?tag=security";
    return;
}

function createPostCard(title, tag, publicationTime, id) {
    let post = document.createElement("div");
    let aTitle = document.createElement("a");
    aTitle.innerHTML = `Title: ${title}`;
    aTitle.href = `?id=${id}`
    let pTag = document.createElement("p");
    pTag.innerText = `Tag: ${tag}`;
    let pPublicationTime = document.createElement("p");
    pPublicationTime.innerText = `Publication time: ${publicationTime}`;
    post.appendChild(aTitle);
    post.appendChild(pTag);
    post.appendChild(pPublicationTime);
    post.appendChild(document.createElement("hr"));
    document.querySelector("#posts").appendChild(post);
}

function createFullPost(title, body, tag, publicationTime) {
    let post = document.createElement("div");
    let pTitle = document.createElement("p");
    pTitle.innerHTML = `Title: ${title}`;
    let pBody = document.createElement("p");
    pBody.innerHTML = `Body: ${body}`;
    let pTag = document.createElement("p");
    pTag.innerText = `Tag: ${tag}`;
    let pPublicationTime = document.createElement("p");
    pPublicationTime.innerText = `Publication time: ${publicationTime}`;
    post.appendChild(pTitle);
    post.appendChild(pTag);
    post.appendChild(pPublicationTime);
    post.appendChild(pBody);
    post.appendChild(document.createElement("hr"));
    document.querySelector("#posts").appendChild(post);
}