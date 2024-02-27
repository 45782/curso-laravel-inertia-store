<template>
  <app-layout>
    <FormSection @submitted="submit" class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
      <template #title> Create Category </template>
      <template #description> Create a Category </template>
      <template #form>

        <div class="col-span-6 grid grid-cols-1">
          <InputLabel>Title</InputLabel>
          <TextInput class="w-full h-8" type="text" v-model="form.title" />
          <InputError :message="errors.title" />
        </div>

        <div class="col-span-6 grid grid-cols-1">
          <InputLabel>Slug</InputLabel>
          <TextInput class="w-full h-8" type="text" v-model="form.slug" />
          <InputError :message="errors.slug" />
        </div>

      </template>
      <template #actions>
        <PrimaryButton type="submit">Send</PrimaryButton>
      </template>
    </FormSection>
  </app-layout>
</template>

<script>
import { Inertia } from "@inertiajs/inertia";
import { useForm } from "@inertiajs/inertia-vue3";

import AppLayout from "@/Layouts/AppLayout.vue";

// import JetFormSection from "@/Components/FormSection.vue";
// import JetInputLabel from "@/Components/InputLabel.vue";
// import JetInputError from "@/Components/InputError.vue";
// import JetTextInput from "@/Components/TextInput.vue";
// import JetButton from '@/Components/PrimaryButton.vue';

import FormSection from "@/Components/FormSection.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";

export default {
  components: {
    AppLayout,
    FormSection,
    InputLabel,
    TextInput,
    InputError,
    InputLabel,
    TextInput,
    InputError,
    PrimaryButton
},
  props: {
    errors: Object,
    
  },

  setup() {

    const form = useForm({
      title: null,
      slug: null,
    }

    )
    function submit() {
      Inertia.post(route("category.store"), form);
    }

    return { form, submit }
  }

}
</script>