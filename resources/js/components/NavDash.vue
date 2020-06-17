<template lang="html">
  <div class="sidebar-wrapper">
    <ul class="nav">
      <li class="nav-item">
        <router-link to="/dashboard" class="nav-link activated">
          <i class="material-icons">dashboard</i>
          <p>
            Dashboard
          </p>
        </router-link>
      </li>

      <li class="nav-item">
        <a href="#" id="menuToggle" class="nav-link">
          <p>
            Management
            <i class="material-icons">settings</i>
          </p>
        </a>
        <ul class="nav" id="menu" style="display:none;">
          <li class="nav-item">
            <router-link to="/admin" class="nav-link">
              <i class="material-icons">how_to_reg</i>
              <p>Admins</p>
            </router-link>
          </li>

          <li class="nav-item">
            <router-link to="/teacher" class="nav-link">
              <i class="material-icons">person</i>
              <p>Teachers</p>
            </router-link>
          </li>

          <li class="nav-item">
            <router-link to="/student" class="nav-link">
              <i class="material-icons">people</i>
              <p>Student</p>
            </router-link>
          </li>

          <li class="nav-item">
            <router-link to="/module" class="nav-link">
              <i class="material-icons">assignment</i>
              <p>Module</p>
            </router-link>
          </li>

          <li class="nav-item">
            <router-link to="/filliere" class="nav-link">
              <i class="material-icons">assignment_turned_in</i>
              <p>Filliere</p>
            </router-link>
          </li>
          <li class="nav-item">
            <router-link to="/element" class="nav-link">
              <i class="material-icons">assignment_turned_in</i>
              <p>Element</p>
            </router-link>
          </li>
          <li class="nav-item">
            <router-link to="/department" class="nav-link">
              <i class="material-icons">assignment_turned_in</i>
              <p>Department</p>
            </router-link>
          </li>
          <li class="nav-item">
            <router-link to="/attendance" class="nav-link">
              <i class="material-icons">assignment_turned_in</i>
              <p>Attendance</p>
            </router-link>
          </li>
        </ul>
      </li>

      <li class="nav-item">
        <router-link to="/attendance" class="nav-link">
          <i class="material-icons">assignment_turned_in</i>
          <p>Absence</p>
        </router-link>
      </li>
      <li class="nav-item">
        <router-link to="/calendar" class="nav-link">
          <i class="material-icons">calendar_today</i>
          <p>Calendar</p>
        </router-link>
      </li>
      <li class="nav-item">
        <a
          class="nav-link"
          href="{{ route('logout') }}"
          onclick="event.preventDefault();
                         document.getElementById('logout-form').submit();"
        >
          <i class="material-icons">logout</i>
          <p>{{ __("Logout") }}</p>
        </a>

        <form
          id="logout-form"
          action="{{ route('logout') }}"
          method="POST"
          style="display: none;"
        >
          @csrf
        </form>
      </li>
    </ul>
  </div>
</template>

<script>
export default {};
</script>

<style lang="css" scoped></style>
