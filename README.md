# Project API Documentation

## Login

**URL** : `/api/auth/login/`

**Method** : `POST`

**Auth required** : NO

**Data example**

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

