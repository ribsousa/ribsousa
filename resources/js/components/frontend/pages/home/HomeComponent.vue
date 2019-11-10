<template>
   <section class="hero is-medium">
      <div class="hero-head has-text-centered">
         <!--
         <router-link :to="{name: 'frontend.home'}">
            <img
               class="is-rounded logo-mark"
               src="/images/logo.png"
               alt="Banckend"
            >
         </router-link>
         -->
      </div>
      <div class="hero-body">
         <div class="container has-text-centered">
            <transition appear name="slide-fade">
               <figure class="image">
                  <img
                     class="is-rounded center"
                     src="/images/0.jpg"
                     alt="Banckend"
                  >
                  <figcaption class="title is-6">
                     Ronaldo R Sousa
                  </figcaption>
               </figure>
            </transition>
            
            <transition appear name="fade">
            <b-button type="is-success" icon-left="xml" outlined>
               <vue-typer
                  :text='["Always developing","Looking for new opportunities","Thanks for contacting"]'
                  :repeat='Infinity'
                  :shuffle='false'
                  initial-action='typing'
                  :pre-type-delay='70'
                  :type-delay='70'
                  :pre-erase-delay='2000'
                  :erase-delay='250'
                  erase-style='select-all'
                  :erase-on-complete='false'
                  caret-animation='blink'
                  >
               </vue-typer>
               </b-button>
            </transition>
         </div>
      </div>
      <div class="hero-foot has-text-centered">
         <section>
            <h6 class="subtitle is-6">
               <b-button size="is-small" icon-left="arrow-collapse-down">Contact me</b-button>
            </h6>
             
            <b-button 
               type="is-dark" 
               outlined  
               size="is-large" 
               icon-left="github-circle"
               tag="a"
               href="https://github.com/ribsousa"
               target="_blank">
            </b-button>
            <b-button 
               outlined
               type="is-info" 
               size="is-large" 
               icon-left="linkedin-box"
               tag="a"
               href="https://www.linkedin.com/in/ribsousa/"
               target="_blank">
               </b-button>
            <b-button  size="is-large" icon-left="git"  type="is-danger" 
               outlined  ></b-button>
         </section> 
      </div>
   </section>
</template>

<script>
import axios from 'axios'
import { VueTyper } from 'vue-typer'

export default {
   data (){
      return {
         commits: []
      }
   },
   created () {
      this.getGitUser()
   },
   methods: {
      getGitUser () {
         axios.get('https://api.github.com/repos/ribsousa/featured-images/commits?per_page=3&sha=')
               .then(response => {
                  this.commits = response.data
                  console.log(this.commits)
               });  
      }
   },
   components: {
      VueTyper
   }
}
</script>

<style lang="scss" scoped>
.fade-enter-active, .fade-leave-active {
  transition: opacity .5s
}
.fade-enter, .fade-leave-active {
  opacity: 0
}
.slide-fade-enter-active {
  transition: all .8s cubic-bezier(1.0, 0.5, 0.8, 1.0);
}
.slide-fade-leave-active {
  transition: all .8s cubic-bezier(1.0, 0.5, 0.8, 1.0);
}
.slide-fade-enter, .slide-fade-leave-to
/* .slide-fade-leave-active em versões anteriores a 2.1.8 */ {
  transform: translateX(10px);
  opacity: 0;
}
.center {
  display: block;
  margin-left: auto;
  margin-right: auto;
  padding: 5px;
  width: 10.0rem;
  border: 1px solid #dedede;
}
.vue-typer {
  font-family: monospace;
}
.vue-typer .custom.char {
  color: #D4D4BD;
  background-color: #1E1E1E;
}
.vue-typer .custom.char.selected {
  background-color: #264F78;
}
.vue-typer .custom.caret {
  width: 10px;
  background-color: #3F51B5;
}
.logo-mark {
   width: 120px;
}
</style>
