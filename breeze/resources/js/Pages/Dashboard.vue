<template>
    <Head title="Dashboard" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        You're logged in!
                    </div>
                </div>

                <Select2 v-model="myValue" :options="myOptions" :settings="{ width: '60%', ajax: ajaxOptions }" @change="myChangeEvent($event)" @select="mySelectEvent($event)" />

            </div>
        </div>


    </BreezeAuthenticatedLayout>
</template>

<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue'
import { Head } from '@inertiajs/inertia-vue3';
import Select2 from 'vue3-select2-component';

export default {
    components: {
        BreezeAuthenticatedLayout,
        Head,
        Select2
    },
     data() {
        return {
            myValue: '',
            myOptions: {
                "results": [
                    {"id": 1, "text": "test"}
                ]
            },
             ajaxOptions: {
              url: "/countries",
              dataType: 'json',
              processResults: function (data) {
                  console.log(data);
                // Transforms the top-level key of the response object from 'items' to 'results'
                return {
                    results: data.map(item => ({"id": item.id, "text": item.name}))
                };
            }
          }
        }
    },
    methods: {
        myChangeEvent(val){
            console.log(val);
        },
        mySelectEvent({id, text}){
            console.log({id, text})
        }
    }
}
</script>
