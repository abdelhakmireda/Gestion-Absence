<template>
  <!--
            container
                row
                    card
                        card-header + card-body(form)


        -->
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
          <h4 class="card-title" v-if="!editMode">Add Students</h4>
          <h4 class="card-title" v-else>Edit Students</h4>
        </div>
        <div class="card-body">
          <form
            class="m-3"
            @submit.prevent="editMode ? updateStudent() : createStudent()"
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
                <label>CNE</label>
                <input
                  v-model="form.cne"
                  type="text"
                  name="cne"
                  class="form-control"
                  :class="{ 'is-invalid': form.errors.has('cne') }"
                />
                <has-error :form="form" field="cne"></has-error>
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
            <div class="row">
              <div class="form-group col-md-6">
                <label>Filliere</label>
                <input
                  v-model="form.filliere"
                  type="text"
                  name="filliere"
                  class="form-control"
                  :class="{ 'is-invalid': form.errors.has('filliere') }"
                />
                <has-error :form="form" field="filliere"></has-error>
              </div>
              <div class="form-group col-md-6">
                <label>Annee Scolaire</label>
                <input
                  v-model="form.anneescolaire"
                  type="text"
                  name="anneescolaire"
                  class="form-control"
                  :class="{ 'is-invalid': form.errors.has('anneescolaire') }"
                />
                <has-error :form="form" field="anneescolaire"></has-error>
              </div>
            </div>
            <div class="row">
              <div class="form-group col-md-6">
                <label>Semester</label>
                <input
                  v-model="form.semester"
                  type="text"
                  name="semester"
                  class="form-control"
                  :class="{ 'is-invalid': form.errors.has('semester') }"
                />
                <has-error :form="form" field="semester"></has-error>
              </div>
              <div class="form-group col-md-6">
                <label>Date Of Birth</label>
                <input
                  v-model="form.dob"
                  type="date"
                  name="dob"
                  class="form-control"
                  :class="{ 'is-invalid': form.errors.has('dob') }"
                />
                <has-error :form="form" field="dob"></has-error>
              </div>
            </div>
            <button type="submit" v-show="!editMode" class="btn btn-primary">
              Add Student
            </button>
            <button type="submit" v-show="editMode" class="btn btn-warning">
              Edit Student
            </button>
          </form>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title ">Students Table</h4>
            <p class="card-category">Description</p>
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
                      Year
                    </th>
                    <th>
                      Semester
                    </th>
                    <th>
                      Major
                    </th>
                    <th>
                      Birth Date
                    </th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="student in students.data" :key="student.id">
                    <td>{{ student.id }}</td>
                    <td>{{ student.firstname }} {{ student.lastname }}</td>
                    <td>{{ student.email }}</td>
                    <td>{{ student.anneescolaire }}</td>
                    <td>{{ student.semester }}</td>
                    <td>{{ student.filliere }}</td>
                    <td>{{ student.dob }}</td>
                    <td>
                      <button
                        class="btn btn-info btn-outline-warning btn-md"
                        @click="editStudent(student)"
                      >
                        <i class="material-icons">edit</i>
                      </button>
                      <button
                        class="btn btn-info btn-outline-danger btn-md"
                        @click="deleteStudent(student.id)"
                      >
                        <i class="material-icons">delete</i>
                      </button>
                    </td>
                  </tr>
                </tbody>
              </table>
              <pagination
                :data="students"
                @pagination-change-page="getStudents"
              >
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
      editMode: false,
      students: {},
      form: new Form({
        id: "",
        firstname: "",
        lastname: "",
        email: "",
        password: "",
        cne: "",
        phone: "",
        filliere: "",
        anneescolaire: "",
        dob: "",
        semester: "",
        remember: false
      })
    };
  },
  methods: {
    createStudent() {
      this.form
        .post("api/student")
        .then(({ data }) => {
          this.getStudents();
          Toast.fire({
            icon: "success",
            title: "Student added successfully"
          });
        })
        .catch(err => {
          console.log(err);
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
    editStudent(student) {
      this.form.fill(student);
      this.editMode = true;
    },
    getStudents(page = 1) {
      axios
        .get("api/student?page=" + page)
        .then(({ data }) => (this.students = data));
    },
    updateStudent() {
      this.form.put("api/student/" + this.form.id);
      Toast.fire({
        icon: "success",
        title: "Student updated successfully"
      });
      this.getStudents();
      this.form.reset();
      this.editMode = false;
    },
    deleteStudent(id) {
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
          this.form.delete("api/student/" + id);
          this.getStudents();
          Swal.fire("Deleted!", "Your file has been deleted.", "success");
        }
      });
    }
  },
  created() {
    this.getStudents();
  }
};
</script>
