laravel-mixpanel
================

Add the service provider at the end of the `providers` array in file `config/app.php`:

> 'Hydrarulz\LaravelMixpanel\LaravelMixpanelServiceProvider',

The service provider will register an interface, but you should also register the alias at the end of the `aliases` array:
> 'LaravelMixpanel' => 'Hydrarulz\LaravelMixpanel\Facades\LaravelMixpanel',

Then the you should publish the config file with
`php artisan vendor:publish`
This creates your config file `/config/laravel-mixpanel.php` that looks like this:

    <?php

    return [
        'token' => 'YOUR TOKEN HERE'
    ];

Replace with your Mixpanel token.

After this you can start using it in your application

```php
$mixpanel = LaravelMixpanel::getInstance();
$mixpanel->people->set(
    $user->mixpanel_id
    , [
        'name' => 'Daniel Luca'
    ]
);
$mixpanel->track(
	'Event'
    , [
        'Type' => 'Click'
    ]
);
```
