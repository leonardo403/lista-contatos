<template>
    <div>
      <h2>{{ isEdit ? 'Editar Contato' : 'Novo Contato' }}</h2>

      <ContactForm
        :modelValue="contact"
        :isEdit="isEdit"
        :onSubmit="saveContact"
      />

      <AddressForm
        v-if="isEdit"
        :contactId="contact.id"
        :onSaved="loadContact"
      />

      <ul v-if="contact.addresses && contact.addresses.length">
        <li v-for="addr in contact.addresses" :key="addr.id">
          {{ addr.street }}, {{ addr.number }} - {{ addr.city }}/{{ addr.state }}
        </li>
      </ul>

      <button v-if="isEdit" @click="remove">Excluir Contato</button>
    </div>
  </template>

  <script setup>
  import { ref, onMounted } from 'vue'
  import { useRoute, useRouter } from 'vue-router'
  import { getContact, createContact, updateContact, deleteContact } from '../api/contacts'
  import ContactForm from '../components/ContactForm.vue'
  import AddressForm from '../components/AddressForm.vue'

  const route = useRoute()
  const router = useRouter()
  const id = route.params.id
  const isEdit = !!id

  const contact = ref({
    name: '',
    email: '',
    phone: '',
    addresses: [],
  })

  onMounted(() => {
    if (isEdit) loadContact()
  })

  async function loadContact() {
    const { data } = await getContact(id)
    contact.value = data
  }

  async function saveContact(data) {
    if (isEdit) {
      await updateContact(id, data)
    } else {
      const { data: created } = await createContact(data)
      router.push(`/contacts/${created.id}`)
    }
  }

  async function remove() {
    if (confirm('Tem certeza que deseja excluir?')) {
      await deleteContact(id)
      router.push('/contacts')
    }
  }
  </script>
