<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'users';

    public $sortable = ['first_name'];

    /**
     * @param $id
     * @return mixed
     */
    public static function getFullName($id)
    {
        $user = User::select(['first_name', 'last_name'])->find($id);

        return $user->first_name . ' ' . $user->last_name;
    }
}
