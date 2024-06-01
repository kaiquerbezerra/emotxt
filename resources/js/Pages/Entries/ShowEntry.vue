<script setup>
import { Link, usePage } from '@inertiajs/vue3';
import PrimaryButton from '@/Components/PrimaryButton.vue';

const props = defineProps({
    entry: {
        type: Object,
        required: true
    }
});

const handleDelete = () => {
    if (confirm('Tem certeza que deseja excluir esta entrada?')) {
        Inertia.delete(route('entry.destroy', props.entry.id), {
            onSuccess: () => {
                Inertia.visit('/dashboard');
            }
        });
    }
};
</script>

<template>
    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900">{{ entry.title }}</h2>
        </header>

        <article class="mt-4">
            <p class="text-sm text-gray-600">{{ entry.text }}</p>
        </article>

        <div class="mt-6 flex items-center gap-4">
            <Link :href="route('entry.edit', entry.id)" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Editar
            </Link>
            <PrimaryButton @click="handleDelete">Excluir</PrimaryButton>
            <Link :href="route('dashboard')" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Voltar ao Dashboard
            </Link>
        </div>
    </section>
</template>

<style scoped>
/* Estilos específicos para a página ShowEntry */
header {
    margin-bottom: 20px;
}
article {
    font-size: 1.2em;
}
</style>
