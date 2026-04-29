<script setup>
import { useForm } from '@inertiajs/vue3'

const props = defineProps({
  todo: {
    type: Object,
    default: null
  }
})

const form = useForm({
  name: props.todo?.name || '',
  description: props.todo?.description || ''
})

function submit() {
  if (props.todo) {
    form.put(`/todos/${props.todo.id}`)
  } else {
    form.post('/todos')
  }
}
</script>

<template>
  <div>

    <!-- Name -->
    <input v-model="form.name"
           class="form-control mb-1"
           placeholder="Name" />

    <div v-if="form.errors.name" class="text-danger mb-2">
      {{ form.errors.name }}
    </div>

    <!-- Description -->
    <textarea v-model="form.description"
              class="form-control mb-1"
              placeholder="Description"></textarea>

    <div v-if="form.errors.description" class="text-danger mb-2">
      {{ form.errors.description }}
    </div>

    <!-- Submit -->
    <button @click="submit"
            :class="props.todo ? 'btn btn-primary' : 'btn btn-success'">
      {{ props.todo ? 'Update' : 'Save' }}
    </button>

  </div>
</template>