<h1>articles-laravel app</h2>
<p>Simple app demonstrating the use of Laravel framework v. 11+ for user registration, and viewieng, publishing, editing, and deleting articles, the users have created. It limits edit and delete to author of article, and article posting to regietsred users, it has endpoints for user login , register, confirm email, performing work on articles, validation on all endpoints (simple, but it still cuts truly bad requests), OneToMany relationship with User -> Articles, it protects restricted endpoints to users (as stated above), it has feature tests for auth and unauth user registration and work on articles, which also quite well test units of code.
<h2>Assumptions</h2>
<p>I'm not familar with Filament as of now, so as it is timed quest, I have omitted front-end part, web.php routes declaration, and Controller for web definition, but still theres api part, controllers, validators, middleware for auth and unauth requests, with all above in project description done in this solution, with auth, registration (using sanctum). It has seeders, migrations for db, db factories and endpoints for searching by title, and content. The app has been developed in much less than 8 hours, so please be advised thats quite quick ;)</p>

<h2>Setup</h2>
<ul>
<li>git clone {this-repository-url} /var/www/html/articles-laravel</li>
<li>navigate to above directory and issue command on shell: composer install</li>
<li>php artisan migrate:fresh</li>
<li>php artisan db:seed</li>
<li>perform tests : php artisan test</li>
</ul>
