<template>
    <button class="btn-lg btn-primary float-right w-50" type="button" id="finished" name="finished"
            data-toggle="tooltip" data-placement="left"
            title="Finishing a story will close it for further additions and will allow you to Publish it."
            @click="update()">
        <p v-if="editing" @click="editing = 0">Un{{ this.name }} the Story</p>
        <p v-else @click="editing = 1">{{ jsUcfirst(this.name) }} the story</p>
    </button>
</template>

<script>
    export default {
        props: ['story', 'prop'],

        data() {
            return {
                name: this.prop,
                value: this.story[this.prop+'ed'],
                url: '/story/'+this.story.id+'/updateFinishPublish',
                editing: this.story[this.prop+'ed'],
            };
        },

        methods: {
            update() {
                axios.patch(this.url, {
                    name: this.name+'ed',
                    value: !this.value
                });
            },

            jsUcfirst(string)
            {
                return string.charAt(0).toUpperCase() + string.slice(1);
            },
        },
    }
</script>
