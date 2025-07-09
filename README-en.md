![image](public/images/project1.webp)

# RINEMA - A Platform for Indonesian Cinema Enthusiasts

[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT)
[![Laravel](https://img.shields.io/badge/Laravel-12-red)](https://laravel.com/)
[![Deployed](https://img.shields.io/badge/Deployed-Yes-green)](https://rinemaa.paramadina.ac.id/)

[![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)](https://www.php.net/)
[![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)](https://laravel.com/)
[![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)](https://tailwindcss.com/)
[![JavaScript](https://img.shields.io/badge/JavaScript-F7DF1E?style=for-the-badge&logo=javascript&logoColor=black)](https://developer.mozilla.org/en-US/docs/Web/JavaScript)
[![MySQL](https://img.shields.io/badge/MySQL-005C84?style=for-the-badge&logo=mysql&logoColor=white)](https://www.mysql.com/)
[![cPanel](https://img.shields.io/badge/cPanel-FF6C2C?style=for-the-badge&logo=cpanel&logoColor=white)](https://cpanel.net/)
![Blade](https://img.shields.io/badge/Blade-f7523f?style=for-the-badge&logo=laravel&logoColor=white)

**RINEMA** is a digital platform dedicated to celebrating and exploring Indonesian cinema. Designed to foster a vibrant community of film enthusiasts, RINEMA provides a space for rating, commenting, discussing, and seamless login using Google accounts. Whether you're a fan of mainstream blockbusters or indie gems, RINEMA is the place to dive into the richness of Indonesian filmmaking.

[README.md](README.md) Indonesia Ver.

🌟 **Live Demo**: Visit RINEMA at [https://rinemaa.paramadina.ac.id/](https://rinemaa.paramadina.ac.id/)

🎬 **Video Demo**: Watch the RINEMA demo at [https://drive.google.com/demo-rinema](https://drive.google.com/file/d/1GFU2u-NRTmvaZKGEcnh3LjmsA2knm4Hj/view?usp=drive_link)

## Table of Contents

-   [About RINEMA](#about-rinema)
-   [Hybrid Architecture](#hybrid-architecture)
-   [Features](#features)
-   [Technologies](#technologies)
-   [API Documentation](#api-documentation)
-   [Project Structure (MVC)](#project-structure-mvc)
-   [Database Structure](#database-structure)
-   [UML (Unified Modeling Language)](#uml)
-   [Installation](#installation)
-   [Usage](#usage)
-   [Screenshots](#screenshots)
-   [Contributing](#contributing)
-   [License](#license)
-   [Contact](#contact)

## About RINEMA

The Indonesian film industry is experiencing a golden era, with high-quality works increasingly showcased in cinemas and at national and international film festivals. However, there has been no centralized platform for fans to deeply appreciate and discuss Indonesian films. RINEMA fills this gap, inspired by global platforms like IMDb but tailored specifically for Indonesian cinema.

### Goals

-   Build an interactive platform for Indonesian film lovers.
-   Foster an active, supportive community with responsible freedom of expression.
-   Provide a safe space for honest ratings, open comments, and dynamic discussions about Indonesian films.

## Hybrid Architecture

The RINEMA project is designed with a unique hybrid approach, making it a comprehensive portfolio:

1. **Functional Web Application**: The project includes a fully functional web application built with Laravel Blade. It is ready to use, interactive, and showcases all of RINEMA’s features directly.

2. **Standalone API**: Alongside the web application, RINEMA provides a robust set of APIs. These APIs enable other developers (e.g., Frontend Developers using React/Vue or Mobile Developers) to build their own client applications using RINEMA’s data and business logic.

This approach demonstrates proficiency in building both traditional monolithic applications and headless API backends.

## Features

-   **Film Search**: Quickly find Indonesian films using keywords like title, director, or actor.
-   **Film Filtering**: Filter films by popularity, release date (newest or oldest), or genre to discover content that matches your interests.
-   **Mobile-Friendly**: Enjoy a seamless experience on mobile devices with a responsive design.
-   **Film Rating**: Provide personal ratings for films you’ve watched, expressing your likes or dislikes honestly.
-   **Open Comments**: Share your thoughts and feelings, from constructive criticism to boundless praise.
-   **Discussion Forum**: Join engaging conversations, discussing film details, theories, or flaws with other users.
-   **User Profile**: Manage your activities, view your rating history, comments, and forum participation.
-   **Account Management**: Update profile information or delete your account as needed.
-   **Google Login**: Log in quickly and securely using your Google account, simplifying access to all features.

## Technologies

RINEMA is built with modern and reliable technologies:

-   **Front-end**:
    -   Laravel Blade (Templating Engine)
    -   Tailwind CSS (Styling)
    -   Vanilla JavaScript (Interactivity)
-   **Back-end**:
    -   Laravel 12 (Framework)
    -   PHP
-   **Database**:
    -   MySQL
-   **Integration**:
    -   Google OAuth for Google Login feature
-   **Deployment**:
    -   Hosted via cPanel at [https://rinemaa.paramadina.ac.id/](https://rinemaa.paramadina.ac.id/)

## API Documentation

The API allows external applications to interact with RINEMA’s data.

**Base URL**: `http://localhost:8000/api` or `https://rinemaa.paramadina.ac.id/api`

### API Authentication

Some endpoints require authentication. The API uses **Bearer Tokens** via Laravel Sanctum. To obtain a token, use the `POST /register` or `POST /login` endpoints.

Include your token in the header of requests to protected endpoints:
`Authorization: Bearer <YOUR_API_TOKEN>`

### List of API Endpoints

#### Authentication

These endpoints handle user registration and login.

##### 1. Register New User

-   **Endpoint**: `POST /register`
-   **Description**: Registers a new user in the system.
-   **Authentication**: Not required.
-   **Body Request (JSON)**:
    ```json
    {
        "name": "New User Name",
        "email": "newuser@example.com",
        "password": "password123",
        "password_confirmation": "password123"
    }
    ```
-   **Success Response (201 Created)**:
    ```json
    {
        "message": "Registration successful.",
        "access_token": "1|aBcDeFgHiJkLmNoPqRsTuVwXyZ...",
        "token_type": "Bearer",
        "user": { ... }
    }
    ```

##### 2. User Login

-   **Endpoint**: `POST /login`
-   **Description**: Logs in a registered user.
-   **Authentication**: Not required.
-   **Body Request (JSON)**:
    ```json
    {
        "email": "newuser@example.com",
        "password": "password123"
    }
    ```
-   **Success Response (200 OK)**:
    ```json
    {
        "message": "Login successful.",
        "access_token": "2|aBcDeFgHiJkLmNoPqRsTuVwXyZ...",
        "token_type": "Bearer",
        "user": { ... }
    }
    ```

##### 3. Google Login (Callback)

-   **Endpoint**: `POST /auth/google/callback`
-   **Description**: Endpoint called by the frontend after receiving an authorization code from Google.
-   **Authentication**: Not required.
-   **Body Request (JSON)**:
    ```json
    {
        "code": "4/0AeaYSH... (code obtained from Google)"
    }
    ```
-   **Success Response (200 OK)**:
    ```json
    {
        "message": "Google login successful.",
        "access_token": "3|aBcDeFgHiJkLmNoPqRsTuVwXyZ...",
        "token_type": "Bearer",
        "user": { ... }
    }
    ```

#### Films & Genres (Public)

These endpoints are publicly accessible.

##### 4. Get All Films

-   **Endpoint**: `GET /films/allFilm`
-   **Authentication**: Not required.

##### 5. Get Latest Films

-   **Endpoint**: `GET /films/latest`
-   **Authentication**: Not required.

##### 6. Get Oldest Films

-   **Endpoint**: `GET /films/oldest`
-   **Authentication**: Not required.

##### 7. Get Popular Films

-   **Endpoint**: `GET /films/popular`
-   **Authentication**: Not required.

##### 8. Search Films

-   **Endpoint**: `GET /films/search?query={film_name}`
-   **Authentication**: Not required.
-   **Query Parameter**:
    -   `query` (required): Keyword for the film title to search.
    -   **Example**: `/api/films/search?query=Dilan`

##### 9. Get All Genres

-   **Endpoint**: `GET /films/allGenre`
-   **Authentication**: Not required.

##### 10. Get Films by Genre

-   **Endpoint**: `GET /films/genre/{genre}`
-   **Authentication**: Not required.
-   **URL Parameter**:
    -   `{genre}` (required): Genre ID.

##### 11. Get Film Details

-   **Endpoint**: `GET /films/{film}`
-   **Authentication**: Not required.
-   **URL Parameter**:
    -   `{film}` (required): Film ID.

#### Ratings (Public & Protected)

##### 12. View All Ratings for a Film

-   **Endpoint**: `GET /films/{film}/ratingsView`
-   **Authentication**: Not required.
-   **URL Parameter**:
    -   `{film}` (required): Film ID.

##### 13. Save/Update Rating

-   **Endpoint**: `POST /films/{film}/ratings`
-   **Authentication**: Required (Bearer Token).
-   **URL Parameter**: `{film}` (required): Film ID.
-   **Body Request (JSON)**:
    ```json
    {
        "rating": 8.5,
        "comment": "My comment about this film."
    }
    ```

##### 14. View User-Specific Rating

-   **Endpoint**: `GET /films/{film}/ratings/user`
-   **Authentication**: Required (Bearer Token).
-   **URL Parameter**: `{film}` (required): Film ID.

##### 15. Delete User Rating

-   **Endpoint**: `DELETE /films/{film}/ratings`
-   **Authentication**: Required (Bearer Token).
-   **URL Parameter**: `{film}` (required): Film ID.

#### Forum (Public & Protected)

##### 16. View All Forum Replies for a Film

-   **Endpoint**: `GET /films/{film}/forum-replies`
-   **Authentication**: Not required.
-   **URL Parameter**: `{film}` (required): Film ID.

##### 17. Create New Forum Reply

-   **Endpoint**: `POST /films/{film}/forum-replies`
-   **Authentication**: Required (Bearer Token).
-   **URL Parameter**: `{film}` (required): Film ID.
-   **Body Request (JSON)**:
    ```json
    {
        "body": "My comment in the forum.",
        "parent_reply_id": null
    }
    ```

##### 18. Delete Forum Reply

-   **Endpoint**: `DELETE /forum-replies/{reply}`
-   **Authentication**: Required (Bearer Token).
-   **URL Parameter**: `{reply}` (required): Reply ID.

## Project Structure (MVC)

```
RINEMA/
├── app/
│   ├── Http/
│   │     └── Controllers/  # Controllers
│   │             └── api/      # API
│   └── Models/             # Models
│
├── resource/
│    └── views/             # Views
│          ├── admin/           # Admin dashboard pages
│          ├── auth/            # Authentication pages (login & register)
│          ├── error/           # 404 error pages
│          ├── components/      # Reusable components
│          ├── page/            # User-facing pages
│          └── index.blade.php  # Main index
│
└── routes/                  # Route Handling
```

## Database Structure

```sql
CREATE TABLE users (
    id SERIAL PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    username VARCHAR(255) UNIQUE NOT NULL,
    password TEXT NOT NULL,
    role VARCHAR(50) DEFAULT 'user',
    is_active BOOLEAN DEFAULT TRUE,
    avatar VARCHAR(255) NULL,
    last_login TIMESTAMP NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE films (
    id SERIAL PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    release_date DATE NOT NULL,
    director VARCHAR(255) NOT NULL,
    poster VARCHAR(255) NOT NULL,
    duration INT NOT NULL,
    is_active BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE genres (
    id SERIAL PRIMARY KEY,
    name VARCHAR(100) UNIQUE NOT NULL
);

CREATE TABLE film_genre (
    film_id INT REFERENCES films(id) ON DELETE CASCADE,
    genre_id INT REFERENCES genres(id) ON DELETE CASCADE,
    PRIMARY KEY (film_id, genre_id)
);

CREATE TABLE ratings (
    id SERIAL PRIMARY KEY,
    user_id INT REFERENCES users(id) ON DELETE CASCADE,
    film_id INT REFERENCES films(id) ON DELETE CASCADE,
    rating DECIMAL(2,1) CHECK (rating BETWEEN 0 AND 10),
    comment TEXT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    UNIQUE (user_id, film_id)
);

CREATE TABLE forums (
    id SERIAL PRIMARY KEY,
    film_id INT REFERENCES films(id) ON DELETE CASCADE,
    user_id INT REFERENCES users(id) ON DELETE CASCADE,
    title VARCHAR(255) NOT NULL,
    is_active BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE forum_replies (
    id SERIAL PRIMARY KEY,
    forum_id INT REFERENCES forums(id) ON DELETE CASCADE,
    user_id INT REFERENCES users(id) ON DELETE CASCADE,
    parent_reply_id INT NULL REFERENCES forum_replies(id) ON DELETE CASCADE,
    reply TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

## UML

### Use Case Diagram

![Use Case Diagram](https://github.com/user-attachments/assets/5e3becc6-d818-40be-a80e-cb059ce90c89)

### Class Diagram

![Class Diagram](https://github.com/user-attachments/assets/49e71499-4a76-474a-b1e6-93eca50870a7)

### Activity Diagram

![Activity Diagram](https://github.com/user-attachments/assets/979fbba5-409d-4e86-9ea4-c3aa8d65ad2e)

## Installation

To run RINEMA project locally, follow these steps:

### Prerequisites

-   PHP >= 8.3
-   Composer
-   MySQL
-   Node.js & npm
-   Git
-   Google Developer account for OAuth setup (optional for Google Login feature)

### Installation Steps

1. **Clone the Repository**:

    ```bash
        git clone https://github.com/ichramsyah/rinema-fullstack-webapp.git
        cd rinema
    ```

2. **Install Dependencies**:

    ```bash
        composer install
        npm install
    ```

3. **Configure Environment**:

    - Copy `.env.example` to `.env`:
        ```bash
        cp .env.example .env
        ```
    - Update `.env` with database credentials and Google OAuth (if using Google Login):

        ```env
        DB_CONNECTION_URL=127.0.0.1
        DB_PORT=3306
        DB_DATABASE=rinema
        DB_USERNAME=your_username
        DB_PASSWORD=your_password

        GOOGLE_CLIENT_ID=your_google_client_id
        GOOGLE_CLIENT_SECRET=your_google_client_secret
        GOOGLE_REDIRECT_URI=http://localhost:8000/auth/google/callback
        ```

4. **Generate App Key**:

    ```bash
        php artisan key:generate
    ```

5. **Run Database Migrations**:

    ```bash
        php artisan migrate
    ```

6. **Build Front-end Assets**:

    ```bash
        npm run build
    ```

7. **Start the Development Server**:

    ```bash
        php artisan serve
    ```

    Access RINEMA at `http://localhost:8000`.

### Notes for Google Login

-   Create OAuth credentials in the [Google Developer Console](https://console.developers.google.com/).
-   Add credentials to the `.env` file as shown above.
-   Ensure the callback route (`/auth/google/callback`) matches your application setup.

## Usage

1. **Sign Up/Log In**: Create a new account, log in with email, or use Google Login for quick access.
2. **Explore Films**: Browse Indonesian films and view details like cast, director, and synopsis.
3. **Rate & Comment**: Share your ratings and opinions about films you’ve watched.
4. **Join Discussions**: Participate in forums to discuss plots, themes, or fan theories with others.
5. **Manage Profile**: View your activity history and update account settings.

## Screenshots

Below are previews of RINEMA’s key pages:

-   **Home Page**

    ![image](https://github.com/user-attachments/assets/06011c9d-28f8-4f1e-830b-0fe11ae20fe8)

-   **Films Page**

    ![image](https://github.com/user-attachments/assets/fe9438a3-eb61-4a58-ad76-42b508804c4a)

-   **Film Details Page**

    ![image](https://github.com/user-attachments/assets/3785a1a1-a765-4129-99b5-d36b2463971b)

-   **Discussion Forum**

    ![image](https://github.com/user-attachments/assets/47684a78-afa9-4712-9eb9-da43ceeffa1d)

-   **Rating Submission**

    ![image](https://github.com/user-attachments/assets/669a7774-fe1a-4dbd-91ff-667e74ce9f72)

-   **Login Page**

    ![image](https://github.com/user-attachments/assets/18f61793-ddf2-45e8-9346-b7c34e34c1fa)

-   **Register Page**

    ![image](https://github.com/user-attachments/assets/51a5da02-1ffc-48c1-8db5-0dfb09f2202d)

-   **Profile Page**

    ![image](https://github.com/user-attachments/assets/8e22335f-bead-4af5-9642-469d0c3a3aa8)

-   **Admin Dashboard**

    ![image](https://github.com/user-attachments/assets/029b801f-3871-429b-abad-2d8a48a91832)

## Contributing

We welcome contributions to make RINEMA even better! To contribute:

1. Fork this repository.
2. Create a new branch (`git checkout -b feature/feature-name`).
3. Make changes and commit (`git commit -m "Add feature"`).
4. Push to the branch (`git push origin feature/feature-name`).
5. Open a Pull Request with a clear description of your changes.

Please adhere to our [Code of Conduct](CODE_OF_CONDUCT.md) and ensure your contributions align with RINEMA’s mission for constructive and respectful discussions.

### Contribution Suggestions

-   Enhance search and filtering features (e.g., by genre or director).
-   Add upvote/downvote for comments or nested replies in forums.
-   Integrate film recommendations based on user activity.
-   Develop moderation tools to maintain healthy discussions.

## License

This project is licensed under the MIT License. See the [LICENSE](LICENSE.txt) file for details.

## Contact

For questions, feedback, or collaboration opportunities, reach out to the RINEMA team:

-   **Email**: ichramsyahabdurrachman@gmail.com

Join us in celebrating Indonesian cinema with RINEMA! 🎥
