# Documentation
## Themes:
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

- Delete.php:
- Import.php:


## Controllers:

Cp_admin/controllers/EpisodeController:

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





