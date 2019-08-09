<template>
    <div class="card mt-4">
        <div class="card-header"><h1>Notes</h1></div>

        <div class="card-body">
            {{ story.notes }}
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log(this.users)
        },
        methods: {
            // update(jscolor) {
            //     document.getElementById('rect').style.backgroundColor = '#' + jscolor
            // }
        },
        props: ['story'],
    }
</script>
