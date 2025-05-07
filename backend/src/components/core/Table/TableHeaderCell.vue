<template>
    <th @click="emit('click',field)"
     class="border-b-2 p-2 text-left cursor-pointer bg-gray-100" 
      :class="field === sortField ? 'bg-blue-50' : ''">
        <div class="flex justify-between">
            <slot></slot>
            <div v-if="sortField === field" class="ml-2">
                <svg v-if="sortDirection === 'asc'" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke-width="1.5" stroke="currentColor" class="w-4 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 10.5 12 3m0 0 7.5 7.5M12 3v18" />
                </svg>
                <svg v-else xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-4 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 13.5 12 21m0 0-7.5-7.5M12 21V3" />
                </svg>

            </div>
        </div>

    </th>
</template>

<script setup>
const {field, sortField,sortDirection} = defineProps({
    field:String,
    sortField:String,
    sortDirection:String,
})
const emit = defineEmits(['click'])
</script>