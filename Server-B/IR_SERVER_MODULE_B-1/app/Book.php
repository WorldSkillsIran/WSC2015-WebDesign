<?php namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property  route
 *a @property  user
 */
class Book extends Model
{

    public function route()
    {
        return $this->belongsTo('Route');
    }

    public function user()
    {
        return $this->belongsTo('User');
    }
}
