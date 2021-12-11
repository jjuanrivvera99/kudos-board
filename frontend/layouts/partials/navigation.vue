<template>
  <!-- Start Header -->
  <header class="fixed-topx header">
    <nav v-if="$auth.loggedIn" class="navbar navbar-expand-lg navbar-dark align-items-center">
      <nuxt-link class="navbar-brand text-uppercase fw-500" :to="{ name: 'index'}">Kudos Board</nuxt-link>
      <button class="navbar-toggler mr-auto" type="button" data-toggle="collapse" data-target="#navbar"
        aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div id="navbar" class="collapse navbar-collapse">
        <ul class="navbar-nav font-14 fw-300">
          <li class="nav-item active">
            <a class="nav-link" href="#" title="Boards">Boards</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#" title="Users"> Users </a>
          </li>
        </ul>
        <div class="header-search">
          <form action="" method="">
            <div class="form-group">
              <input type="text" autocomplete="OFF" name="search" class="form-control text-white font-14 fw-300"
                placeholder="Search and hit enter..." />
              <div class="search-icon text-white">
                <i class="fas fa-search"></i>
              </div>
            </div>
          </form>
        </div>
        <div class="upload-shot white-path font-14 fw-500 text-uppercase mr-auto" @click="openModal">
          <a href="#" class="primary-bg-color text-white">
            <i class="fas fa-plus"></i> Kudos
          </a>
        </div>
      </div>

      <template v-if="!$auth.loggedIn">
        <!-- Before Login -->
        <ul class="before-login font-14 fw-300 text-uppercase">
          <li>
            <nuxt-link :to="{ name: 'register'}">Sign up</nuxt-link>
          </li>
          <li>
            <nuxt-link :to="{ name: 'login'}">Login</nuxt-link>
          </li>
        </ul>
        <!-- End Before Login -->
      </template>


      <template v-if="$auth.loggedIn">
        <!-- After Login -->
        <ul class="author-page white-path">
          <!-- Profile Dropdown -->
          <li class="dropdown">
            <a id="userDropdown" href="#" class="dropdown-toggle text-white" role="button" data-toggle="dropdown"
              aria-haspopup="true" aria-expanded="false">
              <img class="user-thumb" src="~/assets/images/profile.png"/>
              <div class="usr-info">
                <span class="user-name font-14 fw-500">{{ $auth.user.name }}</span>
                <!-- <span class="user-deg font-10 fw-300">Sr. UI Designer</span> -->
                <span class="down-chevron">
                  <i class="fa fa-angle-down"></i>
                </span>
              </div>
            </a>
            <div class="dropdown-menu user-dropdown font-14 fw-500" aria-labelledby="userDropdown">
              <div class="dropdown-title-group font-12 fw-500">
                <span class="dropdown-title text-uppercase">Your Account</span>
              </div>
              <a class="dropdown-item mt-28" href="#" title="Profile">
                <i class="fa fa-user"></i>
                Profile
              </a>
              <a class="dropdown-item" href="#" title="Setting">
                <i class="fa fa-cogs"></i>
                Setting
              </a>
              <div class="dropdown-divider"></div>
              <a title="Sign Out" class="dropdown-item" href="#" @click="logout">
                <i class="fa fa-lock"></i>
                Sign Out
              </a>
            </div>
          </li>
          <!-- End Profile Dropdown -->
        </ul>
        <!-- End After Login -->
      </template>
    </nav>
  </header>
  <!-- End Header -->
</template>

<script>
export default {
  methods: {
    logout() {
      this.$axios.post('/api/logout');
      this.$auth.logout()
    },
    openModal() {
      this.$bvModal.show('modal');
    }
  }
}
</script>
