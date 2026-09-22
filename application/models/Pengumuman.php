<?php

use Illuminate\Database\Eloquent\Model;

class Pengumuman extends Model
{
  protected $table = 'template_audio_pengumuman';
  protected $fillable = ['judul', 'template'];
}
