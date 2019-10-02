<template>
  <main :class="paddingMain">
    <navbar-component ></navbar-component>
    <section class="main-content">
      <router-view ></router-view>
    </section>
    <footer-component></footer-component>
    <sidebar-component @onToggleCollapse="toggleCollapse"></sidebar-component>
  </main>
</template>
<script>
  import NavbarComponent from './partials/NavbarComponent'
  import FooterComponent from './partials/FooterComponent'
  import SidebarComponent from './partials/SidebarComponent'

  export default {
    data () {
      return {
        paddingMain: 'main-padding-colapsed'
      }
    },
    computed: {
      countSkills () {
        return this.$store.state.skills.items.data.length
      }
    },
    methods: {
      toggleCollapse (collapsed) {
        console.log(collapsed)
        if(collapsed){
          this.paddingMain = 'main-padding-colapsed'
        } else {
          this.paddingMain = 'main-padding-colapse'
        }    
      }
    },
    components: {
      NavbarComponent,
      SidebarComponent,
      FooterComponent
    }
  }
</script>

<style>
  .main-content {
    padding: 2rem;
  }
  .main-padding-colapsed {
    padding-left: 3.5rem;
  }
  .main-padding-colapse {
    padding-left: 20rem;
  }
</style>
