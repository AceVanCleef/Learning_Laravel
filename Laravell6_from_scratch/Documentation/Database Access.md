# Database Access

## Setup a Database Connection

`.env` file stores all environment configuration and keys. Also the one for your database access:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=
```

These are used in ` config/database.php `.


### Steps:
1. Change DB_DATABASE, DB_USERNAME AND DB_PASSWORD
2. Create DB in Mysql with the name you defined in DB_DATABASE
3. Create/import table(s)

Alternatively, you can choose from other DBs such as sqLite and postGres.

### Visual DB Managers (Optional)
- TablePlus
- Sequel Pro
- Querious 2


### 

PostController.php
```
    public function showFromDB($slug)
    {
        $postFromDB = \DB::table('posts')->where('slug', $slug)->first();

        //DD = Dump and Die -> to inspect a variable.
        //dd($postFromDB);

        return view('post', [
            'postFromDB' => $postFromDB
        ]);
    }
```

DD($postFromDB) - Output:
```
{#278 ▼
  +"id": 1
  +"slug": "my-first-post"
  +"body": "This is my first post."
}
```

post.blade.php - View:
```
<h1>A Blog Post FETCHED from DB</h1>
<p>{{ $post->body}}</p>
<!-- $post is an object and body its property -->
```



## Hello Eloquent

Eloquent Models allow to...
- use SQL queries
- store distance logic

### Create an Eloquent Model
In your terminal:
```
cd <your project folder>
php artisan make:model Post
```

...will create **App/Post.php**.


### Steps
1. Create Eloquent Model
2. Import Model into your controller: `use App\Post;`
3. Implement in your Controller function:

```
// Eloquent Models
    public function showUsingEloquentModels($slug)
    {
        //Querying from DB via Eloquent Model.
        $post = Post::where('slug', $slug)->firstOrFail(); //replaces an abort(404);

        return view('postsEloquent', [
            'post' => $post
        ]);
    }
```


## Migrations 101
Migrations give us a programmatic way to...
- define a table
- make a change in an existing table
- sorta of perform version control for tables

Benefits?
- Made a mistake? Simply rollback (down())
- Want to migrate to colleagues dev environment? He will have the exact same state of the DB.


### Create a table (A)
1. create a table template via terminal:
`php artisan make:migration create_<tablename>_table`.
This creates a file in **database/migrations/**Create<tablename>Table

2. Setup your up() and down() functions in the Create<tablename>Table class.

3. run `php artisan migrate`


### Add a row to a table (B)
1. In terminal: `php artisan make:migration add_title_to_posts_table`

2. Define up() and down() functions:

```
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->string('title');    //create change
        });
    }

    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn(('title'));  //reverse change
        });
    }
```


#### When to use what approach (A or B)?
- If your databases are empty, define rows in (A)
- If your databases already contain data, define rows in (B)

Note: Droping and re-running table creation migrations leads to a loss of all stored data.

### Relevant Artisan commands for migrations
```
php artisan make:migration create_<tablename>_table
php artisan migrate //forward
php artisan migrate:rollback	//backward
php artisan migrate:fresh //drops all tables, reruns everything from scratch
php artisan //lists all artisan commands
```


## Generate Multiple Files in a Single Command

In each project, we create migrations for managing the database, controllers for defining the locig to routing and models to simplify / define sql queries.

```
php artisan make:...
- migrations
- controller
- model <project name>
```
For convenience, you can create all these three files in one single command:
` php artisan make:model <project name> -mc `


### Flags
-c = controller
-m = migrations

Listing all flags (options):
`php artisan help make:model`


### Repetition: File Locations
- Migrations are at **database/migrations/...**
- Controllers are at **app/Http/Controllers/...**
- Models are at **app/..**



## Business Logic

### php artisan tinker

--> a laravel & PHP playground you can experiment with everything laravel has to offer. Use it! You can execute commands, functions, calculations, etc in the command line.

__Sode note:__
Check commands / steps used in tinker to reproduce:
https://laracasts.com/series/laravel-6-from-scratch/episodes/13?autoplay=true


### Creating a DB default value in the migrations

```
public function up()
{
    Schema::create('assignments', function (Blueprint $table) {
    	...
        $table->boolean('completed')->default('false'); 
        ...
    });
}
```

### Changing / Setting value of a Model in DB
Similar to an object

```
class Assignment extends Model
{
    public function complete()
    {
        //update "completed" field in DB:
        $this->completed = true;
        $this->save();	//stores permanently to DB.
    }
}
```


# Appendix

## SQL

### Data Types
- Serial: primary key. Value is numerical, not null and increments automatically.


### Handle "Post not found"

In your Controller's function, either...
```
//If post doesn't exist in DB
if (! $postFromDB) {
    abort(404);
}
```

or

```
//Querying from DB via Eloquent Model.
$post = Post::where('slug', $slug)->firstOrFail(); //FirstOrFail() executes an abort(404) if Fail;
```

## Issues and Fixes

### Undefined type 'App\Http\Controllers\DB'.intelephense(1009)

Laravel's **DB** facade is defined in global namespace. Either use `\DB` or declare is via `use DB` before the class declaration to access it within a class/function.

Source: [Class 'App\Http\Controllers\DB' not found and I also cannot use a new Model](https://stackoverflow.com/questions/26966652/class-app-http-controllers-db-not-found-and-i-also-cannot-use-a-new-model)


### Having $post and $postFromDB in same File caused an error

```
<h1>My Blog Post</h1>
<!--<p>{{ $post }}</p>-->

<h1>A Blog Post FETCHED from DB</h1>
<p>{{ $postFromDB->body }}</p>
<!-- $post is an object and body its property -->
```

TBD: Find out what the reason is.
Resolved by: Distributing the two variables into separate files.


### PDO (and any other) extension not loading
1. Setup global path for PHP to `C:\MAMP\bin\php\php7.3.7`
2. In php.ini, uncomment `;extension_dir="ext"`
3. In php.ini, uncomment your extension of choise. E.g. `;extension=pdo_mysql`

Uncommenting means removing the **;** character.


### timespams()->nullable() throws error
Remove the s in timestamp**s**(), then it will work.

`$table->timestamp('due_date')->nullable();`