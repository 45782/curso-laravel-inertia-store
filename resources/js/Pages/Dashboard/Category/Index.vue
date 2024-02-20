<template>


    <AppLayout>
        
     <table class="w-full">
       <thead>
        <th class="p-3">id</th>
        <th class="p-3">Title</th>
        <th class="p-3">Slug</th>
        <th class="p-3">Actions</th>
       </thead>
       <tbody>
        <tr v-for="c in categories" :key="c.id">
            <td class="p-2">{{ c.id }} </td>
            <td class="p-2">{{ c.title }} </td>
            <td class="p-2">{{ c.Slug }} </td>
            <td class="p-2">--</td>
            <Link :href="route('category.edit', c.id)">Edit</Link>
            

        </tr>
       </tbody>

     </table>
     <Link v-for="l in categories.links" :key="l" :href="l.url" v-html="l.label"> </Link>


    </AppLayout>
</template>
<script>
import { Link } from "@inertiajs/inertia-vue3";

import AppLayout from '@/Layouts/AppLayout.vue';


export default {

    components:{
    AppLayout,
    Link,
},
    props:{
        category : Object
    }
}


</script>