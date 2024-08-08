<?php

use Illuminate\Database\Eloquent\Model;

class IdentitasPihakDatatable extends Model
{
  protected $table = 'identitas_pihak';
  protected $fillable = ['nama_lengkap', 'nik', 'alamat', 'jenis_kelamin'];
  protected $primaryKey = 'id';
  protected $columnSearch = ['nama_lengkap', 'nik', 'alamat', 'jenis_kelamin'];
  protected $columnOrder = [null, 'nama_lengkap', 'nik', 'alamat', 'jenis_kelamin', null];
  protected $defaultOrder = ['id' => 'desc'];

  public function getData()
  {
    $query = $this->query();
    // echo "<pre>";
    // print_r($this->columnOrder[R_Input::pos('order')['0']['column']]);
    $query = $this->applyFilters($query, R_Input::pos('search')['value']);

    if (R_Input::pos('order')) {
      $query->orderBy(
        $this->columnOrder[R_Input::pos('order')['0']['column']],
        R_Input::pos('order')['0']['dir']
      );
    } else {
      $query->orderBy(key($this->defaultOrder), $this->defaultOrder[key($this->defaultOrder)]);
    }

    $start = R_Input::pos('start');
    $length = R_Input::pos('length');
    if ($length != -1) {
      $query->skip($start)->take($length);
    }

    return $query->get();
  }

  public function countData()
  {
    $query = $this->query();

    $query = $this->applyFilters($query, R_Input::pos('search')['value']);
    return $query->count();
  }

  private function applyFilters($query, $searchValue)
  {

    if ($searchValue) {
      $query->where(function ($query) use ($searchValue) {
        foreach ($this->columnSearch as $column) {
          $query->orWhere($column, 'like', '%' . $searchValue . '%');
        }
      });
    }
    return $query;
  }
}
