<template>
   <sidebar-menu 
      :menu="menu"
      width="300px"
      widthCollapsed="3.25rem"
      collapsed
      theme="white-theme"
      @toggle-collapse="onToggleCollapse">
      <span slot="header">
         <img
            class="is-rounded"
            src="/images/git.png"
            alt="Banckend"
         >
      </span>
      <span slot="toggle-icon">
         <b-icon
            pack="mdi"
            :icon="toggleIcon"
            type="is-primary"
         >
         </b-icon>
      </span>
   </sidebar-menu>
</template>

<script>
   import { SidebarMenu } from 'vue-sidebar-menu'
   import 'vue-sidebar-menu/dist/vue-sidebar-menu.css'
   
   export default {
      data() {
         return {
               toggleIcon: 'gesture-swipe-right',
               paddingMain: 'main-padding-colapsed',
               menu: [
                  {
                     header: true,
                     title: 'Backend Menu',
                     hiddenOnCollapse: true
                  },
                  {
                     href: {name: 'backend.dashboard'},
                     title: 'Dashboard',
                     icon: 'fa fa-code-branch'
                  },
                  {
                     href: {name: 'backend.skills'},
                     class: '',
                     title: 'Skills',
                     icon: 'fa fa-award',
                     child: [{
                        href: {name: 'backend.skills.create'},
                        title: 'Novo',
                        icon: 'fa fa-plus has-text-success',
                        }
                     ],
                      badge: {
                        text: 'new',
                        class: 'vsm--badge_default'
                        //attributes: {value: 'teste'}
                        // element: 'span'
                     }
                  }
               ]
         }
      },
      computed: {
         countSkills () {
            return this.$store.state.skills.items.data.length
         }
      },
      methods: {
         onToggleCollapse (collapsed) {
           this.$emit('onToggleCollapse', collapsed)
           this.toggleIcon = collapsed ? 'gesture-swipe-right' : 'gesture-swipe-left'
         }
      },
      components: {
         SidebarMenu
      }
   }
</script>

<style lang="scss">
  .v-sidebar-menu {
     border-right: 1px solid #dcdada;
  }
  .v-sidebar-menu.vsm_white-theme .vsm--link {
      color: #7957d5;
   }
  .v-sidebar-menu.vsm_white-theme 
  .vsm--link_level-1.vsm--link_exact-active 
  .vsm--icon, .v-sidebar-menu.vsm_white-theme 
  .vsm--link_level-1.vsm--link_active 
  .vsm--icon {
      background-color:#7957d5;
   }
   .v-sidebar-menu.vsm_white-theme.vsm_expanded 
   .vsm--item.vsm--item_open 
   .vsm--link_level-1 {
    background-color: #7957d5;
   }

</style>
