# Documentation

## A top-down study:

This is a top-down study of the Castopod repository for future reference:
The architecture on which Castopod is built is an MVC architecture using the PHP CodeIgniter framework.
This architecture consists of three main parts:
### Model: 
is responsible for all data manipulation and other data operations.

### View: 
displays the application interface and changes it as certain events occur or data changes

### Controller:
is the bridge between the two previous components. In short, it takes user input, sends it to the model component which makes the changes to the data and the database, and then sends the changes to the View component to modify the interface.
 
These three components will appear explicitly and implicitly in the architecture of the code.
The main files of the repository on which we will work are:
### Application :
The application contains most of the code, in other words it contains our application, it defines the routes in the application (app/config/routes.php), it defines the controllers, the migrations and seeds of the database, entities, filters, some helper functions and much more.
This will be discussed in depth later in our analysis.
### Modules:
Modules are used to define sub-parts in an application, it contains sub-folders, each serves as its own (standalone) sub-application with its routes and controllers. One of the folders inside the modules folder is the Admin folder. In this castopod test phase, most of the functionality of the application (website) is limited to the administrator.
### Audience:
Contains images, icons and public data used in the front-end
### Topics:
This folder contains most of the front-end of the application, which you will find in the cp_admin part, (frontend, for podcast, episode, person, …)

### Testing:
Some tests are defined in this folder, to be applied individually
 
Some files are important to note, such as:
.env.example: In .env files, database, email, cookie, encryption, application and media URLs, gateways, API configurations are defined.
Another important file is vit.config.ts, which carries many Vite.js configuration files used in the Themes folder to import different javascript libraries for use in the frontend.
There are many other main folders defined, such as .github, build, docker, initdb, scripts, .husky, .. But these folders will not be used during our work on adding features to castopod.
 


We will now give a detailed explanation of the application components, modules and themes:
### Application :
The first folder inside the app is the configuration folder, which contains configurations for various components, including colors, cookies, cache, exceptions, images, and most importantly, routes.
Routes are used to map URL patterns to a management function, so in case a user visits a certain part of the application, the function would be called, additionally, that router could be called from different parts of the application using its keyword.
 
Example :
$routes->post('action', 'PostController::attemptAction/$1/$2', [
             'as' => 'post-attempt-action',
             'filter' => 'permission:podcast#.interact-as',
         ]);
In this code, when the POST command is called in the action url, the tryAction function, defined in the PostController (Controller folder in the App folder) is called with parameters 1 and 2. If we want to use this route , we can use the "post-attempt-action" keyword. (defined using as)

#### Controllers:
Many controller files are defined in this folder, which provide functions to manage podcasts, streams, episodes, colors, actors, etc. All of these controller classes extend a base class which is BaseController.
 
BaseController.php:
Contains the initController function which is used by CodeIgniter to automatically create the base controller, initialize some helpers, and set the application theme.
This controller inherits from the Controller class in codeigniter.
EpisodeController.php:
This controller uses models (episode, podcast models) and entities and has four main functions, which are index, activity, _remap, embed. The index is used to get the episode and the podcast (using the patterns to get the data from the database).
PodcastController.php: has the following functions: episodes, about, activity, podcastActor, _remap
 
#### Entities:
Define frequently used objects and are similar to objects in object-oriented programming. In the castopod repository, many entities are defined. One of these entities is Podcast.php.
The podcast entity has many attributes including actor, id, handle, url, … and several functions, mainly setters and getters.
There is also an episode entity which contains attributes like id, podcast_id, link, etc. and contains several functions, mainly getters and setters, which defines the episode audio file, transcript, title, etc.
 
#### Models:
The models folder contains the commands needed to store episodes, podcasts, users, etc. via episodeModel, PodcastModel, …
 
Now let's take a look at the modules folder:
### Modules:
The main folder inside this directory that we will focus on is the admin (module) folder. The administrator has his own configuration and controllers. In the controllers folder, many classes extend the classes already defined in the application folder. These controllers contain many additional features. One of the controllers that needs closer examination for our upcoming work is the PodcastImportController.php.
An important note is that all admin-related routes (e.g. routes used in the themes folder) are defined in the modules/config/routes file
 
## Themes:
This folder contains most of the front end code, using php, html, css and some javascript.
Looking at the cp_admin directory:
There is an episode folder which contains files like: create, edit, delete, list .php which creates all the forms for episode creation and for each input in the form routes it to a controller function .
### Podcast:

I’ll start by the properties that are only available for the admin:
- create page:

