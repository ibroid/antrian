<div class="card">
  <div class="card-header card-no-border">
    <div class="header-top">
      <h5 class="m-0">Online User</h5>
    </div>
  </div>
  <div class="card-body pt-0">
    <div class="appointment-table table-responsive">
      <table class="table table-bordernone">
        <tbody>
          <?php foreach ($this->eloquent->table("user_session")->selectRaw('users.*,user_session.created_at as time_login')->leftJoin('users', 'user_session.user_id', '=', 'users.id')->latest('user_session.created_at')->get() as $n => $user) { ?>
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
    </div>
  </div>
</div>