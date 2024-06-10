<p align="center">
<a href="https://laravel.com/"><img src="https://img.shields.io/badge/Laravel-FF2D20?style=flat&logo=laravel&logoColor=white" alt="Build Status"></a>
<a href="https://github.com/rickvdsommen/KBS/actions/workflows/laravel.yml"><img src="https://img.shields.io/github/actions/workflow/status/rickvdsommen/KBS/laravel.yml?branch=main&label=Main%20tests" alt="Total Downloads"></a>
</p>

# Project KIIK

Project KIIK is a comprehensive platform designed to streamline the management of projects and the allocation of team members. With Project KIIK, individuals can create and update their profiles to showcase their skills and expertise, making it easier to match the right people with the right projects.

## Run Locally

### Requirements
- PHP envirmoment (_^8.2_)
- npm (_package manager_)
- composer (_package manager_)
- Create a MySQL database with a preferred name
- Copy the `env.example` to `.env` with updated database and mail reference 

Advised to use something like [Laragon](https://laragon.org/) (_universal development environment_)\
**NOTE**: Add Laragon to `path` to use commands directly in `cmd` in the preferred IDE

### Installation
Clone the project

```bash
  git clone https://github.com/rickvdsommen/KBS
```

Go to the project directory

```bash
  cd my-project
```

Install PHP packages
```bash
composer i
```

Install Javascript packages
```bash
npm i
```

Initialize `APP_KEY` in `.env` 
```bash
  php artisan key:generate
```

### Database migration and seeding
Migrate and seed database
```bash
  php artisan migrate:fresh --seed
```

### Start project
Run Laravel
```bash
  php artisan serve
```

Run npm _(New console)_
```bash
  npm run dev
```
