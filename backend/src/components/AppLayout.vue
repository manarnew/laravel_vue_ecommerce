<template>
  <div v-if="currentUser && currentUser.id" class="min-h-full bg-gray-200 flex">
    <!-- sidebar -->
    <Sidebar :class="{'-ml-[200px]': !sidebarOpened}" />
    <!-- sidebar -->
    <div class="flex-1">
      <Navbar @toggle-sidebar="toggleSidebar" />
      <!-- content -->
      <main class="p-6">
        <router-view />
      </main>
      <!-- content -->
    </div>
  </div>
  <div v-else class="min-h-full flex items-center justify-center">
    <Spinner />
  </div>
</template>

<script setup>
import {ref,onMounted,onUnmounted,computed} from "vue"
import Sidebar from "./Sidebar.vue"
import Navbar from "./Navbar.vue";
import store from "@/store";
import Spinner from "./Spinner.vue";
const currentUser = computed(()=> store.state.user.data);
const { title } = defineProps({
  title: String
})
const sidebarOpened = ref(true);
function toggleSidebar(){
  sidebarOpened.value = !sidebarOpened.value;
}
onMounted(()=>{
  store.dispatch('getUser')
  handleSideBarOpened
  window.addEventListener('resize',handleSideBarOpened);
}) 
onUnmounted(()=>{
  window.addEventListener('resize',handleSideBarOpened);
})
function handleSideBarOpened(){
    sidebarOpened.value = window.outerWidth > 768;
}
</script>
