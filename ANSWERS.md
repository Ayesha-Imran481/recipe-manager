# Recipe Management System

## 1. How to run the project
To run this project on a fresh machine:

1. Install XAMPP (Apache + MySQL)
2. Copy project into:
   C:\xampp\htdocs\ your-folder-name
3. Start Apache and MySQL from XAMPP control panel
4. Open phpMyAdmin: (enter into browser)
   http://localhost/phpmyadmin
5. Create database:
    recipe_manager
6. Import provided SQL file
7. Run project:
   http://localhost/your-folder-name/
   
## 2. Stack choice:
I have used 
          PHP for(backend logic)
          MySQL (database)
          HTML/CSS (UI)
          Bootstrap (styling)
I chose PHP and MySQL because they are simple, widely supported, and ideal for CRUD-based web applications.

A worse choice would be using a complex framework like Django or Laravel for this small project because it adds unnecessary setup complexity for a basic CRUD system.
That's why Php is a better choice.
## ## 3. One real edge-case
In the file: edit_recipe.php, I handle the case where the recipe ID is missing or invalid:

(php code)
$id = intval($_GET['id']);
if($id <= 0){
 header("Location: index.php");
 exit();
}

This handles the case where:
1. The id is missing in the URL
2. The id is 0 or a negative value
3. The id is invalid or non-numeric (e.g., abc, empty value)
Why this is important:
 If this check was not present,
      The database query could run with an invalid ID.
      It could generate errors or warnings
      It might fetch an empty or non-existent record
      The application could crash or behave unexpectedl
