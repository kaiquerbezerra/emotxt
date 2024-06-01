<script setup>
import { Head, Link } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { ref } from 'vue';
import { usePage } from '@inertiajs/vue3'


const entries = ref(usePage().props.entries);
const userId = ref(usePage().props.auth.user.id);
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                        <div v-for="entry in entries" :key="entry.id" class="bg-yellow-200 rounded shadow hover:bg-yellow-300 transition aspect-w-1 aspect-h-1">
                            <Link :href="`/user/entry/show/${entry.id}`" class="block w-full h-full p-4">
                                <h3 class="text-lg font-semibold">{{ entry.title }}</h3>
                            </Link>
                        </div>
                    </div>
                </div>

                <div class="my-5">
                    <Link href="/user/entry/create" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-3 px-3 rounded">
                        Cadastrar nova entrada
                    </Link>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style scoped>
.grid {
    display: grid;
    gap: 1rem;
}
</style>
