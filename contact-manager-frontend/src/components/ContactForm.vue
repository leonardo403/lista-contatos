<template>
    <form @submit.prevent="submit">
      <input v-model="form.name" placeholder="Nome completo" required />
      <input v-model="form.email" type="email" placeholder="E-mail" required />
      <input v-model="form.phone" placeholder="Telefone" required />
      <button type="submit">{{ isEdit ? 'Atualizar' : 'Criar' }}</button>
    </form>
  </template>

  <script setup>
  import { ref, watch } from 'vue'

  const props = defineProps({
    modelValue: Object,
    isEdit: Boolean,
    onSubmit: Function,
  })

  const form = ref({
    name: '',
    email: '',
    phone: '',
  })

  watch(
    () => props.modelValue,
    (newVal) => {
      if (newVal) form.value = { ...newVal }
    },
    { immediate: true }
  )

  function submit() {
    props.onSubmit(form.value)
  }
  </script>
