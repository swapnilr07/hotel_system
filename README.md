## Folder Structure
```bash

hotel_system/
│
├── index.php           <-- Login page
├── logout.php          <-- Logout
├── includes/
│   ├── config.php      <-- DB connection
│   └── header.php      <-- Navbar 
├── admin/
│   ├── dashboard.php
│   ├── rooms.php
│   ├── bookings.php
│   └── users.php
└── staff/
    ├── dashboard.php
    └── bookings.php
```
## Screenshots
- **Login page** 

![Login page](img/Screenshot%20(30).png)

- **Dashboard page** 

![Dashboard page](img/Screenshot%20(31).png)

- **Rooms page** 

![Rooms page](img/Screenshot%20(32).png)

- **Rooms edit option** 

![Rooms edit option](img/Screenshot%20(33).png)

- **Bookings manage page** 

![Bookings manage page](img/Screenshot%20(35).png)

- **Manage users** 

![Manage users](img/Screenshot%20(36).png)
## Requirements

- XAMPP (Apache + MySQL)
- PHP 7.4+
- MySQL / MariaDB

---

## Installation
1. **Clone the repository**  

   git clone https://github.com/yourusername/hotel_management_system.git 
1. **Download / Clone Project**  
   Place the project folder inside `htdocs` (e.g., `C:\xampp\htdocs\hotel_system`).

2. **Start XAMPP**  
   Start **Apache** and **MySQL** from the XAMPP control panel.

3. **Create Database**  
   - Open [phpMyAdmin](http://localhost/phpmyadmin)  
   - Create a new database: `hotel_system`  
   - Import `hotel_system.sql` (included in the project)

4. **Configure Database**  
   Edit `includes/config.php` if needed:

```php
$servername = "localhost";
$username = "root";
$password = ""; // default XAMPP
$dbname = "hotel_system";
