import { defineStore } from 'pinia'
import { login, register, logout } from '../api/auth'

export const useAuthStore = defineStore('auth', {
  state: () => ({
    user: null,
    token: localStorage.getItem('token') || null,
  }),
  actions: {
    async loginUser(credentials) {
      const { data } = await login(credentials)
      this.token = data.token
      localStorage.setItem('token', data.token)
    },
    async registerUser(payload) {
      const { data } = await register(payload)
      this.token = data.token
      localStorage.setItem('token', data.token)
    },
    async logoutUser() {
      await logout()
      this.token = null
      localStorage.removeItem('token')
    },
  },
})
