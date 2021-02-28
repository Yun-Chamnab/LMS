---
title: API Reference

language_tabs:
- bash
- javascript

includes:

search: true

toc_footers:
- <a href='http://github.com/mpociot/documentarian'>Documentation Powered by Documentarian</a>
---
<!-- START_INFO -->
# Info

Welcome to the generated API reference.
[Get Postman Collection](http://localhost/docs/collection.json)

<!-- END_INFO -->

#Auth


<!-- START_c8bf91adab3a5372be7ac63a2b3c17d5 -->
## Register

> Example request:

```bash
curl -X POST "/auth/register" \
    -H "Content-Type: application/json" \
    -d '{"email":"accusamus","password":"vitae","name":"porro"}'

```

```javascript
const url = new URL("/auth/register");

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
}

let body = {
    "email": "accusamus",
    "password": "vitae",
    "name": "porro"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST /auth/register`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    email | string |  required  | The email
    password | string |  required  | The password
    name | string |  required  | The name

<!-- END_c8bf91adab3a5372be7ac63a2b3c17d5 -->

<!-- START_ac6527c96d4b9793a4c77ff1e22a8906 -->
## Login

> Example request:

```bash
curl -X POST "/auth/login" \
    -H "Content-Type: application/json" \
    -d '{"email":"et","password":"ex"}'

```

```javascript
const url = new URL("/auth/login");

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
}

let body = {
    "email": "et",
    "password": "ex"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST /auth/login`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    email | string |  required  | The email
    password | string |  required  | The password

<!-- END_ac6527c96d4b9793a4c77ff1e22a8906 -->

<!-- START_b4e23dbf06b305a21e44d153f8ad228f -->
## Verify User

> Example request:

```bash
curl -X GET -G "/auth/verify/1?token=tenetur" 
```

```javascript
const url = new URL("/auth/verify/1");

    let params = {
            "token": "tenetur",
        };
    Object.keys(params).forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (400):

```json
{
    "data": {
        "message": "Invalid verification token"
    }
}
```

### HTTP Request
`GET /auth/verify/{token}`

#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    token |  required  | The token

<!-- END_b4e23dbf06b305a21e44d153f8ad228f -->

<!-- START_08d1453474ae561a20f0a95994970216 -->
## Send new Password Request

> Example request:

```bash
curl -X POST "/auth/password/forgot" \
    -H "Content-Type: application/json" \
    -d '{"email":"dolore"}'

```

```javascript
const url = new URL("/auth/password/forgot");

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
}

let body = {
    "email": "dolore"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST /auth/password/forgot`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    email | string |  required  | The email

<!-- END_08d1453474ae561a20f0a95994970216 -->

<!-- START_3c966784bbbe87d5b562743e136120e4 -->
## Create new P assword

> Example request:

```bash
curl -X POST "/auth/password/recover/1" \
    -H "Content-Type: application/json" \
    -d '{"password":"unde"}'

```

```javascript
const url = new URL("/auth/password/recover/1");

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
}

let body = {
    "password": "unde"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST /auth/password/recover/{token}`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    password | string |  required  | The new password

<!-- END_3c966784bbbe87d5b562743e136120e4 -->

<!-- START_e95cda783e76bb7f4ec8742fda939d69 -->
## Current User

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X GET -G "/auth/user" 
```

```javascript
const url = new URL("/auth/user");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "errors": {
        "title": "Unauthorized"
    }
}
```

### HTTP Request
`GET /auth/user`


<!-- END_e95cda783e76bb7f4ec8742fda939d69 -->

#general


<!-- START_0e15ea04da0215ae3f6c064c85ba4ff3 -->
## /__clockwork/{id:(?:[0-9-]+|latest)}[/{direction:(?:next|previous)}[/{count:\d+}]]
> Example request:

```bash
curl -X GET -G "/__clockwork/1[/1[/1]]" 
```

```javascript
const url = new URL("/__clockwork/1[/1[/1]]");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (404):

```json
{
    "message": "Not Found",
    "status": 404
}
```

### HTTP Request
`GET /__clockwork/{id:(?:[0-9-]+|latest)}[/{direction:(?:next|previous)}[/{count:\d+}]]`


<!-- END_0e15ea04da0215ae3f6c064c85ba4ff3 -->

<!-- START_78aff8d899929e0a0ca041c212e9284e -->
## /__clockwork
> Example request:

```bash
curl -X GET -G "/__clockwork" 
```

```javascript
const url = new URL("/__clockwork");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (302):

```json
null
```

### HTTP Request
`GET /__clockwork`


<!-- END_78aff8d899929e0a0ca041c212e9284e -->

<!-- START_b2065e93f01a798b4875dc5a4f988f04 -->
## /__clockwork/app
> Example request:

```bash
curl -X GET -G "/__clockwork/app" 
```

```javascript
const url = new URL("/__clockwork/app");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
null
```

### HTTP Request
`GET /__clockwork/app`


<!-- END_b2065e93f01a798b4875dc5a4f988f04 -->

<!-- START_90ae3a920c2df1cc920c076da4f258c2 -->
## /__clockwork/assets/{path:.+}
> Example request:

```bash
curl -X GET -G "/__clockwork/assets/1" 
```

```javascript
const url = new URL("/__clockwork/assets/1");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (404):

```json
{
    "message": "Not Found",
    "status": 404
}
```

### HTTP Request
`GET /__clockwork/assets/{path:.+}`


<!-- END_90ae3a920c2df1cc920c076da4f258c2 -->


