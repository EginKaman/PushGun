<template>
  <div
    class="calendar_block"
    v-click-outside="
      () => {
        statusCalendar = false;
      }
    "
  >
    <div class="calendar_input">
      <input
        type="text"
        readonly
        :value="dateValue"
        @click="statusCalendar = true"
        :placeholder="placeholder"
      />
      <span class="material-icons"><img style="max-width: 16px" src="../../../images/calendar.svg" alt=""> </span>
    </div>
    <div class="calendar" style="z-index: 9999" v-show="statusCalendar">
      <v-date-picker
        title-position="left"
        :is-range="typeIsRange"
        value=""
        ref="VDatePicker"
        :disabled-dates="null"
        @dayclick="calendarClickHandler"
        :attributes="attributes"
        mode="datetime"
        :model-config="modelConfig"
        v-model="datetime"
        :is24hr="true"
        :key="refreshC"
      />
      <div class="outside__calendar" v-if="statusCalendar"></div>
      <div class="calendar_options">
        <button class="btn btn-orange" @click.prevent="applyTheSelectedDate">
          Применить
        </button>
        <button class="btn btn-gray" @click.prevent="resetDate">
          Сбросить
        </button>
      </div>
    </div>
  </div>
</template>
<script>
import VDatePicker from "v-calendar/lib/components/date-picker.umd";
import vClickOutside from "v-click-outside";

export default {
  directives: {
    clickOutside: vClickOutside.directive,
  },
  components: {
    VDatePicker,
  },
  data() {
    return {
      today: new Date(),
      date: "",
      datetime: "",
      statusCalendar: false,
      modelConfig: {
        type: "string",
        mask: "DD.MM.YYYY HH:mm",
      },
      from: {
        date: null,
        time: null,
      },
      to: {
        date: null,
        time: null,
      },
      inputValue: "",
      refreshC: 1,
    };
  },
  props: {
    calendarType: {
      type: String,
      required: true,
    },
    isShowTime: {
      type: Boolean,
      default: false,
    },
    placeholder: {
      type: String,
      default: "",
    },
  },
  computed: {
    dateValue() {
      if (this.isShowTime && this.calendarType === "range") {
        const start = this.datetime?.start || "";
        const end = this.datetime?.end || "";
        if (start && end) {
          return `${start} - ${end}`;
        } else if (start && !end) {
          console.log("ss");
          return `${start} - `;
        } else if (!start && !end) {
          return "";
        }
      } else if (this.isShowTime && this.calendarType !== "range") {
        return this.datetime;
      } else {
        return this.inputValue;
      }
    },
    attributes() {
      const attributes = [
        {
          key: "today",
          dot: true,
          dates: this.today,
        },
      ];
      return attributes;
    },
    typeIsRange() {
      if (this.calendarType === "range") {
        return true;
      }
      return false;
    },
    calendarClickHandler() {
      if (this.typeIsRange) {
        return this.setDate;
      }
      return function () {};
    },
  },
  mounted() {
    // const calendar = document.querySelector('.calendar_block')
    // document.onclick = () => {
    //   if (!calendar.contains(event.target)) {
    //     this.statusCalendar = false
    //   }
    // }
  },
  methods: {
    setDate() {
      if (
        this.$refs.VDatePicker.inputValues[0] ===
        this.$refs.VDatePicker.inputValues[1]
      ) {
      } else {
        this.inputValue = `${
          this.$refs.VDatePicker.inputValues[0].split(" ")[0]
        } - ${this.$refs.VDatePicker.inputValues[1].split(" ")[0]}`;
      }
    },
    resetDate() {
      this.refreshC++;
      this.inputValue = "";
      this.datetime = "";
      this.$emit("reset", null);
    },
    applyTheSelectedDate() {
      this.$emit("selectedDate", this.$refs.VDatePicker.value_);
      this.statusCalendar = false;
    },
  },
};
</script>
