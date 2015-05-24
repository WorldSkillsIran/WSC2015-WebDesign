<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Route extends Model {

    protected $fillable = ['from', 'to', 'user_id', 'type', 'time'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

}
