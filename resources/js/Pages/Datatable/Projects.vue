<template>
    <div class="antialiased font-sans bg-gray-200">
        <div class="container mx-auto px-4 sm:px-8">
            <div class="py-8">
                <div>
                    <h2 class="text-2xl font-semibold leading-tight">Users</h2>
                </div>
                <div class="my-4 flex sm:flex-row flex-col justify-between items-center">
                    <div class="flex-1 pr-4">
                        <div class="flex flex-row mb-1 sm:mb-0">
                            <div class="relative">
                                <select
                                    class="appearance-none h-full  border block appearance-none w-full bg-white  text-gray-700 py-2 px-4 pr-8 leading-tight rounded-lg shadow focus:outline-none focus:shadow-outline text-gray-600 font-medium"
                                    v-model="tableData.length" @change="getProjects()">
                                    <option v-for="(records, index) in perPage" :key="index" :value="records">{{
                                            records
                                        }}
                                    </option>
                                </select>
                                <div
                                    class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                         viewBox="0 0 20 20">
                                        <path
                                            d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div>
                        <div class="relative">
                            <input type="search"
                                   v-model="tableData.search"
                                   @input="getProjects()"
                                   class="w-full pl-10 pr-4 py-2 rounded-lg shadow focus:outline-none focus:shadow-outline text-gray-600 font-medium"
                                   placeholder="Search...">
                            <div class="absolute top-0 left-0 inline-flex items-center p-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-400"
                                     viewBox="0 0 24 24"
                                     stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                                     stroke-linejoin="round">
                                    <rect x="0" y="0" width="24" height="24" stroke="none"></rect>
                                    <circle cx="10" cy="10" r="7"/>
                                    <line x1="21" y1="21" x2="15" y2="15"/>
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
                        <tr class="bg-white lg:hover:bg-gray-100 flex rounded-lg md:rounded-none  lg:table-row flex-row lg:flex-row flex-wrap lg:flex-no-wrap mb-10 lg:mb-0"
                            v-for="project in projects" :key="project.id">
                            <td
                                class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                                <span
                                    class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">
                                    Vehículo
                                </span>

                                <div class=" flex justify-center lg:justify-start items-center">
                                    <div class="  flex-shrink-0 h-9 w-9">
                                        <img class="h-9 w-9 rounded-full"
                                             :src="'/storage/'+project.photo_path"
                                             alt="">
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm leading-5 font-medium text-gray-900">
                                            {{ project.placa }}
                                        </div>
                                        <div class="text-sm leading-5 text-gray-500 ">
                                            {{ project.modelo }}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td
                                class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                                <span
                                    class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">
                                   {{columns[1].label}}
                                </span>

                                {{ project.color }}
                            </td>
                            <td
                                class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                                <span
                                    class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">
                                    {{columns[2].label}}
                                </span>
                                {{ project.modelo }}
                            </td>
                            <td
                                class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                                <span
                                    class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">
                                    {{columns[3].label}}
                                </span>
                                {{ project.tipo_combustible }}
                            </td>
                            <td
                                class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                                <span
                                    class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">
                                    {{columns[4].label}}
                                </span>
                            {{ project.rendimiento_estipulado }}
                            </td>
                            <td
                                class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                                <span
                                    class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">
                                    {{columns[5].label}}
                                </span>
                                <inertia-link :href="route('trucks.edit',project.id)"
                                              class="inline-flex items-center  p-1 border border-transparent text-sm leading-5 font-medium rounded-full text-blue-500 hover:bg-blue-100 focus:outline-none focus:shadow-outline-indigo focus:border-blue-700 active:bg-blue-700 transition duration-150 ease-in-out h-8 w-8">

                                    <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                                        <path fill="currentColor" d="M20.71,7.04C21.1,6.65 21.1,6 20.71,5.63L18.37,3.29C18,2.9 17.35,2.9 16.96,3.29L15.12,5.12L18.87,8.87M3,17.25V21H6.75L17.81,9.93L14.06,6.18L3,17.25Z" />
                                    </svg>

                                </inertia-link>
                                <inertia-link :href="route('trucks.preview',project.id)"
                                              class="inline-flex items-center p-1 border border-transparent text-sm leading-5 font-medium rounded-full text-red-500  hover:bg-red-100 focus:outline-none focus:shadow-outline-red focus:border-red-700 active:bg-red-700 transition duration-150 ease-in-out h-8 w-8">

                                    <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                                        <path fill="currentColor" d="M19,4H15.5L14.5,3H9.5L8.5,4H5V6H19M6,19A2,2 0 0,0 8,21H16A2,2 0 0,0 18,19V7H6V19Z" />
                                    </svg>

                                </inertia-link>
                                <inertia-link :href="route('trucks.show',project.id)"
                                              class="inline-flex items-center p-1 border border-transparent text-sm leading-5 font-medium rounded-full text-green-700 hover:bg-green-100 focus:outline-none focus:shadow-outline-green focus:border-green-700 active:bg-green-700 transition duration-150 ease-in-out h-8 w-8">

                                    <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                                        <path fill="currentColor" d="M13.5,4A1.5,1.5 0 0,0 12,5.5A1.5,1.5 0 0,0 13.5,7A1.5,1.5 0 0,0 15,5.5A1.5,1.5 0 0,0 13.5,4M13.14,8.77C11.95,8.87 8.7,11.46 8.7,11.46C8.5,11.61 8.56,11.6 8.72,11.88C8.88,12.15 8.86,12.17 9.05,12.04C9.25,11.91 9.58,11.7 10.13,11.36C12.25,10 10.47,13.14 9.56,18.43C9.2,21.05 11.56,19.7 12.17,19.3C12.77,18.91 14.38,17.8 14.54,17.69C14.76,17.54 14.6,17.42 14.43,17.17C14.31,17 14.19,17.12 14.19,17.12C13.54,17.55 12.35,18.45 12.19,17.88C12,17.31 13.22,13.4 13.89,10.71C14,10.07 14.3,8.67 13.14,8.77Z" />
                                    </svg>
                                </inertia-link>
                            </td>
                        </tr>
                        </tbody>
                    </datatable>
                    <pagination :pagination="pagination"
                                @prev="getProjects(pagination.prevPageUrl)"
                                @next="getProjects(pagination.nextPageUrl)">
                    </pagination>
                </div>

            </div>
        </div>

    </div>
</template>

<script>
import Datatable from './Datatable.vue';
import Pagination from './Pagination.vue';

export default {
    components: {datatable: Datatable, pagination: Pagination},
    created() {
        this.getProjects();
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
            projects: [],
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
        getProjects(url = '/trucks/datatable') {
            console.log(url)
            this.tableData.draw++;
            axios.post(url, this.tableData)
                .then(response => {
                    let data = response.data;
                    console.log(data)
                    if (this.tableData.draw == data.draw) {
                        this.projects = data.data.data;
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
            this.getProjects();
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
