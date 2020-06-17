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
          <h4 class="card-title" v-if="!editMode">Add Elements</h4>
          <h4 class="card-title" v-else>Edit Elements</h4>
        </div>
        <div class="card-body">
          <form
            @submit.prevent="editMode ? updateElement() : createElement()"
            @keydown="form.onKeydown($event)"
          >
            <div class="row">
              <div class="form-group col-md-6 col-sm-12">
                <label class="bmd-label-floating">Professor</label>
                <input
                  v-model="form.professor"
                  type="text"
                  name="professor"
                  class="form-control"
                  :class="{ 'is-invalid': form.errors.has('professor') }"
                />
                <span v-if="errors.professor" class="text-danger">{{
                  errors.professor[0]
                }}</span>
              </div>
              <div class="form-group col-md-6 col-sm-12">
                <label class="bmd-label-floating">Name</label>
                <input
                  v-model="form.name"
                  type="text"
                  name="name"
                  class="form-control"
                  :class="{ 'is-invalid': form.errors.has('name') }"
                />
                <span v-if="errors.name" class="text-danger">{{
                  errors.name[0]
                }}</span>
              </div>
            </div>
            <div class="row">
              <div class="form-group col-md-6">
                <label>Start Date</label>
                <datetime
                  firstDayOfWeek="1"
                  format="YYYY-MM-DD H:i"
                  width="300px"
                  v-model="form.start_date"
                ></datetime>
                <span v-if="errors.start_date" class="text-danger">{{
                  errors.start_date[0]
                }}</span>
              </div>
              <div class="form-group col-md-6">
                <label>End Date</label>
                <datetime
                  firstDayOfWeek="1"
                  format="YYYY-MM-DD H:i"
                  width="300px"
                  v-model="form.end_date"
                ></datetime>
                <span v-if="errors.end_date" class="text-danger">{{
                  errors.end_date[0]
                }}</span>
              </div>
            </div>
            <div class="row">
              <div class="form-group col-md-6 col-sm-12">
                <label class="bmd-label-floating">Hours Total </label>
                <input
                  v-model="form.total"
                  type="text"
                  name="total"
                  class="form-control"
                  :class="{ 'is-invalid': form.errors.has('total') }"
                />
                <span v-if="errors.total" class="text-danger">{{
                  errors.total[0]
                }}</span>
              </div>
              <div class="form-group col-md-6 col-sm-12">
                <label class="bmd-label-floating">Type</label>
                <select
                  v-model="form.type"
                  class="form-control"
                  :class="{ 'is-invalid': form.errors.has('type') }"
                >
                  <option selected value="Cours">Cours</option>
                  <option value="TD">TD</option>
                  <option value="TP">TP</option>
                  <option value="Cours magistral">Cours Magistral</option>
                </select>
                <span v-if="errors.type" class="text-danger">{{
                  errors.type[0]
                }}</span>
              </div>
            </div>
            <button
              type="submit"
              v-show="!editMode"
              class="btn btn-primary btn-round pull-right"
            >
              Add Element
            </button>
            <button
              type="submit"
              v-show="editMode"
              class="btn btn-warning btn-round pull-right"
            >
              Edit Element
            </button>
          </form>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title ">Elements Table</h4>
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
                      Professor
                    </th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Type</th>
                    <th>Total Hours</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="element in elements.data" :key="element.id">
                    <td class="text-primary">
                      {{ element.id }}
                    </td>
                    <td>{{ element.name }}</td>
                    <td>{{ element.professor }}</td>
                    <td>{{ element.start_date }}</td>
                    <td>{{ element.end_date }}</td>
                    <td>{{ element.type }}</td>
                    <td>{{ element.total }}</td>
                    <td>
                      <button
                        class="btn btn-info btn-outline-warning btn-md"
                        @click="editElement(element)"
                      >
                        <i class="material-icons">edit</i>
                      </button>
                      <button
                        class="btn btn-info btn-outline-danger btn-md"
                        @click="deleteElement(element.id)"
                      >
                        <i class="material-icons">delete</i>
                      </button>
                    </td>
                  </tr>
                </tbody>
              </table>
              <pagination
                :data="elements"
                @pagination-change-page="getElements"
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
import datetime from "vuejs-datetimepicker";

export default {
  components: {
    datetime
  },
  data() {
    return {
      elements: {},
      errors: {},
      editMode: false,
      form: new Form({
        id: "",
        professor: "",
        name: "",
        type: "",
        start_date: "",
        end_date: "",
        total: ""
      })
    };
  },
  methods: {
    createElement() {
      this.form
        .post("/api/element")
        .then(({ data }) => {
          Toast.fire({
            icon: "success",
            title: "Element added successfully"
          });
          this.getElements();
          this.form.reset();
        })
        .catch(err => {
          this.errors = err.response.data.errors;
        });
    },
    getElements(page = 1) {
      axios
        .get("api/element?page=" + page)
        .then(({ data }) => (this.elements = data));
    },
    editElement(element) {
      this.editMode = true;
      this.form.fill(element);
    },
    updateElement() {
      this.form.put("api/element/" + this.form.id);
      Toast.fire({
        icon: "success",
        title: "Element updated successfully"
      });
      this.editMode = false;
      this.form.reset();
      this.getElements();
    },
    deleteElement(id) {
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
          this.form.delete("api/element/" + id);
          this.getElements();
          Swal.fire("Deleted!", "Element has been deleted.", "success");
        }
      });
    }
  },
  created() {
    this.getElements();
  }
};
</script>
