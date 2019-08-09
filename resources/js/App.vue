<template>
    <div id="app" class="container">

        <my-vuetable v-bind:datadest="datadest"></my-vuetable>
    </div>
</template>

<script>
    import MyVuetable from './components/MyVuetable'

    export default {
        name: "App",
        props: ['datadest'],
        // data() {
        //     return {
        //         datadest: 'zxc'
        //     }
        // },
        components: {
            MyVuetable
        },
        mounted () {
            // Do something useful with the data in the template
            // console.log(datadest)
        }
    };
</script>

<style>
    #app {
        font-family: "Avenir", Helvetica, Arial, sans-serif;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
        color: #2c3e50;
        margin-top: 20px;
    }
</style>
