<template>
  <div class="container">
    <h2 style="text-transform:capitalize; font-size:3vw;">
      {{ capitalize(this.$parent.currentComponent) }}
    </h2>
    <div class="row">
      <div class="card">
        <div
          class="card-header"
          v-bind:class="{
            'card-header-primary': !editMode,
            'card-header-danger': editMode
          }"
        >
          <h4 class="card-title" v-if="!editMode">Add Admins</h4>
          <h4 class="card-title" v-else>Edit Admins</h4>
        </div>
        <div class="card-body">
          <form
            @submit.prevent="editMode ? updateAdmin() : createAdmin()"
            @keydown="form.onKeydown($event)"
          >
            <div class="row">
              <div class="form-group col-md-6">
                <label class="bmd-label-floating">First Name</label>
                <input
                  v-model="form.firstname"
                  type="text"
                  name="firstname"
                  class="form-control"
                  :class="{ 'is-invalid': form.errors.has('firstname') }"
                />
                <has-error :form="form" field="firstname"></has-error>
              </div>

              <div class="form-group col-md-6">
                <label class="bmd-label-floating">Last Name</label>
                <input
                  v-model="form.lastname"
                  type="text"
                  name="lastname"
                  class="form-control"
                  :class="{ 'is-invalid': form.errors.has('lastname') }"
                />
                <has-error :form="form" field="lastname"></has-error>
              </div>
            </div>
            <div class="row">
              <div class="form-group col-md-6">
                <label class="bmd-label-floating">Email</label>
                <input
                  v-model="form.email"
                  type="email"
                  name="email"
                  class="form-control"
                  :class="{ 'is-invalid': form.errors.has('email') }"
                />
                <has-error :form="form" field="email"></has-error>
              </div>

              <div class="form-group col-md-6">
                <label class="bmd-label-floating">Password</label>
                <div class="input-group mb-2">
                  <div class="input-group-prepend">
                    <div class="input-group-text">
                      <i
                        id="toggleButton"
                        class="material-icons"
                        v-on:click="togglePassword()"
                        >visibility</i
                      >
                    </div>
                  </div>
                  <input
                    id="passwordInput"
                    v-model="form.password"
                    type="password"
                    name="password"
                    class="form-control"
                    :class="{ 'is-invalid': form.errors.has('password') }"
                  />
                  <has-error :form="form" field="password"></has-error>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="form-group col-md-6">
                <label class="bmd-label-floating">CIN</label>
                <input
                  v-model="form.cin"
                  type="text"
                  name="cin"
                  class="form-control"
                  :class="{ 'is-invalid': form.errors.has('cin') }"
                />
                <has-error :form="form" field="cin"></has-error>
              </div>
              <div class="form-group col-md-6">
                <label class="bmd-label-floating">Phone</label>
                <input
                  v-model="form.phone"
                  type="text"
                  name="phone"
                  class="form-control"
                  :class="{ 'is-invalid': form.errors.has('phone') }"
                />
                <has-error :form="form" field="phone"></has-error>
              </div>
            </div>

            <button
              type="submit"
              v-show="!editMode"
              class="btn btn-primary btn-round pull-right"
            >
              Add Admin
            </button>
            <button
              type="submit"
              v-show="editMode"
              class="btn btn-warning btn-round pull-right"
            >
              Edit Admin
            </button>
          </form>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title ">Admins Table</h4>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table">
                <thead class=" text-primary">
                  <tr>
                    <th>
                      ID
                    </th>
                    <th>
                      Full Name
                    </th>
                    <th>
                      Email
                    </th>
                    <th>
                      CIN
                    </th>
                    <th>
                      Phone
                    </th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="admin in admins.data" :key="admin.id">
                    <td class="text-primary">
                      {{ admin.id }}
                    </td>
                    <td>{{ admin.firstname }} {{ admin.lastname }}</td>
                    <td>{{ admin.email }}</td>
                    <td>{{ admin.cin }}</td>
                    <td>{{ admin.phone }}</td>
                    <td>
                      <button
                        class="btn btn-info btn-outline-warning btn-md"
                        @click="editAdmin(admin)"
                      >
                        <i class="material-icons">edit</i>
                      </button>
                      <button
                        class="btn btn-info btn-outline-danger btn-md"
                        @click="deleteAdmin(admin.id)"
                      >
                        <i class="material-icons">delete</i>
                      </button>
                    </td>
                  </tr>
                </tbody>
              </table>
              <pagination :data="admins" @pagination-change-page="getAdmins">
                <span slot="prev-nav">&lt; Previous</span>
                <span slot="next-nav">Next &gt;</span>
              </pagination>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<style scoped>
label {
  color: black !important;
}

.nav-tabs .nav-item .nav-link.active {
  background-color: #9a33b2;
  color: white !important;
}

.nav-tabs .nav-item .nav-link,
.nav-tabs .nav-item .nav-link:hover,
.nav-tabs .nav-item {
  color: grey !important;
}

.nav-link:focus {
  color: white !important;
}
</style>
<script>
export default {
  data() {
    return {
      pro: profile,
      admins: {},
      editMode: false,
      form: new Form({
        id: "",
        firstname: "",
        lastname: "",
        email: "",
        password: "",
        cin: "",
        phone: ""
      })
    };
  },
  methods: {
    createAdmin() {
      this.form.post("/api/admin").then(({ data }) => {
        this.getAdmins();
        Toast.fire({
          icon: "success",
          title: "Admin created successfully"
        });
        this.form.reset();
      });
    },
    capitalize(str) {
      let name = str.split("/");
      return name[1];
    },
    togglePassword() {
      let input = document.getElementById("passwordInput");
      let icon = document.getElementById("toggleButton");
      if (input.type == "password") {
        input.type = "text";
        icon.innerHTML = "visibility_off";
      } else {
        input.type = "password";
        icon.innerHTML = "visibility";
      }
    },
    getAdmins(page = 1) {
      axios
        .get("api/admin?page=" + page)
        .then(({ data }) => (this.admins = data));
    },
    editAdmin(admin) {
      this.editMode = true;
      this.form.fill(admin);
      this.form.password = admin.password;
    },
    updateAdmin() {
      this.form.put("api/admin/" + this.form.id);
      this.editMode = false;
      this.form.reset();
      this.getAdmins();
      Toast.fire({
        icon: "success",
        title: "Admin updated successfully"
      });
    },
    deleteAdmin(id) {
      Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!"
      }).then(result => {
        if (result.value) {
          this.form.delete("api/admin/" + id);
          this.getAdmins();

          Swal.fire("Deleted!", "Admin has been deleted.", "success");
        }
      });
    }
  },
  created() {
    this.getAdmins();
  }
};
</script>
