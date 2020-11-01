<?php

namespace App;
use Illuminate\Database\Eloquent\Model;use Illuminate\Support\Facades\App;

class Task extends Model
{
//    protected $table = 'tasks';
protected $fillable = ['name','contents','deadline','status','priority'];
}
