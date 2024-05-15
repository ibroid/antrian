<?php

use Illuminate\Database\Eloquent\Model;

class PesananProdukDatatable extends Model
{

  protected $table = 'produk_pengadilan';
  protected $fillable = ['nomor_perkara', 'nomor_akta_cerai', 'jenis_perkara', 'nama_pengambil', 'jenis_pihak', 'jenis_produk'];
  protected $primaryKey = 'id';
  protected $columnSearch = ['nomor_perkara', 'nomor_akta_cerai', 'jenis_perkara', 'nama_pengambil', 'jenis_pihak', 'jenis_produk'];
  protected $defaultOrder = ['id' => 'asc'];

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

    $query->whereDate('created_at', date('Y-m-d'));

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
