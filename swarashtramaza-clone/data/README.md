# Database Initialization for Swarashtramaza Clone

This directory contains the SQLite database initialization script for the Swarashtramaza news website clone.

## init_db.php

- Creates the SQLite database file `news.db`.
- Creates the following tables:
  - `news`: Stores news articles with fields for id, title, category, content, image URL, and date.
  - `users`: Stores admin user credentials with username and password hash.
- Inserts a default admin user with:
  - Username: `admin`
  - Password: `password`

## How to run

1. Ensure PHP CLI is installed.
2. Run the script from the command line:

```bash
php init_db.php
```

3. This will create the `news.db` file in the same directory.

## Notes

- You can modify the default admin credentials by editing the script.
- The database file `news.db` should be readable and writable by the web server.
