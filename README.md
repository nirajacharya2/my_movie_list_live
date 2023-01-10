
# My Movie List



A Web application to record your movies,reviews and rating.
## Live Demo

[Try It](https://mymovielists.up.railway.app/)



## Run Locally

Clone the project

```bash
  git clone https://github.com/nirajacharya2/my_movie_list_live.git
```

Go to the project directory

```bash
  cd my_movie_list_live
```

Create Enviroment file

```bash 
cp .env.example .env 
```

open .env and update DB_DATABASE (database details)

Install dependencies
```bash 
composer install
```
Generate app key
```bash 
php artisan key:generate
```
Create a fresh database
```bash 
php artisan migrate:fresh --seed
```
or get database dump from [here](https://drive.google.com/file/d/1FEAxzixt7Oxifq2UNBUppMvM6QIbL3Zd/view?usp=sharing)

Start the server
```bash 
php artisan serve
```
