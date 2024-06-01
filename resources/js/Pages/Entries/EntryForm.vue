<template>
    <div>
      <h1>Criar Nova Entrada</h1>
      <form @submit.prevent="handleSubmit">
        <div>
          <label for="title">Título</label>
          <input type="text" id="title" v-model="form.title" required />
        </div>
        <div>
          <label for="text">Texto</label>
          <textarea id="text" v-model="form.text" required></textarea>
        </div>
        <button type="submit">Salvar</button>
      </form>
    </div>
  </template>
  
  <script>
  import { Inertia } from '@inertiajs/inertia';
  
  export default {
    data() {
      return {
        form: {
          title: '',
          text: '',
          user_id: this.$page.props.auth.user.id,
        },
      };
    },
    methods: {
      handleSubmit() {
        Inertia.post('/entries', this.form);
      },
    },
  };
  </script>
  
  <style scoped>
  /* Estilos específicos para a página EntryForm */
  h1 {
    font-size: 2em;
    margin-bottom: 20px;
  }
  form {
    display: flex;
    flex-direction: column;
  }
  div {
    margin-bottom: 10px;
  }
  label {
    margin-bottom: 5px;
  }
  input,
  textarea {
    padding: 10px;
    font-size: 1em;
    width: 100%;
    box-sizing: border-box;
  }
  button {
    padding: 10px 15px;
    font-size: 1em;
    cursor: pointer;
  }
  </style>
  