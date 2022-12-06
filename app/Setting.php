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
      'rightclick',
      'inspect',
      'wel_email',
      'w_email_enable',
      'meta_data_desc',
      'meta_data_keyword',
      'google_ana',
      'fb_login_enable',
      'gitlab_login_enable',
      'google_login_enable',
  ];

}
