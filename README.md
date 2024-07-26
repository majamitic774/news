## Local Development

First, copy the `.env.example` file and rename the copy to `.env`. Change the values as you wish. The `ENVIRONMENT` variable should have the value `dev` for local development and `prod` for production.

### Steps

1. **Build and start docker containers:**
    ```
    docker compose build
    docker compose upi
    ```

2. **Install dependencies:**
    ```
    docker compose exec app composer install
    ```

3. **Change ownership of storage directory:**
    ```
    docker compose exec app chown -R www-data:www-data /var/www/public/storage
    ```

4. **Login to database via terminal:**
    ```
    docker compose exec db mysql -h db -u news_user -p
    ```
    Enter the password from the `.env` file when prompted.