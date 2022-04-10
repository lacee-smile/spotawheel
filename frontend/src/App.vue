<template>
  <div class='row my-3 justify-content-around'> 
    <div class='col-3'>
      <Datepicker
        v-model='startDate'
        placeholder='Start date'
        :enableTimePicker='false'
        :format='dateFormat'
        :previewFormat='dateFormat'
        :modelValue='string'
        autoApply
        @update:modelValue="setStartDate"
      />
      <span v-if="clicked && !startDate" class="text-danger">Please select a start date!</span>
      <span v-if="clicked && !!startDateError" class="text-danger">{{ startDateError }}</span>
    </div>
    <div class='col-3'>
      <Datepicker
        v-model='endDate'
        placeholder='End date'
        :enableTimePicker='false'
        :format='dateFormat'
        :previewFormat='dateFormat'
        :modelValue='string'
        autoApply
        @update:modelValue="setEndDate"
      />
      <span v-if="clicked && !endDate" class="text-danger">Please select an end date!</span>
      <span v-if="clicked && !!endDateError" class="text-danger">{{ endDateError }}</span>

    </div>
    <div class="col-2">
      <Button
        text='Search'
        class='btn-primary'
        @click='search'
      />
    </div>
  </div>
  <div class='row'>
    <div class="col-12">
      <Table
        :columns="columns"
        :data="clients"
      />
    </div>
  </div>
</template>

<script lang='ts'>

import { defineComponent } from "vue";
import { mapActions, mapGetters, useStore } from 'vuex';
import Datepicker from '@vuepic/vue-datepicker';
import Table from '@/components/table/Table.vue';
import TableDefinition from "@/components/table/TableDefinition";
import Payment from "./model/Payment";
import Button from "./components/button/Button.vue";

export default defineComponent({
  components: {
    Datepicker,
    Table,
    Button,
  },
  setup() {
    const store = useStore();
    const dateFormat = (date: Date) => {
      let day = "";
      if(date.getDate() < 9) {
        day = '0' + date.getDate();
      } else {
        day = date.getDate().toString();
      }


      let month = "";
      if(date.getMonth() < 9) {
        month = '0' + (date.getMonth() + 1);
      } else {
        month = (date.getMonth() + 1).toString();
      }

      const year = date.getFullYear();
      return `${year}-${month}-${day}`;
    };
    return { store, dateFormat };
  },
  data(): Record<string, any> {
    return {
      columns: new TableDefinition({
        id: {
          data: 'id',
          display: 'ID',
        },
        name: {
          data: 'name',
          display: 'Name',
        },
        surname: {
          data: 'surname',
          display: 'Surname',
        },
        amount: {
          render: function(data: Payment) {
            return data?.amount ?? '-';
          },
          display: 'Amount',
          data: 'latest_payment'
        },
        date: {
          render: function(data: Payment) {
            return data?.created_at ?? '-';
          },
          display: 'Date',
          data: 'latest_payment'
        }
      }),
      startDate: null,
      endDate: null,
      clicked: false,
    }
  },
  created(): void {
    this.loadClients();
  },
  computed: {
    ...mapGetters({
      clients: "clients",
    }),
    total(): number {
      return this.clients.length;
    }
  },
  methods: {
    ...mapActions({
      loadClients: "loadClients",
      filterClients: "filterClients",
    }),
    search(): void {
      this.clicked = true;

      const startDate = new Date(this.startDate);
      const endDate = new Date(this.endDate);

      if (startDate > endDate) {
        this.startDateError = "Start date cannot be after end date!";
        this.endDateError = "End date cannot be before start date!";
        return;
      }
      this.clicked = false;
      this.filterClients({
        startDate: this.startDate,
        endDate: this.endDate,
      });
    },
    setStartDate(value: Date): void {
      this.startDate = this.dateFormat(value);
      this.clicked = false;
    },
    setEndDate(value: Date): void {
      this.endDate = this.dateFormat(value);
      this.clicked = false;
    },
 }
});
</script>

<style lang="scss">
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
}

</style>