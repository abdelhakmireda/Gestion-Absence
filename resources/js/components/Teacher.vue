<template>
  <div class="container">
    <div class="row">
      <div class="card">
        <div
          class="card-header"
          v-bind:class="{
            'card-header-primary': !editMode,
            'card-header-danger': editMode
          }"
        >
          <h4 class="card-title" v-if="!editMode">Add Teachers</h4>
          <h4 class="card-title" v-else>Edit Teacher</h4>
        </div>
        <div class="card-body">
          <form
            @submit.prevent="editMode ? updateTeacher() : createTeacher()"
            @keydown="form.onKeydown($event)"
          >
            <div class="row">
              <div class="form-group col-md-6">
                <label>First Name</label>
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
                <label>Last Name</label>
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
                <label>Email</label>
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
                <label>Password</label>
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
                <label>CIN</label>
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
                <label>Phone</label>
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
            <button type="submit" v-show="!editMode" class="btn btn-primary">
              Add teacher
            </button>
            <button type="submit" v-show="editMode" class="btn btn-warning">
              Edit teacher
            </button>
          </form>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title ">Teachers Table</h4>
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
                  <tr v-for="teacher in teachers" :key="teacher.id">
                    <td class="text-primary">{{ teacher.id }}</td>
                    <td>{{ teacher.firstname }} {{ teacher.lastname }}</td>
                    <td>{{ teacher.email }}</td>
                    <td>{{ teacher.cin }}</td>
                    <td>{{ teacher.phone }}</td>
                    <td>
                      <button
                        class="btn btn-info btn-outline-warning btn-md"
                        @click="editTeacher(teacher)"
                      >
                        <i class="material-icons">edit</i>
                      </button>
                      <button
                        class="btn btn-info btn-outline-danger btn-md"
                        @click="deleteTeacher(teacher.id)"
                      >
                        <i class="material-icons">delete</i>
                      </button>
                    </td>
                  </tr>
                </tbody>
              </table>
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
      editMode: false,
      teachers: {},
      errors: {},
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
    createTeacher() {
      this.form
        .post("/api/teacher")
        .then(({ data }) => {
          this.getTeachers();
          this.form.reset();
          Toast.fire({
            icon: "success",
            title: "Teacher added successfully"
          });
        })
        .catch(err => {
          this.errors = err.response.data.errors;
        });
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
    getTeachers() {
      axios.get("api/teacher").then(({ data }) => (this.teachers = data.data));
    },
    editTeacher(teacher) {
      this.editMode = true;
      this.form.fill(teacher);
    },
    updateTeacher() {
      this.form.put("api/teacher/" + this.form.id);
      this.editMode = false;
      this.form.reset();
      this.getTeachers();
      Toast.fire({
        icon: "success",
        title: "Teacher updated successfully"
      });
    },
    deleteTeacher(id) {
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
          this.form.delete("api/teacher/" + id);
          this.getTeachers();
          Swal.fire("Deleted!", "Your file has been deleted.", "success");
        }
      });
    },
    resetForm() {
      Object.keys(this.form).forEach(key => {
        return (this.form[key] = "");
      });
    }
  },
  created() {
    this.getTeachers();
  }
};
</script>
