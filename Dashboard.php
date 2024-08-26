<?php
include_once 'Connection/Connect.php';
include 'vendor/autoload.php';


session_start();

if (!isset($_SESSION['user']) && !isset($_SESSION['email'])) {
    header('location:login.php');
} else {
    $email = $_SESSION['email'];
    $user = $_SESSION['user'];


}
$sql = $conn->prepare("SELECT `session` FROM `user_info` WHERE email=:email");
$sql->bindParam(':email', $email);
$sql->execute();
$result = $sql->fetch();
$session = session_id();
if ($result['session'] != $session) {
    unset($_SESSION['user']);
    unset($_SESSION['email']);
    session_destroy();
    header('location:login.php');
}










?>
<!doctype html>
<html lang="en" dir="ltr">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css"
        integrity="sha384-dpuaG1suU0eT09tx5plTaGMLBsfDLzUCCUXOY2j/LSvXYuG6Bqs43ALlhIqAJVRb" crossorigin="anonymous">

    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="CSS/Dashboard.css">

    <title>Dashboard</title>

    
</head>

<body>
    <div class="container-fluid d-flex flex-column">
        <nav class="navbar bg-body-tertiary">
            <div class="container-fluid d-flex justify-content-between align-items-center">
                <a class="navbar-brand mb-0 h1" href="#">
                    <img src="user.png" alt="Logo">
                </a>
                <div class="d-flex align-items-center">
                    <div id="user_info" class="user-info" data-bs-toggle="popover" data-bs-html="true">
                        <img id="user_img" src="" alt="Profile Image">
                        <span id="user_name" class="user_name"></span>
                    </div>
                </div>
            </div>
        </nav>

        <div class="d-flex flex-grow-1">
            <?php
            include 'Partials/Dashnav.php';
            ?>
            </aside>

            <main class="message-area">
                <h3>Chat Room</h3>
                <div class="messages" id="texts">


                </div>

                <!-- Input Form -->
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Type your message..." id="message">
                    <button class="btn-send" id="send">
                        <i class="fas fa-paper-plane"></i>
                    </button>
                </div>
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const userInfo = document.querySelector("#user_info");
            const userImg = document.querySelector("#user_img");
            const userName = document.querySelector("#user_name");
            const messageInput = document.querySelector("#message");
            const send = document.querySelector("#send");
            const texts = document.querySelector("#texts");
            texts.scrollTop = texts.scrollHeight;


            let image;
            const xhr = new XMLHttpRequest();
            xhr.open('GET', 'display.php', true);
            xhr.onload = function () {
                if (xhr.status === 200) {
                    const response = JSON.parse(xhr.responseText);
                    if (!response.error) {
                        userImg.src = response.image || 'default.png';
                        userName.textContent = response.username;
                        image = response.image;

                        const popoverContent = `
    <div class="d-flex align-items-center">
        <img src="${response.image || 'default.png'}" alt="Profile Image" class="me-2">
        <div>&nbsp;&nbsp;
            <strong>${response.username}</strong>
        </div>
    </div>
    <hr/>
    <div class="profile d-flex align-items-center">
        <a href="Profile.php" class="text-decoration-none">Profile</a>
    </div>
    <hr/>
    <div class="signout d-flex align-items-center">
        <a href="Signout.php" class="text-decoration-none">Sign Out</a>
    </div>
    `;
                        userInfo.setAttribute('data-bs-content', popoverContent);
                        const popover = new bootstrap.Popover(userInfo);
                        popover.update();
                    } else {
                        console.error(response.message || 'An error occurred');
                    }
                } else {
                    console.error('Failed to fetch user data');
                }
            };
            xhr.send();


            const popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'));
            const popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
                return new bootstrap.Popover(popoverTriggerEl);
            });

            // Fetch Active Users From the Server
            function updateActiveUsers() {
                const userXhr = new XMLHttpRequest();
                userXhr.open('GET', 'ActiveUser.php', true);
                userXhr.onload = function () {
                    if (userXhr.status === 200) {
                        const response = JSON.parse(userXhr.responseText);
                        const userlist = document.getElementById("user_list");
                        userlist.innerHTML = '';
                        response.forEach(function (user) {
                            const li = document.createElement('li');
                            li.classList.add('d-flex', 'align-items-center');
                            li.innerHTML = `
        <img src="${user.image || 'default.png'}" alt="User Image">
        <span>${user.username}</span>
        <span class="logged-in" style="padding-left:4rem;color:green;">●</span>
        `;
                            userlist.appendChild(li);
                        });
                    } else {
                        console.error('Failed to fetch active users');
                    }
                };
                userXhr.send();
            }

            setInterval(updateActiveUsers, 500);
            updateActiveUsers();

            var conn = new WebSocket('ws://localhost:8080');

            conn.onopen = function (e) {
                console.log("Connection established!");
            };

            conn.onmessage = function (e) {
                const data = JSON.parse(e.data);

                let d = document.createElement('div');
                d.setAttribute('class', 'message other-message');

                const timestamp = new Date(data.timestamp).toLocaleTimeString();

                d.innerHTML = `
<img src="${data.senderImage || 'default.png'}" alt="User Image" class="rounded-circle me-2">
<div class="message-content">
    <strong>${data.sender}</strong>
    <span>${data.msg}</span>
    <span class="message-time">${timestamp}</span>
</div>
`;

                texts.appendChild(d);
                texts.scrollTop = texts.scrollHeight;
            };

            const sendata = (receiver) => {
                const message = messageInput.value;
                if (message.trim() !== "") {
                    let d = document.createElement('div');
                    d.setAttribute('class', 'message user-message');
                    const name = <?php echo json_encode($user); ?>;
                    const timestamp = new Date().toLocaleTimeString();
                    d.innerHTML = `
    <img src="${image}" alt="User Image" class="rounded-circle me-2">
    <div class="message-content">
        <strong>${name}</strong>
        <span>${message}</span>
        <span class="message-time">${timestamp}</span>
    </div>
    `;
                    texts.appendChild(d);
                    texts.scrollTop = texts.scrollHeight;

                    const obj = {
                        sender: name,
                        receiver: receiver,
                        msg: message,
                        senderImage: image,
                        timestamp: new Date().toISOString()
                    };
                    conn.send(JSON.stringify(obj));
                    messageInput.value = "";
                }
            }

            send.addEventListener('click', () => {
                sendata('receiverUsername');
            });

            document.addEventListener('keydown', (e) => {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    sendata('receiverUsername');
                }
            });
        });


    </script>
</body>

</html>