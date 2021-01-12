<template>
    <app-layout>
        <template #header>
            <div class="flex items-center justify-between">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Gestión de Camiones
                </h2>

                <span class=" sm:block shadow-sm rounded-md">
                    <inertia-link :href="route('trucks.create')"
                                  class="inline-flex items-center px-4 py-2 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:shadow-outline-indigo focus:border-indigo-700 active:bg-indigo-700 transition duration-150 ease-in-out"
                                  type="button">
                        <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor"
                             viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                          <path d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"/>
                        </svg>
                        Agregar
                    </inertia-link>
                </span>
            </div>
        </template>
        <div>

            <div class="antialiased font-sans bg-gray-200">
                <div class="container mx-auto px-4 sm:px-8">
                    <div class="py-8">
                        <div class="my-4 flex sm:flex-row flex-col justify-between items-center">
                            <div class="flex-1 pr-4">
                                <div class="flex flex-row mb-1 sm:mb-0">
                                    <div class="relative">
                                        <select
                                            v-model="tableData.length"
                                            class="appearance-none h-full  border block appearance-none w-full bg-white  text-gray-700 py-2 px-4 pr-8 leading-tight rounded-lg shadow focus:outline-none focus:shadow-outline text-gray-600 font-medium"
                                            @change="getTrucks()">
                                            <option v-for="(records, index) in perPage" :key="index" :value="records">{{
                                                records
                                                }}
                                            </option>
                                        </select>
                                        <div
                                            class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                            <svg class="fill-current h-4 w-4" viewBox="0 0 20 20"
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
                                           @input="getTrucks()">
                                    <div class="absolute top-0 left-0 inline-flex items-center p-2">
                                        <svg class="w-6 h-6 text-gray-400" fill="none"
                                             stroke="currentColor"
                                             stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                             viewBox="0 0 24 24"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <rect height="24" stroke="none" width="24" x="0" y="0"></rect>
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
                                <tr v-if="trucks.length<=0" class="odd">
                                    <td :colspan="columns.length" class="dataTables_empty  justify-center" valign="top">
                                        <div class="flex justify-center p-3 text-gray-800">
                                            No se encontraron registros
                                        </div>
                                    </td>
                                </tr>
                                <tr v-for="item in trucks"
                                    v-else
                                    :key="item.id"
                                    class="bg-white lg:hover:bg-gray-100 flex rounded-lg md:rounded-none  lg:table-row flex-row lg:flex-row flex-wrap lg:flex-no-wrap mb-10 lg:mb-0">
                                    <td
                                        class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                                        <span
                                            class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">
                                            Vehículo
                                        </span>

                                        <div class=" flex justify-center lg:justify-start items-center ">
                                            <div class="flex-shrink-0 h-9 w-9 rounded-full">
                                                <img :src="'/storage/'+item.photo_path"
                                                     class="h-9 w-9 rounded-full  flex items-center justify-center">
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm leading-5 font-medium text-gray-900">
                                                    {{ item.placa }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td
                                        class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                                <span
                                    class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">
                                   {{ columns[1].label }}
                                </span>

                                        {{ item.color }}
                                    </td>
                                    <td
                                        class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                                <span
                                    class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">
                                    {{ columns[2].label }}
                                </span>
                                        {{ item.modelo }}
                                    </td>
                                    <td
                                        class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                                <span
                                    class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">
                                    {{ columns[3].label }}
                                </span>
                                        {{ item.tipo_combustible }}
                                    </td>
                                    <td
                                        class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                                <span
                                    class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">
                                    {{ columns[4].label }}
                                </span>
                                        {{ item.rendimiento_estipulado }}
                                    </td>
                                    <td
                                        class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                                <span
                                    class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">
                                    {{ columns[5].label }}
                                </span>
                                        <inertia-link :href="route('trucks.edit',item.id)"
                                                      class="inline-flex items-center  p-1 border border-transparent text-sm leading-5 font-medium rounded-full text-blue-500 hover:bg-blue-100 focus:outline-none focus:shadow-outline-indigo focus:border-blue-700 active:bg-blue-700 active:text-white transition duration-150 ease-in-out h-8 w-8">

                                            <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                                                <path
                                                    d="M20.71,7.04C21.1,6.65 21.1,6 20.71,5.63L18.37,3.29C18,2.9 17.35,2.9 16.96,3.29L15.12,5.12L18.87,8.87M3,17.25V21H6.75L17.81,9.93L14.06,6.18L3,17.25Z"
                                                    fill="currentColor"/>
                                            </svg>

                                        </inertia-link>
                                        <inertia-link :href="route('trucks.preview',item.id)"
                                                      class="inline-flex items-center p-1 border border-transparent text-sm leading-5 font-medium rounded-full text-red-500  hover:bg-red-100 focus:outline-none focus:shadow-outline-red focus:border-red-700 active:bg-red-700 active:text-white transition duration-150 ease-in-out h-8 w-8">

                                            <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                                                <path
                                                    d="M19,4H15.5L14.5,3H9.5L8.5,4H5V6H19M6,19A2,2 0 0,0 8,21H16A2,2 0 0,0 18,19V7H6V19Z"
                                                    fill="currentColor"/>
                                            </svg>

                                        </inertia-link>
                                        <inertia-link :href="route('trucks.show',item.id)"
                                                      class="inline-flex items-center p-1 border border-transparent text-sm leading-5 font-medium rounded-full text-green-700 hover:bg-green-100 focus:outline-none focus:shadow-outline-green focus:border-green-700 active:bg-green-700 active:text-white transition duration-150 ease-in-out h-8 w-8">

                                            <svg style="width:24px;height:24px"
                                                 viewBox="0 0 24 24">
                                                <path
                                                    d="M18,10A1,1 0 0,1 17,9A1,1 0 0,1 18,8A1,1 0 0,1 19,9A1,1 0 0,1 18,10M12,10H6V5H12M19.77,7.23L19.78,7.22L16.06,3.5L15,4.56L17.11,6.67C16.17,7 15.5,7.93 15.5,9A2.5,2.5 0 0,0 18,11.5C18.36,11.5 18.69,11.42 19,11.29V18.5A1,1 0 0,1 18,19.5A1,1 0 0,1 17,18.5V14C17,12.89 16.1,12 15,12H14V5C14,3.89 13.1,3 12,3H6C4.89,3 4,3.89 4,5V21H14V13.5H15.5V18.5A2.5,2.5 0 0,0 18,21A2.5,2.5 0 0,0 20.5,18.5V9C20.5,8.31 20.22,7.68 19.77,7.23Z"
                                                    fill="currentColor"/>
                                            </svg>
                                        </inertia-link>
                                    </td>
                                </tr>
                                </tbody>
                            </datatable>
                            <pagination :pagination="pagination"
                                        @next="getTrucks(pagination.nextPageUrl)"
                                        @prev="getTrucks(pagination.prevPageUrl)">
                            </pagination>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout'
import Welcome from '@/Jetstream/Welcome'
import Datatable from '@/Pages/Datatable/Datatable.vue';
import Pagination from '@/Pages/Datatable/Pagination.vue';

export default {
    components: {
        AppLayout,
        Welcome,
        datatable: Datatable,
        pagination: Pagination
    },
    props: ['data', 'errors'],

    created() {
        this.getTrucks();
    },
    data() {
        let sortOrders = {};
        let columns = [
            {width: '16%', label: 'vehículo', name: 'photo_path'},
            {width: '16%', label: 'Color', name: 'color'},
            {width: '16%', label: 'Modelo', name: 'modelo'},
            {width: '16%', label: 'Combustible', name: 'tipo_combustible'},
            {width: '16%', label: 'Rendimiento', name: 'rendimiento_estipulado'},
            {width: '16%', label: 'Opciones', name: 'opciones'}
        ];
        columns.forEach((column) => {
            sortOrders[column.name] = -1;
        });
        return {
            trucks: [],
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
        }
    },
    methods: {
        getTrucks(url = '/trucks/datatable') {
            console.log(url)
            this.tableData.draw++;
            axios.post(url, this.tableData)
                .then(response => {
                    let data = response.data;
                    console.log(data)
                    if (this.tableData.draw == data.draw) {
                        this.trucks = data.data.data;
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
            this.getTrucks();
        },
        getIndex(array, key, value) {
            return array.findIndex(i => i[key] == value)
        },
    }
};
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
