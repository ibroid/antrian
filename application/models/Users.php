<?php

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
  protected $table = "users";
  protected $guarded = [];


  /**
   * Inisialisasi event ketika model dibuat
   * @return void
   */
  public static function booted()
  {
  }

  /**
   * Relasi ke tabel role. 
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo The belongsTo relationship.
   */
  public function role()
  {
    return $this->belongsTo(Roles::class);
  }

  /**
   * Hash password sebelum disimpan. Password dicampur dengan salt.
   * @param string $value
   */
  public function setPasswordAttribute($value)
  {
    $this->attributes['password'] = password_hash(
      $value . $this->attributes['salt'],
      PASSWORD_BCRYPT
    );
  }

  /**
   * Mendefinisikan relasi 1:1 antara model Users dan Petugas.
   * @return \Illuminate\Database\Eloquent\Relations\HasMany
   */
  public function petugas()
  {
    return $this->hasOne(Petugas::class, 'user_id', 'id');
  }
}
