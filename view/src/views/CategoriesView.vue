<script>

import axios from 'axios';


export default {
  data() {
    return {
      categories: [],
      formData: {
        title: '',
        tax_percentage: ''
      },
    }
  },
  methods: {
    getCategories() {
     axios.get("http://localhost:9050/category", {
      })
      .then(response => { 
        const data = response.data.data;
        data.map((category)=>{
          this.categories.push(category);
        })
       })
      .catch(error => console.log(error))
    },
    submitForm() {
      const requestOptions = {
        method: "POST",
        mode: 'no-cors',
        headers: { 
          "Content-Type": "application/json",
          "Access-Control-Allow-Method": "POST" 
        },
        body: JSON.stringify(this.formData)
      };

      fetch("http://localhost:9050/category", requestOptions)
      .then(  response => {
        alert('the category was created');
      })
      .catch(error => alert(error));
    }
  },
  created() {
    this.getCategories();
  }
}
</script>

<template>
  <div class="content">
    <div class="about">   
      <form @submit.prevent="submitForm">
        <div class="form-input">
          <div class="input-group">
            <label for="title">Title</label>
            <input v-model="formData.title" type="text" name="title" min="1" max="100">
          </div>
          <div class="input-group">
            <label for="tax">Tax Percentage</label>
            <input  v-model="formData.tax_percentage" type="number" name="tax" min="1" max="100">
          </div>
        </div>
        
        <button>Create Category</button>
      </form> 
      <table>
        <tr>
          <th>id</th>
          <th>title</th>
          <th>tax percentage</th>
        </tr>
        <div class="roll">
          <tr v-for="category in categories" class="hover-line">
          <td>{{ category.id }}</td>
          <td>{{category.title}}</td>
          <td>{{ category.tax_percentage }}</td>
        </tr>
        </div>
        
      </table>
    </div>
  </div>
    
  </template>
  
  <style>
  @media (min-width: 1024px) {
    .content {
      display: flex;
      margin: 0 auto;
    }
    
    .about {
      width: 100vw;
      place-content: center;
      display: flex;
      flex-direction: column;
    }

    form {
      display: flex;
      flex-direction: column;
      place-content: center;
      width: 100%;
      margin-bottom: 30px;
    }

    .form-input {
      display: flex;
      flex-direction: row;
      place-content: center;
      width: 100%;
      margin-bottom: 30px;
    }

    .roll {
      max-height: 500px;
      overflow: auto;
    }
    input{ 
      margin: 4px 20px;
    }

    .input-group {
      display: flex;
      flex-direction: column;
      text-align: center;
    }

    button {
      align-self: center;
      width: 180px;
      padding: 10px 5px;
      font-weight: 600;
      font-size:medium;
    }
    
    table {
      border-collapse: collapse;
      width: 50%;
      margin: 0 auto;
    }

    tr {
      display: flex;
      width: 100%;
    }

    th, td {
      text-align: left;
      padding: 8px;
      flex: 1;
    }
  
    table th {
      font-weight:bolder;
    }

    tr:nth-child(even) {
      background-color: #E5E4E2;
      color: #808080;
    }
  }
  </style>