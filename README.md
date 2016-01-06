SPIKE Checkout sample code
==============================


Live demo
------------------

- See
  - [http://matsu.teraren.com/spike-api-demo-php/](http://matsu.teraren.com/spike-api-demo-php/)
  - [https://matsu.teraren.com/spike-api-demo-php/](https://matsu.teraren.com/spike-api-demo-php/)


Requirements
------------------
- bower
- PHP >=5.3, >=7
  - phpredis
- composer
- Redis


Setup
-------------------

```
% git clone git@github.com:matsubo/spike-checkout.git
% cd spike-checkout
% bower install
% php composer.phar install
% echo 'YOUR SECRET KEY' > secret.key
```


Start server
---


1. nginx

Sample configuration for nginx

```
...
location ^~ /spike-api-demo-php/ {
  alias /Users/matsu/Documents/spike-api-demo-php/public/;

  location ~ \.php {
    fastcgi_split_path_info ^/spike-api-demo-php/(.+\.php)(.*)$;
    fastcgi_pass unix:/tmp/php5-fpm.sock;
    fastcgi_index index.php;
    fastcgi_param SCRIPT_FILENAME  /Users/matsu/Documents/spike-api-demo-php/public/$fastcgi_script_name;
    include fastcgi_params;
  }
}
...
```


2. PHP build in server


```
% cd public
% php -S localhost:8000
% open 'http://localhost:8000/'
```
