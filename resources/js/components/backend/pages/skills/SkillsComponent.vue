<template>
   <section class="is-medium">
      <div class="container">
         <b-field grouped group-multiline>
            <b-select v-model="perPage" :disabled="!isPaginated" icon="format-list-numbers">
               <option value="5">5</option>
               <option value="10">10</option>
               <option value="15">15</option>
               <option value="20">20</option>
            </b-select>
            <div class="control">
               <b-button class="button field" type="is-success" tag="router-link" to="skills/create" icon-left="plus">
                  Novo
               </b-button>
            </div>
            <div class="control" v-if="checkedRows.length">
               <b-button class="button field" type="is-danger" @click="confirmDestroy()"
                  :disabled="!checkedRows.length" icon-left="archive" outlined>
                  <span>Excluir <b-tag>{{checkedRows.length}}</b-tag></span>
               </b-button>
            </div>
            <div class="control" v-if="checkedRows.length">
               <b-button class="button field" type="is-primary" @click="clearSelected()" icon-left="playlist-remove" outlined>
                  {{checkedRows.length}} Desmarcar
               </b-button>
            </div>
            <div class="control">
               <search @searchSkill="search"></search>
            </div>
         </b-field>
         <b-table 
            :data="skills.length ? skills : []"
            :columns="columns" 
            :loading="loading" 
            :checked-rows.sync="checkedRows"
            :selected.sync="selected"
            @dblclick="edit"
            :paginated="isPaginated"
            :per-page="perPage"
            :current-page.sync="currentPage"
            :pagination-simple="isPaginationSimple"
            :pagination-position="paginationPosition"
            :default-sort-direction="defaultSortDirection"
            :sort-icon="sortIcon"
            :sort-icon-size="sortIconSize"
            checkable
            draggable
            @click="showDeleteButton"
            default-sort="skill.name"
            aria-next-label="Next page"
            aria-previous-label="Previous page"
            aria-page-label="Page"
            aria-current-label="Current page">
            <template slot="empty">
               <section class="section">
                  <div class="content has-text-grey has-text-centered">
                     <p>
                        <b-icon
                           icon="emoticon-sad"
                           size="is-large">
                        </b-icon>
                     </p>
                     <p>Nenhum Registro Encontrado.</p>
                  </div>
               </section>
            </template>
         </b-table>
      </div>
   </section>
</template>

<script>
import SearchSkillComponent from './partials/SearchSkillComponent'

export default {
   created () {
      this.loadSkills()
   },
   computed: {
      skills () {
         return this.$store.state.skills.items.data
      },
      loading () {
         return this.$store.state.loading.loader
      }
   },
   data () {
      return {
         errors: {},
         filter: '',
         isTagItems: false,
         showDelete: false,
         showResults: false,
         selectedItems: [],
         ids: [],
         selected: {},
         checkedRows: [],
         isPaginated: true,
         isPaginationSimple: false,
         paginationPosition: 'bottom',
         defaultSortDirection: 'asc',
         sortIcon: 'sort-ascending',
         sortIconSize: 'is-small',
         currentPage: 1,
         perPage: 10,
         columns: [
            {
               field: 'id',
               label: 'ID',
               width: '40',
               numeric: true
            },
            {
               field: 'name',
               label: 'Nome',
               sortable: true
            },
            {
               field: 'created_at',
               label: 'Criado em',
               sortable: true
            },
            {
               field: 'updated_at',
               label: 'Atualizado em',
               centered: false,
               sortable: true
            }
         ],
      }
   },
   methods: {
      loadSkills () {
         console.log(this.filter);
         this.$store.dispatch('loadSkills', {name: this.filter})
      },
      edit (skill) {
         this.$buefy.dialog.prompt({
            inputAttrs: {
               maxlength: 10,
               value: skill.name
            },
            trapFocus: true,
            confirmText: 'Salvar',
            cancelText: 'Cancelar',
            onConfirm: (value) => {
               skill.name = value
               this.update(skill)
               this.clearSelected()
            }
         })
      },
      update (skill) {
         this.$store.dispatch('update', skill)
                        .then(() => {
                           this.errors = {}
                           this.$buefy.notification.open({
                              message: 'Skill alterado com sucesso!',
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
                        .finally()
      },
      confirmDestroy () {
         this.$buefy.dialog.confirm({
            message: `${this.checkedRows.length} registros serão excluídos permanentemente`,
            confirmText: 'Confirmar exclusão',
            cancelText: 'Cancelar',
            type: 'is-danger',
            position: 'is-bottom',
            hasIcon: true,
            onConfirm: () => this.handlerDestroy(),
            onCancel: () => this.clearSelected()
         })
      },
      handlerDestroy () {
         this.ids = this.checkedRows.map(skill => skill.id);
         this.selectedItems = this.ids.length

         if (this.ids.length > 1) {
            this.destroyAll()
         } else {
            this.destroy()
         }
            
      },
      destroy () {
         this.$store.dispatch('destroy', this.ids)
                        .then(() => {
                           this.$buefy.notification.open({
                              message: 'Skill excluído com sucesso!',
                              type: 'is-success',
                              hasIcon: true,
                              position: 'is-bottom',
                              closable: true,
                              duration: 3000
                           })
                           this.clearSelected()
                           this.showDelete = false
                           this.loadSkills()
                        })
                        .catch(error => {
                           this.$buefy.notification.open({
                              message: 'Erro ao excluir!',
                              type: 'is-danger',
                              hasIcon: true,
                              position: 'is-bottom',
                              closable: true,
                              duration: 3000
                           })
                        })
                        .finally(() => {
                           
                        })

      },
      destroyAll () {
         this.ids = this.checkedRows.map(skill => skill.id);
         this.selectedItems = this.ids.length

         this.$store.dispatch('destroyAll', this.ids)
                        .then(() => {
                           let mesage = this.selectedItems > 1 ? 'skills excluídos!' : 'skill excluído!'
                           this.$buefy.notification.open({
                              message: mesage,
                              type: 'is-success',
                              hasIcon: true,
                              position: 'is-bottom',
                              closable: false,
                              duration: 3000
                           })
                           this.clearSelected()
                           this.showDelete = false
                           this.loadSkills()
                        })
                        .catch(error => {
                           console.log(error)
                        })
                        .finally(() => {
                           
                        })
      },
      search (filter) {
         this.clearSelected()
         this.filter = filter
         this.loadSkills()
         this.showResults = true
      },
      clearSelected () {
         this.selected = {}
         this.checkedRows = []
      },
      showDeleteButton (value) {
         this.clearSelected()
         this.checkedRows.push(value)
      }
   },
   components: {
      search: SearchSkillComponent
   }
}
</script>

<style lang="scss">
   .b-table thead th .th-wrap .icon {
      color: #23d160;
      &.is-desc {
         color: #ff3860;
      }
   }
</style>
