<template>
    <HeaderAccions title="Actualizar Etapa" to="StageDashboard"/>
    <Form :create="stages.updateStage" :form="form" button-text="Actualizar">
        <FormGroup label="Nombre" :error="stages.errors ? stages.errors.stage_name : []">
            <input type="text" id="stage_name" v-model="form.stage_name">
        </FormGroup>
        <FormGroup label="Tipo de Etapa" :error="stages.errors ? stages.errors.stage_type_stage_id : []">
            <select id="stage_type_stage_id" v-model="form.stage_type_stage_id">
                <option value="">Seleccione</option>
                <option v-for="typeStage in typeStages.typeStagesAll" :value="typeStage.id">{{typeStage.type_stage_name}}</option>
            </select>
        </FormGroup>
        <FormGroup label="Caso" :error="stages.errors ? stages.errors.stage_case_id : []">
            <select id="stage_case_id" v-model="form.stage_case_id">
                <option value="">Seleccione</option>
                <option v-for="caseItem in cases.casesAll" :value="caseItem.id">{{caseItem.case_name}}</option>
            </select>
        </FormGroup>
        <FormGroup label="Notas" :error="stages.errors ? stages.errors.stage_notes : []">
            <textarea id="stage_notes" v-model="form.stage_notes"></textarea>
        </FormGroup>
        <button v-on:click="open" id="upload_widget" class="cloudinary-button">
            Upload files
        </button>
    </Form>
  
</template>

<script setup>
import { onMounted, ref } from 'vue';
import HeaderAccions from '../../components/headers/HeaderAccions.vue';
import Form from '../../components/forms/Form.vue';
import FormGroup from '../../components/forms/FormGroup.vue';
import { useStageStore } from '../../stores/stageStore';
import { useTypeStageStore } from '../../stores/typeStageStore';
import { useCaseStore } from '../../stores/caseStore';
import { useRoute } from 'vue-router';

const stages = useStageStore();
const typeStages = useTypeStageStore();
const cases = useCaseStore();
const route = useRoute();

const form = ref({
    id: route.params.id,
    stage_name: '',
    stage_type_stage_id: '',
    stage_case_id: '',
    stage_notes: '',
});

onMounted(async() => {
    typeStages.getTypeStagesAll();
    cases.getCasesAll();
    await stages.getStage(route.params.id);
    form.value = stages.stage;
});
const cloudName = "dcvsxucd4"; // replace with your own cloud name
const uploadPreset = "preset_TrialTasker"; // replace with your own upload preset
const myWidget = cloudinary.createUploadWidget(
  {
    cloudName: cloudName,
    uploadPreset: uploadPreset,
    cropping: true, //add a cropping step
    // showAdvancedOptions: true,  //add advanced options (public_id and tag)
    // sources: [ "local", "url"], // restrict the upload sources to URL and local files
    // multiple: false,  //restrict upload to a single file
    // folder: "user_images", //upload files to the specified folder
    // tags: ["users", "profile"], //add the given tags to the uploaded files
    // context: {alt: "user_uploaded"}, //add the given context data to the uploaded files
    // clientAllowedFormats: ["images"], //restrict uploading to image files only
    // maxImageFileSize: 2000000,  //restrict file size to less than 2MB
    // maxImageWidth: 2000, //Scales the image down to a width of 2000 pixels before uploading
    // theme: "purple", //change to a purple theme
  },
  (error, result) => {
    if (!error && result && result.event === "success") {
      console.log("Done! Here is the image info: ", result.info);
      document
        .getElementById("uploadedimage")
        .setAttribute("src", result.info.secure_url);
    }
  }
);

const open = (event) => {
    event.preventDefault();
  myWidget.open();
};
/* export default {
  name: "UploadWidget",
  data: () => ({
    open: function () {
      myWidget.open();
    },
  }),
  props: {
    msg: String,
  },
}; */
</script>
