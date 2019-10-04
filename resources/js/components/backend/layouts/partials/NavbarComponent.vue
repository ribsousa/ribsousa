<template>
   <b-navbar fixed-top :class="paddingMain">
      <template slot="brand">
          <b-navbar-item tag="router-link" :to="{name: 'backend.dashboard'}">
              <img
                  class="is-rounded"
                  src="images/0.jpg"
                  alt="Banckend"
              >
          </b-navbar-item>
      </template>
      <template slot="start">
          <b-navbar-item tag="router-link" :to="{name: 'backend.dashboard'}">
              Dashboard
          </b-navbar-item>
          <b-navbar-item tag="router-link" :to="{name: 'backend.skills'}">
                Skills
          </b-navbar-item>
          <b-navbar-dropdown label="Contact">
              <b-navbar-item href="#">
                  {{ countSkills }}
              </b-navbar-item>
              <b-navbar-item href="#">
                  Contact
              </b-navbar-item>
          </b-navbar-dropdown>
      </template>

      <template slot="end">
          <b-navbar-item tag="div">
              <div class="buttons">
                  <a class="button is-primary">
                      <strong>Sign up</strong>
                  </a>
                  <a class="button is-light">
                      Log in
                  </a>
              </div>
          </b-navbar-item>
      </template>
    </b-navbar>
</template>

<script>
  export default {
   data (){
      return {
         paddingMain: 'main-padding-colapsed'
      }
   },
   computed: {
      countSkills () {
      return this.$store.state.skills.items.data.length
      }
   }
  }
</script>

<style lang="scss">
  .navbar {
     padding-left: 3.5rem;
     border-bottom: 1px solid #dcdada;
  }
</style>