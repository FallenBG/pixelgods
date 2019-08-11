<template>
    <div class="card mt-4">
        <div class="card-header"><h1>Story Chat</h1></div>

        <div class="card-body">
            <div class="scroll-box scroll-box-chat" id="chatBox" style="border:1px solid gray;" v-model="chatBox">
                <ul class="chat">
                    <li class="left clearfix" v-for="message in messages">
                        <div class="chat-body clearfix">
                            <div class="header">
                                <strong class="primary-font">
                                    {{ message.user.name }}
                                </strong>
                            </div>
                            <p>
                                {{ message.message }}
                            </p>
                        </div>
                    </li>
                </ul>
            </div>

            <div class="input-group">
                <input id="btn-input" type="text" name="message" class="form-control input-sm"  v-model="newMessage" @keyup.enter="sendMessage">

                <span class="input-group-btn">
                    <button class="btn btn-primary btn-sm" id="btn-chat" @click="sendMessage">
                        Send
                    </button>
                </span>
            </div>
            <!--<input class="form-control mt-2" ref="message" v-model="message" @keyup.enter="send()">-->
            <!--<button type="button" class="btn btn-primary btn-sm float-right mt-1" @click.prevent="send()">Send</button>-->

        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            setTimeout(this.scrollToBottom, 1000);

        },

        created() {

            this.fetchMessages();
            console.log('chat.'+this.story.id);

            Echo.join('chat.'+this.story.id)
                .here(users => (this.users = users))
                .joining(user => this.users.push(user))
                .leaving(user => (this.users = this.users.filter(u => (u.id !== user.id))))
                .listen('ChatEvent', (e) => {
                    console.log('event triggered');
                    this.messages.push({
                        message: e.message.message,
                        user: e.user
                    });

                    setTimeout(this.scrollToBottom, 10);
                });
        },

        methods: {
            scrollToBottom() {
                $("#chatBox").scrollTop($("#chatBox")[0].scrollHeight);
            },

            sendMessage() {
                this.$emit('ChatEvent', {
                    user: this.user,
                    message: this.newMessage
                });

                this.send();
                this.messages.push({
                    message: this.newMessage,
                    user: this.user
                });

                this.newMessage = '';

                setTimeout(this.scrollToBottom, 10);


            },

            fetchMessages() {
                axios.get('/story/'+this.story.id+'/chat').then(response => {
                    this.messages = response.data;
                });
            },

            send() {

                console.log(this.user.id);
                console.log(this.newMessage);

                // message = this.$refs.message.value;
                // chatId = this.$refs.chatId.value;
                let url = '/story/'+this.story.id+'/chat';
                // return;
                return new Promise((resolve, reject) => {
                    // axios[requestType](url, this.data())
                    axios['post'](url, {'message': this.newMessage, 'user_id': this.user.id, 'story_id': this.story.id})
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
                // console.log(data);

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
                chatBox: '',
                newMessage: '',
                messages: []
            }
        },
    }
</script>
