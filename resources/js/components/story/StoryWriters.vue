<template>
    <div class="card mt-4">
        <div class="card-header"><h1>Writers</h1></div>

        <div class="card-body">
            <li>
                {{ owner }}
            </li>

            <li v-for="user in users">
                {{ user.name }}
            </li>
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
        props: ['users', 'owner'],
    }
</script>
