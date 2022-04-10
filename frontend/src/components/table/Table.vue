<template>
  <div class="offset">
    <table class="table table-bordered" :style="style">
      <thead>
        <tr>
          <td v-for="column in columns.columns" v-bind:key="column.data">
            {{ column.display }}
          </td>
        </tr>
      </thead>
      <tbody>
        <tr v-for="entry in data" v-bind:key="entry.id">
          <td
            v-for="column in columns.columns"
            v-bind:key="column.data"
            :style="column.style"
          >
            <span
              v-if="column.hasRender"
              v-html="column.render(entry[column.data], entry)"
            />
            <span v-else>
              {{ entry[column.data] }}
            </span>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script lang="ts">
import TableDefinition from "./TableDefinition";
import { defineComponent } from "vue";

export default defineComponent({
  props: {
    data: { type: Array, required: true },
    columns: { type: Object as () => TableDefinition, required: true },
    style: { type: String, default: "" },
  },
});
</script>
