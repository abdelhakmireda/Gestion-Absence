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
          <h4 class="card-title" v-if="!editMode">Add Departments</h4>
          <h4 class="card-title" v-else>Edit Departments</h4>
        </div>
        <div class="card-body">
          <form
            @submit.prevent="editMode ? updateDepartment() : createDepartment()"
            @keydown="form.onKeydown($event)"
          >
            <div class="row">
              <div class="form-group col-md-12 col-sm-12">
                <label class="bmd-label-floating">Department Name</label>
                <input
                  v-model="form.name"
                  type="text"
                  name="name"
                  class="form-control"
                  :class="{ 'is-invalid': form.errors.has('name') }"
                />
                <has-error :form="form" field="name"></has-error>
              </div>
            </div>
            <div class="row">
              <div class="form-group col-md-12 col-sm-12">
                <label class="bmd-label-floating">Responsable</label>
                <input
                  v-model="form.responsable"
                  type="text"
                  name="responsable"
                  class="form-control"
                  :class="{ 'is-invalid': form.errors.has('responsable') }"
                />
                <has-error :form="form" field="responsable"></has-error>
              </div>
            </div>
            <button
              type="submit"
              v-show="!editMode"
              class="btn btn-primary btn-round pull-right"
            >
              Add Department
            </button>
            <button
              type="submit"
              v-show="editMode"
              class="btn btn-warning btn-round pull-right"
            >
              Edit Department
            </button>
          </form>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title ">Departments Table</h4>
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
                      Name
                    </th>
                    <th>
                      Responsable
                    </th>
                  </tr>
                </thead>
                <tbody>
                  <tr
                    v-for="department in departments.data"
                    :key="department.id"
                  >
                    <td class="text-primary">
                      {{ department.id }}
                    </td>
                    <td>{{ department.name }}</td>
                    <td>{{ department.responsable }}</td>
                    <td>
                      <button
                        class="btn btn-info btn-outline-warning btn-md"
                        @click="editDepartment(department)"
                      >
                        <i class="material-icons">edit</i>
                      </button>
                      <button
                        class="btn btn-info btn-outline-danger btn-md"
                        @click="deleteDepartment(department.id)"
                      >
                        <i class="material-icons">delete</i>
                      </button>
                    </td>
                  </tr>
                </tbody>
              </table>
              <pagination
                :data="departments"
                @pagination-change-page="getDepartments"
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
      departments: {},
      editMode: false,
      form: new Form({
        id: "",
        name: "",
        responsable: ""
      })
    };
  },
  methods: {
    createDepartment() {
      this.form.post("/api/department").then(({ data }) => {
        Toast.fire({
          icon: "success",
          title: "Department added successfully"
        });
        this.form.reset();
        this.getDepartments();
      });
    },
    getDepartments(page = 1) {
      axios
        .get("api/department?page=" + page)
        .then(({ data }) => (this.departments = data));
    },
    editDepartment(department) {
      this.editMode = true;
      this.form.fill(department);
    },
    updateDepartment() {
      this.form.put("api/department/" + this.form.id);
      this.editMode = false;
      this.form.reset();
      Toast.fire({
        icon: "success",
        title: "Department updated successfully"
      });
      this.getDepartments();
    },
    deleteDepartment(id) {
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
          this.form.delete("api/department/" + id);
          this.getDepartments();
          Swal.fire("Deleted!", "Department has been deleted.", "success");
        }
      });
    }
  },
  created() {
    this.getDepartments();
  }
};
</script>
