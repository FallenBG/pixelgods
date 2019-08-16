<template>
    <div class="row mt-12">
        <div class="col-md-3">
            {{ name }}
        </div>
        <div class="col-md-9">
            {{ value }}
        </div>
    </div>
</template>

<script>
    export default {
        props: ['name', 'value'],

        // data() {
        //     return {
        //         name: this.prop,
        //         value: this.story[this.prop+'ed'],
        //         url: '/story/'+this.story.id+'/updateFinishPublish',
        //         editing: this.story[this.prop+'ed'],
        //     };
        // },
        //
        // methods: {
        //     update() {
        //         axios.patch(this.url, {
        //             name: this.name+'ed',
        //             value: !this.value
        //         });
        //     },
        //
        //     jsUcfirst(string)
        //     {
        //         return string.charAt(0).toUpperCase() + string.slice(1);
        //     },
        // },
    }
</script>
