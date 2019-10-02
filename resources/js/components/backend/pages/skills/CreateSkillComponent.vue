<template>
   <section>
      <div class="container">
         <div class="columns">
            <div class="column is-5 is-offset-3">
               <div class="card">
                  <div class="card-content">
                     <div class="content">
                        <form>
                           <b-field label="Nome"
                              label-position="inside"
                              :type="errors.name ? 'is-danger' : ''"
                              :message="errors.name ? errors.name : ''">
                              <b-input ref="name" v-model="name" maxlength="60"></b-input>
                           </b-field>
                           <b-field>
                              <p class="control">
                                 <b-button type="is-primary" icon-left="cube-send" :loading="loading" @click="submit" outlined>
                                 Enviar
                                 </b-button>
                              </p>
                           </b-field>
                        </form>
                     </div>
                  </div>   
               </div>
            </div>
         </div>
      </div>
   </section>
</template>

<script>
export default {
   data () {
      return {
        name: '',
        loading: false,
        errors: {}
      }
   },
   mounted () {
      this.$refs.name.focus()
   },
   methods: {
      submit () {
            
         this.loading = true
         this.$store.dispatch('store', {name: this.name})
                        .then(() => {
                           this.$router.push({name: 'backend.skills'})
                           this.errors = {}
                           this.$buefy.notification.open({
                              message: 'Skill incuído com sucesso!',
                              type: 'is-success',
                              hasIcon: true,
                              position: 'is-bottom',
                              closable: true,
                              duration: 3000
                           })
                        })
                        .catch(error => {
                           this.errors = error.response.data.errors
                            this.$buefy.notification.open({
                              message: this.errors.name[0],
                              type: 'is-danger',
                              hasIcon: true,
                              position: 'is-bottom',
                              closable: true,
                              duration: 3000
                           })
                        })
                        .finally(() => this.loading = false)
            
         
      }
   }  
}
</script>

<style scoped>

</style>