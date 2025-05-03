<template>
    <iframe :src="url" width="100%" height="300" style="border:0;" allowfullscreen loading="lazy"></iframe>
  </template>

  <script setup>
  defineProps(['url'])
  </script>
