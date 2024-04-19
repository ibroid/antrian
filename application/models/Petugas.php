<?php

use Illuminate\Database\Eloquent\Model;

class Petugas extends Model
{
  /**
   * Mendefinisikan nama tabel pada database.
   * @var string
   */
  protected $table = 'petugas';

  /**
   * Mendefinisikan mass assignment. 
   * Yaitu kolom mana saja pada tabel yang boleh diisi.
   * @var array
   */
  protected $guarded = [];

  /**
   * Mendefinisikan relasi antar model.
   * Kolom user_id adalah foreign key dari tabel users.
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function user()
  {
    return $this->belongsTo(Users::class, 'user_id', 'id');
  }
}
