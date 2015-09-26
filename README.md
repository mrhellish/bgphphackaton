h2. Conventions

* MySQL Table Fields:
** <tablename>_id - Row ID
** some_field     - underscore
* MySQL Table Names:
** underscore
** plural

h2. Tables:

* containers
** container_id varchar(255)
* containers_coordinates
** id int(11)
** container_id varchar(255)
** longitude float
** latitude float
** created_at datetime

h2. API:

REST
JSON response

Methods:

* create
** Params:
*** container_id varchar(255)
*** longitude float
*** latitude float
** Response:
*** boolean true|false
* get
** Params:
*** container_id varchar(255)
** Response:
*** Some container data that includes the last known location