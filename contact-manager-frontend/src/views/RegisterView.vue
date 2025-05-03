<template>
    <div class="max-w-md mx-auto mt-10 p-6 bg-white rounded shadow">
      <h2 class="text-2xl font-bold mb-4">Criar Conta</h2>

      <form @submit.prevent="submit">
        <div class="mb-4">
          <label>Nome</label>
          <input v-model="form.name" type="text" class="w-full border rounded px-3 py-2" />
          <p v-if="errors.name" class="text-red-500 text-sm">{{ errors.name }}</p>
        </div>

        <div class="mb-4">
          <label>Email</label>
          <input v-model="form.email" type="email" class="w-full border rounded px-3 py-2" />
          <p v-if="errors.email" class="text-red-500 text-sm">{{ errors.email }}</p>
        </div>

        <div class="mb-4">
          <label>Senha</label>
          <input v-model="form.password" type="password" class="w-full border rounded px-3 py-2" />
          <p v-if="errors.password" class="text-red-500 text-sm">{{ errors.password }}</p>
        </div>

        <div class="mb-4">
          <label>Confirmar Senha</label>
          <input v-model="form.password_confirmation" type="password" class="w-full border rounded px-3 py-2" />
          <p v-if="errors.password_confirmation" class="text-red-500 text-sm">{{ errors.password_confirmation }}</p>
        </div>

        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Cadastrar</button>
      </form>
    </div>
  </template>

  <script setup>
  import { reactive } from 'vue'
  import api from '@/services/api'
  import { useRouter } from 'vue-router'

  const router = useRouter()

  const form = reactive({
    name: '',
    email: '',
    password: '',
    password_confirmation: ''
  })

  const errors = reactive({})

  async function submit() {
    Object.keys(errors).forEach(k => errors[k] = '')

    try {
      await api.get('/sanctum/csrf-cookie')

      await api.post('/register', form)

      // redireciona após cadastro
      router.push('/dashboard')
    } catch (e) {
      if (e.response && e.response.status === 422) {
        const resErrors = e.response.data.errors
        Object.assign(errors, resErrors)
      } else {
        alert('Erro ao registrar.')
      }
    }
  }
  </script>
