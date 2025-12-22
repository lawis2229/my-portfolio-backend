## Running the Project with Docker

This project provides a Docker setup for running the PHP application using PHP-FPM (version 8.2, Alpine-based). Composer is included for dependency management, and all required PHP extensions are installed during the build process.

### Requirements
- Docker (latest recommended)
- Docker Compose (latest recommended)

### Environment Variables
- The application uses a `.env` file for configuration. Ensure you have a valid `.env` file in the project root before building. You can use `.env.example` as a template.
- If you wish to pass environment variables to the container, uncomment the `env_file: ./.env` line in `docker-compose.yml`.

### Build and Run Instructions

1. **Build and start the application:**
   ```bash
   docker compose up --build
   ```
   This will build the Docker image and start the `php-app` service.

2. **Accessing the application:**
   - The PHP-FPM service is exposed on port `9000`.
   - You may need to configure a web server (e.g., Nginx) separately to proxy requests to PHP-FPM if required by your setup.

### Special Configuration
- The Dockerfile removes sensitive files (`.env`, `.env.example`, `.git`, `.gitignore`, `.gitattributes`, `composer.lock`) from the final image for security.
- Composer dependencies are installed with `--no-dev` and optimized autoloader for production use.
- The container runs as a non-root user (`appuser`).

### Exposed Ports
- `php-app`: `9000` (PHP-FPM)

---

Refer to the `docker-compose.yml` and `Dockerfile` for further customization. If your application requires a database, add the relevant service to `docker-compose.yml` and update your `.env` configuration accordingly.