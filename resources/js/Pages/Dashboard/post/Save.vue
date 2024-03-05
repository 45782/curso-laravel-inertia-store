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
          <!-- <TextInput class="rounded-md w-full border-gray-400" type="text" v-model="form.text" /> -->
          <ckeditor
          :editor="editor.editor"
          v-model="form.text"
          >
        </ckeditor>
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
        <div class="col-span-6">
          <inputlabel value="Image" />
          <input
            class="w-full"
            type="file"
            @input="form.image = $event.target.files[0]"
          />

          <jet-input-error :message="errors.image" />
        </div>
        <div class="col-span-6">
          <jet-label value="Image" />

          <o-upload v-model="form.image">
            <o-button tag="a" variant="primary">
              <o-icon icon="upload"></o-icon>
              <span>Click to upload</span>
            </o-button>
          </o-upload>

          <jet-input-error :message="errors.image" />
        </div>

        <div class="col-span-6" v-if="post.id">
    <o-upload 
      :files="dropFiles" 
      @update:files="updateDropFiles"
      multiple 
      drag-drop
    >
            <section class="ex-center">
      <p>
          <o-icon icon="upload" size="is-large"> </o-icon>
        </p>
        <p>Drop your files here or click to upload</p>
      </section>
    </o-upload>
  </div>
      </template>
  
      <template #actions>
        <PrimaryButton type="submit">Crear</PrimaryButton>
      </template>
    </FormSection>

    <div class="container mb-4 " v-if="post.image">
    <div class="card">
      <div class="card-body">
        <img class="max-w-xs rounded-md shadow-sm" :src="'/image/post/' + post.image" alt="">
        <Primary-Danger-Button class="mt-4" @click="form.delete(route('post.image-delete', form.id))">Delete</Primary-Danger-Button>
        <a :href="'/image/post/' + post.image" download="" class="ml-2 mt-4 link-button-default">Descargar</a>
    </div>
  </div>
</div>
  </app-layout>
</template>

<script>
import { Inertia } from "@inertiajs/inertia";
import { useForm } from "@inertiajs/inertia-vue3";
import ClassicEditor from "@ckeditor/ckeditor5-build-classic"


import AppLayout from "@/Layouts/AppLayout.vue";
import FormSection from "@/Components/FormSection.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryDangerButton from "@/Components/DangerButton.vue";
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
    ClassicEditor,
    PrimaryDangerButton,
  },
  data() {
    return {
      image:null ,
      editor: {
        editor: ClassicEditor
      }
    }
  },
  props: {
    errors: Object,
    post: {
      type: Object,
      default: {
        id: "",
        title: "",
        slug: "",
        date: "",
        description: "",
        text: "",
        type: "",
        posted: "",
        category_id: "",
        image:"",
      },
    },
    categories: Object,
    dropFiles: []
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
      category_id: props.post.category_id,
      image: "",
    });
    function submit() {
      if (form.id == "") Inertia.post(route("post.store"), form);
      //else Inertia.put(route("post.update", form.id), form);
      else
        Inertia.post(route("post.update", form.id), {
          _method: "put",
          title: form.title,
          date: form.date,
          slug: form.slug,
          description: form.description,
          text: form.text,
          type: form.type,
          posted: form.posted,
          category_id: form.category_id,
          image: form.image,
        });
    }
    return { form, submit };
    
    const dropFiles = ref([])
  },
  watch: {
    dropFiles:{
      handler(val){
        Inertia.post(route("post.upload", this.$page.props.post.id), {
          "image":val[val.length -1]
        });
      }
    }
  }
};
</script>