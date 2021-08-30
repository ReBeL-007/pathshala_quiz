<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Setting extends Model
{
    //
    use SoftDeletes;

    protected $dates = [
      'created_at',
      'updated_at',
  ];
  
    protected $fillable = [
      'title',
      'logo',
      'favicon',
      'copyright',
      'footer-logo',
      'theme_color',
      'description',
      'created_at',
      'updated_at',
      'deleted_at',
  ];

}
