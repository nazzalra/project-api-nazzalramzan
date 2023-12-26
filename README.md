# Project API Documentation

## Login

**URL** : `/api/auth/login/`

**Method** : `POST`

**Headers** : `Accept: application/json`, `Content-Type: application/json`

**Auth required** : NO

**Request Body**

```json
{
    "username": "test@gmail.com",
    "password": "password",
    "device_name": "android"
}
```

### Success Response

**Code** : `200 OK`

**Content example**

```json
{
    "token": "93144b288eb1fdccbe46d6fc0f241a51766ecd3d"
}
```

### Error Response

**Condition** : If 'username' and 'password' combination is wrong.

**Code** : `422 Unprocessable Content`

**Content** :

```json
{
    "message": "The given data was invalid.",
    "errors": {
        "error": [
            "The provided credentials are incorrect."
        ]
    }
}
```

## CRUD User Login - Create / Store

**URL** : `/api/users`

**Method** : `POST`

**Headers** : `Accept: application/json`, `Content-Type: application/json`

**Auth** : `Bearer Token`

**Request Body**

```json
{
    "name": "ped",
    "email": "ped@gmail.com",
    "password": "12345678",
    "password_confirmation": "12345678"
}
```

### Success Response

**Code** : `201 Created`

**Content example**

```json
{
    "data": {
        "id": 4,
        "name": "ped",
        "email": "ped@gmail.com"
    }
}
```

### Error Response

**Condition** : If 'email' is already exist.

**Code** : `422 Unprocessable Content`

**Content** :

```json
{
    "message": "The given data was invalid.",
    "errors": {
        "email": [
            "The email has already been taken."
        ]
    }
}
```

**Condition** : If 'Bearer Token' is invalid.

**Code** : `401 Unauthorized`

**Content** :

```json
{
    "message": "Unauthenticated."
}
```


## CRUD User Login - READ / GET SPECIFIC RECORD

**URL** : `/api/users/:id`

**Method** : `GET`

**Headers** : `Accept: application/json`, `Content-Type: application/json`

**Auth** : `Bearer Token`

### Success Response

**Code** : `200 Ok`

**Content example**

```json
{
    "data": {
        "id": 2,
        "name": "gun",
        "email": "gun@gmail.com"
    }
}
```

### Error Response

**Condition** : If 'Bearer Token' is invalid.

**Code** : `401 Unauthorized`

**Content** :

```json
{
    "message": "Unauthenticated."
}
```
**Condition** : If 'Record Not Found'.

**Code** : `404 Not Found`

**Content** :

```json
{
    "message": "Data not found."
}
```

## CRUD User Login - READ / GET ALL

**URL** : `/api/users`

**Method** : `GET`

**Headers** : `Accept: application/json`, `Content-Type: application/json`

**Auth** : `Bearer Token`

### Success Response

**Code** : `200 Ok`

**Content example**

```json
{
    "data": [
        {
            "id": 2,
            "name": "gun",
            "email": "gun@gmail.com"
        },
        {
            "id": 3,
            "name": "kanompang",
            "email": "kanompang@gmail.com"
        },
        {
            "id": 4,
            "name": "ped",
            "email": "ped@gmail.com"
        }
    ],
    "links": {
        "first": "http://localhost:8000/api/users?page=1",
        "last": "http://localhost:8000/api/users?page=1",
        "prev": null,
        "next": null
    },
    "meta": {
        "current_page": 1,
        "from": 1,
        "last_page": 1,
        "links": [
            {
                "url": null,
                "label": "&laquo; Previous",
                "active": false
            },
            {
                "url": "http://localhost:8000/api/users?page=1",
                "label": "1",
                "active": true
            },
            {
                "url": null,
                "label": "Next &raquo;",
                "active": false
            }
        ],
        "path": "http://localhost:8000/api/users",
        "per_page": 10,
        "to": 3,
        "total": 3
    }
}
```

### Error Response

**Condition** : If 'Bearer Token' is invalid.

**Code** : `401 Unauthorized`

**Content** :

```json
{
    "message": "Unauthenticated."
}
```


## CRUD User Login - UPDATE

**URL** : `/api/users/:id`

**Method** : `POST`

**Headers** : `Accept: application/json`, `Content-Type: application/json`

**Auth** : `Bearer Token`

**Request Body**

```json
{
    "email":"robin@gmail.com",
    "_method": "PUT"
}
```

### Success Response

**Code** : `200 Ok`

