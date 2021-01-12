<template>
    <app-layout>
        <template #header>
            <nav aria-label="Breadcrumb" class="text-black font-bold">
                <ol class="list-none p-0 inline-flex">
                    <li class="flex items-center">
                        <a :href="route('dashboard')" class="text-indigo-800">
                            Dashboard
                        </a>
                        <svg class="fill-current w-3 h-3 mx-3" viewBox="0 0 320 512"
                             xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z"/>
                        </svg>
                    </li>
                    <li class="flex items-center">
                        <a :href="route('trucks.index')" class="text-indigo-800">
                            Camiones
                        </a>
                        <svg class="fill-current w-3 h-3 mx-3" viewBox="0 0 320 512"
                             xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z"/>
                        </svg>
                    </li>
                    <li>
                        <a aria-current="page" class="text-gray-500">Mostrar</a>
                    </li>
                </ol>
            </nav>
        </template>

        <div class="p-6">
            <div class="mt-12 sm:mt-0">
                <div
                    class="relative flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-xl rounded-lg mt-12 ">
                    <div class="px-6">
                        <div class="flex flex-wrap justify-center">
                            <div class="w-full lg:w-3/12 px-4 lg:order-2 flex justify-center">
                                <div class="relative rounded-full">
                                    <img :src="`/storage/${data.photo_path}`"
                                         alt="..."
                                         class="shadow-xl  rounded-full h-24 w-24 flex items-center justify-center border-none absolute -m-16 -ml-20 lg:-ml-16"
                                         style="max-width: 150px;">
                                </div>
                            </div>
                            <div class="w-full lg:w-4/12 px-4 lg:order-3 lg:text-right lg:self-center">
                                <div class="pt-6 sm:py-6 px-3 mt-10 sm:mt-0">
                                    <button
                                        class="inline-flex items-center bg-indigo-600 active:bg-indigo-600 uppercase text-white font-bold hover:shadow-md shadow text-xs px-4 py-2 rounded outline-none focus:outline-none sm:mr-2 mb-1"
                                        style="transition: all 0.15s ease 0s;"
                                        type="button" @click="openModal()">
                                        <svg class="-ml-1 mr-2 h-5 w-5" style="width:24px;height:24px"
                                             viewBox="0 0 24 24">
                                            <path d="M18,10A1,1 0 0,1 17,9A1,1 0 0,1 18,8A1,1 0 0,1 19,9A1,1 0 0,1 18,10M12,10H6V5H12M19.77,7.23L19.78,7.22L16.06,3.5L15,4.56L17.11,6.67C16.17,7 15.5,7.93 15.5,9A2.5,2.5 0 0,0 18,11.5C18.36,11.5 18.69,11.42 19,11.29V18.5A1,1 0 0,1 18,19.5A1,1 0 0,1 17,18.5V14C17,12.89 16.1,12 15,12H14V5C14,3.89 13.1,3 12,3H6C4.89,3 4,3.89 4,5V21H14V13.5H15.5V18.5A2.5,2.5 0 0,0 18,21A2.5,2.5 0 0,0 20.5,18.5V9C20.5,8.31 20.22,7.68 19.77,7.23Z"
                                                  fill="currentColor"/>
                                        </svg>
                                        Agregar
                                    </button>
                                </div>
                            </div>

                            <div class="w-full lg:w-4/12 px-4 lg:order-1">
                                <div class="flex justify-center py-4 lg:pt-4 sm:pt-8 pt-4">
                                    <div class="mr-4 p-3 text-center">
                                    <span
                                        class="text-xl font-bold block uppercase tracking-wide text-gray-700">
                                        {{ data.rendimiento_estipulado }}
                                    </span>
                                        <span
                                            class="text-sm text-gray-500">
                                        Rendimiento
                                    </span>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="text-center mt-0 sm:mt-8">
                            <h3
                                class="text-4xl font-semibold leading-normal mb-2 text-gray-800 mb-2 uppercase">
                                PLACA: {{ data.placa }}
                            </h3>
                            <div class="text-sm leading-normal mt-0 mb-2 text-gray-500 font-bold uppercase">
                                Modelo: {{ data.modelo }}
                            </div>
                            <div class="mb-2 text-gray-700 mt-10">
                                Tipo de Combustible: {{ data.tipo_combustible }}
                            </div>
                            <div class="mb-2 text-gray-700">
                                Color: {{ data.color }}
                            </div>
                        </div>

                        <div class="mt-10 py-10 border-t border-gray-300 text-center">
                            <!--datatable-->
                            <div class="antialiased font-sans bg-gray-200">
                                <div class="container mx-auto sm:px-8">
                                    <div class="py-4">
                                        <div class="my-4 flex sm:flex-row flex-col justify-between items-center">
                                            <div class="flex-1 pr-4">
                                                <div class="flex flex-row mb-1 sm:mb-0">
                                                    <div class="relative">
                                                        <select
                                                            v-model="tableData.length"
                                                            class="appearance-none h-full  border block appearance-none w-full bg-white  text-gray-700 py-2 px-4 pr-8 leading-tight rounded-lg shadow focus:outline-none focus:shadow-outline text-gray-600 font-medium" @change="getConsumption()">
                                                            <option v-for="(records, index) in perPage" :key="index"
                                                                    :value="records">{{
                                                                    records
                                                                }}
                                                            </option>
                                                        </select>
                                                        <div
                                                            class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                                            <svg class="fill-current h-4 w-4"
                                                                 viewBox="0 0 20 20"
                                                                 xmlns="http://www.w3.org/2000/svg">
                                                                <path
                                                                    d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/>
                                                            </svg>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div>
                                                <div class="relative">
                                                    <input v-model="tableData.search"
                                                           class="w-full pl-10 pr-4 py-2 rounded-lg shadow focus:outline-none focus:shadow-outline text-gray-600 font-medium"
                                                           placeholder="Search..."
                                                           type="search"
                                                           @input="getConsumption()">
                                                    <div class="absolute top-0 left-0 inline-flex items-center p-2">
                                                        <svg class="w-6 h-6 text-gray-400"
                                                             fill="none"
                                                             stroke="currentColor"
                                                             stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                             viewBox="0 0 24 24"
                                                             xmlns="http://www.w3.org/2000/svg">
                                                            <rect height="24" stroke="none" width="24" x="0"
                                                                  y="0"></rect>
                                                            <circle cx="10" cy="10" r="7"/>
                                                            <line x1="21" x2="15" y1="21" y2="15"/>
                                                        </svg>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="md:shadow-none lg:shadow-lg rounded-t-lg">
                                            <datatable
                                                :columns="columns" :sortKey="sortKey" :sortOrders="sortOrders"
                                                @sort="sortBy">


                                                <tbody class="flex-1 sm:flex-none">

                                                <tr v-if="consumptions.length<=0" class="odd">
                                                    <td :colspan="columns.length" class="dataTables_empty  justify-center"
                                                        valign="top">
                                                        <div class="flex justify-center p-3 text-gray-800">
                                                            No se encontraron registros
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr v-for="consumption in consumptions"
                                                    v-else
                                                    :key="consumption.id" class="bg-white lg:hover:bg-gray-100 flex rounded-lg md:rounded-none  lg:table-row flex-row lg:flex-row flex-wrap lg:flex-no-wrap mb-10 lg:mb-0">
                                                    <td
                                                        class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                                    <span
                                        class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">
                                        {{ columns[0].label }}
                                    </span>
                                                        {{ consumption.litros }}
                                                    </td>
                                                    <td
                                                        class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                                                        <span
                                                            class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">
                                                            {{ columns[1].label }}
                                                        </span>
                                                        {{ consumption.precio_litros * consumption.litros }}
                                                    </td>
                                                    <td
                                                        class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                                                        <span
                                                            class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">
                                                           {{ columns[2].label }}
                                                        </span>

                                                        {{ consumption.kilometraje_anterior }}
                                                    </td>
                                                    <td
                                                        class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                                                        <span
                                                            class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">
                                                           {{ columns[3].label }}
                                                        </span>

                                                        {{ consumption.kilometraje_actual }}
                                                    </td>
                                                    <td
                                                        class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                                                        <span
                                                            class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">
                                                            {{ columns[4].label }}
                                                        </span>
                                                        {{ consumption.kilometro_recorrido }}
                                                    </td>
                                                    <td
                                                        class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                                <span
                                    class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">
                                    {{ columns[5].label }}
                                </span>
                                                        {{ Math.floor(consumption.rendimiento) }}
                                                    </td>
                                                    <td
                                                        class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                                <span
                                    class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">
                                    {{ columns[6].label }}
                                </span>
                                                        <span :class="consumption.indicador!='Bueno'?'bg-red-100 ':'bg-green-100'"
                                                              class="p-1 rounded">
                                        {{ consumption.indicador }}
                                    </span>
                                                    </td>
                                                    <td
                                                        class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                                    <span
                                        class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">
                                        {{ columns[7].label }}
                                    </span>
                                                        {{ (consumption.created_at).substring(0, 10) }}
                                                    </td>
                                                    <td
                                                        class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                                    <span
                                        class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">
                                        {{ columns[8].label }}
                                    </span>
                                                        <a class="inline-flex cursor-pointer items-center  p-1 border border-transparent text-sm leading-5 font-medium rounded-full text-blue-500 hover:bg-blue-100 focus:outline-none focus:shadow-outline-indigo focus:border-blue-700 active:bg-blue-700 transition duration-150 ease-in-out h-8 w-8"
                                                           @click="edit(consumption)">

                                                            <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                                                                <path d="M20.71,7.04C21.1,6.65 21.1,6 20.71,5.63L18.37,3.29C18,2.9 17.35,2.9 16.96,3.29L15.12,5.12L18.87,8.87M3,17.25V21H6.75L17.81,9.93L14.06,6.18L3,17.25Z"
                                                                      fill="currentColor"/>
                                                            </svg>

                                                        </a>
                                                        <a class="inline-flex cursor-pointer items-center p-1 border border-transparent text-sm leading-5 font-medium rounded-full text-red-500  hover:bg-red-100 focus:outline-none focus:shadow-outline-red focus:border-red-700 active:bg-red-700 transition duration-150 ease-in-out h-8 w-8"
                                                           @click="deleteElement(consumption)">

                                                            <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                                                                <path d="M19,4H15.5L14.5,3H9.5L8.5,4H5V6H19M6,19A2,2 0 0,0 8,21H16A2,2 0 0,0 18,19V7H6V19Z"
                                                                      fill="currentColor"/>
                                                            </svg>

                                                        </a>
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </datatable>
                                            <pagination :pagination="pagination"
                                                        @next="getConsumption(pagination.nextPageUrl)"
                                                        @prev="getConsumption(pagination.prevPageUrl)">
                                            </pagination>
                                        </div>

                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>


        <!--modal-->
        <div v-if="isOpen" class="fixed z-10 inset-0 overflow-y-auto ease-out duration-400">
            <div
                class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">

                <div class="fixed inset-0 transition-opacity">
                    <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                </div>
                <!-- This element is to trick the browser into centering the modal contents. -->
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>
                <div
                    aria-labelledby="modal-headline"
                    aria-modal="true" class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full" role="dialog">
                    <form>
                        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                            <div class="">
                                <div class="mb-4">
                                    <label class="block text-gray-700 text-sm font-bold mb-2"
                                           for="litros">
                                        Galones de combustible:
                                    </label>
                                    <input id="litros"
                                           v-model.number="form.litros"
                                           class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                           placeholder="Galones de combustible"
                                           type="number">
                                    <div v-if="$page.errors.litros" class="text-red-500">{{
                                            $page.errors.litros[0]
                                        }}
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <label class="block text-gray-700 text-sm font-bold mb-2"
                                           for="precio_litros">
                                        Precio por Galón:
                                    </label>
                                    <input id="precio_litros"
                                           v-model.number="form.precio_litros"
                                           class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                           placeholder="Precio por Galón"
                                           type="number">
                                    <div v-if="$page.errors.precio_litros" class="text-red-500">{{
                                            $page.errors.precio_litros[0]
                                        }}
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label class="block text-gray-700 text-sm font-bold mb-2"
                                           for="kilometraje_actual">
                                        Kilometraje actual:
                                    </label>


                                    <input id="kilometraje_actual"
                                           v-model="form.kilometraje_actual"
                                           class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Kilometraje actual"
                                           type="text">
                                    <div v-if="$page.errors.kilometraje_actual" class="text-red-500">{{
                                            $page.errors.kilometraje_actual[0]
                                        }}
                                    </div>
                                </div>


                            </div>
                        </div>
                        <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                            <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
                              <button v-show="!editMode"
                                      class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5"
                                      type="button" @click="save(form)">
                                Agregar
                              </button>
                            </span>
                            <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
                                  <button v-show="editMode"
                                          class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5"
                                          type="button" @click="update(form)">
                                    Actualizar
                                  </button>
                            </span>
                            <span class="mt-3 flex w-full rounded-md shadow-sm sm:mt-0 sm:w-auto">

                              <button class="inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2 bg-white text-base leading-6 font-medium text-gray-700 shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5" type="button"
                                      @click="closeModal()">
                                Cancel
                              </button>
                            </span>
                        </div>
                    </form>

                </div>
            </div>
        </div>

    </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout'
