<!-- <template>
    <HeaderAccions title="Editar Caso" to="CasesDashboard" />
<Form :create="cases.updateCase" :form="form" button-text="Actualizar">
    <FormGroup label="Nombre" :error="cases.errors ? cases.errors.case_name : []">
        <input type="text" id="case_name" v-model="cases.caseStore.case_name">
        </FormGroup>
        <FormGroup label="Radicado" :error="cases.errors ? cases.errors.case_radicate : []">
            <input type="text" id="case_radicate" v-model="cases.caseStore.case_radicate">
            <p id="case_radicate"></p>
        </FormGroup>
        <FormGroup label="Juez" :error="cases.errors ? cases.errors.case_person_id : []">
            <input type="text" id="case_person_id" v-model="cases.caseStore.case_person_id">
        </FormGroup>
        <FormGroup label="Abogado" :error="cases.errors ? cases.errors.case_user_id : []">
            <input type="text" id="case_user_id" v-model="auth.user.name">
        </FormGroup>
        <FormGroup label="Estado" :error="cases.errors ? cases.errors.case_status : []">
            <select id="case_status" v-model="form.case_status">
                <option value="1">Activo</option>
                <option value="0">Inactivo</option>
            </select>
        </FormGroup>
    </Form>
</template>

<script setup>
import { onMounted, ref } from 'vue';
import HeaderAccions from '@/components/headers/HeaderAccions.vue';
import Form from '@/components/forms/Form.vue';
import FormGroup from '@/components/forms/FormGroup.vue';
import { useRoute } from 'vue-router';
import { useCaseStore } from '@/stores/caseStore';
import { usePersonStore } from '@/stores/personStore';
import { useUserStore } from '@/stores/userStore';
import { useAuthStore } from '@/stores/authStore';

const route = useRoute();
const cases = useCaseStore();
const persons = usePersonStore();
const users = useUserStore();
const auth = useAuthStore();

var casoid = localStorage.getItem("id");
cases.getCase(casoid);

const form = ref({
    id: '',
    case_name: '',
    case_radicate: '',
    case_person_id: '',
    case_user_id: '',
    case_status: 1,
});

onMounted(async () => {
    persons.getPersonsAll();
    auth.getUser();
    users.getUsersAll();
    await cases.getCase(route.params.id);
    form.value = {
        id: route.params.id,
        case_name: cases.case.case_name,
        case_radicate: cases.case.case_radicate,
        case_person_id: cases.case.case_person_id,
        case_user_id: cases.case.case_user_id,
        case_status: cases.case.case_status,
    }

});


</script>

<style></style> -->

<template>
    <HeaderAccions title="Editar Caso" to="CasesDashboard" />
    <Form :create="cases.updateCase" :form="form" button-text="Actualizar">
        <FormGroup label="Nombre" :error="cases.errors ? cases.errors.case_name : []">
            <input type="text" id="case_name" v-model="form.case_name">
        </FormGroup>
        <FormGroup label="Radicado" :error="cases.errors ? cases.errors.case_radicate : []">
            <input type="text" id="case_radicate" v-model="form.case_radicate">
        </FormGroup>
        <FormGroup label="Cliente" :error="cases.errors ? cases.errors.case_person_id : []">
            <select id="case_person_id" v-model="form.case_person_id">
                <option value="">Seleccione un cliente</option>
                <option v-for="person in persons.personsAll" :value="person.id">{{ person.per_name }} {{ person.per_lastname
                }}</option>
            </select>
        </FormGroup>
        <FormGroup label="Abogado" :error="cases.errors ? cases.errors.case_user_id : []">
            <select id="case_user_id" v-model="form.case_user_id">
                <option value="">Seleccione un abogado</option>
                <option v-for="user in users.usersAll" :value="user.id">{{ user.name }} {{ user.lastname }}</option>
            </select>
        </FormGroup>
        <FormGroup label="Estado" :error="cases.errors ? cases.errors.case_status : []">
            <select id="case_status" v-model="form.case_status">
                <option value="1">Activo</option>
                <option value="0">Inactivo</option>
            </select>
        </FormGroup>
    </Form>
</template>

<script setup>
import { onMounted, ref } from 'vue';
import HeaderAccions from '@/components/headers/HeaderAccions.vue';
import Form from '@/components/forms/Form.vue';
import FormGroup from '@/components/forms/FormGroup.vue';
import { useUserStore } from '@/stores/userStore';
import { usePersonStore } from '@/stores/personStore';
import { useRoute } from 'vue-router';
import { useCaseStore } from '@/stores/caseStore';



const route = useRoute();
const cases = useCaseStore();
const persons = usePersonStore();
const users = useUserStore();
console.log(cases.getCase());
const form = ref({
    id: '',
    case_name: '',
    case_radicate: '',
    case_person_id: '',
    case_user_id: '',
    case_status: 1,
});
// El error esta en la promesa de espera, primero se se asigna un undefined pero cuando encuentra el id que toca no realiza el cambio
onMounted(async () => {
    persons.getPersonsAll();
    users.getUsersAll();
    await cases.getCase(route.params.id);
    form.value = {
        id: route.params.id,
        case_name: cases.case.case_name,
        case_radicate: cases.case.case_radicate,
        case_person_id: cases.case.case_person_id,
        case_user_id: cases.case.case_user_id,
        case_status: cases.case.case_status,
    }
});
</script>

<style></style>