## Repottern - A repository pattern for Laravel >= 5
Those who are working with MVC and want to work in Thin Model, Thin Controller, Fat Repository. This one will do this for you.
This works like the Laravel Eloquent does. Exactly the same, with some extra features.

## Requirements:
* Laravel 5+
* PHP  5.6+

## How to install
`composer require anik/repottern`

## Usages
To make it use, you've to create a Class, where your Class which will extend `Anik\Repottern\BaseRepository` , next implement the model method from that class and you're done.

Now, you can inject this class to method, to constructor, or can call the methods statically using that class. 

Assuming you've an User model. Now,

```php
<?php
// Repository
class UserRepository extends BaseRepository
{
	public function model ()
	{
		return User::class;
	}	
	
	protected function findUserWithWildCard()
	{
	    return $this->where('username', 'LIKE', "%n%")->get();
	}
}
```

```php
<?php
// From controller
class HomeController extends Controller
{
    public function controllerMethod(UserRepository $repository)
    {
        # return $repository->with('role')->get();
        # return $repository->paginate(10);
        # return $repository->find(10);
        # return $repository->findUserWithWildCard();
        
        # return UserRepository::with('role')->get();
        # return UserRepository::paginate(10);
        # return UserRepository::find(10);
        # return UserRepository::findUserWithWildCard();
        
    }
}
```

_Things to note in here, to call the methods statically with the class name, you MUST have to use the **protected** access modifier with that method name_

## License
Repottern is released under the MIT Licence.

## Bugs and Issues
If you find any bug or other issues, please open an issue and let me know. Forks are always welcomed. 