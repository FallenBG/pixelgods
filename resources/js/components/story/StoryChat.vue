<template>
    <div class="card mt-4">
        <div class="card-header"><h1>Story Chat</h1></div>

        <div class="card-body">
            <div class="scroll-box scroll-box-chat" id="chatBox" style="border:1px solid gray;" v-model="chatBox">
                <p v-for="chat in chats">
                    <b>{{ chat.user.name }}: </b>
                    {{ chat.message }}
                </p>
            </div>

            <input class="form-control mt-2" ref="message" v-model="message" @keyup.enter="send()">
            <button type="button" class="btn btn-primary btn-sm float-right mt-1" @click.prevent="send()">Send</button>

        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            setTimeout(function () {
                $("#chatBox").scrollTop($("#chatBox")[0].scrollHeight);
            }, 1000);

        },
        methods: {
            refresh() {

                console.log('asd');
            },
            send() {

                console.log(this.user.id);
                console.log(this.message);

                // message = this.$refs.message.value;
                // chatId = this.$refs.chatId.value;
                let url = '/story/'+this.story.id+'/chat';
                // return;
                return new Promise((resolve, reject) => {
                    // axios[requestType](url, this.data())
                    axios['post'](url, {'message': this.message, 'user_id': this.user.id, 'story_id': this.story.id})
                        .then(response => {
                            this.onSuccess(response.data);

                            resolve(response.data);
                        })
                        .catch(error => {
                            this.onFail(error.response.data);

                            reject(error.response.data);
                        })
                    // .catch(this.onFail.bind(this))
                    // .catch(error => this.errors.record(error.response.data.errors));
                });
            },

            onSuccess(data) {
                console.log(data);

            // <p>
            //         <b>{{ chat.user.name }}: </b>
            //     {{ chat.message }}
            // </p>
                // this.errors.clear();
                // this.reset();
            },

            onFail(errors) {
                alert('fail');

                // this.errors.record(errors.errors);
            }
        },
        props: ['user', 'story', 'chats'],
        data() {
            return {
                message: '',
                chatId: '',
                chatBox: ''
            }
        },
    }
</script>
