<template lang="">
    <div>
        <h1>Store Page ghdfsjhgjdfhgjdfh</h1>
        <hr>
        {{store.get_token}}
    </div>
</template>
<script>
import { useStore } from '../Store/auth';
export default {
    setup(){
      const store = useStore();
      return { store }
    },
}
</script>
<style lang="">
    
</style>