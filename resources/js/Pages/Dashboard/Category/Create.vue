<template>
  <app-layout>
   
    <Jet-Form-Section @submitted="submit"  class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
      <template #title>
        Create Category
      </template>
      <template #description>
        Create Category
      </template>
      <template #form>
        


        <div class="col-span-6 grid grid-cols-1">

            <jet-label>Title</jet-label>
            <input class="w-full h-8" type="text" v-model="form.title" />
            <jet-input-error :message="errors.title" />
        </div>

        <div class="col-span-6 grid grid-cols-1">
            <jet-label>Slug </jet-label>
            <input class="w-full h-8" type="text" v-model="form.slug" />
            <jet-input-error :message="errors.slug" />
          </div>

          <jet-primary-button type="submit">
            send
          </jet-primary-button>

      </template>
    </Jet-Form-Section>
  </app-layout>
</template>

<script>

import { useForm, router } from "@inertiajs/vue3";

import AppLayout from "@/Layouts/AppLayout.vue";

import JetFormSection from "@/Components/FormSection.vue";
import JetInputLabel from "@/Components/InputLabel.vue";
import JetInputError from "@/Components/InputError.vue";
import JetTextInput from "@/Components/TextInput.vue";
import JetPrimaryButton from '@/Components/PrimaryButton.vue';


export default {
  components: {
    AppLayout,
    JetFormSection,
    JetInputLabel,
    JetInputError,
    JetTextInput,
    JetPrimaryButton,

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