This page is displayed when the user pressed “New Podcast” button on the side bar.
The most important thing in this page to focus on is the form of class "flex flex-col w-full max-w-xl gap-y-6",
The action (after submission) of this form is routed to PodcastController.php (This controller is found in modules/cp_admin/controllers) . How to check and know that? You can use the routes.php in cp_admin/config, where you search for the “podcast-create” keyword. In the routes file, there are different router groups, that connect different links, or even frontend components, to different actions defined by controllers.
In this section I am only visiting the Themes (frontend) thus the explanation of different actions of different components will be given in the Controllers section. 

In the form we have different sections, one of which is the cover of the podcast, where you could drop or add an image of your choice (Note: the dimensions of the images accepted are a bit precise and you should respect them: to check sizes you could go to App/Config/Images.php where all the configurations for images are found including podcast covers).
The other sections include: title, description, type, classification, author, monetization, and other details.

To make sure that the create.php is quite understood I will give some examples to illustrate:
<form action="<?= route_to('podcast-create') ?>" method="POST" enctype='multipart/form-data' class="flex flex-col w-full max-w-xl gap-y-6">

This is the definition of the form that contains all the different fields of the podcast creation:
Action: the route_to function is used here, where the route defined in cp_admin/config/routes.php with the field as = “podcast-create” , is accessed and used after the form is submitted to call the different functions defined in the controllers.
Method=”POST”, it just defines the HTPP function used, this field is also used in the route.
enctype='multipart/form-data':  just indicates that when the form is submitted through the HTTP request, POST, it contains a file fomat also
Class: defines the name of the class used for different purposes including CSS.
Another example is :
<Forms.Section title="<?= lang('Podcast.form.classification_section_title') ?>" subtitle="<?= lang('Podcast.form.classification_section_subtitle') ?>">

I gave this example just to clarify what lang is:
Lang gives different values depending on the languages chosen, you could access this data in the cp_admin/languages.

- Other theme files: Delete.php, Import.php


## Controllers (Cp_admin/controllers/EpisodeController) :

In this controller, two models are used: A Podcast model, and an Episode model
### Functions:
#### public function _remap(string $method, string ...$params): mixed:

This function receives a method name (one of the methods defined in the episodeController) and a group of parameters. 
It is used to handle URL/URI requests or routing, where it takes the URL with the sets of parameters that follow ( 
•	Params[0]: Podcast ID
•	Params[1]: episode ID
Note: Params[i] are casted from char to int
)
First, the function checks if the Podcast id is found, if not a PageNotFoundException is thrown. After the podcast id is retrieved it sets the Podcast model parameter in the EpisodeController object to the Podcast model with ID equal to Params[0].
The next step is to check Params[1], if an episode with parameters: id = params[1] and podcast_id = params[0], the Episode Model variable in the EpisodeController object is set to the one identified by the parameters. Else, a PageNotFoundException exception is thrown.
At the end the _remap calls the method (name is in the parameters) and returns whatever that function returns (mixed return type):
return $this->{$method}(...$params);


#### public function list(): string
This function is used to return a view that displays the episodes found in a podcast as a reply to a GET query sent by the user.
It first accesses the GET query, and reads its q parameter to get a string. In the “q” string there is the title and the description_markdown of the epsisodes, There are two possibilities in this case, either the length of q is more than four and thus MySQL Full-Text Search could be used (a method for text-biased search in MYSQL which uses natural language to search) or its length is less than 4 and in this case a Like operator is used.
If the LIKE operator is used, a matching between the titles and description markdown of each episode is done in comparison with the parameters using ->like('title', $query)
 ->orLike('description_markdown', $query)
In the case where the length is more than 4, the MATCH _  AGAINST  _  command is used to find the list of episodes.
The final possible case is if the q parameter had length 0 (no description). In this case, all the available episodes of the podcast will be displayed in descending order of creation time.
After the handling of the GET request, a helper function is used to create an html form, and the metadata are defined to describe the display on different pages, etc.
Finally, the breadcrump parameters (which indicate the location of the user in the page) are changed to the handle of the podcast (see at_handle in the podcast model) .
The data found are then passed as a parameter to the view function which takes the name of the View class(episode/list) and the data it needs (which are in this case the list of episodes to display in the form defined in episode/list)

