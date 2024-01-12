<script>

import axios from 'axios';


export default {
  data() {
    return {
      orders: [],
      categories: [],
    }
  },
  methods: {
    getOrders() {
     axios.get("http://localhost:9050/order", {
      })
      .then(response => { 
        const data = response.data.data;
        data.map((order)=>{
          this.orders.push(order);
        })
       })
      .catch(error => console.log(error));

      console.log(this.orders);
    },
  },
  created() {
    this.getOrders();
  }
}
</script>

<template>
  <div class="content">
    <div class="about">   
      <table>
        <tr>
          <th>title</th>
          <th>total sold</th>
          <th>total tax paid</th>
        </tr>
        <div class="roll">
          <tr v-for="order in orders">
            <td>{{ order.product_title }}</td>
            <td>{{ order.total_sold}}</td>
            <td>${{ order.total_tax_paid }}</td>
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