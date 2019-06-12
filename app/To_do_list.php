<?php

namespace App;

use App\Events\Created;
use App\Events\Deleted;
use App\Events\StatusChange;
use App\Events\Updated;
use Illuminate\Database\Eloquent\Model;

class To_do_list extends Model
{
    protected $table='to_do_list';
    protected $fillable=(['title', 'description', 'deleted', 'status', 'deadline', 'user_id']);


    protected $dispatchesEvents = [
        'created'       => Created::class,
        'deleted'       => Deleted::class,
        'updated'       => Updated::class,
        'statusChange'  => statusChange::class,
    ];


}
