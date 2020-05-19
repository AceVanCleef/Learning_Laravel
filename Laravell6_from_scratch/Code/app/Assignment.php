<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    public function complete()
    {
        //update "complete" field in DB:
        $this->completed = true;
        $this->save();
    }
}
