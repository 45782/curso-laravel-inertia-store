<template>
  <app-layout >
    <FormSection @submit="submit" class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
      <template #title> CREATE CATEGORY </template>
      <template #description> Create a Category </template>
      <template #form>
        <div class="col-span-6">
          <InputLabel> Title </InputLabel>
          <TextInput class="w-full" v-model="form.title" ></TextInput> 
          <InputError :message="errors.title" />
        </div>
        <div class="col-span-6">
          <InputLabel value="Slug" />
          <TextInput class="w-full" type="text" v-model="form.slug" />
          <InputError :message="errors.slug" />
        </div>
    
          <PrimaryButton type="submit">Send </PrimaryButton>
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
  category:Object,
},
setup(props) {
  const form = useForm({
    id:props.category.id,
    title: props.category.title,
    slug: props.category.slug,
  });

  function submit() {
    Inertia.put(route("category.update",form.id), form);
  }

  return { form, submit };
},
};
</script>