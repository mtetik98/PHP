#Introduction
This very basic framework is meant to be useable for beginning PHP developers who have an understanding off basic OOP. Creating pages and models is an ease. 
Please take note that __This is not a fully functional MVC!__

#Table of contents
####Setting up the environment
####Create a page
####Add a model

#How to read
This framework is easy to use but has a few things you need to know when creating things. Down here there is a step by step plan on making stuff.

<hr/>

#Seting up the environment
When you set up a new website, follow these steps.
##Create a database
You should first create an empty database. Remember the name.
##Configure your connection
You now have a database. Go to the `core/DB.php` file and edit the following variables to match your database:
```
private $servername = "localhost";
private $username = "debian-sys-maint";
private $password = "lgdq56dlGj6EGIyi";
private $database = "examentraining";
```
##Creating the user
In the framework there is a base user. Open the `model/User.php` file. This file contains protected properties. Don't change the visibility and leave it on protected. Add a protected property according to your data needs. You could e.g. add an address property like so:
```
protected $address;
```
When you're finished, go to your database to add a table. The table __has__ to have the name `user` or else it won't work. Next add the columns recorded in your `User.php` file. Give them the exact names they have in the class. __Don't forget the__ `id` __column!__ This property is not and should not be added to the `User.php` file as the `Model.php` file already contains it.

##Load your page
Once you are done with the above steps you're ready to go. Try to find your page and register for an account and loging in afterwards. If that works then you can start writing your own code following the guidelines below.

<hr/>

#Create a page
The framework comes with a set of pages pre made. You can edit those to your needs. When adding a page, the authentication __must__ be handeled or it won't get loaded.
##Create new file
Inside the pages folder, create a new file and name it as you wish. By convention the name is in camelCase. In this file you won't need to include the head, header and footer as the framework will handle this.
##Add the page
Once the page is created, it needs to be added to the authentication. Go to `core/authentication.php` and add the page name to the user that could visit it like
```
array_push($auth['<role>'], '<pagename>');
```
Do this __without__ the PHP extension.
<hr/>
#Add a model
A model is always based from the `model/Model.php` file.
##Create a file
Inside the `model` folder, create a new file. Give it a logical name and start write it in PascalCase. Inside the new model start with the following code
```
<?php

class <modelname> extends Model{

    //Define properties here
    //Define them as protected!

    //The constructor should not have any arguments. If you do need them, make sure it could be called without arguments.
    public function __construct(){
    
    }

}
```

##Create a table
We now need something to save the model in. Create a new table in your database with the exact name as you classname exept it needs to be all lowercase. e.g: the class `UserComment` becomes `usercomment`.
Add all columns according to the protected properties inside the class. Do not forget to add the auto increment `id` column. This shouldn't be in the class as the base model already contains it.
##implementation
The implementation in your application is handled by PHP autoload. You don't need to do anything else as long as you followed these steps.
##using the model
In this example I will use an example Team based on the following file:
```

```