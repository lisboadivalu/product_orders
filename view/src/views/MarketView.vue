<script>

import axios from 'axios';

export default {
  data() {
    return {
      products: [],
      categories: [],
      formData: {
        product_id: '',
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
    submitData(data) {
      this.formData.product_id = data.id;
      this.formData.category_id = data.category_id;

      const requestOptions = {
        method: "POST",
        mode: 'no-cors',
        headers: { 
          "Content-Type": "application/json",
          "Access-Control-Allow-Method": "POST" 
        },
        body: JSON.stringify(this.formData)
      };

      fetch("http://localhost:9050/order", requestOptions)
      .then(  response => {
        alert('the order was created');
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
      
      <table>
        <tr>
          <th>id</th>
          <th>title</th>
          <th>category</th>
          <th>price</th>
          <th>action</th>
        </tr>
        <div class="roll">
          <tr v-for="product in products" class="hover-line">
            <td>{{ product.id }}</td>
            <td>{{ product.title}}</td>
            <td>{{ product.category_title}}</td>
            <td>${{ product.price }}</td>
            <td>
              <button @click="submitData(product)">Buy</button>
            </td>
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
      width: 40px;
      padding: 10px 5px;
      font-weight: 600;
      font-size:10px;
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