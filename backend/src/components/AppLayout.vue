<template>
  <div class="min-h-full bg-gray-200 flex">
    <!-- sidebar -->
    <div :class="{'-ml-[200px]': !sidebarOpened}" class="transition-all duration-300 flex">
      <sidebar />
    </div>
    <!-- sidebar -->
    <div class="flex-1">
      <Navbar @toggle-sidebar="toggleSidebar"></Navbar>
      <!-- content -->
      <main class="p-6">
        <router-view></router-view>
      </main>
      <!-- content -->
    </div>
  </div>
</template>

<script setup>
import {ref,onMounted,onUnmounted,computed} from "vue"
import Navbar from "./Navbar.vue";
import Sidebar from "./Sidebar.vue";
const { title } = defineProps({
  title: String
})
const sidebarOpened = ref(true);
function toggleSidebar(){
  sidebarOpened.value = !sidebarOpened.value;
}
onMounted(()=>{
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

<style></style>