
# User Content Management System Project

This project is a web application developed using PHP and MySQL, intended to be set up locally using XAMPP.

## Project Structure

- `account.php` - Handles user account operations.
- `createpost.php` - Allows users to create new posts.
- `createuser.php` - Allows creation of new user accounts.
- `dbcon.php` - Manages database connection.
- `deletepost.php` - Allows users to delete posts.
- `deleteuser.php` - Allows deletion of user accounts.
- `editpost.php` - Allows users to edit posts.
- `edituser.php` - Allows editing of user accounts.
- `func.php` - Contains common functions used across the application.
- `header.php` - Contains the header template for the application.
- `index.php` - The main entry point of the application.
- `login.php` - Handles user login operations.
- `logout.php` - Manages user logout operations.
- `myposts.php` - Displays posts created by the logged-in user.
- `search.php` - Enables searching through posts.
- `users.php` - Displays and manages user accounts.
- `css` - Directory containing CSS files.
- `img` - Directory containing image files.
- `js` - Directory containing JavaScript files.
- `webfonts` - Directory containing web font files.

## Features

- User authentication (login, logout, account creation, account deletion)
- Post creation, editing, and deletion
- User management (creation, editing, deletion)
- Search functionality for posts
- User-specific post management

## Prerequisites

- XAMPP (Apache, MySQL, PHP)
- Web browser

## Installation

### Step 1: Download and Install XAMPP

Download XAMPP from the [official website](https://www.apachefriends.org/index.html) and install it on your local machine.

### Step 2: Setup the Project Files

1. Extract the project files to the `htdocs` directory of your XAMPP installation. This is usually located at `C:\xampp\htdocs\` on Windows or `/Applications/XAMPP/htdocs/` on macOS.

2. The directory structure should look like this:

   ```
   C:\xampp\htdocs\project\
       ├── account.php
       ├── createpost.php
       ├── createuser.php
       ├── css
       ├── dbcon.php
       ├── deletepost.php
       ├── deleteuser.php
       ├── editpost.php
       ├── edituser.php
       ├── func.php
       ├── header.php
       ├── img
       ├── index.php
       ├── js
       ├── login.php
       ├── logout.php
       ├── myposts.php
       ├── search.php
       ├── users.php
       ├── webfonts
   ```

### Step 3: Setup the Database

1. Start XAMPP and ensure that Apache and MySQL services are running.

2. Open your web browser and go to `http://localhost/phpmyadmin`.

3. Create a new database for the project. You can name it `project_db`.

4. Import the database schema by running the following SQL commands:

   ```sql
   CREATE TABLE `users` (
       `user_ID` int(11) NOT NULL AUTO_INCREMENT,
       `user_First` varchar(30) NOT NULL,
       `user_Last` varchar(30) NOT NULL,
       `user_Email` varchar(50) NOT NULL,
       `user_Pswd` varchar(255) NOT NULL,
       `user_Year` year(4) NOT NULL,
       `acc_Created` datetime NOT NULL DEFAULT current_timestamp(),
       PRIMARY KEY (`user_ID`),
       UNIQUE KEY `user_Email` (`user_Email`)
   ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

   CREATE TABLE `admins` (
       `user_ID` int(11) NOT NULL,
       `is_Super` varchar(1) NOT NULL,
       PRIMARY KEY (`user_ID`),
       CONSTRAINT `admining` FOREIGN KEY (`user_ID`) REFERENCES `users` (`user_ID`) ON DELETE CASCADE ON UPDATE CASCADE
   ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

   CREATE TABLE `posts` (
       `post_ID` int(11) NOT NULL AUTO_INCREMENT,
       `post_cont` text NOT NULL,
       `post_Creator` int(11) NOT NULL,
       `post_Date` datetime NOT NULL DEFAULT current_timestamp(),
       PRIMARY KEY (`post_ID`),
       KEY `creating` (`post_Creator`),
       CONSTRAINT `creating` FOREIGN KEY (`post_Creator`) REFERENCES `users` (`user_ID`) ON DELETE CASCADE ON UPDATE CASCADE
   ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
   ```

5. Update the `dbcon.php` file with your database credentials:

   ```php
   <?php
   $servername = "localhost";
   $username = "root"; // Default XAMPP username
   $password = ""; // Default XAMPP password (leave empty)
   $dbname = "project_db";

   // Create connection
   $conn = new mysqli($servername, $username, $password, $dbname);

   // Check connection
   if ($conn->connect_error) {
       die("Connection failed: " . $conn->connect_error);
   }
   ?>
   ```

### Step 4: Run the Application

1. Open your web browser and go to `http://localhost/project/index.php`.

2. You should see the homepage of your web application. From here, you can log in, create posts, manage users, etc.

## Contributing

Feel free to contribute to this project by submitting issues or pull requests.

## License

This project is licensed under the MIT License.

## Demonstration

To see how the application works, you can watch this [YouTube video](https://youtu.be/a28KnjsJGBA).
