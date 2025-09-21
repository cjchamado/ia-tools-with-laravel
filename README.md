
## Resources

- [Laravel 12](https://laravel.com/docs/12.x)
- [Docker](https://www.docker.com) (+Docker Compose)
- [Pest](https://pestphp.com)
- [Redis](https://redis.io)
- [Quasar Framework](https://quasar.dev) (+VueJS)
- [Pusher](https://pusher.com)
- [DeepSeek](https://platform.deepseek.com)

## Download

```sh
# via https
git clone https://github.com/cjchamado/ia-tools-with-laravel.git

# via ssh
git@github.com:cjchamado/ia-tools-with-laravel.git

# via gh (github cli)
gh repo clone cjchamado/ia-tools-with-laravel
```

## Build

```sh
# DockerCompose V2 (Docker CLI >= 20.10)
docker compose build

# DockerCompose V1
docker-compose build
```

## Run

```sh
# DockerCompose V2 (Docker CLI >= 20.10)
docker compose up

# DockerCompose V1
docker-compose up
```

## API (preparation)

```sh
# Make .env file
docker exec ia_tools_backend cp .env.example .env

# Make app key
docker exec ia_tools_backend php artisan key:generate

# Access container cli (optional)
docker exec -it ia_tools_backend bash
```

## Open

**[APP/Frontend](http://localhost:9922)**

**[API/Backend](http://localhost:8822)**

**[PHPMyAdmin](http://localhost:4422)**
