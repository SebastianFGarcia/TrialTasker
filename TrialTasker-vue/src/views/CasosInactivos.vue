<template>
    <main>
        <HeaderTableVue title="Casos Inactivos" to="PersonDashboardCreate" />
        <input class="search" type="search" placeholder="Buscar">

        <table>
            <thead>
                <tr>
                    <td class="tds">Numero de caso</td>
                    <td class="tds">Nombre del Cliente</td>
                    <td class="tds">Radicado</td>
                    <td class="tds">Estatus</td>
                    <td class="tds">Acciones</td>
                </tr>
            </thead>
            <tbody>
                <tr v-for="active, index in cases.inactiveCases" class="caso">
                    <td>{{ cases.numinactivos[index] }}</td>
                    <td>{{ active["case_name"] }}</td>
                    <td>{{ active["case_radicate"] }}</td>
                    <td>Inactivo</td>
                    <td>
                        <RouterLink :to="{ name: 'SeeMoreActive' }" class="navButton" @click="cases.getCase(active.id)">
                            <div class="buttonSeeMore">Ver Mas</div>
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
    cases.casesInactive()
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
.createButton {
    border: solid 1px;
    width: 20vh;
    padding: 5px;
    height: 30px;
    text-align: center;
    border-radius: 5px;
    background-color: var(--verde);
    color: var(--white);

}

.buttonCreateCase {
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
    width: 40vh;
}

tr {
    margin-top: 5vh;
    height: 50px;
}

a {
    text-decoration: none;
    color: black;
}

input {
    height: 15px;
}

.Button {
    border: solid 1px;
    width: 20vw;
    padding: 5px;
    height: 30px;
    text-align: center;
    border-radius: 5px;
    background-color: var(--verde);
    color: var(--white);

}
</style>