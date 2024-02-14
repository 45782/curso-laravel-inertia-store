<template>
 <app-layout>
      
     
        <Jet-Form-Section >
           <template #title>
                    Create Category
           </template>
           <template #description>
                    Create Category
           </template>
           <template #form>
            <form @submitted ="submit">
          <jet-input-label for="">Title</jet-input-label>
          <jet-input-error :message="errors.title"/>
          <jet-text-input type="text" v-model="form.title"/>
          
          
          <jet-input-label for="">slug</jet-input-label>
            <jet-input-error :message="errors.slug"/>
          <jet-text-input type="text" v-model="form.slug"/>
           
            <jet-primary-button type="submit">
              send

            </jet-primary-button>

          
        </form>
                    
           </template>
        </Jet-Form-Section>




 
</app-layout>
    
  
</template>
<script>
 
 import {useForm, router} from "@inertiajs/vue3"; 

 import AppLayout from "@/Layouts/AppLayout.vue";

 import FormSection from "@/Components/FormSection.vue";
 import InputLabel from "@/Components/InputLabel.vue";
import InputError from "@/Components/InputError.vue";
import TextInput from "@/Components/TextInput.vue";
import PrimaryButton from '@/Components/PrimaryButton.vue';
  

     export default {
      components:{
      AppLayout,
      FormSection,
      InputLabel,
      InputError,
      TextInput,
      PrimaryButton,
      
      },
    props:{
      errors:Object
    },
    
         setup (){

          const form=useForm({
            Title:null,
            slug:null,

          }


          )

            function submit (){
              router.post(route("category.store"),form)
            }

            return { form, submit}
         }

   }
</script>