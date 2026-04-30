<script setup>
import { router, Link, usePage } from '@inertiajs/vue3'
import { ref, watch } from 'vue'

defineProps({
  todos: Object
})

const page = usePage()

const showFlash = ref(false)

watch(
  () => page.props.flash.success,
  (message) => {
    if (message) {
      showFlash.value = true

      setTimeout(() => {
        showFlash.value = false
      }, 3000)
    }
  },
  { immediate: true }
)

function destroy(id) {
  if (confirm('Delete this todo?')) {
    router.delete(`/todos/${id}`)
  }
}
</script>

<template>
<div class="container mt-5">

  <!-- Flash Message -->
  <div
    v-if="showFlash"
    class="alert alert-success"
  >
    {{ page.props.flash.success }}
  </div>

  <div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Todo List</h2>

    <Link href="/todos/create" class="btn btn-primary">
      + Add Todo
    </Link>
  </div>

  <!-- Todo List -->
  <div
    v-for="todo in todos.data"
    :key="todo.id"
    class="card mb-3"
  >
    <div class="card-body">

      <h5>{{ todo.name }}</h5>
      <p>{{ todo.description }}</p>

      <div class="d-flex gap-2">
        <Link
          :href="`/todos/${todo.id}/edit`"
          class="btn btn-warning btn-sm"
        >
          Edit
        </Link>

        <button
          @click="destroy(todo.id)"
          class="btn btn-danger btn-sm"
        >
          Delete
        </button>
      </div>

    </div>
  </div>

  <!-- No Data Found -->
  <div
    v-if="todos.data.length === 0"
    class="alert alert-info text-center">
    No todos available. Click "Add Todo" to create one.
  </div>

  <!-- PAGINATION -->
  <nav class="mt-4" v-if="todos?.data?.length > 0 && todos.links">
    <ul class="pagination justify-content-center">

      <li
        v-for="link in todos.links"
        :key="link.label"
        class="page-item"
        :class="{ active: link.active, disabled: !link.url }"
      >
        <Link
          class="page-link"
          :href="link.url ?? ''"
          v-html="link.label"
        />
      </li>

    </ul>
  </nav>

</div>
</template>