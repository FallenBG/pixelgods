<template>
    <div class="card mt-4">
        <div class="card-header"><h1>Notes</h1></div>

        <div class="card-body">

            <div v-if="editing">
                <textarea cols="30" rows="20" v-model="note"></textarea>
            </div>

            <div v-else v-text="note"></div>
        </div>

        <div class="card-footer" v-if="edit">
            <button v-if="!editing"
                    type="submit"
                    class="btn btn-primary btn-lg float-right width30p ml-3"
                    @click="editing = true">Update</button>
            <button v-if="editing"
                    type="submit"
                    class="btn btn-primary btn-lg float-right width30p ml-3"
                    @click="update">Save</button>
            <button v-if="editing"
                    ype="submit"
                    class="btn btn-primary btn-lg float-right width30p"
                    @click="editing = false">Cancle</button>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            // console.log(this.users)
        },
        methods: {
            update() {
                console.log('asd');
                axios.patch('/story/'+this.story.id+'/updateNote', {
                    notes: this.note
                });
                this.editing = false;
            }
        },
        props: ['story', 'edit'],
        data() {
            return {
                editing: false,
                note: this.story.notes
            };
        }
    }
</script>