####  public function view(): string
This function just is used to get the metadata for the episode/view  View code defined in the themes directory where it give the podcast Model and the episode Model.
####  public function create(): string
This function gives the episode/create view the metadata it needs from the episode model: podcast id, current season number, and the next episode number
####  public function attemptCreate(): RedirectResponse
This function is used to create an episode and add it to the database. It starts by defining a set of rules concerning the maximum length of the slug, the format of the audio file, the format of the cover, etc.
It also put a requirement on the episode number in case the podcast type is serial.
Then all these rules are validated using the CodeIgniter framework through the validate function. In case, the rules were not validated the page is redirected to the previous one with a set of errors and parameters.
Next, the function checks if the episode isn’t already found in the database (redirects in case it is available) and then connects to the database using the db_connect built-in function and starts a transaction.
A new episode object is created using the Episode entity (defined in the Entity folder), where different properties are fild using the content of the POST HTTP request and the files uploaded in this request (title, slug, description, location, etc.  using the getPost and getFile functions).
Other properties (not in the episode entity) are then also extracted and finally the episode Model is created. The function then tries to insert the Episode into the model and either it rolls back in case the insert didn’t work or continues to create a footer for the podcast object and then completes the transaction (commit).
Finally, the page is redirected to a new page defined by the “episode-view” View object (which also requires certain parameters for display)
####  public function edit(): string 
This function is used to get the required metadata for the episode/edit View page from the models (episode, podcast)
####  public function attemptEdit(): RedirectResponse
This function does the same as the attemptCreate function but for an already existing episode.
####  public function transcriptDelete(): RedirectResponse
This function deletes the transcript of a certain episode. First the function checks if the transcript of the episode is available, if not it redirects to the previous page, if yes it create a mediaModel to interact with the media of the database and deletes the transcript of the targeted episode using deleteMedia function.
####  public function chaptersDelete(): RedirectResponse
Deletes episode chapters
####  public function publish(): string | RedirectResponse
This function checks the publish status of the episode. If the episode is not published, it creates a form with the data including the podcast and episode properties of the controller and returns the view “episode/publish” with the retrieved data.

### Other functions available:
 
####  public function attemptPublish(): RedirectResponse
####  public function publishEdit(): string | RedirectResponse
####  public function attemptPublishEdit(): RedirectResponse
####  public function publishCancel(): RedirectResponse
####  public function publishDateEdit(): string|RedirectResponse
####  public function attemptPublishDateEdit(): RedirectResponse
####  public function unpublish(): string | RedirectResponse
####  public function attemptUnpublish(): RedirectResponse
####  public function delete(): string
####  public function attemptDelete(): RedirectResponse
####  public function embed(): string
####  public function attemptCommentCreate(): RedirectResponse
####  public function attemptCommentReply(string $commentId)


 ## Media:
 
 The media folder is made of the following folders:
- Config:
This folder contains three php files and configure the media module, where the media.php is used to do basic configuration like base url path and extentions, etc.
As for the routes.php, it only defines one routes for this module which is: static/(:any). If we take an in depth look at the code we can see that at the beginning the $routes variable was initialized using the service('routes') helper function built-in in CodeIgniter where it retrieves and instance of the 'CodeIgniter\Router\RouteCollection' class (router class).
The get function (the only one defined) is used to route requests for 'static/(:any)', where 'any' could take different values (file1, file2, etc.), to the serve function in the MediaController class with a parameter of $1.
The $1 parameter is a variable representing the "any" variable defined in the routes field (file1, file2, etc.). For example, if 'static/file1' was requested, the serve(file1) would be called. 
Furthermore, the other parameters used in the get function are supplementary parameters, where 'as' gives a name for our route ('static/(:any)') which makes it easier to use throughout our module and namespace indicates where is the MediaController found.

The third file found in the Config folder is Services.php, where in this file a Services class is created which extends the BaseService class built-in in Codeigniter. This file is used to overrides some of the built-in Codeigniter services to use application-specific services you define. In this case, the defined function is file_manager function which returns a FileManager interface. This function receives one parameter set by default to true, which is the "getShared" parameter. In case getShared was True, the default file_manager is used using the getSharedInstance function defined in BaseService.
In case the getShared parameter was set to False, a $config variable for Media is created (Media/Config/Config.php) and the fileManagerClass is imported according to the fileManager array defined in Config.php. For example, if the '$fileManager' property is set to 'fs', then $fileManagerClass would hold the value 'Modules\Media\FileManagers\FS'. (two available fileManagers defined in the config.php: fs and s3. In the current instance the 'fs' property is chosen since public string $fileManager = 'fs').

