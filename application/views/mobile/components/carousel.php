<div class="carousel slide" id="carouselExampleInterval" data-bs-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active" data-bs-interval="10000"><img class="d-block w-100" src="<?= base_url('/uploads/images/Loading.gif') ?>" alt="drawing-room"></div>

    <?php foreach ($this->eloquent->table("banner_pengumuman")->get() as $b) { ?>
      <div class="carousel-item" data-bs-interval="10000"><img class="d-block w-100" src="/uploads/banner/<?= $b->filename ?>" alt="drawing-room"></div>
    <?php } ?>

  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="prev"><span class="carousel-control-prev-icon" aria-hidden="true"></span><span class="visually-hidden">Previous</span></button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="next"><span class="carousel-control-next-icon" aria-hidden="true"></span><span class="visually-hidden">Next</span></button>
</div>