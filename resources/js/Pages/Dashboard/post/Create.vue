<template>
  <app-layout>
    <FormSection @submitted="submit" class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
      <template #title> Create post </template>
      <template #description> Create a post </template>
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
        <div class="col-span-6">
          <InputLabel value="Date" />
          <TextInput class="w-full" type="date" v-model="form.date" />
          <InputError :message="errors.date" />
        </div>
        <div class="col-span-6">
          <InputLabel value="Text" />
          <TextInput class="rounded-md w-full border-gray-400" type="text" v-model="form.text" />
          <InputError :message="errors.text" />
        </div>
        <div class="col-span-6">
          <InputLabel value="Description" />
          <TextInput class="w-full" type="text" v-model="form.description" />
          <InputError :message="errors.description" />
        </div>
        <div class="col-span-6">
          <InputLabel value="Posted" />
          <select class="w-full border-gray-300" v-model="form.posted">
            <option value="no">No</option>
            <option value="yes">Yes</option>
          </select>
          <InputError :message="errors.posted" />
        </div>

        <div class="col-span-6">
          <InputLabel value="Type" />
          <select class="w-full border-gray-300" v-model="form.type">
            <option value="adverd">Adverd</option>
            <option value="post">Post</option>
            <option value="course">Course</option>
            <option value="movie">Movie</option>
          </select>
          <InputError :message="errors.type" />
        </div>

        <div class="col-span-6">
          <InputLabel value="Category" />
          <select class="w-full border-gray-300" v-model="form.category_id">
            <option value=""> </option>
            <option v-for="c in categories" :value="c.id" :key="c.id">{{ c.title }}</option>
          </select>
          <InputError :message="errors.category_id" />
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

import AppLayout from "@/Layouts/AppLayout.vue";
import FormSection from "@/Components/FormSection.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";

export default {
  components: {
    AppLayout,
    TextInput,
    InputLabel,
    InputError,
    PrimaryButton,
    FormSection,
  },
  data() {
    return {
      form: {
        title: null,
        slug: null,
        date: null,
        text: null,
        description: null,
        posted: null,
        type: null,
        category_id: null
      }
    }
  },
  props: {
    errors: Object,
    categories: Array
  },
  methods: {
    submit() {
      Inertia.post(route('post.store'), this.form);
    }
  }
};
</script>