In conclusion, I'll give a step by step explanation of the file_Manager function:
1- if getShared = true, self::getSharedInstance('file_manager') is returned which is already defined in CodeIgniter\Config\BaseService. Hence, the application still uses the behaviour defined in codeigniter.
2-if getShared is False, the config defined in Media.php is imported to the $config variable.
3- $fileManagerClass = $config->fileManagers[$config->fileManager];
In this line of code the fileManagers dictionary defined in 'Config.php' is accessed and the class of key = '$config->fileManager' is retrieved. We can check the config.php file where fileManager is set to 'fs'. The fileManagers dictionary maps 'fs' to the FS class defined in Media/FileManagers. In conclusion, $fileManagerClass is equal to FS::class
4-A new instance of the FS class is created
5- If the fileManager defined class implements FileManagerInterface it is returned, otherwise an exception is thrown.

To give the best understanding of this module, We will now study the FileManagers folder/namespace used frequently in the Config folder.

- FileManangers:
As defined in the Config.php, there are two defined file managers in the current Castopod application, the FS and the S3 managers which both implement the FileManagerInterface.

We'll take a top-down approach in this explanation where we'll start with the FileManagerInterface and then study FS and S3.

### FileManagerInterface:
This interface defines several functions such as:
- save : takes a file object and a string which represents the name of the file to save and returns either a string or false, it would be most probably used for saving audio files.
- delete: takes a string parameter: key. It gets the name of the file and deletes it.
- getUrl: takes a string parameter "key"
- rename: takes a string parameter "oldkey" which represents the name of the file targeted, and another string parameter "newKey" which is the new name of the file. Hence this function is used to update the name of a file and returns a boolean to indicate the success or failure of the operation
- getFileContents: takes a string parameter: key
- getFileInput: takes a string parameter: key
- deletePodcastImageSizes
- deletePersonImagesSizes
- deleteAll
- isHealthy
- serve

### FS:

The FS class implements the FileManagerInterface in order manage saved data (podcasts, people, images) for the server's file system.

The constructor of this class __construct receives the config file defined in Config/Media.php as an input. This config file will be later used for defining the main roots.

Before explaining the public functions used for managing the file system, we need to define a helper private function used throughout the class:

#### media_path_absolute(string | array $uri = ''): string (private function):

It takes a string/array `uri`, converts it to a string in case it was an array, removes the final `/` in the string, and then returns `storage defined in Config/Media.php`/ `root defined in Config/Media.php`/ `uri`.

Using the most recent Config file:
take $uri = '' (default value)

returns : `ROOTPATH .public/media/`




#### save(File $file, string $path): string | false:

This function receives a file object and a string that defines the path where the file should be saved.
Steps:

- It checks if a path extension is available in `$path` using the pathinfo function ( PHP function that returns an associative array containing information about the path including the directory name, basename, extension, and filename). In case no path extension (.mp3, .jpeg, ...) was found the file object had a defined extension ( retrieved through `$file->getExtension()`), the retrieved extension will be added to the `$path` extension.

- media_path_absolute() is called to add the root and storage paths

- checks if the file path ($path string appended to the root) exists, if not, it creates the directory and names it.

- checks if an index.html file is available in the directory, if not it create an empty one. This is a common practice to prevent directory listing and leak of sensitive information, where in this case the server will display the content of index.html (empty) instead of all available directories

- The functions tries to move the file object to the final path, and finally it either returns the path string or returns false in case of failure.

#### public function delete(string $key): bool:

This function uses the media_path_absolute to get the full path added to `key` part and then deletes it from the file system using the unlink built-in php method.
Note: the use of `@` in the call for unlink is to supress any error messages that could be thrown in case the file wasn't available.

#### getUrl(string $key): string:
/// forget it:shouldn't "helper('media') be added??"
returns the output of the media_url helper function which will be later explained in the helpers section.

#### The following functions all use built-in php functions and return their output:
- rename(string $oldKey, string $newKey): bool
- getFileContents(string $key): string|false
- getFileInput(string $key): string

#### deleteAll(string $prefix, string $pattern = '*'): bool: 

In case the pattern was *, this means that the function will delete all the contents of the folder (prefix). delete_files built-in function is imported using helper('filesystem') and is called on the absolute path.

If the pattern is different, eg: image_*.png (which represents all the files with a name that starts with `image_` and is of png format), the glob built-in function is used to get all the paths with the absolute path and pattern specified. If no paths have this pattern, the function returns `true`, else it uses `unlink` built in function to delete all the files with the given format and returns true.

#### public function deletePodcastImageSizes(string $podcastHandle): bool:

deletes all the files with the path extension of `podcasts/{$podcastHandle}` (where podcast handel is defined in the podcast model class) and with a format of 'jpg', 'jpeg', 'png', 'webp' (podcast images). In order to carry out this operation, the deleteAll function previously explained is used.

#### deletePersonImagesSizes(): bool:
This function does exactly the same as the previous one but deletes person images instead (path extension: persons)

