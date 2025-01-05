# php-w32

## virtual hosts
- for windows: C:\windows\System32\drivers\etc\hosts
- for Unix: /etc/hosts

```conf

<Directory "/home/janus/projects/php-w32">
     Options Indexes FollowSymLinks MultiViews
     AllowOverride all
     Order Deny,Allow
     Allow from all
     Require all granted
</Directory>

<VirtualHost 127.0.1.2:80>
    ServerAdmin webmaster@php.my
    DocumentRoot "/home/janus/projects/php-w32/public"
    
    ServerName php.my
    ServerAlias www.php.my
    ErrorLog "logs/php.my-error_log"
    CustomLog "logs/php.my-access_log" common
</VirtualHost>
```


## Синтаксис .htaccess
- Файл .htaccess (hypertext access) – це локальний конфігураційний файл веб сервера
- Apache. .htaccess дає можливість налаштовувати окемі директорії веб сервера. Директиви, що містяться у файлі, виконуються для всіх файлів та вкладених директорій, які знаходяться в одній директорії з файлом .htaccess.

```conf
Options +FollowSymlinks
RewriteEngine On
# Exclude directories from rewrite rules
RewriteRule ^(css|i|js|storages|assets) - [L]
# обмежуємо доступ до фізичних файлів
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
# перенаправляємо всі запити на index.php.
RewriteRule ^(.*)$ index.php?route=$1 [L,QSA

```

## Routing
```php

function uri(): string {
    return trim($_SERVER['REQUEST_URI'], '/');
}

function home() {
    echo "<h1>Home page</h1>";
}

function about() {
    echo "<h1>About page</h1>";
}

function contact() {
    include './contact.php';
}

function error() {
    echo "<h1>404: Not found</h1>";
}

// switch ($route) {uri()
//     case '/':
//         echo "<h1>Home page</h1>";
//         break;
//     case '/about':
//         echo "<h1>About page</h1>";
//         break;
//     case '/contract':
//         include './contact.php';
//         break;
// }

// $expressionResult = match (uri()) {
//     '/' => home(),
//     '/about' => about(),
//     '/contact' => contact(),
//     default => error(),
// };

$expressionResult = match (uri()) {
    '' => home(),
    'about' => about(),
    'contact' => contact(),
    default => error(),
};
```


