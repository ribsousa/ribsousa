export default {
   state: {
      loader: false
   },
   mutations: {
      LOADING (state, status)  {
         state.loader = status
      }
   }
}