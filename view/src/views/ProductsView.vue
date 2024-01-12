<script>

import axios from 'axios';


export default {
  data() {
    return {
      products: [],
      categories: [],
      formData: {
        title: '',
        price: '',
        category_id: ''
      },
      
    }
  },
  methods: {
    getProducts() {
     axios.get("http://localhost:9050/product", {
      })
      .then(response => { 
        const data = response.data.data;
        data.map((product)=>{
          this.products.push(product);
        })
       })
      .catch(error => console.log(error))
    },
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

      fetch("http://localhost:9050/product", requestOptions)
      .then(  response => {
        alert('the product was created');
      })
      .catch(error => alert(error));
    }
  },
  created() {
    this.getProducts();
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
            <label for="tax">Category</label>
            <select v-model="formData.category_id"  name="categories" id="categoies" >
              <option :value="category.id" v-for="category in categories" >{{ category.title }}</option>
            </select>
          </div>
          <div class="input-group">
            <label for="price">Price</label>
            <input  v-model="formData.price" type="number" name="price" min="0.1" step="0.01">
          </div>
        </div>
        
        <button>Create Product</button>
      </form> 
      <table>
        <tr>
          <th>id</th>
          <th>title</th>
          <th>category</th>
          <th>price</th>
        </tr>
        <div class="roll">
          <tr v-for="product in products" class="hover-line">
          <td>{{ product.id }}</td>
          <td>{{ product.title}}</td>
          <td>{{ product.category_title}}</td>
          <td>${{ product.price }}</td>
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