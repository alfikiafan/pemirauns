# PEMIRA

PEMIRA, short for "Pemilihan Raya Mahasiswa" (Student Council Elections), is a web-based application designed to facilitate the electoral process for the Student Executive Board (BEM) at Universitas Sebelas Maret (UNS). This digital platform serves for organizing, managing, and executing the entire electoral procedure, ensuring efficiency, transparency, and accessibility throughout the election cycle.

## Features

1. **Admin Dashboard**
   - View statistics on users, elections, and candidates.
   - Access real-time election results and detailed vote counts for each candidate.

2. **Voter Dashboard**
   - Access voting guidelines, candidate information, and current election results.
   - Cast votes through a user-friendly interface.

3. **User Management**
   - Manage users with roles such as superadmin, university admin, faculty admin, and voter.
   - Approve or disapprove user accounts as needed.

4. **Election Management**
   - Create, edit, and delete elections (Pemira).
   - Set election schedules, determine election scope (faculty or university level), and manage related information.

5. **Candidate Management**
   - Add, edit, and delete candidates.
   - Manage detailed candidate profiles, including photos and vision-mission statements.

6. **Candidate Profiles**
   - Voters can view detailed candidate profiles, including vision-mission, profile videos, biographies, experiences, and achievements.

7. **Election Results**
   - Display election results with appealing visualizations.
   - Show vote percentages for each candidate and detailed vote statistics in an organized table.

8. **Authentication and Security**
   - Ensure only registered users can access the system.
   - Create superadmin accounts securely using seeders.

9. **Notifications**
   - Notify users about their account status and other important information.

## System Requirements

- **PHP 8.2 or higher**
- **MySQL 5.7 or higher**
- **Laravel 11 or higher**
- **Composer (dependency manager)**
- **Web Server (Apache, Nginx)**
- **Browser Compatibility:** Chrome, Firefox, Safari, Edge

## Installation

Follow these steps to install and configure the PEMIRA application:

1. **Clone the repository:**
   ```bash
   git clone https://github.com/Alfurqon02/ppl-pemira.git
   cd ppl-pemira
   ```

2. **Install dependencies:**
   ```bash
   composer install
   ```

3. **Copy the example environment file and rename it to .env:**
   ```bash
   cp .env.example .env
   ```

4. **Generate the application key:**
   ```bash
   php artisan key:generate
   ```

5. **Configure the database settings in the .env file:**
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=your_database_name
   DB_USERNAME=your_database_username
   DB_PASSWORD=your_database_password
   ```

6. **Configure email settings in the .env file:**
   ```env
   MAIL_MAILER=smtp
   MAIL_HOST=smtp.mailtrap.io
   MAIL_PORT=2525
   MAIL_USERNAME=your_email@example.com
   MAIL_PASSWORD=your_password
   MAIL_ENCRYPTION=tls
   MAIL_FROM_ADDRESS=your_email@example.com
   MAIL_FROM_NAME="${APP_NAME}"
   ```

7. **Run the database migrations:**
   ```bash
   php artisan migrate
   ```

8. **Seed the database to create an administrator account:**
   ```bash
   php artisan db:seed
   ```

9. **Create a symbolic link for storage:**
   ```bash
   php artisan storage:link
   ```

10. **Configure the web server:**
    - Set up your web server (Apache or Nginx) to direct HTTP/HTTPS requests to the PEMIRA application's directory on the server.

## Contributors

We would like to thank the following contributors for their valuable contributions to this project:
- Alfiki Diastama Afan Firdaus - [Github](https://github.com/alfikiafan)
- Mohammad Al-Furqon - [Github](https://github.com/Alfurqon02)
- Rio Saputro - [Github](https://github.com/XnoahR)
- Syah Rizan Nazri Muhammad - [Github](https://github.com/snazrimuh)
- Tulus Toto Raharjo - [Github](https://github.com/tulustoto)

## Credits

PEMIRA is built using several resources and libraries, including:
- Laravel
- Bootstrap
