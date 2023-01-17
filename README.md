# Tech skills learning platform

### A WIP application for tracking tech skills that I would like to learn, or am currently learning.

This application uses Slim 4 with Slim PSR-7 implementation and PHP-DI container implementation along with the PHP-View template renderer. It also uses the Monolog logger.

## Setup

1. Clone this repo: `git@github.com:mikeycodingstuff/tech-skills-learning-platform.git`
2. Inside the directory, run `composer install` to install the slim components
3. Import the `/db/topics.sql` file and adjust your db settings as needed in `/app/settings`
4. Run the application locally with `composer start`

## Tests
Run unit tests locally with `composer test`

## Routes
For local development use `localhost:8080/api/topics` as your URL

### /topics
#### POST
**Purpose:**
- Add a new topic to the database.

**Sends**
```
{
    "topic_name": "new topic",
    "status": "learning",
    "resources": "none"
}
```

**Success Response:**
- Returns the added topic in `"data"`
```
{
    "success": true,
    "message": "Topic successfully added to db.",
    "status": 200,
    "data": []
}
```

**Failure Response:**
- If added Id is not in database:
```
{
    "success": false,
    "message": "Invalid Id",
    "status": 404,
    "data": []
}
```

#### GET
**Purpose:**
- Gets all of the topics from the database.
- Get a single topic from the database.
- Filter topics by learning status.

**URL Params:**
- Optional:
  - `id=[integer]`

**Data Params:**
- Optional:
  - `learning=true`

**Data Format**
```
"data": {
    "id": "1",
    "topic_name": "TypeScript",
    "status": "learning",
    "resources": "https://www.typescriptlang.org/docs/",
    "deleted": "0"
}
```

**Success Response:**
- Retrieving all topics:
```
{
    "success": true,
    "message": "All topics successfully retrieved from database.",
    "status": 200,
    "data": []
}
```
- Retrieving a topic by id:
```
{
    "success": true,
    "message": "Topic successfully retrieved from database.",
    "status": 200,
    "data": []
}
```
- Retrieving topics filtered by `?learning=true`:
```
{
    "success": true,
    "message": "Filtered topics successfully retrieved from database.",
    "status": 200,
    "data": []
}
```

**Failure Response:**
- If Id is not in database:
```
{
	"success": false,
	"message": "Invalid Id",
	"status": 404,
	"data": []
}
```

#### PUT
**Purpose:**
- Edit a topic by Id.

**URL Params:**
- Required:
  - `id=[integer]`
  
**Sends**
```
{
    "topic_name": "TypeScript",
    "status": "not learning",
    "resources": "https://www.typescriptlang.org/docs/"
}
```

**Success Response:**
- Successfully editing a topic:
```
{
    "success": true,
    "message": "Topic successfully updated in database.",
    "status": 200,
    "data": []
}
```

**Failure Response:**
- If Id is not in database:
```
{
	"success": false,
	"message": "Invalid Id",
	"status": 404,
	"data": []
}
```

#### DELETE
**Purpose:**
- Delete all topics from the database.
- Delete a single topic by Id from the database.
