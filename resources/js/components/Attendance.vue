<template>
  <!--
            container
                row
                    card
                        card-header + card-body(form)


        -->
  <div class="container">
    <!-- <div class="row" v-if="this.type !== 'student'"> -->
    <div class="row">
      <div class="card">
        <div
          class="card-header"
          v-bind:class="{
            'card-header-primary': !editMode,
            'card-header-danger': editMode
          }"
        >
          <h4 class="card-title" v-if="!editMode">Add Absence</h4>
          <h4 class="card-title" v-else>Edit Absence</h4>
        </div>
        <div class="card-body">
          <form
            @submit.prevent="editMode ? updateAttendance() : createAttendance()"
            @keydown="form.onKeydown($event)"
          >
            <div class="row">
              <div class="form-group col-md-6">
                <label for="exampleFormControlSelect1">Student Fullname</label>
                <select class="form-control" v-model="form.student_id">
                  <option v-for="student in students" v-bind:value="student.id">
                    {{ student.firstname }} {{ student.lastname }}
                  </option>
                </select>
                <has-error :form="form" field="student_id"></has-error>
              </div>
              <div class="form-group col-md-6">
                <label for="exampleFormControlSelect1">Element</label>
                <select class="form-control" v-model="form.element_id">
                  <option v-for="element in elements" v-bind:value="element.id">
                    {{ element.name }}
                  </option>
                </select>
                <has-error :form="form" field="student_id"></has-error>
              </div>
            </div>
            <div class="row">
              <div class="form-group col-md-6">
                <label>Date</label>
                <datetime
                  firstDayOfWeek="1"
                  format="YYYY-MM-DD H:i"
                  width="300px"
                  v-model="form.date"
                ></datetime>
                <has-error :form="form" field="date"></has-error>
              </div>
              <div class="form-group col-md-6">
                <label>Hours</label>
                <input
                  v-model="form.hours"
                  type="text"
                  name="hours"
                  class="form-control"
                  :class="{ 'is-invalid': form.errors.has('hours') }"
                />
                <has-error :form="form" field="hours"></has-error>
              </div>
            </div>
            <div class="row">
              <div class="form-group col-md-6">
                <label>Type</label>
                <input
                  v-model="form.type"
                  type="text"
                  name="type"
                  class="form-control"
                  :class="{ 'is-invalid': form.errors.has('type') }"
                />
                <has-error :form="form" field="type"></has-error>
              </div>
              <div class="form-group col-md-6">
                <label>Justification</label>
                <input
                  v-model="form.justification"
                  type="text"
                  name="justification"
                  class="form-control"
                  :class="{ 'is-invalid': form.errors.has('justification') }"
                />
                <has-error :form="form" field="justification"></has-error>
              </div>
            </div>
            <button type="submit" v-show="!editMode" class="btn btn-primary">
              Add absence
            </button>
            <button type="submit" v-show="editMode" class="btn btn-warning">
              Edit absence
            </button>
          </form>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title ">Absences Table</h4>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table" v-if="this.type !== 'student'">
                <thead class=" text-primary">
                  <tr>
                    <th>
                      ID
                    </th>
                    <th>
                      Full Name
                    </th>
                    <th>
                      Filliere
                    </th>
                    <th>
                      Semester
                    </th>
                    <th>
                      Element
                    </th>
                    <th>
                      Horaire
                    </th>
                    <th></th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="attendance in attendances" :key="attendance.id">
                    <td class="text-primary">{{ attendance.id }}</td>
                    <td>
                      {{ attendance.firstname }} {{ attendance.lastname }}
                    </td>
                    <td>{{ attendance.filliere }}</td>
                    <td>{{ attendance.semester }}</td>
                    <td>{{ attendance.name }}</td>
                    <td>{{ attendance.date }}</td>
                    <td>
                      <button
                        class="btn btn-info btn-outline-warning btn-md"
                        @click="editAttendance(attendance)"
                      >
                        <i class="material-icons">edit</i>
                      </button>
                      <button
                        class="btn btn-info btn-outline-danger btn-md"
                        @click="deleteAttendance(attendance.id)"
                      >
                        <i class="material-icons">delete</i>
                      </button>
                    </td>
                  </tr>
                </tbody>
              </table>
              <table class="table" v-else>
                <thead class=" text-primary">
                  <tr>
                    <th>
                      ID
                    </th>
                    <th>
                      Full Name
                    </th>
                    <th>
                      Filliere
                    </th>
                    <th>
                      Semester
                    </th>
                    <th>
                      Element
                    </th>
                    <th>
                      Horaire
                    </th>
                    <th></th>
                    <th></th>
                  </tr>
                </thead>
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
// let profile = document.getElementById("userType").innerHTML.trim();

import datetime from "vuejs-datetimepicker";

export default {
  components: {
    datetime
  },
  data() {
    return {
      // type: profile,
      editMode: false,
      attendances: {},
      students: {},
      elements: {},
      form: new Form({
        id: "",
        justification: "",
        hours: "",
        type: "",
        date: "",
        element_id: "",
        student_id: ""
      })
    };
  },
  methods: {
    createAttendance() {
      this.form.post("/api/attendance").then(({ data }) => {
        Toast.fire({
          icon: "success",
          title: "Absence added successfully"
        });
        this.getAttendances();
        this.form.reset();
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
    getAttendances() {
      axios.get("api/attendance").then(({ data }) => {
        this.attendances = data;
      });
    },
    editAttendance(attendance) {
      this.editMode = true;
      this.form.fill(attendance);
    },
    updateAttendance() {
      this.form.put("api/attendance/" + this.form.id);
      this.form.reset();
      Toast.fire({
        icon: "success",
        title: "Absence updated successfully"
      });
      this.getAttendances();
      this.editMode = false;
    },
    deleteAttendance(id) {
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
          this.form.delete("api/attendance/" + id);
          this.getAttendances();

          Swal.fire("Deleted!", "Element has been deleted.", "success");
        }
      });
    },
    getStudents() {
      axios.get("/api/student").then(({ data }) => (this.students = data.data));
    },
    getModules() {
      axios.get("/api/element").then(({ data }) => (this.elements = data.data));
    }
  },
  created() {
    this.getAttendances();
    this.getStudents();
    this.getModules();
  }
};
</script>
