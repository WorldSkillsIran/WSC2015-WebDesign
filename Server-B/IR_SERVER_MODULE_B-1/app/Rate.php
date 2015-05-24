<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{

    protected $fillable = ['from', 'to', 'rate'];

    public function from()
    {
        return $this->belongsTo('User', 'from');
    }

    public function to()
    {
        return $this->belongsTo('User', 'to');
    }

}
