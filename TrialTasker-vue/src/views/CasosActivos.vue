<template>
    <main>
        <HeaderTableVue title="Casos Activos" to="CreateCase" />

        <div class="navbar">
            <!-- <RouterLink :to="{ name: 'CambiarEstatus' }" class="button" @click="getCase(cases.activeCase.id)">
                <div class="Button">Cambiar Estatus</div>
            </RouterLink> -->
            <RouterLink :to="{ name: 'CreatePerson' }" class="button">
                <div class="Button">Crear Persona</div>
            </RouterLink>
            <RouterLink :to="{ name: 'CreateCasePRUEBAS' }" class="button">
                <div class="Button">Crear Caso</div>
            </RouterLink>
        </div>
        <input class="search" type="search" placeholder="Buscar">

        <table>
            <thead>
                <tr>
                    <td class="tdEstatus">Cambiar Estatus</td>
                    <td class="tds">Numero de caso</td>
                    <td class="tds">Nombre del Cliente</td>
                    <td class="tds">Radicado</td>
                    <td class="tds">Estatus</td>
                    <td class="tds">Acciones</td>
                </tr>
            </thead>
            <tbody>
                <tr v-for="active, index in cases.activeCases" class="caso">
                    <td>
                        <RouterLink :to="{ name: 'CambiarEstatus' }" class="navButton" @click="cases.getCase(active.id)">
                            <div class="buttonSeeMore" @click="cases.id = cases.active.id">Cambiar</div>
                        </RouterLink>
                    </td>
                    <td>{{ cases.numactivos[index] }}</td>
                    <td>{{ active.case_name }}</td>
                    <td>{{ active.case_radicate }}</td>
                    <td>
                        Activo
                        <RouterLink :to="{ name: 'CambiarEstatus' }" class="button" @click="cases.getCase(active.id)">
                            <div class="Button">Cambiar Estatus{{ active.id }}</div>
                        </RouterLink>
                    </td>
                    <td>
                        <RouterLink :to="{ name: 'SeeMoreActive' }" class="navButton" @click="cases.getCase(active.id)">
                            <div class="buttonSeeMore"  @click="cases.id=cases.active.id">Ver Mas</div>
                        </RouterLink>
                        <RouterLink :to="{ name: 'ActualizarCaso' }" class="navButton" @click="cases.getCase(active.id)">
                            <div class="buttonSeeMore">Actualizar</div>
                        </RouterLink>
                    </td>
                </tr>
            </tbody>
        </table>
    </main>
</template>

<script setup>
import { onMounted } from 'vue';
import { useCaseStore } from '@/stores/caseStore';
import HeaderTableVue from '@/components/headers/HeaderTableNoButton.vue';

localStorage.removeItem("id");

const cases = useCaseStore();

onMounted(() => {
    cases.casesActive();
    
});

document.addEventListener("keyup", e => {
    if (e.target.matches(".search")) {
        document.querySelectorAll(".caso").forEach(caso => {
            caso.textContent.toLowerCase().includes(e.target.value.toLowerCase())
                ? caso.classList.remove("filtro")
                : caso.classList.add("filtro")
        })
    }
})

</script>

<style scoped>
/* variables */



.filtro {
    display: none;
}

.navbar {
    width: 100%;
    height: 50px;
    display: flex;
    justify-content: space-around;
    align-items: center;
}

.search {
    width: 100%;
    height: 30px;
    border: none;
    border-radius: 10px;
    padding-left: 10px;
    background-color: #e8e8e8;
}

/* main */
main {
    height: auto;
    box-shadow: 0px 0px 10px 0.1px rgba(0, 0, 0, 0.288);
    border-radius: 12px;
    padding: 10px;
}

/* estilos boton de crear caso */
.Button {
    width: 20vw;
    padding: 5px;
    height: 30px;
    text-align: center;
    border-radius: 5px;
    color: var(--black);

}

.button {
    text-decoration: none;

}

/* estilos de la tabla */
table {
    margin-top: 30px;
}

/* estilos del thead */
thead {
    width: 100%;
    height: 5vh;
    background-color: var(--verde);
    color: var(--white);
}

/* estilos del tbody */


td {
    text-align: center;
}

.tds {
    width: 20vw;
    text-align: center;
    border-radius: 5px;

}

.tdEstatus {
    width: 10vh;
    border-radius: 5px;
    text-align: center;
    padding: 5px;

}

tr {
    margin-top: 5vh;
    height: 50px;

}


a {
    text-decoration: none;
    color: #000;
}

input {
    height: 15px;
}
</style> 