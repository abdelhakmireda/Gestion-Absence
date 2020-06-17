<template>
  <div class="container">
    <div class="row" v-if="this.pro === 'admin'">
      <div class="card">
        <div
          class="card-header"
          v-bind:class="{
            'card-header-primary': addingMode,
            'card-header-danger': !addingMode
          }"
        >
          <h4 class="card-title" v-if="addingMode">Add Events</h4>
          <h4 class="card-title" v-else>Edit Events</h4>
        </div>
        <div class="card-body">
          <form class="m-3" @submit.prevent>
            <div class="row">
              <div class="form-group col-md-6">
                <label>Course Name</label>
                <input
                  type="text"
                  name="title"
                  class="form-control"
                  v-model="form.title"
                />
                <span v-if="errors.title" class="text-danger">{{
                  errors.title[0]
                }}</span>
              </div>
              <div class="form-group col-md-6">
                <label>Teacher</label>
                <input
                  v-model="form.teacher"
                  type="text"
                  name="teacher"
                  class="form-control"
                />
                <span v-if="errors.teacher" class="text-danger">{{
                  errors.teacher[0]
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
              <div class="form-group col-md-6">
                <label>Salle</label>
                <input
                  v-model="form.salle"
                  type="text"
                  name="salle"
                  class="form-control"
                />
                <span v-if="errors.salle" class="text-danger">{{
                  errors.salle[0]
                }}</span>
              </div>
              <div class="form-group col-md-6">
                <label>Type</label>
                <input
                  v-model="form.type"
                  type="text"
                  name="type"
                  class="form-control"
                />
                <span v-if="errors.type" class="text-danger">{{
                  errors.type[0]
                }}</span>
              </div>
            </div>
            <button
              v-if="addingMode"
              type="submit"
              class="btn btn-primary pull-right btn-round"
              @click="addNewEvent"
            >
              Add Event
            </button>
            <template v-else class="">
              <div class="col-md-7 mb-4 float-right">
                <button
                  class="btn btn-md btn-success btn-round"
                  @click="updateEvent"
                >
                  Update
                </button>
                <button
                  class="btn btn-md btn-danger btn-round"
                  @click="deleteEvent"
                >
                  Delete
                </button>
                <button
                  class="btn btn-md btn-secondary btn-round"
                  @click="cancelEvent"
                >
                  Cancel
                </button>
              </div>
            </template>
            <div class="clearfix"></div>
          </form>
        </div>
      </div>
    </div>
    <div class="col-md-12">
      <Fullcalendar
        @eventClick="showEvent"
        defaultView="dayGridMonth"
        :header="{
          left: 'prev,next today',
          center: 'title',
          right: 'dayGridMonth,timeGridWeek,timeGridDay'
        }"
        :plugins="calendarPlugins"
        :events="events"
      />
    </div>
  </div>
</template>
<script>
// let profile = document.getElementById("userType").innerHTML.trim();

import Fullcalendar from "@fullcalendar/vue";
import dayGridPlugin from "@fullcalendar/daygrid";
import timeGridPlugin from "@fullcalendar/timegrid";
import interactionPlugin from "@fullcalendar/interaction";
import resourceTimeline from "@fullcalendar/resource-timeline";
import listWeek from "@fullcalendar/list";
import datetime from "vuejs-datetimepicker";
import axios from "axios";

export default {
  components: {
    Fullcalendar,
    datetime
  },
  data() {
    return {
      // pro: profile,
      calendarPlugins: [
        dayGridPlugin,
        timeGridPlugin,
        interactionPlugin,
        listWeek,
        resourceTimeline
      ],
      events: "",
      errors: {},
      calendarWeekends: true,
      form: new Form({
        title: "",
        start_date: "",
        end_date: "",
        type: "",
        teacher: "",
        salle: ""
      }),
      addingMode: true,
      indexToUpdate: ""
    };
  },
  created() {
    this.getEvents();
  },
  methods: {
    cancelEvent() {
      this.addingMode = !this.addingMode;
      this.resetForm();
    },

    addNewEvent() {
      this.errors = "";
      this.form
        .post("/api/calendar")
        .then(data => {
          this.resetForm();
          this.getEvents();
          Toast.fire({
            icon: "success",
            title: "Course added successfully"
          });
        })
        .catch(err => {
          this.errors = err.response.data.errors;
          console.log(err.response.data.errors);
        });
    },
    showEvent(arg) {
      this.addingMode = false;
      const { id, title, start, end, type, salle, teacher } = this.events.find(
        event => event.id === +arg.event.id
      );
      this.indexToUpdate = id;
      this.form = {
        title: title,
        start_date: start,
        end_date: end,
        teacher: teacher,
        type: type,
        salle: salle
      };
    },

    updateEvent() {
      axios
        .put("/api/calendar/" + this.indexToUpdate, {
          ...this.form
        })
        .then(resp => {
          this.resetForm();
          Toast.fire({
            icon: "success",
            title: "Course updated successfully"
          });
          this.getEvents();
          this.addingMode = !this.addingMode;
        })
        .catch(err =>
          console.log("Unable to update event!", err.response.data)
        );
    },

    deleteEvent() {
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
          axios
            .delete("/api/calendar/" + this.indexToUpdate)
            .then(resp => {
              this.resetForm();
              this.getEvents();
              this.addingMode = !this.addingMode;
              Swal.fire("Deleted!", "Your file has been deleted.", "success");
            })
            .catch(err =>
              console.log("Unable to delete event!", err.response.data)
            );
        }
      });
    },
    getEvents() {
      axios
        .get("/api/calendar")
        .then(resp => {
          this.events = resp.data.data;
        })
        .catch(err => console.log(err.response.data));
    },
    resetForm() {
      this.$emit("input", "");
      Object.keys(this.form).forEach(key => {
        return (this.form[key] = "");
      });
    }
  },
  watch: {
    indexToUpdate() {
      return this.indexToUpdate;
    }
  }
};
</script>
<style lang="css">
@import "~@fullcalendar/core/main.css";
@import "~@fullcalendar/daygrid/main.css";

.nav-l[data-v-4bd11526],
.nav-r[data-v-4bd11526] {
  background-color: #9c27b0 !important;
}

.year-month-wrapper[data-v-4bd11526] {
  background-color: #9c27b0;
}

.days[data-v-4bd11526] {
  color: #9c27b0;
}

.activePort[data-v-4bd11526],
.activePort[data-v-4bd11526]:hover {
  background-color: #9c27b0;
}

.okButton[data-v-4bd11526] {
  color: #9c27b0;
}

.fc-title {
  color: #fff;
}

.fc-title:hover {
  cursor: pointer;
}
</style>
