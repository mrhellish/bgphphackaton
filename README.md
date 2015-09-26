# bgphphackathon project

## The task

Most shipping companies provide some form of tracking service, where a container can be traced by its identification number. Your task is to implement a very cool container tracking web application, which relies on live GPS data (coordinates) from a web service. The service needs to accept a container tracking number (a.k.a. container ID) and be able to visualise the location of the corresponding container (preferrably on a map). The UI of your web app is totally up to you.

Since most of us have had the unpleasant experience of working with APIs with poor design or bad formatting/validation, your team also gets to implement the API part of the task to your liking. It has to provide simple funcionality. It accepts only two calls:

* A call for registering new container (accepts container identification string, returns boolean result)
* A call for obtaining the current GPS coordinates of a container (accepts container ID string, returns GPS coordinates string(s))

You can format the request/response any way you like. For example, you can return the GPS coordinates for the second call as an array of two strings, encoded in json, or you can choose to use some form of special formatting - it's all up to your team's decision. Our sponsors from KYUP have provided free accounts for their LXC-based cloud service, where you can spawn a new virtual container to host your API.