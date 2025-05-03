import http from './http'

export function login(data) {
  return http.post('/login', data)
}

export function register(data) {
  return http.post('/register', data)
}

export function logout() {
  return http.post('/logout')
}
