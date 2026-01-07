<div class="card">
  <div class="card-header m-0 p-3">
    <h5 class="m-0">Online User</h5>
  </div>
  <div class="card-body pt-0">
    <div class="appointment-table table-responsive">
      <table class="table table-bordernone">
        <tbody>
          <?php foreach ($this->eloquent->table("user_session")->selectRaw('users.*,user_session.created_at as time_login')->limit('4')->leftJoin('users', 'user_session.user_id', '=', 'users.id')->latest('user_session.created_at')->get() as $n => $user) { ?>
            <tr>
              <td> <img class="b-r-10" src="https://api.dicebear.com/7.x/adventurer/svg?size=40&backgroundColor=b6e3f4&seed=<?= $user->avatar ?>" alt="avatar" /></td>
              <td class="img-content-box"><a class="d-block f-w-500" href="user-profile.html"><?= $user->name ?></a><span class="f-light"><?= $user->time_login ?></span></td>
              <td class="text-end">
                <p class="m-0 font-success">Online</p>
              </td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
      <div class="text-center mt-3">
        <a href="javacript:void(0)" data-bs-toggle="modal" data-bs-target="#modal-detail-online-user" ">
          <i class=" bi bi-eye"></i>
          Detail
        </a>
      </div>
    </div>
  </div>
</div>


<!-- Modal -->
<div class="modal fade" id="modal-detail-online-user" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Detail Online User</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>