# Repository Pattern For Laravel

This package provides the base repository interface and Implementation based on it, like `Hanksie\Repository\EloquentRepository`

## Usage

Eloquent:

```php
use Hanksie\Repository\EloquentRepository;
use App\Models\User;

class UserRepository extends EloquentRepository {
    public function __construct(
        protected User $user
    ){}
}
```

Note that if your eloquent repository requires global scope constraints, you should call the `applySearch` method. The method integrates `applyFilter`, `applyWith` and `applyOrder`.
`applyWith` and `applyOrder` only return `\Illuminate\Database\Eloquent\Builder` defaults, you can override them.