**Content example**

```json
{
    "data": {
        "id": 2,
        "name": "robin van persie",
        "email": "robin@gmail.com"
    }
}
```

### Error Response

**Condition** : No Record exist.

**Code** : `404 Not Found`

**Content** :

```json
{
    "message": "Data not found."
}
```
**Condition** : If 'Bearer Token' is invalid.

**Code** : `401 Unauthorized`

**Content** :

```json
{
    "message": "Unauthenticated."
}
```

## CRUD User Login - UPDATE PASSWORD

**URL** : `/api/users/:id/update-password`

**Method** : `POST`

**Headers** : `Accept: application/json`, `Content-Type: application/json`

**Auth** : `Bearer Token`

**Request Body**

```json
{
    "current_password": "password",
    "new_password":"passwordbaru",
    "new_password_confirmation":"passwordbaru",
    "_method": "PUT"
}
```

### Success Response

**Code** : `200 Ok`

**Content example**

```json
{
    "status": "success",
    "message": "Password updated successfully"
}
```

### Error Response

**Condition** : Current Password doesnt match

**Code** : `422 Unprocessable Content`

**Content** :

```json
{
    "message": "The given data was invalid.",
    "errors": {
        "error": [
            "The provided credentials are not correct"
        ]
    }
}
```
**Condition** : If 'Bearer Token' is invalid.

**Code** : `401 Unauthorized`

**Content** :

```json
{
    "message": "Unauthenticated."
}
```

## CRUD User Login - DELETE

**URL** : `/api/users/:id`

**Method** : `POST`

**Headers** : `Accept: application/json`, `Content-Type: application/json`

**Auth** : `Bearer Token`

**Request Body**

```json
{
    "_method": "DELETE"
}
```

### Success Response

**Code** : `204 No Content`

### Error Response

**Condition** : No Record Found

**Code** : `404 Not Found`

**Content** :

```json
{
    "message": "Data not found."
}
```
**Condition** : If 'Bearer Token' is invalid.

**Code** : `401 Unauthorized`

**Content** :

```json
{
    "message": "Unauthenticated."
}
```


## Students (Realtime External API) - Search By Name

**URL** : `/api/students/search?nama=Turner Mia`

**Method** : `GET`

**Headers** : `Accept: application/json`, `Content-Type: application/json`

**Auth** : `Bearer Token`

### Success Response

**Code** : `200 Ok`

**Params** : `nama`

**Content example**

```json
{
    "status": "success",
    "data": [
        {
            "NAMA": "Turner Mia",
            "YMD": "20220713",
            "NIM": "9352078461"
        }
    ]
}
```

### Error Response

**Condition** : If 'Bearer Token' is invalid.

**Code** : `401 Unauthorized`

**Content** :

```json
{
    "message": "Unauthenticated."
}
```
## Students (Realtime External API) - Search By NIM

**URL** : `/api/students/search?nim=9352078461`

**Method** : `GET`

**Headers** : `Accept: application/json`, `Content-Type: application/json`

**Auth** : `Bearer Token`

### Success Response

**Code** : `200 Ok`

**Params** : `nim`

**Content example**

```json
{
    "status": "success",
    "data": [
        {
            "NIM": "9352078461",
            "YMD": "20220713",
            "NAMA": "Turner Mia"
        }
    ]
}
```

### Error Response

**Condition** : If 'Bearer Token' is invalid.

**Code** : `401 Unauthorized`

**Content** :

```json
{
    "message": "Unauthenticated."
}
```
## Students (Realtime External API) - Search By YMD

**URL** : `/api/students/search?ymd=20230405`

**Method** : `GET`

**Headers** : `Accept: application/json`, `Content-Type: application/json`

**Auth** : `Bearer Token`

### Success Response

**Code** : `200 Ok`

**Params** : `ymd`

**Content example**

```json
{
    "status": "success",
    "data": [
        {
            "NIM": "1206485739",
            "NAMA": "Aiden Hayes",
            "YMD": "20230405"
        },
        {
            "NIM": "5036487912",
            "NAMA": "Hill Elijah",
            "YMD": "20230405"
        },
        {
            "NIM": "8761043925",
            "NAMA": "Sophia Martinez",
            "YMD": "20230405"
        }
    ]
}
```

### Error Response

**Condition** : If 'Bearer Token' is invalid.

**Code** : `401 Unauthorized`

**Content** :

```json
{
    "message": "Unauthenticated."
}
```

