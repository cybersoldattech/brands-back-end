# Brand Back-end

## Clone the application
```bash
git clone https://github.com/cybersoldattech/brands-back-end.git
cd brands-back-end
```

### Instal Php dependency
```bash
    composer install 
```

### The project contains a command to initialize the project 
```bash
      php artisan app:init-project-command                                                                         
```

- [x] Installation of dependencies via composer and npm :tada:
- [x] Creation of the Env file :tada:
- [x] Generation of the key artisan  :tada:
- [x] Publish storage folders :tada:
- [x] Migration of the database :tada:
- [x] create Seed Data :tada:

> [!NOTE] 
> It is possible to modify the env file to make specific needs.

> [!NOTE] 
> By default the database is configured with sqlite if you wish mysql please modify your environment file.after modifying the file please execute the commands below


```bash
      php artisan migrate                                                                         
```

```bash
      php artisan db:seed                                                                         
```

### Start Application

```bash
      php artisan serve                                                                         
```

### The API will be accessible at: http://localhost:8000/api . Where 8000 is the application startup port

##### For GET all brands

```bash
      http://localhost:8000/api/brands 
```

##### For POST the brand
```bash
      http://localhost:8000/api/brands 
```

##### For UPDATE / PUT the brand 

```bash
      http://localhost:8000/api/brands/{id} 
```

> [!IMPORTANT] 
> where id represents the brand identifier


##### For DELETE add brands

```bash
      http://localhost:8000/api/brands/{id} 
```

> [!IMPORTANT] 
> where id represents the brand identifier




### Admin interface will be accessible at: http://localhost:8000/admin/login . where 8000 is the application startup port


> [!NOTE] 
> Information for admin user.
> Email:**admin@casinoonlinefrancais.info**
> Password:**password**


##### Login Interface

<img src="./public/img/readme4.png" alt="Login interface"/>

##### Brand list interface

<img src="./public/img/readme2.png" alt="Update brand interface"/>


##### Interface to create the brand

<img src="./public/img/readme3.png" alt="Create brand interface"/>


##### Interface for modifying the brand

<img src="./public/img/readme1.png" alt="Update brand interface"/>
