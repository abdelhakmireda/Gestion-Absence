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
          <h4 class="card-title" v-if="!editMode">Add Modules</h4>
          <h4 class="card-title" v-else>Edit Modules</h4>
        </div>
        <div class="card-body">
          <form
            @submit.prevent="editMode ? updateModule() : createModule()"
            @keydown="form.onKeydown($event)"
          >
            <div class="row">
              <div class="form-group col-md-12 col-sm-6">
                <label class="bmd-label-floating">Module Name</label>
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
              <div class="form-group col-md-12 col-sm-6">
                <label class="bmd-label-floating">Description</label>
                <textarea
                  name="description"
                  rows="3"
                  class="form-control"
                  v-model="form.description"
                  :class="{ 'is-invalid': form.errors.has('description') }"
                ></textarea>
                <has-error :form="form" field="description"></has-error>
              </div>
            </div>
            <button
              type="submit"
              v-show="!editMode"
              class="btn btn-primary btn-round pull-right"
            >
              Add Module
            </button>
            <button
              type="submit"
              v-show="editMode"
              class="btn btn-warning btn-round pull-right"
            >
              Edit Module
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
            <p class="card-category">Here is a subtitle for this table</p>
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
                      Description
                    </th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="module in modules.data" :key="module.id">
                    <td>
                      {{ module.id }}
                    </td>
                    <td>
                      {{ module.name }}
                    </td>
                    <td>
                      {{ module.description }}
                    </td>
                    <td>
                      <button
                        class="btn btn-info btn-outline-warning btn-md"
                        @click="editModule(module)"
                      >
                        <i class="material-icons">edit</i>
                      </button>
                      <button
                        class="btn btn-info btn-outline-danger btn-md"
                        @click="deleteModule(module.id)"
                      >
                        <i class="material-icons">delete</i>
                      </button>
                    </td>
                  </tr>
                </tbody>
              </table>
              <pagination :data="modules" @pagination-change-page="getModules">
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
      modules: {},
      editMode: false,
      form: new Form({
        id: "",
        name: "",
        description: ""
      })
    };
  },
  methods: {
    createModule() {
      this.form.post("/api/module").then(({ data }) => {
        Toast.fire({
          icon: "success",
          title: "Module added successfully"
        });
        this.form.reset();
        this.getModules();
      });
    },
    getModules(page = 1) {
      axios
        .get("api/module?page=" + page)
        .then(({ data }) => (this.modules = data));
    },
    editModule(module) {
      this.editMode = true;
      this.form.fill(module);
    },
    updateModule() {
      this.form.put("api/module/" + this.form.id);
      Toast.fire({
        icon: "success",
        title: "Module updated successfully"
      });
      this.form.reset();
      this.editMode = false;
      this.getModules();
    },
    deleteModule(id) {
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
          this.form.delete("api/module/" + id);
          this.getModules();
          Swal.fire("Deleted!", "Module has been deleted.", "success");
        }
      });
    }
  },
  created() {
    this.getModules();
  }
};
</script>
