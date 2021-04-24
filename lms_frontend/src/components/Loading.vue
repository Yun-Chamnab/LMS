<template>
    <div>
      <div class="loading">
            <loading 
                :active.sync="isLoading" 
                :is-full-page="fullPage"
                loader= "dots"
                background-color="rgba(255, 255, 255, 5)"
                :width=40
                :height=40
                >
                <div v-if="myLoading">
                    <CustomLoading />
                </div>
            </loading>
        </div>
        <div v-if ="visible">
            <v-card>
                <v-snackbar
                    v-model="visible"
                    :bottom="y === 'bottom'"
                    :color="color"
                    :left="x === 'left'"
                    :multi-line="mode === 'multi-line'"
                    :right="x === 'right'"
                    :timeout="timeout"
                    :auto-width="true"
                    :top="y === 'top'"
                    :vertical="mode === 'vertical'"
                >
                    {{ alertText }}
            
                    <template v-slot:action="{ attrs }">
                    <v-btn
                        dark
                        text
                        v-bind="attrs"
                        @click="alertMessage = false"
                    >
                        Close
                    </v-btn>
                    </template>
                </v-snackbar>
            </v-card>
        </div>
    </div>
</template>

<script>
    // Import component
    import Loading from 'vue-loading-overlay';
    // Import stylesheet
    import 'vue-loading-overlay/dist/vue-loading.css';
    import CustomLoading from './CustomLoading'
    
    export default {
        props:[
            'isLoading',
            'fullPage',
            'myLoading',
            'alertMessage',
            'color',
            'alertText'
        ],
        name: 'LoadingMe',
        data() {
            return {
              mode: '',
              snackbar: true,
              visible : false,
              text: 'Success',
              timeout: 6000,
              x: 'right',
              y: 'top',
            }
        },
        components: {
            Loading,
            CustomLoading
        },
        methods:{
         
        },
        watch: {
             alertMessage () {
                this.visible = this.alertMessage
            }
        },
    }
</script>
<style scoped>

 .vld-overlay{
     transition: 0.4s ease-in !important;
 }
</style>