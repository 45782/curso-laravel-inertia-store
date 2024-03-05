<template>
  <app-layout>
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

    <div class="container max-w-screen-xl">
      <div class="card">
        <div class="card-body">
          <div class="grip gripd-cols-2 gap-2">
          <InputLabel value="image" />
          <TextInput class="w-full h-8" type="file" @input="form.image = $event.target.files[0]" v-model="form.image" />
          <InputError :message="errors.image" />
          <PrimaryButton @click="upload"> Send</PrimaryButton>

         </div>

        </div>

      </div>

    </div>

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
import { watch } from "vue";
import { router } from "@inertiajs/vue3";

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
    post: Object,
    categories: Object,
  },
  setup(props) {
    const form = useForm({
      id: props.post.id,
      title: props.post.title,
      slug: props.post.slug,
      date: props.post.date,
      description: props.post.description,
      text: props.post.text,
      type: props.post.type,
      posted: props.post.posted,
      type: props.post.type,
      category_id: props.post.category_id,
      image: "",
    });

    function submit() {
      Inertia.put(route("post.update", form.id), form);
    }

    function upload() {
      Inertia.post(route("post.upload", form.id), form);
    }
    const dropFiles =ref([]);

    watch(() =>dropFiles, (currentValue, oldValue) =>{
      router.post(route("post.uplosd", props.post.id),{
        "image": currentValue.value[currentValue.value.length-1]
      });
    },
            
       {deep: true});
       
    return { form, submit, upload };
  },
};
</script>