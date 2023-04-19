# Documentation
## Podcast:

I’ll start by the properties that are only available for the admin:
### Themes:
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





