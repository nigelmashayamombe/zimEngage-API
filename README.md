## Running the Project with Docker

To run this project using Docker, follow the steps below:

### Prerequisites

Ensure you have the following installed on your system:

- Docker version 20.10 or higher
- Docker Compose version 1.29 or higher

### Environment Variables

The project requires specific environment variables to be set. Refer to the `.env.example` file in the root directory for the required variables. Copy this file to `.env` and update the values as needed:

```bash
cp .env.example .env
```

### Build and Run the Services

Use the provided `docker-compose.yml` file to build and run the services:

```bash
docker-compose up --build
```

This command will build the Docker images and start the services defined in the `docker-compose.yml` file.

### Services and Ports

The following services are defined:

- **php-service**: Exposes port `9000` for PHP-FPM.
- **ts-service**: Exposes port `3000` for the TypeScript-based application.

Access the services using the respective ports on your localhost.

### Additional Notes

- Ensure the `.env` file is correctly configured before starting the services.
- For any issues, consult the Docker logs using:

```bash
docker-compose logs
```