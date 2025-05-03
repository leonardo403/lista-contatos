<template>
  <form @submit.prevent="save">
    <input v-model="form.cep" @blur="buscarCep" placeholder="CEP" />
    <input v-model="form.street" placeholder="Rua" />
    <input v-model="form.number" placeholder="Número" />
    <input v-model="form.neighborhood" placeholder="Bairro" />
    <input v-model="form.city" placeholder="Cidade" />
    <input v-model="form.state" placeholder="Estado" />
    <button type="submit">Salvar Endereço</button>

    <AddressMap v-if="mapUrl" :url="mapUrl" />
  </form>
</template>

<script setup>
import { ref, watch } from 'vue'
import axios from 'axios'
import AddressMap from './AddressMap.vue'

const props = defineProps(['contactId', 'onSaved'])

const form = ref({
  contact_id: props.contactId,
  cep: '',
  street: '',
  number: '',
  neighborhood: '',
  city: '',
  state: '',
})

const mapUrl = ref('')

async function buscarCep() {
  try {
    const { data } = await axios.get(`http://lista-contato.test:8000/api/cep/${form.value.cep}`)
    form.value.street = data.street
    form.value.neighborhood = data.neighborhood
    form.value.city = data.city
    form.value.state = data.state
  } catch (e) {
    alert('CEP inválido')
  }
}

async function save() {
  await axios.post('http://lista-contato.test:8000/api/addresses', form.value, {
    headers: {
      Authorization: `Bearer ${localStorage.getItem('token')}`,
    },
  })

  const { data } = await axios.get(`http://lista-contato.test:8000/api/addresses/${props.contactId}/map`)
  mapUrl.value = data.url

  props.onSaved()
}
</script>
