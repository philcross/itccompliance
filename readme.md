### Considerations

 - To output the product response, I've added a basic UI with CSS and Javascript. I have knowledge of basic CSS, and a better understanding of vanilla javascript, but am more used to working with VueJS, or jQuery. But as the task requirements stated no frameworks, I wrote the basic vanilla javascript for demonstration purposes.
 
 - I've created an SDK to communicate with the product API. Normally I would do this if there are a lot of endpoints, but it seemed reasonable to demonstrate this ability here. The job of the SDK is to purely make a request to the service, and return an array response. It can correctly handle 4xx, 5xx and transfer errors, as well as the 2xx status response which was actually an error.
I've used the GuzzleHttp client so it could be test driven, easier, but could easily be rewritten for cUrl.
 
 - I've used the adapter pattern, purely for demonstration purposes. The main adapter used is the `SdkAdapter`. The job of the adapter is to take the array response from the service, and convert it to a domain model. It will also perform sanitization on the returned data, which gets rid of HTML tags and the content within them, UTF-8 characters, and also trims the string of undesirable characters.
The models can also handle situations where the data isn't in a valid format - such as missing data.
 
 - The repositories job is to leverage the adapter. It will attempt to build up a complete product payload. If the API returns an error while making a request, it will keep trying the endpoint until it gets the required data, then move on. The repository can accept any adapter which utilizes the `AdapterInterface` interface.
 
 - The transformers job is to convert the domain models, `Product` and `ProductOverview` to an array which can be used in the frontend HTML / javascript.
 
 - I have 2 controllers. One, `EntryController` is the main entry point into the application. The `AjaxController`'s job is to make a request to retrieve all product information, and return is as a JSON response, which the frontend can handle.
 
 - I've used Test Driven Development from the start of this test, and have included an example of adapter polymorphism by adding a `MemoryAdapter` which isn't used in the actual test, but I think is useful in showing good SOLID principles.
The test for the adapters is a single abstract test. Each adapter has it's own test object, whose sole job is to return an instance of the adapter.
This will allow you to quickly create a new adapter, and ensure it's compatible and maintains polymorphism with the other adapters.

- In a real application, I would use a Cache to store the products for a set number of time to reduce subsequent load times for the end users, and reduce any API rate limits imposed on us, but for the demonstration, it makes a request on each load.

- Tests are located in the `tests/` directory, all the source files for the application are in `src/`, and frontend assets (excluding the view file) are stored in `assets/`. The main HTML index page is stored in `src/Views`. In a real life situation, I'd have used some kind of templating engine like Blade or Twig.

- While I've displayed the details in a modal, and the overview in a table, all the data is retrieved in one go - as requested in the documentation. You can go to `/products.php` to view the raw JSON payload for all products.

- I've regularly commited, so show how the application evolved over time, and how I performed refactorings.

### Running the tests

You can run all the unit tests by running `./vendor/bin/phpunit`

### Running the application

You can run the application using the built in PHP server. `php -S localhost:8000`
It requires PHP >= 7.1


### Screenshots

Product list

<img src="https://github.com/philcross/itccompliance/blob/master/assets/screenshot1.png">

Product Details

<img src="https://github.com/philcross/itccompliance/blob/master/assets/screenshot2.png">
