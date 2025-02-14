<?php
$user = $this->session->userdata('user_login');
?>

<div class="nav-right col-xxl-7 col-xl-6 col-md-7 col-8 pull-right right-header p-0 ms-auto">
    <ul class="nav-menus">
        <li>
            <a href="<?= base_url("mobile/beranda") ?>">
                <svg>
                    <use href="<?= base_url() ?>assets/svg/icon-sprite.svg#star"></use>
                </svg>
            </a>
        </li>
        <li>
            <div class="mode">
                <svg>
                    <use href="<?= base_url() ?>assets/svg/icon-sprite.svg#moon"></use>
                </svg>
            </div>
        </li>

        <li class="onhover-dropdown">
            <div class="notification-box">
                <svg>
                    <use href="<?= base_url() ?>assets/svg/icon-sprite.svg#notification"></use>
                </svg><span class="badge rounded-pill badge-secondary">new </span>
            </div>
            <div class="onhover-show-div notification-dropdown">
                <h6 class="f-18 mb-0 dropdown-title">Notitications </h6>
                <ul>
                    <li class="b-l-primary border-4">
                        <p>Update Cooming Soon 😇 <span class="font-danger">10 min.</span></p>
                    </li>
                    <!-- <li class="b-l-success border-4">
                        <p>Order Complete<span class="font-success">1 hr</span></p>
                    </li>
                    <li class="b-l-secondary border-4">
                        <p>Tickets Generated<span class="font-secondary">3 hr</span></p>
                    </li>
                    <li class="b-l-warning border-4">
                        <p>Delivery Complete<span class="font-warning">6 hr</span></p>
                    </li>
                    <li><a class="f-w-700" href="#">Check all</a></li> -->
                </ul>
            </div>
        </li>
        <li class="profile-nav onhover-dropdown pe-0 py-0">
            <div class="media profile-media">
                <img class="b-r-10" src="https://api.dicebear.com/7.x/adventurer/svg?size=65&backgroundColor=b6e3f4&seed=<?= $user['avatar'] ?? null ?>" alt="avatar" />
                <div class="media-body"><span><?= $user['name'] ?? null ?></span>
                    <p class="mb-0"><?= $user['role']['role_name'] ?? null  ?> <i class="middle fa fa-angle-down"></i></p>
                </div>
            </div>
            <ul class="profile-dropdown onhover-show-div">
                <!-- <li><a href="<?= base_url('profile') ?>"><i data-feather="user"></i><span>Profile </span></a></li> -->
                <!-- <li><a href="#"><i data-feather="mail"></i><span>Inbox</span></a></li> -->
                <li><a href="<?= base_url("/menu") ?>"><i data-feather="home"></i><span>Menu</span></a></li>
                <li>
                    <?php $setting_url = $this->is_admin ? 'pengguna/setting/' : 'pelayanan/user_setting/' ?>
                    <a href="<?= base_url($setting_url . Cypher::urlsafe_encrypt($this->user['id'])) ?>"><i data-feather="user"></i><span>Setting</span></a>
                </li>
                <li>
                    <form action="<?= base_url('auth/logout') ?>" id="logoutForm" method="POST">
                    </form>
                    <a href="javascript:void(0)" onclick="document.getElementById('logoutForm').submit()"><i data-feather="log-out"> </i><span>Log Out</span>
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</div>