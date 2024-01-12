<script setup>
import { RouterLink, RouterView } from 'vue-router'
</script>

<template>
    <header>
      <div class="wrapper">
        <nav>
          <RouterLink to="/">Home</RouterLink>
          <RouterLink to="/categories">Categories</RouterLink>
          <RouterLink to="/products">Products</RouterLink>
          <RouterLink to="/orders">Orders</RouterLink>
          <RouterLink to="/market">Market</RouterLink>
        </nav>
      </div>
    </header>

    <main>
      <RouterView />
    </main>

</template>

<style scoped>
header {
  line-height: 1.5;
  /* max-height: 100vh; */
}

nav {
  width: 100%;
  font-size: 12px;
  margin-top: 2rem;
}

nav a.router-link-exact-active {
  color: var(--color-text);
}

nav a.router-link-exact-active:hover {
  background-color: transparent;
}

nav a {
  display: inline-block;
  padding: 0 1rem;
}

nav a:first-of-type {
  border: 0;
}

@media (min-width: 1024px) {
  header {
    display: block;
    position:absolute;
    place-items: flex-start;
    padding-right: calc(var(--section-gap) / 2);
    padding-left: 35px;
  }

  header .wrapper {
    display: flex;
    place-content: center space-between;
    
    flex-wrap: wrap;
    position: absolute;
  }

  nav {
    display: flex;
    flex-direction:row;
    margin-left: -1rem;
    font-size: 1rem;
    width: 100%;
    padding: 1rem 0;
    margin-top: 1rem;
  }

}
</style>
