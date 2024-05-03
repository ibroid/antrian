<?php

use Illuminate\Database\Eloquent\Model;

class AntrianPtspDatatable extends Model
{

  protected $table = 'antrian_pelayanan';
  protected $fillable = ['nomor_urutan', 'tujuan', 'kode', 'status', 'pegawai_id'];
  protected $primaryKey = 'id';
  protected $columnSearch = ['nomor_urutan', 'tujuan', 'kode', 'status', 'pegawai_id'];
  protected $defaultOrder = ['id' => 'asc'];

  public $condition = null;


  public function __construct()
  {
    parent::__construct();
  }


  public function getData()
  {

    $query = $this->query();

    $query = $this->applyFilters($query, R_Input::pos('search')['value']);

    if (R_Input::pos('order')) {
      $query->orderBy($this->columnOrder[R_Input::pos('order')['0']['column']], R_Input::pos('order')['0']['dir']);
    } else {
      $query->orderBy(key($this->defaultOrder), $this->defaultOrder[key($this->defaultOrder)]);
    }

    $start = R_Input::pos('start');
    $length = R_Input::pos('length');
    if ($length != -1) {
      $query->skip($start)->take($length);
    }

    $query->whereDate('created_at', date('Y-m-d'));
    if ($this->condition) {
      $query->where($this->condition);
    }

    return $query->get();
  }

  public function countData()
  {
    $query = $this->query();
    $query->whereDate('created_at', date('Y-m-d'));
    if ($this->condition) {
      $query->where($this->condition);
    }

    $query = $this->applyFilters($query, R_Input::pos('search')['value']);
    return $query->count();
  }

  private function applyFilters($query, $searchValue)
  {
    $query->whereDate('created_at', date('Y-m-d'));
    if ($this->condition) {
      $query->where($this->condition);
    }

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
