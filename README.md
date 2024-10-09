# Web_Services
This repository will contain the work for the module Web Services.

Project done by:
Dhruv Kumar Sharma Punchcoory (2116038)
Chetanand Goboodun (2013212)

Consumption of Existing Soap
In this project, we use an existing SOAP-based web service, specifically the CountryInfoService provided by webservices.oorsprong.org. This service allows us to access information about various countries, including ISO codes and currency details.

The goal is to retrieve the currency code for a given country using the SOAP service. When a user enters a country name, our application sends a SOAP request to get the corresponding ISO country code and then uses that code to obtain the currency information.

Creation and Consumption of Soap
The creation and consumption of our SOAP service involve developing a PHP-based SOAP server that offers two key functionalities: a basic calculator and a forex converter. The service uses a CalculatorService class with methods for arithmetic operations and currency conversion, utilizing predefined rates from an XML file. Users interact with the service through a web form, selecting between basic calculations or currency conversions. A SOAP client then sends these inputs to the server, processes the request, and returns the results, which are displayed on the web page, providing a seamless user experience.

Consuming of Existing Rest
The given code snippet is a configuration setup for accessing a foreign exchange rates API. It defines an API key ($apiKey) and the base URL ($baseUrl) for making requests to the Forex Rate API service, which provides the latest currency exchange rates. The base currency is set to USD ($baseCurrency), and the desired target currencies are specified as EUR, JPY, INR, CAD, CHF, MUR, GBP ($targetCurrencies). This configuration will be used to query the API and retrieve the current exchange rates of the specified target currencies against the base currency, USD.

The code constructs a URL dynamically to query an external currency conversion API and fetches data using the file_get_contents method. If the request fails, it displays an error message. The JSON response is decoded and validated, ensuring no errors occurred during parsing. If the API returns valid exchange rate data, the code displays it based on the user’s preferred format: JSON or XML. For JSON, it outputs a neatly formatted JSON structure, while for XML, it builds an XML document using the SimpleXMLElement class. The snippet includes buttons for users to view exchange rates in their desired format.

Creation and Consumption of Rest
The creation and consumption of the REST service involve setting up a PHP-based endpoint that serves travel expense data in JSON format. The data includes details like accommodation, food, transportation, and sightseeing costs for various countries. The PHP script reads a JSON file containing this information and responds to GET requests with relevant data based on the user's selected country. Users interact with this service through a simple web interface where they can select a country, and a JavaScript function sends an AJAX request to the REST endpoint. The response is parsed and displayed on the page, providing users with detailed travel expenses for their chosen destination.

Use of XML
In our web application, XML is utilized for defining and storing currency exchange rates in a structured format. This allows the system to easily parse and access the conversion rates between different currencies

Use of Json
JSON is employed in our application for managing travel expense data. It stores details such as accommodation, food, transportation, and sightseeing costs for various countries.

Installation:
1.Extract the folder from the zip to a folder in the server’s document root.
For example: Easy PHP :\Program Files (x86)\EasyPHP-Devserver-17\eds-www

2.Open a web browser and enter the URL to access the website
http://localhost:8080/Web_Services/finexo-html/index.html

3.How to access differents links:
Existing Soap: http://localhost:8080/Web_Services/finexo-html/consumingSoap.html
Rest Consumption: http://localhost:8080/Web_Services/finexo-html/consumingRest.html
Rest Creation and Consumption: http://localhost:8080/Web_Services/finexo-html/travelExpenses.html
Soap Creation and Consumption: http://localhost:8080/Web_Services/finexo-html/creatingSoap.html

