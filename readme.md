# Eventier
####Copy env file
```
cp app/.env.example app/.env
```
#### Run Docker compose and connect into php container
```
docker-compose up -d
docker exec -it eventier_php bash
```
#### Apply migrations and run seeder
``` 
php artisan migrate --seed
exit
```
#### If ypu want to change sass or js run watcher which compile assets on change
```
cd app 
npm run watch
```

The project will be available at http://localhost:8012

### Admin credentials
##### login: ``` test@test.com```

#####password: ```secret```

## Make something amazing!
