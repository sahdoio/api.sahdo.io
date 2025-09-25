# api.sahdo.io

Blog API built with PHP 8.4 and Tempest Framework 2.0.4, featuring articles, comments, and likes functionality.

## Architecture

This project follows **Ports and Adapters** (Hexagonal Architecture) pattern, ensuring clean separation between business logic and external dependencies.

## Tech Stack

- **PHP**: 8.4
- **Framework**: Tempest 2.0.4
- **ORM**: Doctrine
- **Testing**: PHPUnit
- **Architecture**: Ports and Adapters (Hexagonal)

## Features

- Blog articles management
- Comments system
- Likes/reactions
- User authentication
- RESTful API endpoints

## Getting Started

### Prerequisites

- PHP 8.4 or higher
- Composer
- Database (MySQL/PostgreSQL)

### Installation

```bash
composer install
```

### Configuration

Copy the environment configuration:
```bash
cp .env.example .env
```

Configure your database settings in `.env`

### Database Setup

```bash
php tempest migrate
```

### Running the Application

```bash
php tempest serve
```

### Development

```bash
php tempest serve --env=dev
```

### Testing

```bash
./vendor/bin/phpunit
```

## Project Structure

```
src/
├── Domain/          # Business logic and entities
├── Application/     # Use cases and application services
├── Infrastructure/  # External dependencies (DB, HTTP, etc.)
└── Ports/          # Interfaces for external communication
```

## API Endpoints

- `GET /api/articles` - List articles
- `POST /api/articles` - Create article
- `GET /api/articles/{id}` - Get article
- `POST /api/articles/{id}/comments` - Add comment
- `POST /api/articles/{id}/likes` - Like article

## Contributing

1. Fork the repository
2. Create a feature branch
3. Make your changes
4. Run tests: `./vendor/bin/phpunit`
5. Submit a pull request

## License

[License information]