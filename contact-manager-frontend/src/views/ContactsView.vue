<template>
    <div>
      <h2>Meus Contatos</h2>
      <router-link to="/contacts/new">+ Novo Contato</router-link>
      <ul v-if="contacts.length">
        <li v-for="c in contacts" :key="c.id">
          <router-link :to="`/contacts/${c.id}`">
            {{ c.name }} - {{ c.email }}
          </router-link>
        </li>
      </ul>
    </div>
  </template>

  <script setup>
  import { onMounted, ref } from 'vue'
  import { getContacts } from '../api/contacts'

  const contacts = ref([])

  onMounted(async () => {
    const { data } = await getContacts()
    contacts.value = data
  })
  </script>
