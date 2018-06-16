1.  Use composer install for instalation project
2. execute mkdir -p app/config/jwt
    openssl genrsa -out config/jwt/private.pem -aes256 4096
  openssl rsa -pubout -in config/jwt/private.pem -out config/jwt/public.pem
3. call 
    ```
    POST /api/login_check HTTP/1.1
    Host: football
    Content-Type: application/json
    
    {
        "username": "admin",
        "password": "admin"
    }
    ```
4. result 
    ```
    {
        "token": "eyJhbGciOiJSUzI1NiJ9.eyJyb2xlcyI6W10sInVzZXJuYW1lIjoiYWRtaW4iLCJpYXQiOjE1MjkxNTU5NzEsImV4cCI6MTUyOTE1OTU3MX0.DBhDcpHbivDCe2ZZvZbD_0B15je9vyJxvlf9VQVzUV4DgiZgDIUbWuWGRt8lX07tRYxYc7QhQC3EgGzHtwrd5zAQ3kPTpNF6jS3ZAgQMJsN0uhuSQNlo3N4PBNqtXYTOpdyIlJirwvacJTQwIHvGSi6oAXHALrscT6b1fkNW0x6hqbVnR8rMHJlmovUhlbzR3FYCsJJxwnB1f7yYMM9uRWCw8ndH5aOw3J-wMuhMOxFeG4v-cf4OA_kslcXZeTQjbPO-0IdGgKFAGa6FNIFyI4lUZTO4zfmeDdhRAvJSmzPaM2epjtpi9RzBYWxX9KpU0MVzOZu5vwOz1paejALlAvKko1-2yZnROhLWgCoqD1PoQpff4mr8W-DtwiFZQuIZdAA7fy9vJtxt352Jivn4tzHgvyiNhKUcR4oCT7lmXxdMx2rQRWIVVNZg5c9K48jTtAh7_PHt4LeHLkskUfuz7MWVApgJQNH-GjiYoq36OfgjLyFj3dirCUbEacpbESeuM-_MylznDqWEvv9vyF-f7QP0MCMBnMMekjglOxBytmgK8gPKRW9o__kHreBqONz_OKOZ511Lv8fb3W76d88wSlIglVTMREaYU6ZkJ_pPJHiJfkyn_jvUJyVNr6OgNRcFBDFSOGZclgGbbEaPZsjiE936eNIMwSZ4ex4avKLWDag"
    }
    ```
## Leagues ##
1. create League
    ```
    POST /api/leagues HTTP/1.1
    Host: football
    Content-Type: application/x-www-form-urlencoded
    Authorization: Bearer <your JWT TOKEN>
    
    {
        "name": "league"
    }
    ```
2. update league
    ```
    PUT /api/leagues/<id_league> HTTP/1.1
    Host: football
    Content-Type: application/x-www-form-urlencoded
    Authorization: Bearer <your JWT TOKEN>
    
    {
        "name": "league"
    }
    ```
3. delete league
    ```
    DELETE /api/leagues/<id_league> HTTP/1.1
    Host: football
    Content-Type: application/x-www-form-urlencoded
    Authorization: Bearer <your JWT TOKEN>
    ```
4. league list
    ```
    GET /api/leagues HTTP/1.1
    Host: football
    Content-Type: application/x-www-form-urlencoded
    Authorization: Bearer <your JWT TOKEN>
    ```
5. league details
    ```
    GET /api/leagues/<id_league> HTTP/1.1
    Host: football
    Content-Type: application/x-www-form-urlencoded
    Authorization: Bearer <your JWT TOKEN>
    ```
## Teams ##
1. create Team
    ```
    POST /api/teams HTTP/1.1
    Host: football
    Content-Type: application/x-www-form-urlencoded
    Authorization: Bearer <your JWT TOKEN>
    
    {
        "name": "league11",
        "id_league": 1,
        "strip": "strip11",
    }
    ```
2. update Team
    ```
    PUT /api/teams/<id_team> HTTP/1.1
    Host: football
    Content-Type: application/x-www-form-urlencoded
    Authorization: Bearer <your JWT TOKEN>
    
    {
        "name": "league11",
        "id_league": 1,
        "strip": "strip11",
    }
    ```
3. delete team
    ```
    DELETE /api/teams/<id_team> HTTP/1.1
    Host: football
    Content-Type: application/x-www-form-urlencoded
    Authorization: Bearer <your JWT TOKEN>
    ```
4. teams list
    ```
    GET /api/teams HTTP/1.1
    Host: football
    Content-Type: application/x-www-form-urlencoded
    Authorization: Bearer <your JWT TOKEN>
    ```
5. team details
    ```
    GET /api/teams/<id_team> HTTP/1.1
    Host: football
    Content-Type: application/x-www-form-urlencoded
    Authorization: Bearer <your JWT TOKEN>
    ```