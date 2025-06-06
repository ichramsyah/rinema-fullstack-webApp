# RINEMA - Platform for Indonesian Film Enthusiasts

[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT)
[![Laravel](https://img.shields.io/badge/Laravel-12-red)](https://laravel.com/)
[![Deployed](https://img.shields.io/badge/Deployed-Yes-green)](https://rinemaa.paramadina.ac.id/)

[![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)](https://www.php.net/)
[![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)](https://laravel.com/)
[![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)](https://tailwindcss.com/)
[![JavaScript](https://img.shields.io/badge/JavaScript-F7DF1E?style=for-the-badge&logo=javascript&logoColor=black)](https://developer.mozilla.org/en-US/docs/Web/JavaScript)
[![MySQL](https://img.shields.io/badge/MySQL-005C84?style=for-the-badge&logo=mysql&logoColor=white)](https://www.mysql.com/)
[![cPanel](https://img.shields.io/badge/cPanel-FF6C2C?style=for-the-badge&logo=cpanel&logoColor=white)](https://cpanel.net/)

### Group: Apa Bae

#### [README.md](README.md) Indonesia Ver.

**RINEMA** is a digital platform dedicated to celebrating and exploring Indonesian cinema. Designed to build a passionate community of film enthusiasts, RINEMA provides a space for rating, commenting, discussing, and logging in seamlessly using a Google account. Whether you're a fan of big-screen movies or independent works, RINEMA is the place to dive into the richness of Indonesian filmmaking.

🌟 **Live Demo**: Visit RINEMA at [https://rinemaa.paramadina.ac.id/](https://rinemaa.paramadina.ac.id/)

🎬 **Demo Video**: Watch the RINEMA Demo at [https://drive.google.com/demo-rinema](https://drive.google.com/file/d/1GFU2u-NRTmvaZKGEcnh3LjmsA2knm4Hj/view?usp=drive_link)

✨ **Link Design Figma**: Lihat desain Rinema di [https://www.figma.com/rinema-design](https://www.figma.com/design/yb2RG0CQay2An0RKcYorFD/Rinema?node-id=0-1&t=BAkABHVPZgUs5MtC-1)

## Table of Contents

- [About RINEMA](#about-rinema)
- [Features](#features)
- [Technologies](#technologies)
- [Project Structure (MVC)](#project-structure--mvc-)
- [Database Structure](#database-structure)
- [Team](#team)
- [UML (Unified Modeling Language)](#uml)
- [Installation](#installation)
- [Usage](#usage)
- [Screenshots](#screenshots)
- [Contributing](#contributing)
- [License](#license)
- [Contact](#contact)

## About RINEMA

The Indonesian film industry is experiencing a golden era, with high-quality works increasingly showcased in cinemas and film festivals, both nationally and internationally. However, there is no centralized platform that allows fans to deeply appreciate and discuss Indonesian films. RINEMA steps in to fill this gap, inspired by global platforms like IMDb, but tailored specifically for Indonesian cinema.

### Objectives

- Build an interactive platform for Indonesian film enthusiasts.
- Foster an active, supportive community with responsible freedom of expression.
- Provide a safe space for honest ratings, open comments, and dynamic discussions about Indonesian films.

## Features

- **Film Search**: Quickly find Indonesian films using keywords like title, director, or actor.
- **Film Filters**: Sort films by popularity, newest, oldest, or genre to match your interests.
- **Mobile-Friendly**: Enjoy a seamless experience on mobile devices with responsive design.
- **Film Rating**: Share your personal rating for watched films, expressing likes or dislikes honestly.
- **Open Comments**: Write your thoughts and feelings, from constructive criticism to limitless praise.
- **Discussion Forum**: Join exciting conversations, discuss film details, theories, or flaws with other users.
- **User Profile**: Manage your activities, view rating history, comments, and forum participation.
- **Account Management**: Update profile information or delete your account as needed.
- **Google Login**: Sign in quickly and securely using your Google account for easy access to all features.

## Technologies

RINEMA is built with modern and reliable technologies:

- **Front-end**:
  - Laravel Blade (Templating Engine)
  - Tailwind CSS (Styling)
  - Vanilla JavaScript (Interactivity)
- **Back-end**:
  - Laravel 12 (Framework)
  - PHP
- **Database**:
  - MySQL
- **Integration**:
  - Google OAuth for Google Login feature
- **Deployment**:
  - Hosted via cPanel at [https://rinemaa.paramadina.ac.id/](https://rinemaa.paramadina.ac.id/)

## Project Structure (MVC)

```
RINEMA/
├── app/    
│   ├── Http/
│   │     └── Controllers/  # Controllers
│   └── Models/             # Models          
│
├── resource/
│    └── views/             # Views
│          ├── admin/           # Admin dashboard pages
│          ├── auth/            # Authentication pages (login & register)
│          ├── error/           # 404 pages
│          ├── komponen/        # Components
│          ├── page/            # User pages
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

## Team

- Miftahul Fitriah (Leader)
- Ichramsyah Abdurrachman

## UML (Unified Modeling Language)

### Class Diagram

![Class Diagram](https://github.com/user-attachments/assets/49e71499-4a76-474a-b1e6-93eca50870a7)

### Use Case Diagram

![Use Case Diagram](https://github.com/user-attachments/assets/b415e827-8202-461d-b914-bd26e3f2afd7)

### Activity Diagram

![Activity Diagram](https://github.com/user-attachments/assets/1bc38f7d-4d99-42e6-b5c9-9393080462ca)

## Installation

To run RINEMA locally, follow these steps:

### Prerequisites

- PHP >= 8.1
- Composer
- MySQL
- Node.js & npm
- Git
- Google Developer Account for OAuth configuration (optional for Google Login feature)

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

    - Copy the `.env.example` file to `.env`:
        ```bash
        cp .env.example .env
        ```
    - Update the `.env` file with your database credentials and Google OAuth (if using Google Login):

        ```env
        DB_CONNECTION=mysql
        DB_HOST=127.0.0.1
        DB_PORT=3306
        DB_DATABASE=rinema
        DB_USERNAME=your_username
        DB_PASSWORD=your_password

        GOOGLE_CLIENT_ID=your_google_client_id
        GOOGLE_CLIENT_SECRET=your_google_client_secret
        GOOGLE_REDIRECT_URI=http://localhost:8000/auth/google/callback
        ```

4. **Generate Application Key**:

    ```bash
    php artisan key:generate
    ```

5. **Run Database Migrations**:

    ```bash
    php artisan migrate
    ```

6. **Build Front-end Assets**:

    ```bash
    npm run dev
    ```

7. **Run Development Server**:
    ```bash
    php artisan serve
    ```
    Access RINEMA at `http://localhost:8000`.

### Notes for Google Login

- Create OAuth credentials in [Google Developer Console](https://console.developers.google.com/).
- Add the credentials to the `.env` file as shown above.
- Ensure the callback route (`/auth/google/callback`) matches your application settings.

## Usage

1. **Sign Up/Log In**: Create a new account, log in with email, or use Google Login for quick access.
2. **Explore Films**: Browse Indonesian films and view details like cast, director, and synopsis.
3. **Rate & Comment**: Share your ratings and opinions on watched films.
4. **Join Discussions**: Participate in forums to discuss plots, themes, or flaws with other users.
5. **Manage Profile**: View your activity history and update account settings.

## Screenshots

Here are previews of RINEMA's main pages:

- **Home Page**
  
    ![image](https://github.com/user-attachments/assets/06011c9d-28f8-4f1e-830b-0fe11ae20fe8)

- **Film Page**
  
    ![image](https://github.com/user-attachments/assets/fe9438a3-eb61-4a58-ad76-42b508804c4a)
  
- **Film Detail Page**

    ![image](https://github.com/user-attachments/assets/3785a1a1-a765-4129-99b5-d36b2463971b)

- **Discussion Forum**
 
    ![image](https://github.com/user-attachments/assets/47684a78-afa9-4712-9eb9-da43ceeffa1d)

- **Rating Submission**
 
    ![image](https://github.com/user-attachments/assets/669a7774-fe1a-4dbd-91ff-667e74ce9f72)

- **Login Page** 

    ![image](https://github.com/user-attachments/assets/18f61793-ddf2-45e8-9346-b7c34e34c1fa)
    
- **Register Page** 

    ![image](https://github.com/user-attachments/assets/51a5da02-1ffc-48c1-8db5-0dfb09f2202d)

- **Profile Page** 

    ![image](https://github.com/user-attachments/assets/8e22335f-bead-4af5-9642-469d0c3a3aa8)

- **Admin Dashboard Page** 

    ![image](https://github.com/user-attachments/assets/029b801f-3871-429b-abad-2d8a48a91832)

## Contributing

We welcome contributions to make RINEMA even better! To contribute:

1. Fork this repository.
2. Create a new branch (`git checkout -b feature/feature-name`).
3. Make changes and commit (`git commit -m "Add feature"`).
4. Push to the branch (`git push origin feature/feature-name`).
5. Open a Pull Request with a clear description of your changes.

Please adhere to our [Code of Conduct](CODE_OF_CONDUCT.md) and ensure your contributions align with RINEMA's mission for constructive and respectful discussions.

### Contribution Suggestions

- Enhance search and filter features (e.g., by genre or director).
- Add upvote/downvote for comments or nested replies in the forum.
- Integrate film recommendations based on user activity.
- Develop moderation tools to maintain healthy discussions.

## License

This project is licensed under the MIT License. See the [LICENSE](LICENSE.txt) file for details.

## Contact

For questions, feedback, or collaboration opportunities, contact the RINEMA team:

- **Email**: ichramsyahabdurrachman@gmail.com

Join us to celebrate Indonesian cinema with RINEMA! 🎥
