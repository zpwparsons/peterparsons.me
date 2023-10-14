## Setting up the article search
The site is making use of [Spatie's site search](https://spatie.be/docs/laravel-site-search/v1/introduction) package that crawls the site and indexes the specified content.

The package uses Meilisearch under the hood. Head over to the [Meilisearch docs](https://docs.meilisearch.com/learn/getting_started/installation.html#download-and-launch) to learn how to install it on your system.

First, run this command to define a site that needs to be indexed.
```
php artisan site-search:create-index
```

This command will ask for a name for the index, and the URL of your site that should be crawled.

Enter `articles` as the name and `https://blog.test/articles` as the URL that should be crawled.

After that, start `meilisearch` and run this command to start a queued job that crawls your site, and puts the content in a search index:
```
php artisan site-search:crawl
```

The site search package which contains a command that will crawl the site, and update the indexes.

The command is scheduled to run the every three hours. See `app/Console/Kernel.php`
```php
$schedule->command(CrawlCommand::class)->everyThreeHours();
```
