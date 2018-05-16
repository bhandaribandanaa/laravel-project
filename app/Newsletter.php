<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Newsletter extends Model
{
     /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'newsletter';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['email'];

    public static function findByEmail($email)
    {
        return Newsletter::where('email', $email)->first();
    }
}
