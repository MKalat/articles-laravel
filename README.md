<h1>articles-laravel app</h2>
<p>Simple app demonstrating the use of Laravel framework v. 11+ for user registration, and viewieng, publishing, editing, and deleting articles, the users created.
<h2>Assumptions</h2>
<p>I'm not familar with Filament as of now, so as it is timed quest, I have omitted front-end part, web.php routes declaration, and Controller for web definition, but still theres api part with all above in project description, with auth, registration (using sanctum).</p>

<h2>Setup</h2>
<ul>
<li>git clone {this-repository-url} /var/www/html/articles-laravel</li>
<li>navigate to above directory and issue command on shell: composer install</li>
<li>php artisan migrate:fresh</li>
<li>php artisan db:seed</li>
<li>perform tests : php artisan test</li>
</ul>
