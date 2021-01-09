<template>
    <div>
        <table id="example"
               class="w-full flex flex-row flex-no-wrap rounded-none sm:rounded-t-lg  overflow-hidden table-auto">
            <thead>

            <tr>
                <th v-for="(column,n) in columns" :key="column.name" @click="$emit('sort', column.name)"
                    class="p-3 font-bold text uppercase border-b-2 border-gray-200 bg-gray-100 text-gray-600 hidden lg:table-cell flex sm:flex-row flex-col justify-between items-center w-1/7 "
                    :class="sortKey === column.name ? (sortOrders[column.name] > 0 ? 'sorting_asc' : 'sorting_desc') : 'sorting'"
                    :style="'width:'+column.width+';'+'cursor:pointer;'">
                    <div class="relative ">

                        <div class="absolute inset-y-0 left-0 flex items-center justify-center pointer-events-none ">
                          <span class="text-gray-500 sm:text-sm">
                            <svg style="width:14px;height:14px" viewBox="0 0 24 24">
                                <path fill="currentColor"
                                      d="M18 21L14 17H17V7H14L18 3L22 7H19V17H22M2 19V17H12V19M2 13V11H9V13M2 7V5H6V7H2Z"/>
                            </svg>
                          </span>
                        </div>

                        <span class=" block w-full mr-2 ">
                           {{ column.label }}
                        </span>
                    </div>


                </th>
            </tr>
            </thead>

            <slot></slot>
        </table>
    </div>
</template>

<script>
export default {
    props: ['columns', 'sortKey', 'sortOrders']
}
</script>

