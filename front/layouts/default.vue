<template>
  <div>
    <div class="page-container">
      <div class="menu">
          <h2> {{title}} </h2>
          <nav>
            <NuxtLink class="lien" to="/"> 
              <span id="icon-dashboard" class="material-icons">dashboard</span> 
              <p>Dashboard</p>
            </NuxtLink>
            <NuxtLink class="lien" to="/liste">
              <span id="icon-list" class="material-icons">list</span>
              <p>Tickets</p>
            </NuxtLink> 
          </nav>
      </div>
      <div class="menu-user">
        <!-- Valeur en dure en attendant de mettre en place le système d'authentification avec token -->
        <p>Alice Lafleur</p>
        <p>alicelafleur10@gmail.com</p>
        <v-btn elevation="0" > deconnexion </v-btn>
      </div>

      <v-app>
        <v-main>
          <Nuxt />
        </v-main>
      </v-app>
    </div>
  </div>
</template>

<script>
export default {
  data () {
    return {
      title: 'Vuetify.js'
    }
  },
  created() {
    let _this = this;
    this.$root.updateTitle = function(value) {
      _this.title = value;
    }
  }
}
</script>
