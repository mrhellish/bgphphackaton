# bgphphackathon project

## The task

Most shipping companies provide some form of tracking service, where a container can be traced by its identification number. Your task is to implement a very cool container tracking web application, which relies on live GPS data (coordinates) from a web service. The service needs to accept a container tracking number (a.k.a. container ID) and be able to visualise the location of the corresponding container (preferrably on a map). The UI of your web app is totally up to you.

Since most of us have had the unpleasant experience of working with APIs with poor design or bad formatting/validation, your team also gets to implement the API part of the task to your liking. It has to provide simple funcionality. It accepts only two calls:

* A call for registering new container (accepts container identification string, returns boolean result)
* A call for obtaining the current GPS coordinates of a container (accepts container ID string, returns GPS coordinates string(s))

You can format the request/response any way you like. For example, you can return the GPS coordinates for the second call as an array of two strings, encoded in json, or you can choose to use some form of special formatting - it's all up to your team's decision. Our sponsors from KYUP have provided free accounts for their LXC-based cloud service, where you can spawn a new virtual container to host your API.


## Conventions

* MySQL Table Fields:
    * <tablename>_id - Row ID
    * some_field     - underscore
* MySQL Table Names:
    * underscore
    * plural

## Tables:

* containers
    * container_id varchar(255)
* containers_coordinates
    * id int(11)
    * container_id varchar(255)
    * longitude float
    * latitude float
    * created_at datetime

## API:

REST
JSON response

Methods:

* create
    * Params:
        * container_id varchar(255)
        * longitude float
        * latitude float
    * Response:
        * boolean true|false
* get
    * Params:
        * container_id varchar(255)
    * Response:
        * Some container data that includes the last known location

## Endpoints

| URI                   | Verb   | Description                  | Params                            |
| --------------------- | ------ | ---------------------------- | --------------------------------- |
| /api/containers       | GET    | get list of all containers   | -                                 |
| /api/containers       | POST   | create record                | name                              |
| /api/containers/:id   | GET    | get single                   | -                                 |
| /api/containers/:id   | PUT    | update given record          | name                              |
| /api/containers/:id   | DELETE | delete record                | -                                 |
| /api/coordinates      | GET    | get list of all coordinates  | -                                 |
| /api/coordinates      | POST   | create record                | container_id, longitude, latitude |
| /api/coordinates/:id  | GET    | get single                   | -                                 |
| /api/coordinates/:id  | PUT    | update given record          | container_id, longitude, latitude |
| /api/coordinates/:id  | DELETE | delete record                | -                                 |
