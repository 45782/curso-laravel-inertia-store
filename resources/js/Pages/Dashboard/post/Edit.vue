<template>
  <app-layout >
      <FormSection @submitted="submit" class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
      <template #title> Create post </template>
      <template #description> Create a post </template>
      <template #form>

        <div class="col-span-6 grid grid-cols-1">
          <InputLabel>Title</InputLabel>
          <TextInput class="w-full h-8" type="text" v-model="form.title"></TextInput>
          <InputError :message="errors.title" />
        </div>

        <div class="col-span-6 grid grid-cols-1">
          <InputLabel>Slug</InputLabel>
          <TextInput class="w-full h-8" type="text" v-model="form.slug" />
          <InputError :message="errors.slug" />
        </div>
        <div class="col-span-6">
          <InputLabel value="Date" />
          <TextInput class="w-full" type="date" v-model="form.date" />
          <InputError :message="errors.slug" />
        </div>
        <div class="col-span-6">
          <InputLabel value="Text" />
          <TextInput class="rounded-md w-full border-gray-400" type="text" v-model="form.text" />
          <InputError :message="errors.slug" />
        </div>
        <div class="col-span-6">
          <InputLabel value="Description" />
          <TextInput class="w-full" type="text" v-model="form.description" />
          <InputError :message="errors.slug" />
        </div>
        <div class="col-span-6">
          <inputLabel value="Posted" />

          <select class=" w-full border-gray-300" v-model="form.posted">
            <option value="not">No</option>
            <option value="Yes">Yes</option>

          </select>
        </div>

        <div class="col-span-6">
          <inputLabel value="Type" />

          <select class=" w-full border-gray-300" v-model="form.type">
            <option value="adverd">Adverd</option>
            <option value="Post">Post</option>
            <option value="Course">Course</option>
            <option value="Movie">Movie</option>
          </select>
        </div>
        <div class="col-span-6">
          <InputLabel value="Category" />
          <!-- <TextInput class="w-full" type="text" v-model="form.Category_id" />
          <InputError :message="errors.Type" /> -->
          <select class=" w-full border-gray-300" v-model="form.category_id">
            <option value="1">Hiolaaaaa</option>
            <option value="2">wqeryherfdhz</option>
            <option value="3">qweret</option>
            <option value="4">afsdnjk</option>
          </select>
        </div>
      </template>
      <template #actions>
        <PrimaryButton type="submit">Crear</PrimaryButton>
      </template>
    </FormSection>

  </app-layout>
</template>

<script>
import { Inertia } from "@inertiajs/inertia";
import { useForm } from "@inertiajs/inertia-vue3";

// import AppLayout from "../../../Layouts/AppLayout"
import AppLayout from "@/Layouts/AppLayout.vue";

 


import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import FormSection from "@/Components/FormSection.vue";
import TextInput from "@/Components/TextInput.vue";

export default {
components: {
    AppLayout,
    // JetInput,
    InputError,
    InputLabel,
    PrimaryButton,
    FormSection,
    TextInput,
    InputError
},
props: {
  errors: Object,
  post:Object,
  categories: Object,
},
setup(props) {
  const form = useForm({
    id:props.post.id,
    title: props.post.title,
    slug: props.post.slug,
    date: props.post.date,
    description: props.post.description,
    text: props.post.text,
    type: props.post.type,
    posted: props.post.posted,
    type: props.post.type,
    category_id: props.post.category_id,




    
    
    
  });

  function submit() {
    Inertia.put(route("post.update",form.id), form);
  }

  return { form, submit };
},
};
</script>