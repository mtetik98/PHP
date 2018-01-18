# Introduction
This very basic framework is meant to be useable for beginning PHP developers who have an understanding off basic OOP. Creating pages and models is an ease. 

Please take note that __This is not a fully functional MVC!__

#### How to use
This document is created to provide a step by step instruction when creating new pages or models. 

# Setting up the environment
When you set up a new website, follow these steps.
#### Create a database
You should first create an empty database. Remember the name.
#### Configure your connection
You now have a database. Go to the `core/DB.php` file and edit the following variables to match your database:
```php
private $servername = "localhost";
private $username = "";
private $password = "";
private $database = "";
```
#### Creating the user
In the framework there is a base user. Open the `model/User.php` file. This file contains protected properties. Don't change the visibility and leave it on protected. Add a protected property according to your data needs. You could e.g. add an address property like so:
```php
protected $address;
```
When you're finished, go to your database to add a table. The table __has__ to have the name `user` or else it won't work. Next add the columns recorded in your `User.php` file. Give them the exact names they have in the class. __Don't forget the__ `id` __column!__ in your database. Every table has to have an `id` column with the following options: PK, INT, NN, AI. Please note that you should not add these to the `User.php` file as the `Model.php` file already contains it.

#### Load your page
Once you are done with the above steps you're ready to go. Try to find your page and register for an account and loging in afterwards. If that works then you can start writing your own code following the guidelines below.

<hr/>

# Create a page
The framework comes with a set of pages pre made. You can edit those to your needs. When adding a page, the authentication __must__ be handeled or it won't get loaded.
#### Create new file
Inside the pages folder, create a new file and name it as you wish. By convention the name is in camelCase. In this file you won't need to include the head, header and footer as the framework will handle this.
#### Add the page
Once the page is created, it needs to be added to the authentication. Go to `core/authentication.php` and add the page name to the user that could visit it like
```php
array_push($auth['<role>'], '<pagename>');
```
Do this __without__ the PHP extension.
<hr/>

# Add a model
A model is always based from the `model/Model.php` file.
### Create a file
Inside the `model` folder, create a new file. Give it a logical name and start write it in PascalCase. Inside the new model start with the following code
```php
<?php

class <modelname> extends Model{

    // Define properties here
    // Define them as protected! Example:
    // protected $brand;

    // The constructor should not have any arguments. 
    // If you do need them, make sure it could be called without arguments.
    public function __construct(){
    
    }
    
    // In this function you can check if an "about to be saved" object meets 
    // the requirements. If not, return false. If so, return true.
    public static function newModel($obj){
        return true;    
    }

}
```

#### Create the table
We now need something to save the model in. Create a new table in your database with the exact name as you classname exept it needs to be all lowercase. e.g: the class `UserComment` becomes `usercomment`. Add all columns according to the protected properties inside the class. Do not forget to add the auto increment `id` column. This shouldn't be in the class as the base model already contains it. The implementation in your application is handled by PHP autoload. You don't need to do anything else as long as you followed these steps.
<hr/>

# Define a relation
In the database you have defined the relations between the tables. These relations could and should also be added to the models. Luckily there is a function for these matters. Follow the example below to add a relation between 2 tables:  
#### The scenario
In the example we assume 2 models.  
- User
- Order

In this example a User can Order one or multiple products. This Order is split up into multiple OrdRegs (one OrdReg per product)
#### Determining the relation
A User has multiple Orders

#### Define the relation
Lets define the User - Order relation. In the User class we add the following code:
```php
protected $order;

public function getOrders(){
    return $this->hasMany('Order');
}
```
In this example the argument is the model of the relation and thus written with a capital letter. In this framework you'll need to define the relation in both classes. In the Order class add the following function:
```php
protected $user;

public function getUser(){
    return $this->belongsTo('User');
}
```
#### alternative fieldname
You can use an alternative fieldname. You could e.g. be more comfortable with the fieldname `$orders` for the orders. In this case the code should look like this:
```php
protected $orders;

public function getOrders(){
    return $this->belongsTo('Order', 'orders');
}
```
In this example the second argument is the fieldname it should be put in. If this value is not given it will automatically store it in the lowercase version off the classname and you will need to declare it as in the previous example.
#### usage
Now you can use it like in the following example:
```php
$users = User::find();

foreach($users as $user){
    echo '<b>' . $user->getUsername() . ':</b><br>';
    foreach($user->getOrders() as $order){
        echo $order->getOrderNr() . '<br>';    
    }
    echo '<hr>';
}
```
<hr/>

# Function overview and its usage
In this section every function will be covered and explained how to use it
## The App class
This is the core of your application. 
### App: Error handling
The app class contains some error handling. You can add, display and check for errors. 
   
`App::addError("this is an error");` will add a new error to the application.   
`App::displayErrors();` will display all errors to the user. will also empty the error store so a check for new errors is not necessary.  
`App::hasErrors();` gives you a boolean value indicating if there were errors added after the last `displayErrors()` was called.  
`App::getErrors();` will give you all present errors. Please note that the error array is not emptied out when this function was called.
### App: User management
The app covers the user management off your application.
    
`App::setLoggedInUser();` sets the user that is currently logged in. You will probably not call this function but it's important to know what it does.  
`App::getUser();` gets the user set with `setLoggedInUser()`.  
`App::logoutUser();` unsets the currently logged in user. You should refresh or redirect the page after this.  
### App: Utility
Covers other functionality.  
  
`App::redirect("home");` redirects a user to the homepage.  
`App::refresh();` refreshes the page without the POST values. Useful for after saving a form.  
`App::currentPage();` gets you the current page.  
`App::link("home");` provides you the link to the page. A usage could be `<a <?= App::link("home") ?>>return to home!</a>`.  
`App::addTextInput("title", $form);` provides a modal popup with a form. How to add a form can be read in the 'form' section.

## The DB class
Just... \*sigh\*. Just edit the connection info. Don't do anything else with this file. The Model and App class use it.

## The authentication file
This file handles all authentication for the redirection and stuff. There are 2 roles defined:
- __user__ someone who is logged in as a user (so not an admin)
- __guest__ someone who isn't logged in. Everyone without a role will automatically get the 'guest' role.

To add a role just add the following code in the `//==== Roles ====` section
```php
$auth['admin'] = [];
```
This will create the admin role. Next add the pages in the `//==== Pages ====` section like so:
```php
array_push($auth['admin'], 'home');
array_push($auth['admin'], 'adminpanel');
array_push($auth['admin'], 'logout');
```
Pay attention to what page is added first. This will be the page the user is redirected to when he visits an unauthorized page.  
e.g.: When an admin tries to reach the login page. he will be redirected to home.

## The Model class
This class will provide you (with some of your code) with a PHP representation off your database. How to use this file is described in the 'Add a Model' section.  
The User model has already been added for ease of use.
