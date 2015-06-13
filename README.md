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

-----------

In the config package the regex `'userAgent' => '^Mozilla((?!bot).)*$'` skips all bot.

-----------

Now, to use this package, there is 2 solutions :
- You can use 'LaravelMixpanel::', ie. `LaravelMixpanel::track('Homepage View', ['connected' => false])`

But with this solution, mixpanel people is unavailable. Then, I created `getInstance()`.

- The second solution is to use `$mixpanel = LaravelMixpanel::getInstance();`

For example :

```php
<?php
$mixpanel = LaravelMixpanel::getInstance();
// identifie l'user
$mixpanel->identify($user->mixpanel_id);
// track l'event
$mixpanel->track("Upgraded account");

// MAJ de l'user dans la BDD de mixpanel
$mixpanel->people->set($user->mixpanel_id, array(
    '$name'       => $user->name,
    '$phone'      => $user->tel,
    '$address'    => $user->address,
    '$lat'        => $user->lat,
    '$lng'        => $user->lng,
));
```
