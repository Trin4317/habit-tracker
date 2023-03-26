Simple Laravel + Vue CRUD app

## Project Setup

* Install VS Code + Dev Containers extension
* Install Docker

### Start development environment inside container

* Clone this repo
* Open the project in VS Code
* Press F1 key → select Dev Containers: Open Folder in Container

### Install dependencies

```sh
composer install

npm install
```

### Migrate the database

```sh
php artisan migrate
```

### Start Vite dev server

```sh
npm run dev
```

### Access the app

```
http://localhost/habits
```

### Test

```sh
php artisan test

npm test
```
