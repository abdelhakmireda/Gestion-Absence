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
          <h4 class="card-title" v-if="!editMode">Add Fillieres</h4>
          <h4 class="card-title" v-else>Edit Fillieres</h4>
        </div>
        <div class="card-body">
          <form
            @submit.prevent="editMode ? updateFilliere() : createFilliere()"
            @keydown="form.onKeydown($event)"
            id="myForm"
          >
            <div class="row">
              <div class="form-group col-md-12 col-sm-12">
                <label class="bmd-label-floating">Filliere Name</label>
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
                <label class="bmd-label-floating">Abbreviation</label>
                <input
                  v-model="form.abbreviation"
                  type="text"
                  name="abbreviation"
                  class="form-control"
                  :class="{ 'is-invalid': form.errors.has('abbreviation') }"
                />
                <has-error :form="form" field="abbreviation"></has-error>
              </div>
            </div>

            <button
              type="submit"
              v-show="!editMode"
              class="btn btn-primary btn-round pull-right"
            >
              Add Filliere
            </button>
            <button
              type="submit"
              v-show="editMode"
              class="btn btn-warning btn-round pull-right"
            >
              Edit Filliere
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
                      Abbreviation
                    </th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="filliere in fillieres.data" :key="filliere.id">
                    <td class="text-primary">
                      {{ filliere.id }}
                    </td>
                    <td>{{ filliere.name }}</td>
                    <td>{{ filliere.abbreviation }}</td>
                    <td>
                      <button
                        class="btn btn-info btn-outline-warning btn-md"
                        @click="editFilliere(filliere)"
                      >
                        <i class="material-icons">edit</i>
                      </button>
                      <button
                        class="btn btn-info btn-outline-danger btn-md"
                        @click="deleteFilliere(filliere.id)"
                      >
                        <i class="material-icons">delete</i>
                      </button>
                    </td>
                  </tr>
                </tbody>
              </table>
              <pagination
                :data="fillieres"
                @pagination-change-page="getFillieres"
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
      fillieres: {},
      editMode: false,
      form: new Form({
        id: "",
        name: "",
        abbreviation: ""
      })
    };
  },
  methods: {
    createFilliere() {
      this.form.post("/api/filliere").then(({ data }) => {
        Toast.fire({
          icon: "success",
          title: "Filliere added successfully"
        });
        this.form.reset();
        this.getFillieres();
      });
    },
    getFillieres(page = 1) {
      axios
        .get("api/filliere?page=" + page)
        .then(({ data }) => (this.fillieres = data));
    },
    editFilliere(filliere) {
      this.editMode = true;
      this.form.fill(filliere);
    },
    updateFilliere() {
      this.form.put("api/filliere/" + this.form.id);
      this.editMode = false;
      this.form.reset();
      Toast.fire({
        icon: "success",
        title: "Filliere updated successfully"
      });
      this.getFillieres();
    },
    deleteFilliere(id) {
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
          this.form.delete("api/filliere/" + id);
          this.getFillieres();
          Swal.fire("Deleted!", "Filliere has been deleted.", "success");
        }
      });
    }
  },
  created() {
    this.getFillieres();
  }
};
</script>
