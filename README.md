# Hi there 👋

## Getting Started

To set up the project, follow these steps:

1. **Dump Autoload**:
   ```bash
   composer dump-autoload
   ```
2. **Run Migrations**:
   ```bash
   php migrate.php
   ```
3. **Start the server**
   ```bash
   php -S localhost:3000
   ```

### Environment Variables

If you need to modify the database credentials, create a .env file with the following variables:

```env
DB_HOST=localhost
DB_NAME=gigsberg
DB_USER=root
DB_PASSWORD=root
```
