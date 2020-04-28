<h1 align="center">Toastr.js notifications for Laravel 5 and Lumen</h1>
<h1 align="center" color="green" style='color:green;'>For more drivers (toastr, pnotify, sweetalers2) please try the new package <a href="https://github.com/yoeunes/notify">yoeunes/notify</a></h1>
<p align="center">:eyes: This package helps you to add <a href="https://github.com/CodeSeven/toastr">toastr.js</a> notifications to your Laravel 5 and Lumen projects.</p>

<p align="center">
    <a href="https://packagist.org/packages/yoeunes/toastr"><img src="https://poser.pugx.org/yoeunes/toastr/v/stable" alt="Latest Stable Version"></a>
    <a href="https://packagist.org/packages/yoeunes/toastr"><img src="https://poser.pugx.org/yoeunes/toastr/v/unstable" alt="Latest Unstable Version"></a>
    <a href="https://scrutinizer-ci.com/g/yoeunes/toastr/build-status/master"><img src="https://scrutinizer-ci.com/g/yoeunes/toastr/badges/build.png?b=master" alt="Build Status"></a>
    <a href="https://scrutinizer-ci.com/g/yoeunes/toastr/?branch=master"><img src="https://scrutinizer-ci.com/g/yoeunes/toastr/badges/quality-score.png?b=master" alt="Scrutinizer Code Quality"></a>
    <a href="https://scrutinizer-ci.com/g/yoeunes/toastr/?branch=master"><img src="https://scrutinizer-ci.com/g/yoeunes/toastr/badges/coverage.png?b=master" alt="Code Coverage"></a>
    <a href="https://packagist.org/packages/yoeunes/toastr"><img src="https://poser.pugx.org/yoeunes/toastr/downloads" alt="Total Downloads"></a>
    <a href="https://packagist.org/packages/yoeunes/toastr"><img src="https://poser.pugx.org/yoeunes/toastr/license" alt="License"></a>
</p>

<p align="center"><img width="300" alt="toastr" src="https://user-images.githubusercontent.com/10859693/39634578-1a9f121a-4fb3-11e8-8863-d64fad42901b.png"></p>

## Install

You can install the package using composer

```sh
$ composer require yoeunes/toastr
```

Then add the service provider to `config/app.php`. In Laravel versions 5.5 and beyond, this step can be skipped if package auto-discovery is enabled.

```php
'providers' => [
    ...
    Yoeunes\Toastr\ToastrServiceProvider::class
    ...
];
```

As optional if you want to modify the default configuration, you can publish the configuration file:
 
```sh
$ php artisan vendor:publish --provider='Yoeunes\Toastr\ToastrServiceProvider' --tag="config"
```

### For Lumen :

1. In `bootstrap/app.php` 
    * uncomment `$app->withFacades();`
    * add bindings for ToastrServiceProvider : `$app->register(Yoeunes\Toastr\ToastrServiceProvider::class);` 
