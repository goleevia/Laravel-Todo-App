<script setup>
import TodoForm from '@/Components/TodoForm.vue'

const props = defineProps({
  todo: Object
})
</script>

<template>
  <div class="container mt-5">

    <div class="d-flex justify-content-between align-items-center mb-4">
      <h2>Edit Todo</h2>

      <button class="btn btn-secondary" @click="$inertia.visit('/todos')">
        ← Back
      </button>
    </div>

    <TodoForm :todo="todo" />

  </div>
</template>