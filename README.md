# E-LEARNING - Setup Backend Enviroment(Quick Guide)

### 1. Clone repository in your local

```
git clone git@github.com:framgia/sph-classroom-els-be.git
```

_note: use ssh when you clone_


### 2. Build the docker container

```
cd edulab-edge-be
docker-compose up -d --build
```

### 3. Create .env file.

```
cp .env.example .env
docker-compose exec backend composer install
docker-compose exec backend php artisan key:generate
```

### 4. Add Database Credentials
update the `DB_` variables part. To add the mysql credentials pleaser refer from `docker-compose.yml`.

```
DB_CONNECTION=mysql
DB_HOST=database
DB_PORT=3306
DB_DATABASE=test
DB_USERNAME=
DB_PASSWORD=
```

After save, run `docker-compose exec backend php artisan migrate`

### 5. Visit it the application in browser

```
http://localhost:82
```

### 6. To run some commands for the application

```
docker-compose exec backend <insert command>
```
