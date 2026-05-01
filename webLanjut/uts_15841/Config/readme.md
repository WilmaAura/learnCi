# Routes Explanation

## Function

1. Costum URL Mapping: to map custom URL patterns to specific controller classes and methods
2. Creating Search Engine

## Components

```bash
$routes->get('/about', 'Page::about', [])
# routes: Objek router
# get: Method of sending data to the server
# Page: Controller that will handle the request
# About: Method on the controller that handles the request
# []: Opsi jika ada, bisa dikosongkan jika tidak ada
```

## Method of sending data

```bash
    GET: Requst data from certain sources
    POST: Send data to server for create or update data
    PUT: Seems like POST, but PUT's requests are idempotent. This means calling the same PUT request multiple times will always produce the same result.
    DELETE: delete data.
```
