<template>
        <AppLayout>
            <div class="container">
          <div class="card">
            <div class="card-body">
                <table class="w-full border">

                </table>
                <Link
            class="link-button-default my-3"
            :href="route('create')"
            >Create</Link>
                <div class="container m-auto">
                    <table class="w-full"> 

                    </table> 

                </div>
            <div class="overflow-x-auto">
                <table class="w-full border border-black-600">
                    <thead>
                        <tr class="border-b bg-blue-500">
                            <th class="p-3">
                                id
                            </th>
                            <th class="p-3">
                                Title
                            </th>
                            <th class="p-3">
                                Slug
                            </th>
                            <th class="p-3">
                                Actions
                            </th>
                        </tr >
                    </thead>
                    <tbody>
                        <tr class="border-b bg-blue-200" v-for="category in categories.data" :key="category.id">
                            <th class="p-2">
                                {{ category.id }}
                            </th>
                            <th>
                                {{ category.title }}
                                </th>
                                <th>
                                    {{ category.slug }}
                                </th>
                                <th>
                                    <Link class="text-sm mr-4 text-purple-400 hover:text-purple-700"
                                        :href="route('category.edit', category.id)">
                                        Edit
                                    </Link >
                                    <Link as="button" type="button" method="DELETE" class="text-sm text-red-400 hover:text-red-700 ml-2" :href="route('category.destroy', category.id)">Delete</Link>
                                </th>
                            </tr>
                        </tbody>
                    <!-- <template v-for="l in categories.links" :key="l">
            <Link v-if="!l.active" class="px-2 py-1" :href="l.url" v-html="l.label"/>
            <span v-else class="px-2 py-1 cursor-pointer text-gray-500"  v-html="l.label"  />
        </template> -->
                </table>
            </div>

            <Pagination class="my-4" :links="categories" />
        </div>
          </div>
        </div>

    </AppLayout>
</template>
<script>
import Pagination from "@/Shared/Pagination.vue";
import { Link } from "@inertiajs/inertia-vue3";

import AppLayout from '@/Layouts/AppLayout.vue';

export default {
    components: {
        AppLayout,
        Link,
        Pagination,
    },
    props: {
        categories: Object,
    },
    methods: {
    deleteCategory() {
      Inertia.delete(route("category.destroy", this.deleteCategoryRow));
      this.confirmDeleteActive = false;
            
        },
    },
};
</script>
