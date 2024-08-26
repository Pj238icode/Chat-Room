# Chat Room

Welcome to the Chat Room project! This repository contains the code and resources for a real-time chat application developed with PHP.

## Features

- **Real-Time Messaging:** Users can send and receive messages instantly.
- **User Authentication:** Secure login and registration.
- **User Presence:** View online users.


## Installation

To set up the Chat Room application, follow these steps:

1. **Clone the Repository:**

    ```bash
    git clone https://github.com/your-username/chat-room.git
    ```

2. **Navigate to the Project Directory:**

    ```bash
    cd chat-room
    ```

3. **Set Up Your Environment:**

    Ensure you have a local web server with PHP and MySQL installed. You can use tools like XAMPP, WAMP, or MAMP.

4. **Configure Database:**

    - Create a new database in MySQL (e.g., `chatroom`).
    - Import the provided SQL schema located in `database/schema.sql`.

    ```bash
    mysql -u your-username -p chatroom < database/schema.sql
    ```

5. **Update Configuration:**

    Edit `config.php` to set up your database connection. Update the file with your database details:

    ```php
    <?php
    define('DB_SERVER', 'localhost');
    define('DB_USERNAME', 'your-username');
    define('DB_PASSWORD', 'your-password');
    define('DB_DATABASE', 'chatroom');
    ?>
    ```

6. **Start the WebSocket Server:**

    Open a terminal and navigate to the project directory, then run:

    ```bash
    php bin/chat-server.php
    ```

    This command starts the WebSocket server which handles real-time messaging.

7. **Start the Web Server:**

    Place the project directory in your web server's root directory (e.g., `htdocs` for XAMPP). Then navigate to `http://localhost/chat-room` in your web browser.

## Usage

After setting up the application, you can:

- **Register:** Create a new account.
- **Login:** Access your account with your credentials.
- **Join a Room:** Enter an existing chat room.
- **Send Messages:** Communicate with other users in real-time.


## Development

To contribute to the Chat Room project, follow these steps:

1. **Fork the Repository.**
2. **Create a New Branch:** 

    ```bash
    git checkout -b feature/your-feature
    ```

3. **Make Your Changes.**
4. **Commit Your Changes:**

    ```bash
    git commit -am 'Add some feature'
    ```

5. **Push to the Branch:**

    ```bash
    git push origin feature/your-feature
    ```

6. **Create a Pull Request.**

Please ensure your code adheres to the project’s coding standards and includes tests where applicable. Review our [Contributing Guidelines](CONTRIBUTING.md) for additional details.

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## Contact

For questions or support, please reach out to [-jena.prasanjeet2003@gmail.com](mailto:jena.prasanjeet2003@gmail.com).

Happy coding! 🚀


