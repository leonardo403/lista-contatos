import http from './http'

export function getContacts() {
  return http.get('/contacts')
}

export function getContact(id) {
  return http.get(`/contacts/${id}`)
}

export function createContact(data) {
  return http.post('/contacts', data)
}

export function updateContact(id, data) {
  return http.put(`/contacts/${id}`, data)
}

export function deleteContact(id) {
  return http.delete(`/contacts/${id}`)
}
