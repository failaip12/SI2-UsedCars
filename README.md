# UsedCars

A web application for buying and selling used cars, built with PHP and MySQL.

## Overview

UsedCars is a platform that allows users to:

- Browse car listings with detailed search functionality
- Create and manage car sale advertisements
- Save searches for later reference
- Register and manage user profiles
- Admin approval system for listings

## Features

### Advanced Search

- Filter cars by multiple criteria:
  - Make and model
  - Year range
  - Mileage range
  - Price range
  - Fuel type
  - Transmission type
  - Drive type
  - Engine displacement
  - Power output

### User Management

- User registration and authentication
- Profile management
- Different permission levels (Admin/User)
- Saved searches functionality

### Advertisement Management

- Create detailed car listings with multiple images
- Admin approval system for new listings
- Comprehensive car details including:
  - Technical specifications
  - Price
  - Description
  - Contact information
  - Multiple photo upload

## Technical Details

### Backend

- PHP 7+ with strict typing
- MySQL database
- PDO for database operations
- Custom MVC-like architecture

### Frontend

- Responsive design
- Mobile-first approach
- Custom CSS
- JavaScript for interactive features

### Security Features

- Password hashing
- CSRF protection
- Input sanitization
- Prepared SQL statements
- Session management

## Project Structure

```bash
├── classes/           # Core PHP classes
├── core/             # Core initialization
├── css/              # Stylesheets
├── functions/        # Helper functions
├── images/           # Static images
├── js/              # JavaScript files
├── slike_oglasa/    # User uploaded images
└── baza/            # Database scripts
```

## Database

The application uses a MySQL database with tables for:

- Users (korisnik)
- Advertisements (oglasi)
- Images (slika)
- Saved searches (pretrage)
- Admin accounts (admin)

## Installation

1. Clone the repository
2. Import the database schema from `baza/skripta.sql`
3. Configure database connection in `core/init.php`
4. Ensure the `slike_oglasa` directory is writable
5. Configure your web server to serve the application

## Requirements

- PHP 7.0 or higher
- MySQL 5.7 or higher
- Web server (Apache/Nginx)

## License

© 2023 UsedCars.com, All rights reserved.

---
