<template>
    <div class="max-w-md mx-auto mt-10 p-6 bg-white rounded shadow">
      <h2 class="text-2xl font-bold mb-4">Login</h2>

      <form @submit.prevent="submit">
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

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Entrar</button>
      </form>
    </div>
  </template>

  <script setup>
  import { reactive, ref } from 'vue'
  import api from '@/services/api'
  import { useRouter } from 'vue-router'

  const form = reactive({
    email: '',
    password: ''
  })

  const errors = reactive({})
  const router = useRouter()

  async function submit() {
    errors.email = ''
    errors.password = ''

    try {
      await api.get('/sanctum/csrf-cookie')

      await api.post('/login', form)

      // redireciona após login
      router.push('/dashboard')
    } catch (e) {
      if (e.response && e.response.status === 422) {
        const resErrors = e.response.data.errors
        Object.assign(errors, resErrors)
      } else {
        alert('Erro ao fazer login.')
      }
    }
  }
  </script>