2. Add `config/session.php`, since it is not present in `Lumen` by default. You can take `session.php` from [Laravel Official Repository](https://github.com/laravel/laravel/blob/master/config/session.php)

## Usage:

Include jQuery and [toastr.js](https://github.com/CodeSeven/toastr) in your view template: 

1. Link to jquery `<script src="jquery.min.js"></script>` or from cdn with our custom blade directive `@jquery`
2. Link to toastr.css `<link href="toastr.css" rel="stylesheet"/>` or `@toastr_css`
3. Link to toastr.js `<script src="toastr.js"></script>` or `@toastr_js` 

The custom directives `@jquery`, `@toastr_css`, `@toastr_js` pulls the latest version for jquery and toastr from cdn.js, you could also pass a specified version a first parameter: `@jquery(3.2)`, `@toastr_css(2.1.4)` and `@toastr_js(2.1.4)`

4. use `toastr()` helper function inside your controller to set a toast notification for info, success, warning or error
```php
// Display an info toast with no title
toastr()->info('Are you the 6 fingered man?')
```

as an example:
```php
<?php

namespace App\Http\Controllers;

use App\Post;
use App\Http\Requests\PostRequest;
use Illuminate\Database\Eloquent\Model;

class PostController extends Controller
{
    public function store(PostRequest $request)
    {
        $post = Post::create($request->only(['title', 'body']));

        if ($post instanceof Model) {
            toastr()->success('Data has been saved successfully!');

            return redirect()->route('posts.index');
        }

        toastr()->error('An error has occurred please try again later.');

        return back();
    }
}
```

After that add the `@toastr_render` at the bottom of your view to actualy render the toastr notifications.

```blade
<!doctype html>
<html>
    <head>
        <title>Toastr.js</title>
        @toastr_css
    </head>
    <body>
        
    </body>
    @jquery
    @toastr_js
    @toastr_render
</html>
```
### Other Options

```php
// Set a warning toast, with no title
toastr()->warning('My name is Inigo Montoya. You killed my father, prepare to die!')

// Set a success toast, with a title
toastr()->success('Have fun storming the castle!', 'Miracle Max Says')

// Set an error toast, with a title
toastr()->error('I do not think that word means what you think it means.', 'Inconceivable!')

// Override global config options from 'config/toastr.php'

toastr()->success('We do have the Kapua suite available.', 'Turtle Bay Resort', ['timeOut' => 5000])
```

### Limit the number of displayed toastrs
To limit the number of displayed toastrs set the value `maxItems` in the config file to an integer value, you can also set  it per action in your controller like this:

```php
toastr()->success('Have fun storming the castle!', 'Miracle Max Says');
toastr()->error('I do not think that word means what you think it means.', 'Inconceivable!'); // i want to display this one
toastr()->info('Are you the 6 fingered man?'); // and this one

toastr()->maxItems(2);
```

now if you call the render method the last two notifications will be displayed

### Other api methods:
// You can also chain multiple messages together using method chaining
```php
toastr()->info('Are you the 6 fingered man?')->success('Have fun storming the castle!')->warning('doritos');
```

// `@jquery`, `@toastr_css` and `@toastr_js` is an alias for helper functions:
```php
function jquery(string $version = '3.3.1', string $src = null);
function toastr_css(string $version = '2.1.4', string $href = null);
function toastr_js(string $version = '2.1.4', string $src = null);
``` 


// you could replace `@toastr_render` by :
```php 
toastr()->render() or app('toastr')->render()
```

// you can use `toastr('')` instead of `toastr()->success()`
```php
function toastr(string $message = null, string $type = 'success', string $title = '', array $options = []);
```

so

* `toastr($message)` is equivalent to `toastr()->success($message)`
* `toastr($message, 'info')` is equivalent to `toastr()->info($message)`
* `toastr($message, 'warning')` is equivalent to `toastr()->warning($message)`
* `toastr($message, 'error') ` is equivalent to `toastr()->error($message)`

### configuration:
```php
// config/toastr.php
<?php

return [
    // Limit the number of displayed toasts, by default no limits
    'maxItems' => null,
    
    'options' => [
        'closeButton'       => true,
        'closeClass'        => 'toast-close-button',
        'closeDuration'     => 300,
        'closeEasing'       => 'swing',
        'closeHtml'         => '<button><i class="icon-off"></i></button>',
        'closeMethod'       => 'fadeOut',
        'closeOnHover'      => true,
        'containerId'       => 'toast-container',
        'debug'             => false,
        'escapeHtml'        => false,
        'extendedTimeOut'   => 10000,
        'hideDuration'      => 1000,
        'hideEasing'        => 'linear',
        'hideMethod'        => 'fadeOut',
        'iconClass'         => 'toast-info',
        'iconClasses'       => [
            'error'   => 'toast-error',
            'info'    => 'toast-info',
            'success' => 'toast-success',
            'warning' => 'toast-warning',
        ],
        'messageClass'      => 'toast-message',
        'newestOnTop'       => false,
        'onHidden'          => null,
        'onShown'           => null,
        'positionClass'     => 'toast-top-right',
        'preventDuplicates' => true,
        'progressBar'       => true,
        'progressClass'     => 'toast-progress',
        'rtl'               => false,
        'showDuration'      => 300,
        'showEasing'        => 'swing',
        'showMethod'        => 'fadeIn',
        'tapToDismiss'      => true,
        'target'            => 'body',
        'timeOut'           => 5000,
        'titleClass'        => 'toast-title',
        'toastClass'        => 'toast',
    ],
];
```
For a list of available options, see [toastr.js' documentation](https://github.com/CodeSeven/toastr).

## Credits

- [Younes Khoubza](https://github.com/yoeunes)
- [All Contributors](../../contributors)

## License

MIT
