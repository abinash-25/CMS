# Content Management System (CMS)

## Project Overview

This CMS is designed to offer a simple interface for users to manage website content without requiring direct backend coding. The system allows for the management of users and posts through an intuitive web interface, similar to WordPress in its approach. The system includes essential features like user authentication, content creation, editing, and deletion.

## Features

### User Authentication
- **Login System**: Users can log in with their email and password. Passwords are hashed using SHA-1 before being stored.
- **Session Management**: Logged-in users have session-based access to protected pages like the dashboard and content management sections.
- **Logout**: Users can securely log out, which destroys their session and redirects them to the homepage.

### Dashboard
- Provides a simple interface where users can navigate to manage posts and users.
- **User-friendly**: All management actions (adding, editing, and deleting users or posts) can be performed through easy-to-use buttons.

### Post Management
- **Add New Post**: Users can create new posts by providing a title, content, and date.
- **Edit Post**: Existing posts can be updated by authorized users.
- **Delete Post**: Posts can be deleted with a single action.
- **TinyMCE Editor**: Integrated for rich text editing of post content.

### User Management
- **Add New User**: New users can be added with a username, email, and password, and their active status can be set (active/inactive).
- **Edit User**: Users' details, including their username, email, password, and status, can be modified.
- **Delete User**: Users can be removed from the system if necessary.

## Technical Stack

- **Frontend**: The frontend uses MDBootstrap to ensure modern and responsive design for forms, buttons, and tables.
- **Backend**: 
  - PHP for server-side scripting.
  - MySQL for database management.
- **Security**: SHA-1 password hashing and session management to protect user data.
- **JavaScript Libraries**: 
  - TinyMCE for rich text editing.

## Installation

1. Clone the repository:
   git clone https://github.com/your-repo/cms.git
2. Import the database from the `sql` file provided.
3. Update the `config.php` file with your MySQL database credentials.
4. Ensure you have the following folder structure:
   ├── includes/
   ├── js/
   ├── css/
   ├── index.php
   ├── dashboard.php
   ├── posts_add.php
   ├── posts_edit.php
   ├── users_add.php
   ├── users_edit.php
   ├── logout.php
   ```

## Usage

- After installation, visit the homepage (`index.php`), which will present a login form.
- Once logged in, you can access the dashboard to manage posts and users.
  
## Known Issues/Limitations
- No validation is performed on email format during user addition.
- SHA-1 is used for password hashing, which is considered weak. Consider upgrading to a more secure hashing algorithm like bcrypt.

## License
This project is licensed under the MIT License.

You can copy and paste this into your `README.md` file in VS Code. It should render properly in Markdown format. Let me know if you'd like to modify anything!
