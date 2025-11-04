<script lang="ts" setup>
import AppShell from '@/components/AppShell.vue';
import Navbar from '@/components/Navbar.vue';
import Sidebar from '@/components/Sidebar.vue';
</script>

<template>
  <AppShell>
    <Navbar></Navbar>
    <Sidebar></Sidebar>
    <main class="p-4 md:ml-64 h-auto pt-20">
      <!-- <Skeleton /> -->
      <slot />
    </main>
  </AppShell>
</template>