How to run this project:

1. Clone the project
   git clone https://github.com/ekasaragih/ProjectAlchemist.git
   cd your-laravel-project

2. Install dependencies
   composer install
   npm install

3. Create an .env File
   cp .env.example .env
   php artisan key:generate

4. Run DB Migration
   php artisan migrate
   php artisan db:seed

5. Compile Frontend Assets
   npm run dev # for development
   npm run prod # for production

6. Start the Development Server
   php artisan serve
