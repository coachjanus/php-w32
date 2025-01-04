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


