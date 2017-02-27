PDFGenerator Documentation
======

#### Dev. env
For ease of development the service have been developed in a docker container. By this means it's recommended to install 
docker in order for further development of the service.

Docker compose have been used to create three containers for separating the concerns of the application.

To get started with docker for the application first download and install [docker.](https://www.docker.com/)

When docker is installed open the terminal and go to the root of the project. Here type

```
docker-compose up -d
```
This can take some time, when run first time due to setup of env.

The default port for the project is set to 8080.
####Unix
When running docker on unix machines the docker instance can be reached by localhost:port
####Windows
When running docker on windows machines the local vm's ip needs to be used when trying to reach the instance. The ip is 
typically: 192.168.99.100:port

#### Third part libs for docker instance
The following third part libs have been used on the linux dist.  for the html to pdf creation.
1. libfontconfg1
2. libxext6
3. libxrender1

These can be installed by using the apt package manager for linux. (apt-get install "package")

#### Docker commands
```
docker ps
```
Shows the running containers

```
docker exec -ti CONTAINER_ID bash
```
Connects to the docker container. (When connected to a container press: ctrl-p, ctrl-q to disconnect from the 
container but leaving it running)

#### PDF lib
For creating the pdf files the [snappy.pdf](https://github.com/KnpLabs/snappy) have been used.

API
------

#### The application
#####Custom styling pdf
For custom styling of the pdf layout, css files can be passed to the layoutHandler when constructed. 
The css file public/css/PDFStyles.css can be used as an example. The twitter bootstrap lib is installed by default.

#####Adding JS to pdf
For adding JavaScript to the pdf, js files can be passed to the layoutHandler when constructed. 
The js file public/js/PDFStyleHelper.js can be used as an example.

#####Queue system
When a job gets send to the service, it gets passed to a queue system. As for now there is only one queue in the system
but more could be added to prioritise different jobs or just wait with handling some tasks for later. The queue implementation 
is based on the standard Laravel implementation of a [queue system.](https://laravel.com/docs/5.4/queues)

The standard MySQL database is used for handling the tasks in the queue, a reddis database could be used to boost the
performance of the system.

#####Storing PDF documents
When a job is done the PDF gets stored in the /temp folder of the project.


#####Running tests
Tests have been developed for supporting the service. Here has three types of tests been developed.
1. unit tests
2. feature tests
3. e2e tests

In order to run the tests it's recommended to connect to the docker container and run the test.
The test can be run from the root of the project by using the phpunit framework.

```
vendor/bin/phpunit
```

```
vendor/bin/phpunit --filter String
```
Can be used to only run some tests.
#####Application logic

######PDFGenerator
The PDFGenerator sets up the environment for creating PDFs. It creates the LayoutHandler and all the Elements for the 
PDF.
######LayoutHandler
Sets up the document with styling and javascript. It handles rows in the document. 
######Element
Each pdf consists of elements, a parrent class have been developed as a base class for all elements in the system. 
Each element extends the element class to make their own version of toString() which is used for converting the element
to a string representation for the PDF.

#### JSON-data example
The endpoint can be tested with Postman by using the JSON example.

Windows: http://192.168.99.100:8080/api/pdfdocument

Unix: http://localhost:8080/api/pdfdocument
```json
{
	"data" : {
		"lines": [
				{
	                "id": 163,
	                "articlenumber": "000341104",
	                "type": 0,
	                "name": "Union     S. 1/2",
	                "index_on_worksheet": 1,
	                "quantity": "6.00",
	                "discount": "0.00",
	                "price_line": "94.46",
	                "status_line": 0,
	                "netto_line": "566.76",
	                "brutto_line": "708.45",
	                "tax_total_line": "141.69",
	                "tax_line": "25.00",
	                "taxID_line": 10,
	                "wholesaler_line": "bd",
	                "employee_assigned": " ",
	                "employee_assigned_id": 0,
	                "registration_date": ""
	            },
	            {
	                "id": 164,
	                "articlenumber": "031425008",
	                "type": 0,
	                "name": "Støbt Brystnippel 1",
	                "index_on_worksheet": 2,
	                "quantity": "3.00",
	                "discount": "0.00",
	                "price_line": "157.02",
	                "status_line": 0,
	                "netto_line": "471.06",
	                "brutto_line": "588.83",
	                "tax_total_line": "117.77",
	                "tax_line": "25.00",
	                "taxID_line": 10,
	                "wholesaler_line": "bd",
	                "employee_assigned": " ",
	                "employee_assigned_id": 0,
	                "registration_date": ""
	            },
	            {
	                "id": 165,
	                "articlenumber": "034686232",
	                "type": 0,
	                "name": "Lige overg.mf.mf. 18x3/4",
	                "index_on_worksheet": 3,
	                "quantity": "10.00",
	                "discount": "0.00",
	                "price_line": "178.29",
	                "status_line": 0,
	                "netto_line": "1782.90",
	                "brutto_line": "2228.62",
	                "tax_total_line": "445.72",
	                "tax_line": "25.00",
	                "taxID_line": 10,
	                "wholesaler_line": "bd",
	                "employee_assigned": " ",
	                "employee_assigned_id": 0,
	                "registration_date": ""
	            },
	            {
	                "id": 166,
	                "articlenumber": "022215168",
	                "type": 0,
	                "name": "6 std Søml. Stålrør",
	                "index_on_worksheet": 4,
	                "quantity": "5.00",
	                "discount": "0.00",
	                "price_line": "1284.48",
	                "status_line": 0,
	                "netto_line": "6422.40",
	                "brutto_line": "8028.00",
	                "tax_total_line": "1605.60",
	                "tax_line": "25.00",
	                "taxID_line": 10,
	                "wholesaler_line": "bd",
	                "employee_assigned": " ",
	                "employee_assigned_id": 0,
	                "registration_date": ""
	            }
			]	
	},
	"layout" : {
		"firstpage" : [
			[
				{
					"element" : {
						"type" : "lines",
						"class" : ["col-xs-6"],
						"table-class" : ["table-striped"],
						"style" : [],
						"config" : {
							"numberOfLines" : 3
						}
					}	
				},
				{
					"element" : {
						"type" : "div",
						"class" : ["col-xs-3"],
						"style" : [],
						"content" : ""
					}
				},
				{
					"element" : {
						"type" : "div",
						"class" : ["col-xs-3"],
						"style" : [],
						"content" : ""
					}
				}
			],
			[
				{
					"element" : {
						"type" : "div",
						"class" : ["col-xs-3"],
						"style" : [],
						"content" : ""
					}	
				},
				{
					"element" : {
						"type" : "div",
						"class" : ["col-xs-3"],
						"style" : [],
						"content" : ""
					}
				},
				{
					"element" : {
						"type" : "div",
						"class" : ["col-xs-3"],
						"style" : [],
						"content" : ""
					}
				}
			],
			[
				{
					"element" : {
						"type" : "div",
						"class" : ["col-xs-3"],
						"style" : [],
						"content" : ""
					}	
				},
				{
					"element" : {
						"type" : "div",
						"class" : ["col-xs-3"],
						"style" : [],
						"content" : ""
					}
				},
				{
					"element" : {
						"type" : "div",
						"class" : ["col-xs-3"],
						"style" : [],
						"content" : ""
					}
				}
			]
		]
	},
	"config" : [],
	"type" : "invoice"
}
```