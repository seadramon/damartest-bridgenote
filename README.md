# Installation
run if you using docker :
```
docker-compose up -d
```
run migration :
```
php artisan migrate
```
instal laravel passport :
```
php artisan passport:install
```
# _API Documentation_

#### Register
```
EndPoint : /api/register
Headers : Accept  application/json
methode : POST
parameters :
    name [your-name]
    email [your-email-address]
    password [new-password]
    password_confirmation [retype-new-password]
```
validation :
```
email : unique
password : password must same with password confirmation,
Require at least one uppercase, one lowercase letter, number and symbol
```
response : 
```
{
  "token": [string]
}
```
#### Login
```
EndPoint : /api/login
Headers : Accept  application/json
methode : POST
parameters :
    email [your-email-address]
    password [your-password]
```
respones:
```
{
  "token": [string]
}
```

## User Detail

#### Get Data Collection
```
EndPoint : api/user-detail
Headers : 
    Accept = application/json
    Authorization = Bearer [generated-token]
method : GET
parameters(optional) :  
    paginate [integer]
```
response:
```
{
	"data": [
		{
			"user": {
				"id": [integer],
				"name": [string],
				"email": [string],
				"email_verified_at": null,
				"created_at": [datetime],
				"updated_at": [datetime]
			},
			"status": [string],
			"position": [string]
		}
	]
}
```

#### show by ID

```
EndPoint : api/user-detail/{id}
Headers : 
    Accept = application/json
    Authorization = Bearer [generated-token]
method : GET
```
response:
```
{
	"data": [
		{
			"user": {
				"id": [integer],
				"name": [string],
				"email": [string],
				"email_verified_at": null,
				"created_at": [datetime],
				"updated_at": [datetime]
			},
			"status": [string],
			"position": [string]
		}
	]
}
```

#### save data

```
EndPoint : api/user-detail
Headers : 
    Content-Type = application/x-www-form-urlencoded
    Authorization = Bearer [generated-token]
method : POST
```
parameter:
```
user_id : [integer] ( from users table )
status : [string] ( active or inactive )
position : [string]
```
response:
```
{
	"status": "success",
	"message": "User Detail Data saved successfully"
}
```

#### update data

```
EndPoint : api/user-detail/{id}
Headers : 
    Content-Type = application/x-www-form-urlencoded
    Authorization = Bearer [generated-token]
method : PUT
```
parameter:
```
user_id : [integer] ( from users table )
status : [string] ( active or inactive )
position : [string]
```
response:
```
{
	"status": "success",
	"message": "User Detail Data updated successfully"
}
```

#### delete data

```
EndPoint : api/user-detail/{id}
Headers : 
    Authorization = Bearer [generated-token]
method : DELETE
```
response:
```
{
	"status": "success",
	"message": "User Detail Data deleted successfully"
}
```
