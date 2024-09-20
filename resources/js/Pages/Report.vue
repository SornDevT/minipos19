<template lang="">
    <div>
        <h1>Report Page</h1>
        <hr>
        <input type="text" v-model="key_token"> <br>
        <button @click="SetToken()" >Set Key</button>
    </div>
</template>
<script>
import { useStore } from '../Store/auth';
export default {
    setup(){
      const store = useStore();
      return { store }
    },
    data() {
        return {
            key_token:''
        }
    },
    methods:{
        SetToken(){
            this.store.set_token(this.key_token)
        }
    }
}
</script>
<style lang="">
    
</style>