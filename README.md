URL Shortner
============================

INSTALLATION
------------

#Git clone
```
git clone https://github.com/strelov1/url_shortner
cd url_shortner
```

#Composer install
```
composer global require "fxp/composer-asset-plugin:^1.2.0"
composer config -g github-oauth.github.com <gitub-token>
composer install
```

#Run docker
```
docker-compose up -d
```

#Browse url
```
http://localhost:8080
```

API
============================

#Create Short URL
``` 
curl -H "Content-Type: application/json" X POST -d '{"long_url":"https://geektimes.ru/company/waves/blog/282356/"}' http://localhost:8080/api/v1/create
curl -H "Content-Type: application/json" X POST -d '{"long_url":"https://geektimes.ru/company/waves/blog/282356/", "save":"true"}' http://localhost:8080/api/v1/create
curl -H "Content-Type: application/json" X POST -d '{"long_url":"https://geektimes.ru/company/waves/blog/2823563/", "short_url":"geektimes"}' http://localhost:8080/api/v1/create
curl -H "Content-Type: application/json" X POST -d '{"long_url":"https://geektimes.ru/company/waves/blog/2823563/", "short_url":"geektimes", "save":"true"}' http://localhost:8080/api/v1/create
```

#Stats
```
GET /api/v1/stats
curl -H "Content-Type: application/json" http://localhost:8080/api/v1/stats
```

