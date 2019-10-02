<template>
      <b-input
         placeholder="Search..."
         type="search"
         icon="magnify"
          @input="searchSkill" 
         v-model="filter">
      </b-input>
</template>

<script>
export default {
   data () {
      return {
         filter: '',
         expanded: true
      }
   },
   methods: {
      searchSkill () {
         this.$emit('searchSkill', this.filter)
      }
   }
}
</script>

<style lang="stylus" scoped>

</style>