import JetActionSection from '@/Jetstream/ActionSection'
import JetButton from '@/Jetstream/Button'
import Button from '@/Jetstream/Button'
import JetConfirmationModal from '@/Jetstream/ConfirmationModal'
import JetModal from '@/Jetstream/Modal'
import JetDangerButton from '@/Jetstream/DangerButton'
import JetSecondaryButton from '@/Jetstream/SecondaryButton'
import Datatable from "@/Pages/Datatable/Datatable";
import Pagination from "@/Pages/Datatable/Pagination";

export default {
    components: {
        Button,
        JetActionSection,
        JetButton,
        JetConfirmationModal,
        JetModal,
        JetDangerButton,
        JetSecondaryButton,
        AppLayout,
        Datatable,
        Pagination
    },
    props: ['data', 'errors'],
    created() {
        this.getConsumption();
    },
    data() {
        let sortOrders = {};
        let columns = [
            {width: '10%', label: 'Galones', name: 'litros'},
            {width: '12%', label: 'Precio tanqueo', name: 'precio_litros'},
            {width: '10%', label: 'km anterior', name: 'kilometraje_anterior'},
            {width: '10%', label: 'km actual', name: 'kilometraje_actual'},
            {width: '10%', label: 'KMS recorrido', name: 'kilometro_recorrido'},
            {width: '10%', label: 'rendimiento', name: 'rendimiento'},
            {width: '10%', label: 'indicador', name: 'indicador'},
            {width: '10%', label: 'Fecha', name: 'created_at'},
            {width: '20%', label: 'Opciones', name: 'opciones'}
        ];
        columns.forEach((column) => {
            sortOrders[column.name] = -1;
        });
        return {
            consumptions: [],
            columns: columns,
            sortKey: 'deadline',
            sortOrders: sortOrders,
            perPage: ['5', '10', '20', '30'],
            tableData: {
                draw: 0,
                length: 10,
                search: '',
                column: 0,
                dir: 'desc',
                truckId: this.data.id
            },
            pagination: {
                lastPage: '',
                currentPage: '',
                total: '',
                lastPageUrl: '',
                nextPageUrl: '',
                prevPageUrl: '',
                from: '',
                to: ''
            },

            editMode: false,
            isOpen: false,
            open: false,
            form: {
                truckId: this.data.id,
                truckRendimiento: this.data.rendimiento_estipulado,
                id: '',
                indicador: "",
                kilometraje_actual: "",
                precio_litros: "",
                kilometro_recorrido: "",
                litros: "",
                rendimiento: "",
            },
            vehiculo: {
                id: "",
                placa: "",
                color: "",
                modelo: "",
                tipoCombustible: "",
                rendimientoEstipulado: "",
                photo: null
            },
            Consumption: {
                id: "",
                litros: "",
                kilometrajeAnterior: "",
                kilometrajeActual: "",
                kilometroRecorrido: "",
                rendimiento: "",
                indicador: "",
                truckId: "",
            },
            photoPreview: null,
            confirmingUserDeletion: false
        }
    },
    methods: {

        getConsumption(url = '/consumptions/datatable') {
            console.log(url)
            this.tableData.draw++;
            let newData = this.tableData;
            console.log('newData', newData);
            axios.post(url, newData)
                .then(response => {
                    let data = response.data;
                    console.log(data)
                    if (this.tableData.draw == data.draw) {
                        this.consumptions = data.data.data;
                        this.configPagination(data.data);
                    }
                })
                .catch(errors => {
                    console.log(errors);
                });
        },
        configPagination(data) {
            this.pagination.lastPage = data.last_page;
            this.pagination.currentPage = data.current_page;
            this.pagination.total = data.total;
            this.pagination.lastPageUrl = data.last_page_url;
            this.pagination.nextPageUrl = data.next_page_url;
            this.pagination.prevPageUrl = data.prev_page_url;
            this.pagination.from = data.from;
            this.pagination.to = data.to;
        },
        sortBy(key) {
            this.sortKey = key;
            this.sortOrders[key] = this.sortOrders[key] * -1;
            this.tableData.column = this.getIndex(this.columns, 'name', key);
            this.tableData.dir = this.sortOrders[key] === 1 ? 'asc' : 'desc';
            this.getConsumption();
        },
        getIndex(array, key, value) {
            return array.findIndex(i => i[key] == value)
        },

        alert(str1) {
            alert(str1)
        },
        openModal: function () {
            this.isOpen = true;
        },
        closeModal: function () {
            this.isOpen = false;
            this.reset();
            this.editMode = false;
        },
        reset: function () {
            this.form = {
                truckId: this.data.id,
                truckRendimiento: this.data.rendimiento_estipulado,
                id: '',
                indicador: "",
                kilometraje_actual: "",
                precio_litros: "",
                kilometro_recorrido: "",
                litros: "",
                rendimiento: "",
            }
            this.getConsumption();
        },
        save: function (data) {
            console.log(data)
            this.$inertia.post('/consumptions', data)
                .then((response) => {
                    console.log(response);
                    console.log(this.$page);
                    if (this.$page.flash.message) {
                        this.$swal(
                            'Buen trabajo!',
                            this.$page.flash.message,
                            'success'
                        )
                        this.reset();
                        this.closeModal();
                        this.editMode = false;
                    }
                })
                .catch((error) => {
                    // handle error
                    console.log('error', error);
                })
                .then(() => {
                    // always executed
                });

        },
        edit: function (data) {
            console.log(data)
            this.form = Object.assign(this.form, data);
            this.editMode = true;
            this.openModal();
        },
        update: function (data) {
            data._method = 'PUT';
            this.$inertia.post('/consumptions/' + data.id, data)
                .then((response) => {
                    console.log(response)
                    console.log(this.$page);
                    console.log(this.$page.errors)
                    if (this.$page.flash.message) {
                        this.$swal(
                            'Buen trabajo!',
                            this.$page.flash.message,
                            'success'
                        )
                        this.reset();
                        this.closeModal();
                    }


                })
                .catch((error) => {
                    console.error(error)
                })

        },
        deleteElement: function (data) {
            this.$swal({
                title: '¿Estas seguro?',
                text: "¡No podrás revertir esto!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, eliminarlo!',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    data._method = 'DELETE';
                    axios.post('/consumptions/' + data.id, data)
                        .then((response) => {
                            // handle success
                            this.getConsumption();
                            if (response.status == 200) {
                                this.$swal(
                                    'Buen trabajo!',
                                    'eliminado correctamente',
                                    'success'
                                )
                                this.reset();
                                console.log(response);
                                this.closeModal();
                            }

                        })
                        .catch((error) => {
                            // handle error
                            console.log(error);
                        })
                        .then(function () {
                            // always executed
                        });

                }
            })


        },
    }

}
</script>

<style>
html,
body {
    height: 100%;
}

@media (min-width: 640px) {
    table {
        display: inline-table !important;
    }

    thead tr:not(:first-child) {
        display: none;
    }
}

td:not(:last-child) {
    border-bottom: 0;
}

th:not(:last-child) {
    border-bottom: 1px solid rgba(0, 0, 0, .1);
}
</style>


