# Brand Backend

## clone the application
```bash
git clone https://github.com/cybersoldattech/brands-back-end.git
cd brands-back-end
```

### PHP Packages
```bash
    composer install 
```

### Configuraiton ENV Project
```bash
    cp .env.example .env
```

### Generate Key Projet for session key data encryption

```bash
    php artisan key:generate
```

## If it's your fist deployment

```bash
    php artisan migrate --seed
```

## Else

```bash
    php artisan migrate:fresh --seed
```
## Create the symbolic link

```bash
    php artisan storage:link
```
## Start  application

```bash
    php artisan serve
```

### The API will be accessible at: http://localhost:8000/api . where 8000 is the application startup port

##### For GET all brands
```bash
      http://localhost:8000/api/brands 
```

##### For POST add brands
```bash
      http://localhost:8000/api/brands 
```

##### For PUT add brands where id represents the brand identifier
```bash
      http://localhost:8000/api/brands/id 
```

##### For DELETE add brands where id represents the brand identifier
```bash
      http://localhost:8000/api/brands/id 
```


### Admin interface will be accessible at: http://localhost:8000/admin . where 8000 is the application startup port

##### The brand table
```bash
      http://localhost:8000/admin/brands
```

##### Interface to create the brand

```bash
      http://localhost:8000/admin/brands/create
```

##### Interface for modifying the brand
```bash
      http://localhost:8000/admin/brands/id/edit
```
