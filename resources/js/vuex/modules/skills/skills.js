import axios from 'axios'
import { reject } from 'q';

export default {
   state: {
      items: {
         data: []
      }
   },
   mutations: {
      LOAD_SKILLS (state, skills) {
         state.items.data = skills
      }
   },
   actions: {
      loadSkills (context, params) {
         context.commit('LOADING', true)
         axios.get('/api/v1/skills', {params})
                  .then(response => {
                     console.log(response)
                  
                     context.commit('LOAD_SKILLS', response.data)
                  })
                  .catch(errors => {
                     console.log(errors)
                  })
                  .finally( () => {
                     context.commit('LOADING', false)
                  })
      },
      store (context, params) {
         context.commit('LOADING', true)
         return new Promise((resolve, reject) => {
            axios.post('/api/v1/skills', params)
                  .then(response => resolve())
                  .catch(error => reject(error))
                  .finally(() => {
                     context.commit('LOADING', false)
                  })
         })
      },
      update (context, params) {
         context.commit('LOADING', true)
         return new Promise((resolve, reject) => {
            axios.put(`/api/v1/skills/${params.id}`, params)
                  .then(response => resolve())
                  .catch(error => reject(error))
                  .finally(() => {
                     context.commit('LOADING', false)
                  })
         })
      },
      destroy (context, id) {
         return new Promise((resolve, reject) => {
            axios.delete(`/api/v1/skills/${id}`)
                  .then(response => resolve())
                  .catch(error => reject(error))
                  .finally(() => {})
         })
      },
      destroyAll (context, ids) {
         return new Promise((resolve, reject) => {
            axios.delete(`/api/v1/skills/delete/${ids}`)
                  .then(response => resolve())
                  .catch(error => reject(error))
                  .finally(() => {})
         })
      }
   },
   getters: {

   }
}
