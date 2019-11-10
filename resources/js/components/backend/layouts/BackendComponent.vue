<template>
  <main :class="paddingMain">
    <navbar-component ></navbar-component>
    <section class="main-content">
      <transition name="fade" mode="out-in">
        <router-view></router-view>
      </transition>
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

<style lang="scss" scoped>
  .main-content {
    padding: 2rem;
  }
  .main-padding-colapsed {
    padding-left: 3.5rem;
  }
  .main-padding-colapse {
    padding-left: 20rem;
  }
  .fade-enter-active,
  .fade-leave-active {
    transition-duration: 0.2s;
    transition-property: opacity;
    transition-timing-function: ease;
  }
  .fade-enter,
  .fade-leave-active {
    opacity: 0
  }
</style>
