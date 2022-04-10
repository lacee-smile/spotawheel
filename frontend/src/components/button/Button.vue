<template>
  <button
    class="btn border"
    :class="className ? 'btn-' + className : ''"
    @click="click"
    :disabled="disabled"
  >
    {{ text }}
  </button>
</template>

<script lang="ts">
export default {
  name: "Button",
  props: {
    className: { type: String, default: "" },
    text: { type: String, default: "" },
    disabled: { type: Boolean, default: false },
  },
};
</script>