Note: For the last two functions the two folders inside of `media` root folder were used: 'podcasts' and 'persons'. These two directories were defined in the Config/Media.php file in the $folders dictionary.

#### isHealthy(): bool:
This function uses the is_really_writable built-in function which checks if the server-side system can modify and edit the directory or not.

#### serve(string $key): Response:

Redirects the page to the Url returned by the getUrl function explained above.


### S3 class:

Amazon S3 (Simple Storage Service) is an object storage service offered by Amazon Web Services (AWS). It provides scalable storage for objects such as images, videos, documents, and other files. 

This class defines an interface to interact with aws S3 and store our files where it implements the functions defined in FileManagerInterface.

Two libraries are used by this class: the S3Client to create a connection with amazon S3 and thus store files, and the Credentials library to indicate the credentials of the user (the key and the secret code)

The following aws s3 client methods where used in this class:
- putObject
- deleteObject
- copyObject
- getObject
- getPaginator
- doesBucketExist
- headBucket
Check the AWS SDK API documentation for PHP for furthur info:
https://docs.aws.amazon.com/aws-sdk-php/v3/api/namespace-Aws.S3.html



#### public function __construct(protected MediaConfig $config):
The constructor receives the MediaConfig object (configuration class defined in Media/Config/Media.php). Then uses the s3 array defined in the config class to create the S3Client. It indicates the version, region of the s3 bucket, endpoint, credentials, and more.

#### public function save(File $file, string $key): string|false:
Uses the putObject command available for the s3client to store the file passed as a parameter in the AWS bucket (defined in the configuration file). This function receives the bucket, the key, sourceFile, and the contentType (html, json, text, etc. through the function getMimeType which just returns the format of the file).
In case the object upload to AWS worked, the function deletes the file from the server storage (unlink) and returns the key (name of the file), otherwise it returns false.

#### public function delete(string $key): bool:

Similar to most of the functions in this class it calls a function predefined for s3Client which is in this case: deleteObject which deletes the file with name `key`.

#### public function getUrl(string $key): string:

This function has just one line: return media_url((string) route_to('media-serve', $key));

First, Config/Routes.php is used to route to the function defined in MediaController called serve($key)
After that, the serve function returns a value which is cast to a string and then passed to the `media_url` function we already explained.

(add more explanation)

#### public function rename(string $oldKey, string $newKey): bool:
The function first copies the object found in the aws s3 bucket with name `oldkey` and stores it it with a new name `newKey` using the s3->copyObject function. It then deletes the object with the old key and returns it.

#### public function getFileContents(string $key): string|false:
The function calls the getObject method and then retrieves the body of the object returned through the `$result->get('Body')` function.

#### public function getFileInput(string $key): string:
This function just returns the url of the file with the name `key` using getUrl function

#### public function deletePodcastImageSizes(string $podcastHandle): bool:
The function loops over all the files with an image format and calls deleteAll on every image with the name podcastHandle inside the `podcasts/` directory.

#### public function deletePersonImagesSizes(): bool:

Does the same as the previous function but deletes any image in the `persons` directory.

#### public function deleteAll(string $prefix, ?string $pattern = '*'): bool:
This function was used in both of the previous functions. It uses the getPaginator function which is used to retrieve large sets of data and returns it as several subsets in a more memory-efficient way.
(The getPaginator function uses the ListObjectsV2 aws api)

Next, the function iterates over all the returned files, and checks which files (objects) have the same key as the `pattern` variable (pattern = prefix.pattern).

After retrieving all the files that should be deleted and storing their keys into the `objectsToDelete` array, the s3->deleteObjects function is called (the array is passed as the second parameter)

#### public function isHealthy(): bool:

This function first checks if the bucket is available on amazon s3 using the `s3->doesBucketExist(string)` function, and in case it available it then checks if the bucket could be accessed. It checks the accessability of the bucket using the `s3->headBucket` function (checks if the user has permission to access the bucket).

#### public function serve(string $key): Response:

Function description:
1- A response Object is returned using the Codeigniter service function with parameter 'response'. A Response object is an instance of the `CI_Output` class and is used to return HTTP responses to the clients. It provides methods to set the HTTP headers, setting the response body, and sending the response to the client.
2- It tries to get the object with the key : `key`.
3- It removes the predefined Cache-Control header using the header_remove function
4- It redefines the cache parameters(max-age, etag, public: parameters representing the freshness of the response), sets the content type of the response (format), and sets the body to the contents of the retrieved file. Finally, it returns the response object.

- Controllers
- Database/Migrations
- Entities

- Helpers
- Models




